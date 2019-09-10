<?php

namespace App\Services;

Class VisitorInfo
{
	public function visitorsIp(){
		$serverinfo = $this->getServerInfo();
		// print_r($serverinfo);exit;
		// $ip ='27.34.25.94'; //$_SERVER['REMOTE_ADDR'];
		if($serverinfo['clientip']){
			$ip_api = json_decode(file_get_contents("http://ip-api.io/json/{$serverinfo['clientip']}"));
			if($ip_api && !$ip_api->status_message){
				$data = array(
						'ip_address' 			=>$serverinfo['clientip'],
						'country_code' 			=>$ip_api->country_code,
						'country'				=>$ip_api->country_name,
						'region'				=>$ip_api->region_name,
						'region_code' 			=>$ip_api->region_code,
						'city'					=>$ip_api->city,
						'useragent'				=>$serverinfo['useragent'],
						'refererurl'			=>$serverinfo['refererurl'],
						'path'              	=>$serverinfo['path'],
						'time_zone'				=>$ip_api->time_zone,
						'latitude' 				=>$ip_api->latitude,
						'longitude'				=>$ip_api->longitude,
						'organisation'			=>$ip_api->organisation,
						'flagurl' 				=>$ip_api->flagUrl,
						'emojiflag'				=>$ip_api->emojiFlag,
						'currencysymbol'		=>$ip_api->currencySymbol,
						'currency'				=>$ip_api->currency,
						'callingcode'			=>$ip_api->callingCode,
						'countrycapital'		=>$ip_api->countryCapital,
					);
			}else{
				$plugin = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$serverinfo['clientip']}"));
				$data = array(
						'ip_address' 			=>$serverinfo['clientip'],
						'country_code' 			=>$plugin->geoplugin_countryCode,
						'country'				=>$plugin->geoplugin_countryName,
						'region'				=>$plugin->geoplugin_regionName,
						'region_code' 			=>$plugin->geoplugin_regionCode,
						'city'					=>$plugin->geoplugin_city,
						'useragent'				=>$serverinfo['useragent'],
						'refererurl'			=>$serverinfo['refererurl'],
						'path'              	=>$serverinfo['path'],
						'time_zone'				=>$plugin->geoplugin_timezone,
						'latitude' 				=>$plugin->geoplugin_latitude,
						'longitude'				=>$plugin->geoplugin_longitude,
						'organisation'			=>'',
						'flagurl' 				=>'',
						'emojiflag'				=>'',
						'currencysymbol'		=>$plugin->geoplugin_currencySymbol,
						'currency'				=>$plugin->geoplugin_currencyCode,
						'callingcode'			=>$plugin->geoplugin_areaCode,
						'countrycapital'		=>'',
					);
			}
			return $data;
		}
	}
	public function getServerInfo(){
		$device = '';
        $useragent = $_SERVER['HTTP_USER_AGENT']; 
        $iPod    = stripos( $useragent,"iPod");
        $iPhone  = stripos( $useragent,"iPhone");
        $iPad    = stripos( $useragent,"iPad");
        $Android = stripos( $useragent,"Android");
        $mac   = stripos( $useragent,"mac");
        $mobile   = stripos( $useragent,"mobile");
        $linux   = stripos( $useragent,"linux");
        $windows   = stripos( $useragent,"windows");
        if( $iPod || $iPhone ){
            $device = 'Ipod';
        }else if($iPad){
            $device = 'IPad';
        }else if($Android){
            $device = 'Android';
        }else if($mobile){
            $device = 'Mobile';
        }else if($mac){
            $device = 'Mac';
        }else if($linux){
            $device = 'Linux';
        }else if($windows){
            $device = 'Windows';
        }
	    if ($_SERVER==='HTTP_REFERER') {
	    	$reff = $_SERVER['HTTP_REFERER'];
	    }else{
	    	$reff = '';
		}
        $server = array(
                    'clientip'          =>$_SERVER['REMOTE_ADDR'],
                    'servername'        =>$_SERVER['SERVER_NAME'],
                    'method'            =>$_SERVER['REQUEST_METHOD'],
                    'path'              =>$_SERVER['PATH_INFO'],
                    'host'				=>$_SERVER['HTTP_HOST'],
                    'requesturl'        =>$_SERVER['REQUEST_URI'],
                    'refererurl'        =>$reff,
                    'useragent'         =>$device,
        );
        return $server;
	}
}