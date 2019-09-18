<?php

namespace App\Jobs;
use Exception;
use App\Services\VisitorInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repository\UserlogInterface;
use Illuminate\Support\Facades\Log;

class VisitorLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $visitorInfo;

    protected $userLogInterface;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( UserlogInterface $userLogInterface,$ipAddress)
    {
        
        $this->visitorInfo =  new visitorInfo();
        $this->userLogInterface=$this->UserlogInterface = app()->make('App\Repository\UserlogInterface');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $serverdata =  $this->visitorInfo->visitorsIp();
        date_default_timezone_set('Asia/Kathmandu');
        $dblogdata=$this->userLogInterface->getLogbyIpAddressAndURL($serverdata['ip_address'],$serverdata['path']);

       if($dblogdata && (trim($dblogdata['details'])!='')){

            $start = date_create($dblogdata['details']->visit_date);
        $end = date_create(date("Y-m-d H:i:s"));
        $diff=date_diff($end,$start);
        
        if((($dblogdata['ip']->ip_address==$serverdata['ip_address'])  && ($dblogdata['details']->redirected_to!=$serverdata['path'])) || ( ($dblogdata['ip']->ip_address==$serverdata['ip_address'])  && ($dblogdata['details']->redirected_to==$serverdata['path']) && ($diff->i>10)) ){
            $logdata = array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
                $dblogdata['ip']->logdetails()->create($logdata);
            }
        }
        else{
            $logdata = array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
            $logcreate= $this->userLogInterface->create(
                   array(
                     'ip_address'           =>$serverdata['ip_address'],
                    'country'               =>$serverdata['country'],
                    'country_code'          =>$serverdata['country_code'],
                    'region'                =>$serverdata['region'],
                    'region_code'           =>$serverdata['region_code'],
                    'city'                  =>$serverdata['city'],
                    'time_zone'             =>$serverdata['time_zone'],
                    'latitude'              =>$serverdata['latitude'],
                    'longitude'             =>$serverdata['longitude'],
                    'isp'                   =>$serverdata['organisation'],
                    'flagurl'               =>$serverdata['flagurl'],
                    'currencysymbol'        =>$serverdata['currencysymbol'],
                    'currency'              =>$serverdata['currency'],
                    'callingcode'           =>$serverdata['callingcode'],
                    'countrycapital'        =>$serverdata['countrycapital'],
                   )
                );
            $logcreate->logdetails()->create($logdata);
        }
    }
    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
       // Log::
    }
}
