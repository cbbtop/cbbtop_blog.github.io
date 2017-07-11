<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
    public function login(){
        //登录验证
    	if (IS_POST) { 
            //create方法触发自动验证
            $user = D('Login');
            if (!M('Admin')->create($_POST,4)){
                $this->error(M('Admin')->getError());
            } else{ 
                //接收用户登录信息并在数据库中进行验证
                $map['user_name'] = I('user_name');
                $map['password'] = md5(I('password'));
                $info = M('Admin')->where($map)->find();

                //判断该用户是否已登录
                // if ($info['is_login'] == 1) { 
                //     $this->error('账户已经登录，请使用其他账户登录',U('Login/login'));
                // }
                //修改登录状态
                    // $k['is_login'] = 1;
                    // $str = M('Admin')->where(['admin_id'=>$info['admin_id']])->save($k);

                if ($info) {
                    //跳转之前，先将当前用户可以操作的节点列表查出来

                    // //1.将当前用户的角色先查出来
                    // $rid = join(',',M('AdminRole')->where(['uid'=>$info['admin_id']])->getField('rid', true));

                    // //2.根据得到的角色id去查出当前角色所拥有的节点id
                    // $nid = join(',', M('RoleNode')->where(['rid'=>['in', $rid]])->getField('nid', true));

                    // //3.根据得到的节点id，查出所有节点
                    // $res = M('Node')->where(['node_id'=>['in', $nid]])->getField('node_name', true);

                    // //默认添加一个后台首页的访问权限
                    // $res[] = 'Index/index';

                    //4.将所有节点写入session
                    // $_SESSION['nodeList'] = $res;
                    $_SESSION['adminInfo'] = $info;
                    $_SESSION['lock'] = 1;

                    $this->success('登录成功', U('Index/index'));
                } else { 
                    $this->error('用户名或密码错误');
                }
            }
        } else {
            $this->display();
        }
    }

    public function logout()
    { 
        session('adminInfo',null);
        session('lock',null);
        $this->redirect('Login/login');
    }
}