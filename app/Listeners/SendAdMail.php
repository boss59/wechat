<?php

namespace App\Listeners;

use App\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;
class SendAdMail implements ShouldQueue
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // 从事件中 拿到 username 参数
        $this->user = $event->user;
        Mail::send('email.loginsuccess',['username'=>$this->user->name,'content'=>'扒皮抽筋，才能脱胎换骨'],function($message){
            $message->to($this->user->email);
            $message->subject('ok,登陆成功！！！！');
        });
        // $this->dispatch(new SendEmail($this->user,'登陆成功','欢迎来到却邪的博客,地址：http://www.639hh.com'));
    }
}
