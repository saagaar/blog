<?php 

namespace App\Repository\Banner;

use App\Models\Banners;
use App\Repository\BannerInterface;

Class Banner implements BannerInterface
{
	protected $Banner;
	public function __construct(Banners $member)
	{
		$this->Banner=$member;
	}
    public function getById($memberid){
      return $this->Banner->where('id', $memberid)->first();
    }

     /**
     * Get id in banner.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->Banner->latest();
    }
 	/**
     * create a post of banner
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->Banner->create($data);
    }
     /**
     * Updates a banner's data.
     *
     * @param int
     * @param array
     */
    public function update( $id,array $data){
         return $this->Banner->find($id)->update($data);
    }
      /**
     * Delete a banner's data.
     *
     * @param int
     */
    public function delete($id){
      return $this->Banner->find($id)->delete();
    }

    public function getBannerTagLine()
    {
        return $this->Banner->where('type','banner')->get();
    }


}
?>