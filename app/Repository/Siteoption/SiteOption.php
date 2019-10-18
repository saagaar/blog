<?php 

namespace App\Repository\SiteOption;
use Illuminate\Contracts\Cache\Factory;
use App\Models\SiteOptions;
use App\Repository\SiteoptionInterface;

Class SiteOption implements SiteoptionInterface
{
	protected $siteSettings;

	public function __construct(SiteOptions $siteSettings)
	{
		  $this->siteSettings=$siteSettings;
	}
  public function getSiteInfo()
  {
      return	$this->siteSettings->latest()->first();                                                                                                            
  }

  public function update( array $data)
  {
    //to remove cache set for config  in SettingsService provider
      $cache=app()->make('Illuminate\Contracts\Cache\Factory');
      $cache->forget('settings');
      $id=1;
      return	$this->siteSettings->find($id)->update($data);
  }
}
?>