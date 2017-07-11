<?php
namespace Admin\Controller;

class AdController extends CommonController {
    public function ad_list(){
        $user = D('Ad');
        if (isset($_GET['ad_title']) && strlen($_GET['ad_title']) > 0) {
            $map['ad_title'] = ['like', '%'.I('get.ad_title').'%'];
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
    	$this->display('ad-list');
    }

    //删除广告
    public function del($id)
    {
        //通过id值删除对应数据库中的数据
        //1 删除广告表中的数据
        $res = M('Ad')->delete($id);
        
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
        //1 删除广告表中的数据
        //注意：delete中只能传字符串
        $res = M('Ad')->delete($map);     
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    //添加广告
    public function Ad_add()
    {

        if (IS_POST) {
            //create方法触发自动验证
            $user = D('Ad');
            if (!$user->create()) { 
                $this->error($user->getError());
            } else { 
                //接收post表单传送的值
                $a['ad_title'] = $_POST['ad_title'];
                $a['ad_link'] = $_POST['ad_link'];
                //处理文件上传   
                if(!($_FILES['ad_img']['error']==4))
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
                         $upload->savePath  =      'link/'; 
                         // 上传单个文件     
                         $info   =   $upload->uploadOne($_FILES['ad_img']);  
                         
                         //判断是否上传成功
                         if(!$info) 
                         {
                            // 上传错误提示错误信息      
                            $this->error($upload->getError());  
                            echo 1;
                         }else{
                            // 上传成功 获取上传文件信息         
                            $map['ad_img']=$info['savename'];
                        }

                    }
                //将图片名存入数组中
                $a['ad_img'] = $map['ad_img'];
                $a['add_time'] = time();
                //添加数据到数据库
                $date = $user->create($a);
                $res = $user->add($date);
                if (!$res) { 
                    $this->error('添加失败');
                }
                $this->success('添加成功', U('ad_list'));
            }
            
        } else {
            $this->display();
        }
    }

    //编辑广告
    public function ad_edit()
    { 
        if (IS_GET) { 
            //接收修改页面传过来的id值
            $id = $_GET['id'];
            $user = M('Ad');
            //根据id值查出要修改数据的值
            $res = $user->where(['ad_id'=>$id])->find();

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
            $user = D('Ad');
            if (!$user->create()) { 
                $this->error($user->getError());
            } else { 
                //处理文件上传   
                if(!($_FILES['ad_img']['error']==4))
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
                         $upload->savePath  =      'link/'; 
                         // 上传单个文件     
                         $info   =   $upload->uploadOne($_FILES['ad_img']);  
                         
                         //判断是否上传成功
                         if(!$info) 
                         {
                            // 上传错误提示错误信息      
                            $this->error($upload->getError());  
                            echo 1;
                         }else{
                            // 上传成功 获取上传文件信息         
                            $map['ad_img']=$info['savename'];
                        }
                        //将图片名存入数组中
                        $a['ad_img'] = $map['ad_img'];
                    } else { 
                        $a['ad_img'] = $_POST['yad_img'];
                    }
                

                $id = $_POST['id'];
                //2.将更新的数据插入数据库
                $map['ad_title'] = $_POST['ad_title'];
                $map['ad_link'] = $_POST['ad_link'];
                $res = M('Ad')->where(['ad_id'=>$id])->save($map);
                if (!$res) { 
                    $this->error('修改失败');
                }
                $this->success('修改成功',U('ad_list'));
            }   

            
        }
    }


    //修改显示状态
    public function mod_status()
    { 
        $id = $_GET['id'];
        $user = M('Ad');
        $res = $user->where(['ad_id'=>$id])->getField('enabled');
        if ($res == 1) { 
            $res = 0;
        } else { 
            $res = 1;
        } 
        $map['enabled'] = $res;
        $str = $user->where(['ad_id'=>$id])->save($map);
        if (!$str) { 
            $this->error('状态修改失败');
        }
        $this->success('状态修改成功',U('ad_list'));
    }


    public function getData()
    { 
        $id = $_GET['ad_id'];
        $enabled = $_GET['enabled'];
        if ($enabled == 1) { 
            $enabled = 0;
        } else { 
            $enabled = 1;
        } 
        $map['enabled'] = $enabled;
        $type = M('Ad');
        $type->where(['ad_id'=>$id])->save($map);
        
        $this->ajaxReturn($enabled);
        //return true;
    }

}