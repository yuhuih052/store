<?php
namespace App\Base\OAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OAuthManager
{

    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }


    public function auth($user){

        $method = 'authWith'.ucfirst($this->driver);
        if (! method_exists($this,$method)){
            return false;
        }
        return $this->$method($user);

    }

    protected function authWithQq($user){

        // 如果已经存在 -> 登录
        $current_user = User::where('qq_openid',$user->id)->first();
        if ($current_user){
            Auth::login($current_user);
            return $current_user;
        }
        // 创建用户
        // 判断有重复昵称则拼接随机字符串

        $username = $user->nickname;
        // 如果的qq好的邮箱为空的
        if($user->email == null){

        }
        if (User::query()->where('name',$user->nickname)->first()){
            $username = $username.'_'.str_random(5);
        }

        $current_user = User::create([
            'qq_openid' =>$user->id,
            'name' => $username,
            'email' => $user->email,
            'is_active' => 1,
            'avatar' => $user->avatar,
            'password' => '',
            'confirmation_token' => str_random(40),
        ]);

        Auth::login($current_user);
        return $current_user;
    }

}