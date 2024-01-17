<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Api\CommonLibrary\CryptographyPlugin;
use Cookie;
use Closure;
use Illuminate\Support\Facades\Config;
use Exception;
use Throwable;
 /**
 * @OA\Info(title="My First API", version="0.1")
 */
class Controller extends BaseController
{
   
    use AuthorizesRequests, ValidatesRequests;

 

     /**
    * encryption check.
    * @param  string  $string
    * @return mixed
    */
    
    public function encryption($string)
    {
        if(!empty($string)) {
            $cryp=new CryptographyPlugin();
            $data = $cryp->encode($string);
            return $data;
        }
    }

    /**
    * decryption check.
    * @param  string  $string
    * @return mixed
    */
    public function decryption($string)
    {
        if(!empty($string)) {
           $cryp=new CryptographyPlugin();
           $data = $cryp->decode($string);
           $data1 = json_decode($data);
           return $data1;
        }
    }


      /**
    * dec check.
    * @param  string  $string
    * @return mixed
    */
    public function dec($string)
    {
        if(!empty($string)) {

            $cryp=new CryptographyPlugin();
            $data = $cryp->decode($string);
            return $data;
        }
        return '';
    }

    /**
    * enc check.
    * @param  string  $string
    * @return mixed
    */
    public function enc($string)
    {
        if(!empty($string)) {
            $cryp=new CryptographyPlugin();
            $data = $cryp->encode($string);
            return $data;
        }
        return '';
    }

}
