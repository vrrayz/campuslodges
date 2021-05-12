<?php

namespace App\Http\Middleware;

use Closure;

class CheckAgentValidation
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
        if (auth()->user()->is_agent == 1 && auth()->user()->kyc->is_validated == 1) {
            return $next($request);
        }

        return redirect('/user/account/index')->with('v_agent_error', 'You need to verify your account as an agent');
    }
}
