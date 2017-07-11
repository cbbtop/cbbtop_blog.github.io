<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends CommonController {

    // 友情链接列表
    public function linkList(){
        $user = M('friendly_link');
        //搜索条件
        if (isset($_POST['link_name']) && strlen($_POST['link_name']) > 0) {
            $maps['link_name'] = ['like', '%'.I('link_name').'%'];
        }
        if (isset($_POST['status']) && strlen($_POST['status']) > 0) {
            $maps['is_show'] = $_POST['status'];
        }
        $total = $user->where($maps)->count();
        $page = new \Think\Page($total, 2);

        //定制分页按钮的显示
        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        // // 隐藏
        // if (!empty($_GET['id']) && $_GET['is_show'] === '1'){
        //    // var_dump($_GET);
        //    $map['link_id'] = $_GET['id'];
        //    $map['is_show'] =  0;
        //    // var_dump($id);
        //    // var_dump($map);
        //    $res = $user->save($map);
        // // 显示
        // } elseif(!empty($_GET['id']) && $_GET['is_show'] === '0') {
        //    $map['link_id'] = $_GET['id'];
        //    $map['is_show'] =  1;
        //    $res = $user->save($map);

        // }
        
        // $res  = $user->select();
        // $this->assign('list',$res);
        $arr = $user->limit($page->firstRow.','.$page->listRows)->select();
        
        // $res  = $user->select();

        $this->assign('list',$arr);
        $this->assign('btn', $page->show());
        // $this->display('productList'); 
        $this->display('linkList'); 
         
    }
    // 友情链接添加
    public function linkListAdd(){
        $user = M('friendly_link');

        if (IS_POST){
            //验证规则
            $rule=array(
            // 链接名称
            array('link_name','require','请输入链接名',1),
            array('link_name','','链接名称已经存在！',0,'unique',1),
            //链接地址
            array('link_url','require','请输入链接地址',1),
            // 排序
            array('oredrby','require','请输入排序',1),
            // 链接图片

            //array('link_logo','require','请输选择上传图片',1),
  
            );
            if (!$user->validate($rule)->create()){
                $this->error($user->getError());
            } else{
                // 图片文件上传
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;//设置附件上传大小   
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
                $upload->saveName  =     date('Y-m-d',time()).mt_rand(); 
                $upload->autoSub = false;// 关闭子目录
                $upload->savePath  =      'link/'; // 设置附件上传目录    // 上传文件  
                $info   =   $upload->upload();

                // var_dump($info);
                // var_dump($_POST); 
                // 添加form表单数据
                // $map['link_id']  = $_POST['link_id'];
                $map['link_name']     = $_POST['link_name'];
                $map['link_url']  = $_POST['link_url'];
                // $map['is_show'] = $_POST['is_show'];
                // $map['orderby']  = $_POST['orderby'];
                $map['add_time']    = time();
                // $map['last_update'] = time();
                if($info){
                $map['link_logo'] = $info['link_logo']['savename'];

                }
                $res = $user->add($map);
                if(!$res) {
                    // 上传错误提示错误信息  
                    echo '提交失败';      
                    $this->error($upload->getError());    
                }else{
                // 上传成功       
                $this->success('上传成功！','linkList',60);    
                }
            }
        } else {
            $this->assign('list',$typeList);
             $this->display('linkListAdd'); 
        }
       
    }
    // 友情链接删除
    public function linkListDel(){
        //批量删除:post 
        //选择删除:get
        // var_dump($_POST);
        // var_dump($_GET);
        // exit();
        $user = M('friendly_link');
        if (IS_GET) {
            // var_dump($_GET);
            $id = $_GET['id'];   
            $res = $user->where(['link_id'=>$id])->delete();
            // 删除操作
            if ($res) {
              $this->success('删除成功','linkList',60);
            }else {
                $this->error('删除失败','linkList',60);
            }         
        } elseif (IS_POST){

            // 功能：批量删除
            $arr = $_POST['box'];
            // var_dump($arr);
            if (empty($_POST)) {
               $this->error('批量删除失败,请选择需要删除的','linkList',50);
            }
            foreach ($arr as $k => $val) {
                $id = $val;
                // echo $id;
                $res = $user->where(['link_id'=>$id])->delete();
                if ($res) {
                       $this->success('批量删除成功','linkList',50);
                    } else {
                        $this->error('批量删除失败','linkList',50);
                }                    
            }          
        }      
        
    }
    // 友情链接的修改编辑
    public function linkListEdit(){
        $user = M('friendly_link');
        // $type = M('type');
        $id   = $_GET['id'];
        $linkList = $user->where(['link_id'=>$id])->find();
        // var_dump($linkList);
        // exit();
        // $typeList = $type->field('id,name')->select(); 
        if (IS_POST){
            //验证规则
            $rule=array(
            // 链接名称
            array('link_name','require','请输入链接名',1),
            //链接地址
            array('link_url','require','请输入链接地址',1),
            // 排序
            array('oredrby','require','请输入排序',1),
            );
            if (!$user->validate($rule)->create()){
                $this->error($user->getError());
            } else{
                $id = $_POST['id'];
                // var_dump($_POST);
                // echo $_POST['goods_photo'];
                // var_dump($id);
                // exit();
                // 图片文件上传
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;//设置附件上传大小   
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
                $upload->saveName  =     date('Y-m-d',time()).mt_rand(); 
                $upload->autoSub = false;// 关闭子目录
                $upload->savePath  =      'link/'; // 设置附件上传目录    // 上传文件  
                $info   =   $upload->upload();
                // var_dump($info);
                // var_dump($_POST); 
                // 添加form表单数据
                $map['link_id']    = $id;
                // $map['is_show']  = $_POST['is_show'];
                $map['link_name']     = $_POST['link_name'];
                $map['link_url']  = $_POST['link_url'];
                // $map['orderby'] = $_POST['orderby'];
                // $map['last_update'] = time();
                // var_dump($map);

                // $map['add_time']    = time();
                // var_dump(!isset($info)); //false
                if($info){
                    $map['link_logo'] = $info['link_logo']['savename'];
                    // 删除原图
                    $arr = $user->where(['link_id'=>$id])->select();
                    $url = './Uploads/link/'.$arr[0]['link_id'];
                    unlink($url);

                }
                // echo $id;
                $res = $user->save($map);
                var_dump($res);
                if(!$res) {
                    // 上传错误提示错误信息  
                    echo '提交失败';      
                    $this->error($upload->getError());    
                }else{
                // 上传成功       
                $this->success('修改成功！','linkList',5);    
                }
            }
        } else {
            // $this->assign('list',$typeList);
            $this->assign('linkList',$linkList);
            $this->display('linkListEdit'); 
        }
    }

}
