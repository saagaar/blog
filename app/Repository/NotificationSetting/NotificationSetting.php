<?php 

namespace App\Repository\NotificationSetting;

use App\Models\NotificationSettings;
use App\Models\SiteOptions;
use App\Repository\NotificationSettingInterface;

Class  NotificationSetting implements NotificationSettingInterface
{
	protected $notify;

  
	public function __construct(NotificationSettings $notify)
	{
		$this->notify=$notify;
	}

     
  public function getNotificationById($Notification_id){
    return $this->notify->where('id', $Notification_id)->first();
  }


   /**
     * Get's a images/userimages/ content by it's code
     *
     * @param int
     */
  public function getNotificationByCode($code){
    return $this->notify->where('code',$code)->first();
  }
      /**
     * Get's all posts.
     *
     * @return mixed
     */
  public function getAll(){
   	return	$this->notify->latest();
  }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
  public function create(array $data){
    return	$this->notify->create($data);
  }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

  public function update( $id,array $data){
    return	$this->notify->find($id)->update($data);
  }

  /**
 * Deletes a post.
 *
 * @param int
 */
  public function delete($id){
    return	$this->notify->find($id)->delete();
  }
}
?>