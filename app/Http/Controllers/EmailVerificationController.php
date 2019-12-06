<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use App\Models\User;
use Exception;
use Mail;
use App\Notifications\EmailVerifyNotication;

class EmailVerificationController extends Controller
{
    public function verify(Request $request){
        //dd ($request->all ());
        // 从 url 中获取 `email` 和 `token` 两个参数
        $email = $request->input('$email');
        $token = $request->input('$token');

        //判断获取到的信息是否存在空值
        if(!$email || !$token){


            throw new Exception('链接不正确');
        }

        //拿到链接跟缓存的token进行对比
        if($token != Cache::get('email_verify_'.$email)){
            throw new Exception('链接不正确或者已过期');
        }

        //验证已完成删除缓存的验证数据
        //修改数据库的email_verified字段
        Cache::forget('email_verify_'.$email);
        $user = User::where('email', $email)->first();
        $user->update(['email_verified'=>true]);

        return view('pages.email_verified_success',['msg'=>'验证成功']);
    }

    public function send(Request $request){
        $user = $request->user();

        //验证是否激活邮箱
        if($user->verified){
            throw new Exception('您已激活邮箱');
        }
        //调用 notify() 方法发送邮件
        $user->notify(new EmailVerifyNotication());

        return view('pages.email_verified_success',['msg'=>'发送成功']);
    }
}
