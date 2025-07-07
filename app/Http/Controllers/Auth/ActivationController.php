<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;

class ActivationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('activation_token', $token)->first();

        if ($user) {
            $user->is_active = true;
            $user->activation_token = null;
            $user->save();

            return redirect()->route('user.login')->with('status', 'Votre compte a été activé. Vous pouvez maintenant vous connecter.');
        }

        // Sinon, cherche chez les administrateurs
        $admin = Admin::where('activation_token', $token)->first();

        if ($admin) {
            $admin->is_active = true; // ou 'validated', selon ta logique
            $admin->activation_token = null;
            $admin->save();

            return redirect()->route('admin.login')->with('status', 'Votre compte administrateur a été activé. Vous pouvez maintenant vous connecter.');
        }

        // Si rien trouvé
        abort(404);
    }

}
