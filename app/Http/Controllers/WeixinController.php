<?php

namespace App\Http\Controllers;

use Log;

use EasyWeChat\Foundation\Application;

class WeixinController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            switch ($message->Event) {
				case 'subscribe':
					return self::getSubscribeResp();
				case 'text':
					return self::getTextResp();
				default:
					# code...
					break;
        }
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
	
	public function getSubscribeResp($message) {
		return "欢迎关注！我们将会持续推送房价信息与变化趋势！嘻嘻！";
	}

	public function getTextResp($message) {
		return "这是文本！";
	}
}
