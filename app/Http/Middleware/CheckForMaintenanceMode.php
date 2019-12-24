<?php

namespace App\Http\Middleware;
use App\Models\SiteOptions;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Symfony\Component\HttpFoundation\Session\Session;
use Closure;
use Illuminate\Support\Facades\Route;
class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */

    protected $app;

    protected $except = [
        //
    ];
    public function __construct(Application $app,SiteOptions $siteOptions)
    {
        $this->app = $app;
        $this->settings=$siteOptions;
    }
    public function handle($request, Closure $next)
    {
    	     $data['time']=10;
	         $data['retry']=10;
	         $data['message']='Sorry we are down';
           $session = new Session();
           $route = Route::getRoutes()->match($request);
            $currentroute = $route->getName();

           // print_r($request->post('maintainence_code'));exit;
	         if($request->post('maintainence_code'))
	         {
              $session->set('maintainence_code', $request->post('maintainence_code'));
	         }
         $maintainence_code= $session->get('maintainence_code');

       	if($this->settings->first()->mode=='1' || $maintainence_code==$this->settings->first()->maintainence || $currentroute=='newsletter')
       	{
       	 return $next($request);
       	}
       		throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
    }
}
