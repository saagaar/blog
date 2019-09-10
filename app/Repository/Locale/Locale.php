<?php 
namespace App\Repository\Locale;
use App\Models\Locales;
use App\Repository\LocaleInterface;
class Locale implements LocaleInterface
{
	
    protected $Locales;

    public function __construct(Locales $locales)
    {
        $this->Locales=$locales;
    }
      /**
     * Get's all Locales.
     *
     * @return mixed
     */
    public function GetAll(){
        return $this->Locales->get();
    }
 	
 	  /**
     * Add a Locale
     *
     * @return mixed
     */
    public function Create(array $data){

    }
     /**
     * Updates a Locale.
     *
     * @param int
     * @param array
     */

    public function Update( $id,array $data){

    }

      /**
     * Deletes a Locale.
     *
     * @param int
     */
    public function Delete($id){

    }

    public function GetActiveLocale(){
      return  $this->Locales->where('display','1')->get();
    }
    
}