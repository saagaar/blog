<?php 

namespace App\Repository\Siteoptions;

use App\Models\SiteOptions;
use App\Repository\SiteoptionsInterface;

Class  SiteOption implements SiteoptionsInterface
{
	protected $sitesettings;

	public function __construct(SiteOptions $sitesettings)
	{
		  $this->sitesettings=$sitesettings;
	}
  public function GetSiteInfo()
  {
      return	$this->sitesettings->latest()->first();
  }

  public function update( array $data)
  {
      $id=1;
      // $data=$this->sitesettings->latest()->first();
      // print_r($data); exit;
      return	$this->sitesettings->find($id)->update($data);
  }
}
?>