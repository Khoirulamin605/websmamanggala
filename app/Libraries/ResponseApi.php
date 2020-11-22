<?php

namespace App\Libraries;

class ResponseApi
{
    public function index($error = 0, $message = '', $data=null){
        $response = array();
        if($error == 0){
            $response['errNumber'] = 0;
            $response['status'] = 'success';
            $response['respTime'] = date('Y-m-d H:i:s');
            $response['errMessage'] = $message;
            $response['data'] = $data;
        }else{
            $response['errNumber'] = $error;
            $response['status'] = 'fialed';
            $response['respTime'] = date('Y-m-d H:i:s');
            $response['errMessage'] = $message;
        }
        return $response;
    }
}