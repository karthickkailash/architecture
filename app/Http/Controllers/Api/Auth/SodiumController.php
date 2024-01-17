<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Throwable;
use Exception;

use Illuminate\Support\Carbon;
use DateTime;
use DateTimeZone;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class SodiumController extends Controller
{
    //

    protected string $empty_result;
    protected int $auth_user_id;
    protected string $auth_org_name;
    protected int $auth_tenant_id;
    protected int $auth_location_id;
   public function __construct(Request $request)
   {
       $this->empty_result = $this->encryption(json_encode([]));
       $payload = JWTAuth::parseToken()->getPayload();
      
       
   }

   

    public function keyge(Request $request)
    {
          // Generate a secret key. This value must be stored securely.
            $key = sodium_crypto_aead_xchacha20poly1305_ietf_keygen();

            // Generate a nonce for EACH MESSAGE. This can be public, and must be provided to decrypt the message.
            $nonce = \random_bytes(\SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

            // Text to encrypt.
            $message = 'Hello World';

            // Encrypt
            $encrypted_text = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt($message, '', $nonce, $key);

            // Decrypt
            $original_message = sodium_crypto_aead_xchacha20poly1305_ietf_decrypt($encrypted_text, '', $nonce, $key);
                    
            echo bin2hex($key);
            //$key_decoded = sodium_hex2bin($this->key);

            dd($nonce);
    }


    /**
     * @OA\POST(
     *      path="/library/test",
     *      operationId="Validate the List of Libraries",
     *      tags={"Library"},
     *      summary="Get project information",
     *      description="Returns project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */



    
    public function libstest(Request $request)
    {
        if (isset($request->request_data)) 
        {
            $data = $this->decryption($request->request_data); //LIPSODIUM Decrypt call
            $convert_arr = json_decode(json_encode($data), true); //Converted Request
            $request = new Request($convert_arr); //Assigned to new request
        }
        dd($request);
    }
    /**
     * Convert Encrypt check.
     * \Illuminate\Http\Request
     * @return mixed
     */
    public function convert_encrypt(Request $request)
    {
      //  dd($request->data);
        $data = $this->enc($request->data);
        return $data;
    }

     /**
     * Covert Decrypt check.
     * \Illuminate\Http\Request
     * @return mixed
     */
    public function convert_decrypt(Request $request)
    {
        $data = $this->dec($request->data);
        return $data;
    }


}
