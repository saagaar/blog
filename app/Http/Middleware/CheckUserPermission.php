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

         /**
         *Check the route request to find permission
         *
         * @return boolean
         */
        $previous=(url()->previous());
        $getpermission=$this->AdminPermission->checkAdminPermission();
        if($getpermission)
        {
            return $next($request);
        }
        else if($previous)
        {
            return redirect($previous)->withError('You are not Authorized to enter to this url!!');
        }
        else
        {
            //Redirect to where it came from
             return redirect('/admin/dashboard');
        }
    }
}
