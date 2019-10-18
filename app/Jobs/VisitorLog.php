<?php
namespace App\Jobs;
use Exception;
use App\Services\VisitorInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repository\VisitorLogInterface;
use Illuminate\Support\Facades\Log;
class VisitorLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $visitorInfo;
    protected $VisitorLogInterface;
    protected $ipAddress;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( VisitorLogInterface $VisitorLogInterface,$ipAddress)
    {
        $this->ipAddress=$ipAddress;
        $this->visitorInfo =  new visitorInfo();
        $this->VisitorLogInterface=$this->VisitorLogInterface = app()->make('App\Repository\VisitorLogInterface');
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $visitorApiData =  $this->visitorInfo->visitorsIp($this->ipAddress);
        $dbLogData=$this->VisitorLogInterface->getAll()->where('ip_address',$this->ipAddress)->first()->toArray();
        $this->VisitorLogInterface->update($dbLogData['id'],
                   array(
                    'country'               =>$visitorApiData['country'],
                    'country_code'          =>$visitorApiData['country_code'],
                    'region'                =>$visitorApiData['region'],
                    'region_code'           =>$visitorApiData['region_code'],
                    'city'                  =>$visitorApiData['city'],
                    'time_zone'             =>$visitorApiData['time_zone'],
                    'latitude'              =>$visitorApiData['latitude'],
                    'longitude'             =>$visitorApiData['longitude'],
                    'isp'                   =>$visitorApiData['organisation'],
                    'flagurl'               =>$visitorApiData['flagurl'],
                    'currencysymbol'        =>$visitorApiData['currencysymbol'],
                    'currency'              =>$visitorApiData['currency'],
                    'callingcode'           =>$visitorApiData['callingcode'],
                    'countrycapital'        =>$visitorApiData['countrycapital'],
                   )
                );
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