<?php
namespace Home\Controller;
use Think\Controller;
use ThinkOauth;
class IcController extends Controller {
	  public function ic()
	  {
	  	import("Org.ThinkSDK.ThinkOauth");//导入SDK基类 
		$sdk=ThinkOauth::getInstance('baidu');//获取SDK实例 
		// var_dump($sdk);
		// exit();
		redirect($sdk->getRequestCodeURL());//跳转到授权页面; 
	  }
}