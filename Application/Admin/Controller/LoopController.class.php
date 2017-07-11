<?php
namespace Admin\Controller;

class LoopController extends CommonController {
    public function loop_list(){
        $user = D('Loop');
        if (isset($_GET['img_title']) && strlen($_GET['img_title']) > 0) {
            $map['img_title'] = ['like', '%'.I('get.img_title').'%'];
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
    	$this->display('loop-list');
    }

    //删除轮播图
    public function del($id)
    {
        //通过id值删除对应数据库中的数据
        //1 删除用户表中的数据
        $res = M('Loop')->delete($id);
        
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
        $res = M('Loop')->delete($map);     
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    //添加轮播图
    public function loop_add()
    {

        if (IS_POST) {
            //create方法触发自动验证
            $user = D('Loop');
            if (!$user->create()) { 
                $this->error($user->getError());
            } else { 
                //接收post表单传送的值
                $a['img_title'] = $_POST['img_title'];
                $a['parent_id'] = $_POST['parent_id'];
                $a['son_id'] = $_POST['son_id'];
                //处理文件上传   
                if(!($_FILES['loop_img']['error']==4))
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
                         $info   =   $upload->uploadOne($_FILES['loop_img']);  
                         
                         //判断是否上传成功
                         if(!$info) 
                         {
                            // 上传错误提示错误信息      
                            $this->error($upload->getError());  
                            echo 1;
                         }else{
                            // 上传成功 获取上传文件信息         
                            $map['loop_img']=$info['savename'];
                        }

                    }
                //将图片名存入数组中
                $a['loop_img'] = $map['loop_img'];
                $a['add_time'] = time();
                //添加数据到数据库
                $date = $user->create($a);
                $res = $user->add($date);
                if (!$res) { 
                    $this->error('添加失败');
                }
                $this->success('添加成功', U('loop_list'));
            }
            
        } else {
            $this->display();
        }
    }

    //编辑轮播图
    public function loop_edit()
    { 
        if (IS_GET) { 
            //接收修改页面传过来的id值
            $id = $_GET['id'];
            $user = M('Loop');
            //根据id值查出要修改数据的值
            $res = $user->where(['id'=>$id])->find();

            //根据分类id查数据
            //分类id = 5
            //找出pid = 2所有子类
            //分配数据
            //分配查到的数据
            $this->assign('res',$res);
            $this->display();
        }
    
        if (IS_POST) { 
            //create方法触发自动验证
            $user = D('Loop');
            if (!$user->create()) { 
                $this->error($user->getError());
            } else { 
                //1.判断是否修改轮播图
                //处理文件上传   
                if(!($_FILES['loop_img']['error']==4))
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
                         $info   =   $upload->uploadOne($_FILES['loop_img']);  
                         
                         //判断是否上传成功
                         if(!$info) 
                         {
                            // 上传错误提示错误信息      
                            $this->error($upload->getError());  
                            echo 1;
                         }else{
                            // 上传成功 获取上传文件信息         
                            $map['loop_img']=$info['savename'];
                        }
                        //将图片名存入数组中
                        $a['loop_img'] = $map['loop_img'];
                    } else { 
                        $a['loop_img'] = $_POST['yloop_img'];
                    }
                

                $id = $_POST['id'];
                //2.将更新的数据插入数据库
                $map['img_title'] = $_POST['img_title'];
                $map['parent_id'] = $_POST['parent_id'];
                $map['son_id'] = $_POST['son_id'];
                $res = M('Loop')->where(['id'=>$id])->save($map);
                if (!$res) { 
                    $this->error('修改失败');
                }
                $this->success('修改成功',U('loop_list'));
            }   

            
        }
    }

    public function getData()
    { 
        $pid = $_GET['pid'];
        $type = M('Type');
        $res = $type->where(['pid'=>$pid])->select();
        $this->ajaxreturn($res);

    }

    public function catchData()
    { 
        $type = M('Type');
        $id = $_GET['pid'];
        $pid = $type->where(['id'=>$id])->getField('pid');
        $res = $type->where(['pid'=>$pid])->select();
        $this->ajaxreturn($res);
    }
}