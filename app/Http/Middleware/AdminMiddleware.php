<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next)
    {
        //dd($this->auth->getUser()->email);
        if ($this->auth->getUser()->group === null){
            return redirect('authproblem');
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
