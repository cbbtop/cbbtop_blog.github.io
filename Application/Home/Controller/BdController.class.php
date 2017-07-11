<?php
namespace Home\Controller;
use Think\Controller;
use ThinkOauth;
class IndexController extends Controller {
    public function index(){
    // 	import("Org.ThinkSDK.ThinkOauth");//导入SDK基类 
    //     $sdk=ThinkOauth::getInstance('baidu');//获取SDK实例
    //     $code = I('code');//获取get过来的CODE值
    //     $info = $sdk->getAccessToken($code);//传入code值 获取JSON格式的数组 主要是获取token和openid
    //     $token = $info['access_token'];
    //     $openid = $info['openid'];
    //     $user_info = file_get_contents("https://openapi.baidu.com/rest/2.0/passport/users/getInfo?access_token=$token");
    //     $user_name = json_decode($user_info,true)['username']; 
    //     // 使用json_decode()//函数把JSON格式的转为数组，我这里只获取他的用户名字，json_decode()必须写true否则会返回一个无用的对象，填true会返回数组
        $this->display();
    // $this->dispaly('index');
    }
}