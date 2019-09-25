<?php 

namespace App\Repository\SiteOption;

use App\Models\SiteOptions;
use App\Repository\SiteoptionInterface;

Class  SiteOption implements SiteoptionInterface
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
      $id=1;
      return	$this->siteSettings->find($id)->update($data);
  }
}
?>