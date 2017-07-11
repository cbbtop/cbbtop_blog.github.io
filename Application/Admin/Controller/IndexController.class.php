<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends CommonController {
    public function index(){
        //分配登录管理员的信息
        // $user_name = $_SESSION['adminInfo']['user_name'];
        // $this->assign('user_name',$user_name);
    	$this->display();
    }

}