<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

/**
 * 第三方登录控制器
 *
 * Class SocialiteLoginController
 * @package App\Http\Controllers\Auth
 */
class SocialiteLoginController extends Controller
{
    /**
     * 第三方登录用户信息的展示
     *
     * @param $service
     * @return mixed
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * 处理第三方登录的回调
     *
     * @param $service
     */
    public function handleProviderCallback($service)
    {
        $user = Socialite::driver($service)->user();
        $manager = new OAuthManager($service);
        $manager->auth($user);

        return redirect('/');
    }

}

