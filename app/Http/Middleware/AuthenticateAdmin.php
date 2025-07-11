<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAdmin extends Middleware
{
    /**
     * Specify the guard to use for admin routes.
     */
    protected function authenticate($request, array $guards)
    {
        // Force use of the 'admin' guard
        $this->auth->shouldUse('admin');

        parent::authenticate($request, ['admin']);
    }

    /**
     * Redirect unauthenticated users to the admin login page.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('authentication.index'); // Make sure this route exists
        }
    }
}
