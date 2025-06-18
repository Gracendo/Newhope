<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin-dash') || $request->is('admin-dash/*')) {
                return route('admin.login');
            }
            if ($request->is('user-dash') || $request->is('user-dash/*')) {
                return route('user.login');
            }
            return route('user.login');
        }
    }
}
