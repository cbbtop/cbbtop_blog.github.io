<?php
namespace Admin\Controller;

class SystemController extends CommonController {
        // 系统信息列表
    public function systemLog(){
    	$role = M('role');
        $user = M('sys');
        // 锁：只执行一次
    	if ($_SESSION['adminInfo'] && $_SESSION['lock'] == 1) {
    		$ip = get_client_ip();
    		$id = $_SESSION['adminInfo']['role_id'];	
    		$role = $role->where("role_id=$id")->select();
    		$map['sys_role'] = $_SESSION['adminInfo']['user_name'];
    		$map['sys_content'] = '登录成功';
    		$map['sys_user'] = $role[0]['role_name'];
    		$map['sys_ip']   = $ip;
    		$map['sys_addtime'] = time();
    		$res = $user->add($map);
    		$_SESSION['lock'] = 0;
    	}
        $res  = $user->select();
        $this->assign('list',$res);
        $this->display('systemLog'); 
         
    }
    // 系统日志删除
    public function systemListDel(){
        //批量删除:post 
        //选择删除:get
        $user = M('sys');
        if (IS_GET) {
            // var_dump($_GET);
            $id = $_GET['id'];   
            $res = $user->where(['sys_id'=>$id])->delete();
            // 删除操作
            if ($res) {
              $this->success('删除成功','systemLog',60);
            }else {
                $this->error('删除失败','systemLog',60);
            }         
        } elseif (IS_POST){
            if (empty($_POST['box'])) {
                $this->error('批量删除失败,请选择需要删除的','systemLog',50);
            }
            // 功能：批量删除
            $arr = $_POST['box'];
            foreach ($arr as $k => $val) {
                $id = $val;
                $res = $user->where(['sys_id'=>$id])->delete();
                if ($res) {
                       $this->success('批量删除成功','systemLog',50);
                    } else {
                        $this->error('批量删除失败','systemLog',50);
                }                    
            }          
        }          
    }
}