<?php 
namespace App\Repository;

interface LocaleInterface
{
	
      
      /**
     * Get's all Locales.
     *
     * @return mixed
     */
    public function getAll();
 	
 	  /**
     * Add a Locale
     *
     * @return mixed
     */
    public function create(array $data);
     /**
     * Updates a Locale.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data);

      /**
     * Deletes a Locale.
     *
     * @param int
     */
    public function delete($id);

    
}