<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // 1. Admin (role 1) has access to all admin routes.
        if ($user->role === 1) {
            return $next($request);
        }

        // 2. Editor (role 2) has access to Dashboard, Articles, Categories, Tags, and Manual Authors.
        if ($user->role === 2) {
            if ($request->is('admin') || 
                $request->is('admin/articles*') || 
                $request->is('admin/categories*') || 
                $request->is('admin/tags*') ||
                $request->is('admin/manual-authors*') ||
                $request->is('admin/categories/search') ||
                $request->is('admin/tags/search')) {
                return $next($request);
            }
        }

        // 3. Journalist (role 3) has access to Dashboard, Articles, and Manual Authors.
        if ($user->role === 3) {
            if ($request->is('admin') || 
                $request->is('admin/articles*') ||
                $request->is('admin/manual-authors*')) {
                return $next($request);
            }
        }

        // Default: block access for regular users (role 0) and any other unauthorized route
        abort(403, 'Unauthorized.');
    }
}
