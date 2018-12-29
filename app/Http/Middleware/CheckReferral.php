<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use App\User;

class CheckReferral
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
        $response = $next($request);
        $ref_code = $request->query('ref_code');

        //TODO:: show user the referral id is invalid
        
        if(! $request->hasCookie('ref_code') && User::isReferralIdValid($ref_code) )
        {
            $response->cookie('ref_code', encrypt($ref_code), 43800); // last for one month
            return $response;
        }

        return $response;
    }
}
