<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;

class RequestException extends Exception
{

    public function __construct($message = "", $code = 400)
    {
        parent::__construct($message, $code);

    }

    public function render(Request $request){

        //判断是否AJAX请求，如果是则返回json格式
        if($request->expectsJson()){
            return response()->json(['msg'=>$this->message,$this->code]);
        }

        return view('pages.error',['msg'=>$this->message],['code'=>$this->code]);
    }
}
