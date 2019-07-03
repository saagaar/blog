<?php

namespace App\Http\Middleware;

use App\Services\AdminPermissionCheck;

use Closure;

class CheckUserPermission
{
    /**
    * Admin permission Global variable
    * @var Object
    */
    protected $AdminPermission;

    /**
     * constructor function
     *
     * @param  \App\Services\AdminPermissionCheck  $adminpermission
     * @param  \Closure  $next
     * @return mixed
     */    
    public function __construct(AdminPermissionCheck $adminpermission)
    {
        $this->AdminPermission=$adminpermission;
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
        
        $this->AdminPermission->check();
        return $next($request);
    }
}
