<?php 
namespace App\Repository\Locale;
use App\Models\Locales;
use App\Repository\LocaleInterface;
class Locale implements LocaleInterface
{
	
    protected $locales;

    public function __construct(Locales $locales)
    {
        $this->locales=$locales;
    }
      /**
     * Get's all Locales.
     *
     * @return mixed
     */
    public function getAll(){
        return $this->locales->get();
    }
 	
 	  /**
     * Add a Locale
     *
     * @return mixed
     */
    public function create(array $data){

    }
     /**
     * Updates a Locale.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){

    }

      /**
     * Deletes a Locale.
     *
     * @param int
     */
    public function delete($id){

    }

    public function getActiveLocale(){
      return  $this->locales->where('display','1')->get();
    }
    
}