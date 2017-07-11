<?php
namespace Admin\Controller;

class UserController extends CommonController {

    //用户列表页
    public function user_list(){
         //var_dump($_GET);
        $user = D('User');
        //搜索条件
        if (isset($_GET['name']) && strlen($_GET['name']) > 0) {
            $map['name'] = ['like', '%'.I('get.name').'%'];
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
     * 删除用户
     * @param  int $id 要删除的ID
     */
    public function del($id)
    {
        //通过id值删除对应数据库中的数据
        //1 删除用户表中的数据
        $res = M('User')->delete($id);
        
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    //批量删除
    public function alldel()
    { 
        //var_dump($_POST['box']);
        //接收传过来的id值
        $id = $_POST['box'];
        $map = join(',',$id);
        //通过id值删除对应数据库中的数据
        //1 删除用户表中的数据
        //注意：delete中只能传字符串
        $res = M('User')->delete($map);     
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }


    //添加用户
    public function user_add()
    {

        if (IS_POST) {
            //create方法触发自动验证
            $user = D('User');
            if (!$user->create()) { 
                $this->error($user->getError());
            } else { 
                //接收post表单传送的值
                $a['name'] = $_POST['name'];
                $a['password'] = md5($_POST['password']);
                $a['reg_time'] = time();
                $a['phone'] = $_POST['phone'];
                $a['sex'] = $_POST['sex'];
                if (!empty($_POST['email'])) { 
                    $a['email'] = $_POST['email'];
                }
                //处理文件上传
                if(!($_FILES['img']['error']==4))
                    {
                         // 实例化上传类    
                         $upload = new \Think\Upload();
                         //关闭子目录
                         $upload->autoSub = false;
                         // 设置附件上传大小    
                         $upload->maxSize   =     3145728 ;
                         // 设置附件上传类型   
                         $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
                         // 设置附件上传目录    
                         $upload->savePath  =      'img/'; 
                         // 上传单个文件     
                         $info   =   $upload->uploadOne($_FILES['img']);  
                         
                         //判断是否上传成功
                         if(!$info) 
                         {
                            // 上传错误提示错误信息      
                            $this->error($upload->getError());  
                            echo 1;
                         }else{
                            // 上传成功 获取上传文件信息         
                            $map['img']=$info['savename'];
                        }

                    }
                //将图片名存入数组中
                $a['img'] = $map['img'];
                //添加数据到数据库
                $date = $user->create($a);
                $res = $user->add($date);
                if (!$res) { 
                    $this->error('添加失败');
                }
                $this->success('添加成功', U('user_list'));
            }
            
        } else {
            $this->display();
        }
    }


    //编辑用户
    public function user_edit()
    { 
        if (IS_GET) { 
            //接收修改页面传过来的id值
            $id = $_GET['id'];
            $user = M('User');
            //根据id值查出要修改数据的值
            $res = $user->where(['id'=>$id])->find();
            //分配查到的数据
            $this->assign('res',$res);
            $this->display();
        }
    
        if (IS_POST) { 
            //判断用户名是否合法
            //密码是否合法    

            //1.判断是否修改密码
            if (!empty($_POST['password'])) { 
                $map['password'] = md5($_POST['password']);
            } else { 
                $map['password'] = $_POST['ypassword'];
            }

            //2.判断是否修改头像
            $id = $_POST['id'];
            //3.将更新的数据插入数据库
            $map['name'] = $_POST['name'];
            $res = M('User')->where(['id'=>$id])->save($map);
            if (!$res) { 
                $this->error('修改失败');
            }
            $this->success('修改成功',U('user_list'));
        }
    }


    //修改状态
    public function mod_status()
    { 
        //获取需要修改的用户的id
        $id = $_GET['id'];
        $user = M('User');
        //查找到该用户当前状态值
        $res = $user->where(['id'=>$id])->getField('flag');
        //修改状态值
        if ($res == 0) { 
            $res = 1;
        } else { 
            $res = 0;
        } 
        //将修改的状态值写入数据库
        $map['flag'] = $res;
        $str = $user->where(['id'=>$id])->save($map);
        if (!$str) { 
            $this->error('状态修改失败');
        }
        $this->success('状态修改成功',U('user_list'));
    }

    //ajax修改用户的状态
    public function getData()
    { 
        $id = $_GET['id'];
        $flag = $_GET['flag'];
        if ($flag == 1) { 
            $flag = 0;
        } else { 
            $flag = 1;
        } 
        $map['flag'] = $flag;
        $type = M('User');
        $type->where(['id'=>$id])->save($map);
        
        $this->ajaxReturn($flag);
    }
}