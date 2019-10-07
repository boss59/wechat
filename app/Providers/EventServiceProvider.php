<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // 用户 注册 后的事件
        // 'App\Events\Register' => [
        //     // 监听器 广告邮件
        //     'App\Listeners\SendAdMail',
        //     // 发送短信
        //     'App\Listeners\SendSms',
        //     //发送帮助短信
        //     'App\Listeners\SendHelpInformation',
        // ],
        // 用户 登录 后的事件
        'App\Events\Login' => [
            // 监听器 广告邮件
            'App\Listeners\SendAdMail',
            // 发送短信
            'App\Listeners\SendSms',
            //发送帮助短信
            'App\Listeners\SendHelpInformation',
        ],
        // 用户 注册 后的事件
        'App\Events\Register' => [
            // 监听器 广告邮件
            'App\Listeners\SendMail',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
