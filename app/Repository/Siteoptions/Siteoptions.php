<?php 

namespace App\Repository\Siteoptions;

use App\Models\SiteOptions;
use App\Repository\SiteoptionsInterface;

Class  Siteoptions implements SiteoptionsInterface
{
	protected $siteoptions;

	public function __construct(SiteOptions $siteoptions)
	{
		$this->siteoptions=$siteoptions;
	}

     
  public function getsiteinfoById($site_id){
      return	$this->siteoptions->where('id', $site_id)->first();
    }

    public function update( $id,array $data){
      return	$this->siteoptions->find($id)->update($data);
    }
}
?>