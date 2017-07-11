<?php
namespace Admin\Controller;

class AdminController extends CommonController {
    public function admin_list(){
         //var_dump($_GET);
        $user = D('Admin');
        //搜索条件
        if (isset($_GET['user_name']) && strlen($_GET['user_name']) > 0) {
            $map['user_name'] = ['like', '%'.I('get.user_name').'%'];
        }
        if (isset($_GET['role_name']) && strlen($_GET['role_name']) > 0) {
            $map['role_name'] = ['like', '%'.I('get.role_name').'%'];
        }
        $total = $user->where($map)->count();
        $page = new \Think\Page($total, 3);

        //定制分页按钮的显示
        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $arr = $user->where($map)->limit($page->firstRow, $page->listRows)->getData();

        //var_dump($arr);
        $this->assign('total',$total);
        $this->assign('list', $arr);
        $this->assign('btn', $page->show());
        $this->display();
    }

    /**
     * 删除管理员
     * @param  int $id 要删除的ID
     */
    public function del($id)
    {
        //通过id值删除对应数据库中的数据
        //1 删除管理员表中的数据
        $res = M('Admin')->delete($id);
        //2 删除admin_role表中的数据
        $str = M('AdminRole')->where(['uid'=>$id])->delete();
        
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }


    public function alldel()
    { 
        //var_dump($_POST['box']);
        //接收传过来的id值
        $id = $_POST['box'];
        $map = join(',',$id);
        //通过id值删除对应数据库中的数据
        //1 删除管理员表中的数据
        //注意：delete中只能传字符串
        $res = M('Admin')->delete($map);
        //2 删除admin_role表中的数据
        foreach ($id as $v) { 
            $str = M('AdminRole')->where(['uid'=>$v])->delete();
        }
        
        if (!$str) { 
            $this->error('删除失败');
        }       
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    //添加管理员
    public function admin_add()
    {

        if (IS_POST) {
            //新添加管理员账户，密码和添加时间
            //var_dump($_POST);
            //exit;
            $a['user_name'] = $_POST['user_name'];
            $a['password'] = md5($_POST['password']);
            $a['add_time'] = time();
            //新添加管理员的角色
            // $rids = $_POST['role_name'];
            // $role = D('AdminRole');
            $user = D('Admin');
            $date = $user->create($a);
            //获取新添加数据的id值
            $res = $user->add($date);
    
                if (!$res) { 
                    $this->error('添加失败');
                }     
            $this->success('添加成功', U('admin_list'));
        } else {
            $this->display();
        }
    }

    //编辑管理员
    public function admin_edit()
    { 
        if (IS_GET) { 
            //接收修改页面传过来的id值
            $id = $_GET['admin_id'];
            $user = M('Admin');
            $role = M('AdminRole');
            //根据id值查出要修改数据的值
            $res = $user->where(['admin_id'=>$id])->find();
            //查出要修改数据的角色并处理
            $str = $role->where(['uid'=>$id])->select();
            foreach ($str as $k=>$v) { 
                $rid[] = $v['rid'];
            }
            //分配查到的数据
            $this->assign('res',$res);
            $this->assign('rid',$rid);
            $this->display();
        }
    
        if (IS_POST) {
            //var_dump($_POST);            
            $uid = I('admin_id');
            $rid = I('role_name');
            //1.先将原来有的角色都干掉
            M('AdminRole')->where(['uid'=>$uid])->delete();

            //2.判断是否修改密码
            if (!empty($_POST['password'])) { 
                $map['password'] = md5($_POST['password']);
            } else { 
                $map['password'] = $_POST['ypassword'];
            }
            //3.将更新的数据插入数据库
            $map['user_name'] = $_POST['user_name'];
            $map['add_time'] = time();
            $res = M('Admin')->where(['admin_id'=>$uid])->save($map);
            if (!$res) { 
                $this->error('修改失败');
            }

            //4.将当前选中的角色加进去
            foreach ($rid as $v) {
                $data['uid'] = $uid;
                $data['rid'] = $v;
                if (!M('AdminRole')->add($data)) {
                    $this->error('修改失败');
                }
            }

            $this->success('修改成功',U('admin_list'));
        }
    }
}