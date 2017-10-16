<?php

namespace App\Http\Middleware;

use Closure;

class SetupMiddleware
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
        //try {
            if (!$request->user()->hasCompletedSetup()) {
                return redirect(route('setup@createTeam'))->with('error', true)->with('message', 'You must complete the setup form.');
            }
        /*} catch (\ErrorException $ee) {
            return redirect(route('setup@createTeam'));
        } catch (\Exception $e) {
            return redirect(route('setup@createTeam'));
        }*/
        return $next($request);
    }
}
