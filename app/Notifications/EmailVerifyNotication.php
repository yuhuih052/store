<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;
use Cache;

class EmailVerifyNotication extends Notification implements ShouldQueue
{
    use Queueable;


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        //创建验证需要的token缓存
        $token = Str::random(20);
        Cache::put('email_verify_'.$notifiable->email,$token,30);
        return (new MailMessage)
                    ->greeting($notifiable->name.'您好:')
                    ->line('注册成功，请点击链接验证邮箱')
                    ->action('点击验证',
                        route('email_verified.verify',
                            ['$email'=>$notifiable->email,'$token'=>$token])
                    )
                    ->line('欢迎使用BBGU网上商城!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
