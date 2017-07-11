<?php
namespace Admin\Controller;

class CommonController extends \Think\Controller {
    public function _initialize(){
        if (!session('?adminInfo')) {
            // $this->redirect('Login/login');
            $this->success('请登陆',U('Login/login'));
            
            exit;
        }

        
        
        // $name = CONTROLLER_NAME.'/'.ACTION_NAME;
        // //判断是否有权限访问该节点
        // if (!in_array_case($name, $_SESSION['nodeList']) && $_SESSION['adminInfo']['user_name'] != 'admin') {
        //     $this->error('不好意思，你没有权限访问，请联系葬爱家族的马少!',U('Welcome/welcome'));
        // }
    }
}