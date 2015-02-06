<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/6/15
 * Time: 12:27 PM
 */

namespace TGL\Core\Http\Middleware;


use Illuminate\Contracts\Auth\Guard;

class IsAdminMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->is_admin != 1)
        {
            $this->auth->logout();
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}