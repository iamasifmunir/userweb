<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $data = [];
    protected $errors = [];
    protected $message = null;
    protected $isDebugging = false;
    private $debugInfo = [];

    const LOGIN_RULES = [
        'email' => 'required',
        'password' => 'required',

    ];


    /**
     * @return array
     */

    /**
     * @param array $requestData
     */



    public function getDebugInfo(): array {
        return $this->debugInfo;
    }

    /**
     * @param array $debugInfo
     */
    public function setDebugInfo( array $debugInfo ) {
        $this->debugInfo = $debugInfo;
    }

    /**
     * @param array $debugInfo
     */
    public function updateDebugInfo( array $debugInfo ) {
        $this->debugInfo = array_merge( $this->getDebugInfo(), $debugInfo );
    }

    /**
     * @return bool
     */
    public function isDebugging(): bool {
        return $this->isDebugging;
    }

    /**
     * @param bool $isDebugging
     */
    public function setIsDebugging( bool $isDebugging ) {
        $this->isDebugging = $isDebugging;
    }

    /**
     * @return null
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @param null $message
     */
    public function setMessage( $message ) {
        $this->message = $message;
    }


    /**
     * @param null $message
     */


    /**
    }


    /**
     * @return bool
     */
    public function isErrors(): array {
        return $this->errors;
    }

    /**
     * @param bool $errors
     */
    public function setErrors( array $errors ) {
        $this->errors = $errors;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData( array $data ) {
        $this->data = $data;
    }


    /**
     * @param $type
     */
    protected function validateReq( array $data, $for, $messages = [] ) {
        $rules     = $for;
        $validator = Validator::make( $data, $rules, $messages );

        if ( $validator->fails() ) {
            $this->errors = $validator->errors()->getMessages();

            return false;
        }

        return true;
    }


    public function response() {
        $resp = [
            'success'           => false,
            'errors'            => [],
            'data'              => null,
            'current_timestamp' => Carbon::now()->toDateTimeString(),
//            'config' => Config::all()->pluck('value', 'key'),
        ];
        if ( $this->isDebugging() ) {
//            $resp['logs'] = $queries = DB::getQueryLog();
//            $resp['debug'] = $this->getDebugInfo();
        }

        if ( count( $this->errors ) === 0 ) {
            $resp['success'] = true;
            $resp['message'] = $this->message;
            $resp['data']    = $this->data;


        } else {

            $resp['success'] = false;

//            $resp['data'] = $this->data;
            if ( is_array( $this->errors ) ) {
                foreach ( $this->errors as $error ) {
                    if ( is_array( $error ) ) {
                        foreach ( $error as $err ) {
                            $resp['errors'][] = $err;
                        }
                    } else {
                        $resp['errors'][] = $error;
                    }
                }
            } else {
                $resp['errors'] = [ $this->errors ];
            }

        }



        return $resp;
    }
}
