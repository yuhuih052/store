<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;

class InsideException extends Exception
{
    protected $msgGiveUser;
    public function __construct($message = "",$msgGiveUser = "系统内部错误", $code = 500,array $data = [])
    {
        parent::__construct($message, $code );
        $this->data = $data;
    }

    public function render(Request $request){
        if($request -> expectsJson()){
        $content = [
          'message' => $this->msgGiveUser,
          'data'    => $this->data ?? [],
            'timestamp' => time()
        ];
        return response()->json($content, $this->code);
        }
        return view('page.error',['msg'=>$this->msgGiveUser,$this->code]);
    }

}
