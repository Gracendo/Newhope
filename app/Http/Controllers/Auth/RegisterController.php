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

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
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
                'longitude' => ['required', 'numeric'],
                'latitude' => ['required', 'numeric'],
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

        if ($user instanceof Admin) {
            auth('admin')->login($user);

            return redirect('/pending-approval');
        }

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
