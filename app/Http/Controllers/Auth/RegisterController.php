<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{Admin, Orphanage, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Validator, Log, Auth};

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        Log::info('Showing registration form');
        return view('frontend.signup');
    }

    protected function validator(array $data)
    {
        Log::debug('Validating registration data', ['email' => $data['email']]);
        
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username|unique:admins,username',
            'email' => 'required|string|email|max:255|unique:users|unique:admins',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:contributor,orphanagemanager',
        ];

        if ($data['status'] === 'orphanagemanager') {
            $rules = array_merge($rules, [
                'orphanage_name' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'orphanage_address' => 'required|string|max:255',
                'longitude' => 'required|numeric|between:-180,180',
                'latitude' => 'required|numeric|between:-90,90',
                'num_enregistrement' => 'required|string|max:255',
                'description' => 'required|string',
                'orphanage_email' => 'required|email',
                'orphanage_phone' => 'required|string|max:20',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }

        return Validator::make($data, $rules);
    }

    public function register(Request $request)
    {
        try {
            Log::info('Registration attempt', ['email' => $request->email]);
            
            $validator = $this->validator($request->all());
            
            if ($validator->fails()) {
                Log::warning('Validation failed', ['errors' => $validator->errors()]);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = $this->create($request->all());
            Log::info('User created successfully', ['user_id' => $user->id]);

            Auth::login($user); // Auto-login after registration
            
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
                
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }

    protected function create(array $data)
    {
        if ($data['status'] === 'contributor') {
            Log::debug('Creating contributor user');
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
            Log::debug('Creating orphanage manager');
            $admin = Admin::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
                'role' => 'orphanagemanager',
                'status' => 'pending', // Set to pending until admin approval
            ]);

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

    protected function registered(Request $request, $user)
{
    LOG::info('sending email');
    $user->sendEmailVerificationNotification();
    LOG::info(' Email sent');
    
    return redirect()->route('verification.notice');
}
}