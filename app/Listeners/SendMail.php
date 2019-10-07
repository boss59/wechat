<?php

namespace App\Listeners;

use App\Events\Register;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Register  $event
     * @return void
     */
    public function handle(Register $event)
    {
        // 从事件中 拿到 user参数
        $this->user = $event->user;
        // Mail::send('email.loginsuccess',['username'=>$this->user->name,'content'=>'扒皮抽筋，才能脱胎换骨'],function($message){
        //     $message->to($this->user->email);
        //     $message->subject('ok,注册成功！！！！');
        // });
        // $this->dispatch(new SendEmail($this->user,'登陆成功','欢迎来到却邪的博客,地址：http://www.639hh.com'));
        Log::info('ok,注册成功！！！！',$user);
    }
}
