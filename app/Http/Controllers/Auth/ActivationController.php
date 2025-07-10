<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;

class ActivationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('activation_token', $token)->first();

        if ($user) {
            $user->is_active = true;
            $user->activation_token = null;
            $user->save();

            return redirect()->route('user.login')->with('status', 'Your account has been activated. Start creating change today !');
        }

        // Sinon, cherche chez les administrateurs
        $admin = Admin::where('activation_token', $token)->first();

        if ($admin) {
            $admin->is_active = true; // ou 'validated', selon ta logique
            $admin->activation_token = null;
            $admin->save();

            return redirect()->route('admin.login')->with('status', 'Your orphanage manager account has been successfully created and is currently pending approval.');
        }

        // Si rien trouvé
        abort(404);
    }
}
