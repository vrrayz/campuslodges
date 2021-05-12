<?php

namespace App\Http\Middleware;

use App\Lodge;
use App\Property;
use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //        Do a routine check for any expired lodge every time this middleware is called
        $lodges = Lodge::all();
        foreach ($lodges as $lodge) {
            if (time() >= $lodge->expiry_time) {
                $lodge->update([
                    'availability' => 'expired'
                ]);
            }
        }
        //        Do a routine check for any expired lodge every time this middleware is called
        $properties = Property::all();
        foreach ($properties as $property) {
            if (time() >= $property->expiry_time) {
                $property->update([
                    'availability' => 'expired'
                ]);
            }
        }
        if (auth()->user()->is_admin == 1) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Access Denied');
    }
}
