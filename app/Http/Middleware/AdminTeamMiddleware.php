<?php

namespace App\Http\Middleware;

use Closure;

class AdminTeamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!$request->user()->isTeamAdmin()) {
                return redirect(route('home'))->with('error', true)->with('message', 'You do not have access to view this page.');
            }
        } catch (\ErrorException $ee) {
            return redirect(route('setup@createTeam'));
        } catch (\Exception $e) {
            return redirect(route('setup@createTeam'));
        }
        return $next($request);
    }
}
