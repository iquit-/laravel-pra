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
				default:
					break;
			}
			switch ($message->MsgType) {
				case 'text':
					return self::getTextResp();
				case 'image':
					return self::getImageResp();
				case 'voice':
					return self::getVoiceResp($message);
				case 'video':
					return self::getVideoResp();
				case 'location':
					return self::getLocationResp();
				case 'link':
					return self::getLinkResp();
				default:
					break;
			}
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
	
	public function broadcast() {
		$wechat = app('wechat');
		echo "previewText 接口开始调用";
		echo "<hr />";
		$res = $wechat->broadcast->previewText("大家好！欢迎使用 EasyWeChat111111。","o9k8Qv2f9-_kl0lpuaMxcjAxppk0");
		var_dump($res);
		echo "<hr />";
		echo "previewText 接口调用结束";
	}
	
	public function user() {
		$wechat = app('wechat');
		echo "user 接口开始调用";
		echo "<hr />";
		$user = $wechat->user->get("o9k8Qv2f9-_kl0lpuaMxcjAxppk0");
		var_dump($user);
		echo "<hr />";
		echo "user 接口调用结束";
	}
	
	public function userList() {
		$wechat = app('wechat');
		echo "userList 接口开始调用";
		echo "<hr />";
		$userList = $wechat->user->lists();
		var_dump($userList);
		echo "<hr />";
		echo "userList 接口调用结束";
	}
	
	public function addMenus() {
		$wechat = app('wechat');
		$menu = $wechat->menu;
		echo "addMenus 接口开始调用";
		echo "<hr />";
		$buttons = [
			[
				"type" => "click",
				"name" => "周围笋盘",
				"key"  => "V1001_NEAR_BUILDING"
			],
			[
				"name"       => "菜单",
				"sub_button" => [
					[
						"type" => "view",
						"name" => "搜索",
						"url"  => "http://www.soso.com/"
					],
					[
						"type" => "view",
						"name" => "视频",
						"url"  => "http://v.qq.com/"
					],
					[
						"type" => "click",
						"name" => "赞一下我们",
						"key" => "V1001_GOOD"
					],
				],
			],
		];
		$result = $menu->add($buttons);
		var_dump($result);
		echo "<hr />";
		echo "addMenus 接口调用结束";
	}
	
	public function getSubscribeResp() {
		return "欢迎关注！我们将会持续推送房价信息与变化趋势！嘻嘻！";
	}

	public function getTextResp() {
		return "这是文本！";
	}
	
	public function getImageResp() {
		return "这是图片！";
	}
	
	public function getVoiceResp($message) {
		return "你说的是".$message->Recongnition."吗？";
	}
	
	public function getVideoResp() {
		return "这是视频！";
	}
	
	public function getLocationResp() {
		return "这是坐标！";
	}
	
	public function getLinkResp() {
		return "这是链接！";
	}
}
