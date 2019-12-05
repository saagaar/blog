<?php 
namespace App\Repository;
interface NotificationSettingInterface
{
	 /**
     * Get's a Email by it's ID
     *
     * @param int
     */
    public function getNotificationById($id);

     /**
     * Get's a Email content by it's code
     *
     * @param int
     */
    public function getNotificationByCode($NotificationCode);
      
      /**
     * Get's all Email.
     *
     * @return mixed
     */
    public function getAll();
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data);
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data);

      /**
     * Deletes a Email.
     *
     * @param int
     */
    public function delete($id);

    
}