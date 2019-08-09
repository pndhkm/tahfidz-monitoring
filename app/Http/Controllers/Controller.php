<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return void
     */
    public function getResponse($status,$status_code,$data=null,$message)
    {
        if($status != false)
        {
            return response()->json(['status'=> $status, 'status_code'=> $status_code, 'data'=>$data, 'message'=>$message]); 
        }
        else
        {
            return response()->json(['status'=> $status, 'status_code'=> $status_code, 'data'=>null, 'message'=>$message]);  
        }
    }

    /**
     * @return void
     */
    public function systemLog()
    {

    }

    /**
     * @return void
     */
    public function dateConvert()
    {
        
    }

    /**
     * @return void
     */
    public function printLog()
    {

    }

}