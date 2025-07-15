<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateCustomer extends Middleware
{
    /**
     * Specify the guard to use for customer routes.
     */
    protected function authenticate($request, array $guards)
    {
        // Force use of the 'customer' guard
        $this->auth->shouldUse('customer');

        parent::authenticate($request, ['customer']);
    }

    /**
     * Redirect unauthenticated users to the customer login page.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('signin'); // Make sure this route exists
        }
    }
}
