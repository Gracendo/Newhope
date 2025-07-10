<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Orphanage;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('frontend.signup');
    }

    protected function validator(array $data)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username', 'unique:admins,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:admins'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => ['required', 'in:contributor,orphanagemanager'],
        ];

        // Add orphanage validation rules if status is orphanagemanager
        if (isset($data['status']) && $data['status'] === 'orphanagemanager') {
            $orphanageRules = [
                'orphanage_name' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'orphanage_address' => ['required', 'string', 'max:255'],
                'longitude' => ['required', 'numeric', 'between:-180,180'],
                'latitude' => ['required', 'numeric', 'between:-90,90'],
                'num_enregistrement' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'orphanage_email' => ['required', 'email'],
                'orphanage_phone' => ['required', 'string', 'max:20'],
                'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ];
            $rules = array_merge($rules, $orphanageRules);
        }

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        if ($data['status'] === 'contributor') {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
                'status' => 'contributor',
                'activation_token' => Str::random(60),
            ]);
        } else {
            // Handle orphanage manager registration
            $admin = Admin::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
                'role' => 'orphanagemanager',
                'status' => 'pending',
                'activation_token' => Str::random(60),
            ]);

            // Handle logo upload
            $logoPath = null;
            if (isset($data['logo'])) {
                $logoPath = $data['logo']->store('orphanage_logos', 'public');
            }

            // Create orphanage record
            Orphanage::create([
                'admin_id' => $admin->id,
                'name' => $data['orphanage_name'],
                'country' => $data['country'],
                'city' => $data['city'],
                'address' => $data['orphanage_address'],
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
                'num_enregistrement' => $data['num_enregistrement'],
                'description' => $data['description'],
                'email' => $data['orphanage_email'],
                'phone' => $data['orphanage_phone'],
                'orphanage_id' => 'ORP'.str_pad($admin->id, 5, '0', STR_PAD_LEFT), // Génère l'ID custom de type ORP00001
                'logo' => $logoPath,
                'region' => $data['region'] ?? null,
            ]);

            return $admin;
        }
    }

    // Override the default registration to handle different user types

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Force logout if accidentally logged in
        auth()->logout();

        // Send appropriate activation email based on user type
        if ($user instanceof Admin) {
            // Send admin activation email to orphanage email address
            Mail::to($user->email)->send(new \App\Mail\ActivationOMEmail($user));

            // Also send notification to orphanage's contact email if different
            if (isset($request->orphanage_email) && $request->orphanage_email !== $user->email) {
                Mail::to($request->orphanage_email)->send(new \App\Mail\ActivationOMEmail($user));
            }

            return redirect('/pending-approval')
                ->with('status', 'Your registration is pending approval. You will receive an activation email once approved.');
        } else {
            // Send regular user activation email
            Mail::to($user->email)->send(new \App\Mail\ActivationEmail($user));

            return redirect()->route('user.login')
                ->with('status', 'An activation email has been sent to you. Please check your inbox.');
        }
    }
}
