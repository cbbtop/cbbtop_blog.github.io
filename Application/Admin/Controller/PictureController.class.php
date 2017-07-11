<!-- 垃圾 -->

<?php
namespace Admin\Controller;
use Think\Controller;
class PictureController extends CommonController {

    // 文章列表
    public function pictureList(){
        $user = M('goods');
        // 下架
        if (!empty($_GET['id']) && $_GET['status'] === '1'){
           // var_dump($_GET);
           $map['goods_id'] = $_GET['id'];
           $map['is_on_sale'] =  0;
           // var_dump($id);
           // var_dump($map);
           $res = $user->save($map);
           // var_dump($res."成功下架");
        // 上架
        } elseif(!empty($_GET['id']) && $_GET['status'] === '0') {
           $map['goods_id'] = $_GET['id'];
           $map['is_on_sale'] =  1;
           $res = $user->save($map);
           // var_dump($res."成功上架");

        }
        
        $res  = $user->select();
        // var_dump($res);
        $this->assign('list',$res);
        $this->display('pictureList');  
    }
    // 文章添加
    public function pictureListAdd(){
        $user = M('Goods');
        $type = M('type');
        $typeList = $type->field('id,name')->select(); 

        if (IS_POST){
            // 图片文件上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;//设置附件上传大小   
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
            $upload->saveName  =     date('Y-m-d',time()).mt_rand(); 
            $upload->autoSub = false;// 关闭子目录
            $upload->savePath  =      'goods/'; // 设置附件上传目录    // 上传文件  
            $info   =   $upload->upload();

            // var_dump($info);
            // var_dump($_POST); 
            // 添加form表单数据
            $map['is_on_sale']  = $_POST['is_on_sale'];
            $map['type_id']     = $_POST['type_id'];
            $map['goods_name']  = $_POST['goods_name'];
            $map['goods_brief'] = $_POST['goods_brief'];
            $map['goods_desc']  = $_POST['goods_desc'];
            $map['goods_photo'] = $info['goods_photo']['savename'];
            $map['add_time']    = time();
            $map['last_update'] = time();
            $res = $user->add($map);
            // var_dump($res);
            if(!$info && $res) {
                // 上传错误提示错误信息  
                echo '提交失败';      
                $this->error($upload->getError());    
            }else{
            // 上传成功       
            $this->success('上传成功！','pictureList',60);    
                }
        } else {
            $this->assign('list',$typeList);
             $this->display('pictureListAdd'); 
        }
       
    }
    // 文章删除
    public function pictureListDel(){
        //批量删除:post 
        //选择删除:get
        // var_dump($_POST);
        // var_dump($_GET);
        // exit();
        $user = M('goods');
        $attr = M('goods_attr');
        if (IS_GET) {
            //判断是否存在子类(id如果能在父类的pid里面查到说明有子类)
            var_dump($_GET);
            $pid['goods_id'] = $_GET['id'];
            $type = $attr->where($pid)->select();
            // var_dump($type);
            // exit();
            if ($type == null) {
                // 删除本地文件夹图片
                $arr = $user->where($pid)->select();  
                $url = './Uploads/goods/'.$arr[0]['goods_photo'];
                unlink($url);
                $res = $user->where($pid)->delete();
                // 删除操作
                if ($res) {
                  $this->success('删除成功','pictureList',60);
                }else {
                    $this->error('删除失败','pictureList',60);
                }
            } else {
                $this->error('删除失败,请先删除子类','pictureList');
            }
        } elseif (IS_POST){
            // 功能：批量删除
            //判断是否存在属性商品
            if ($_POST){
                $pid = $_POST['box'];
                // var_dump($pid);
                // exit;
                foreach ($pid as $k => $val) {
                    $pid = $val;
                    $res[] = $attr->where(['goods_id'=>$pid])->select();
                }               
            }
            // var_dump($res);
            // 遍历判断查询的数组中是否有商品分类的商品，true：不可删，有子属性商品 false：可以删
            foreach ($res as $key => $val) {
                if ($val !== null) {
                    $str = true;
                    break;
                }
                $str = false;
            }
            //如何不存在属性商品，删除操作
            if (!$str) {
                $arr = $_POST['box'];
                // var_dump($arr);
                // exit();
                foreach ($arr as $k => $val) {
                    $id = $val; 
                    // 删除本地文件夹图片
                    $arr = $user->where(['goods_id'=>$id])->select();  
                    $url = './Uploads/goods/'.$arr[0]['goods_photo']; 
                    unlink($url);
                    $res = $user->where(['goods_id'=>$id])->delete();
                    if ($res) {
                           $this->success('批量删除成功','pictureList',5);
                        } else {
                            $this->error('批量删除失败','pictureList',5);
                        }                    
                    } 
            }else {
                        $this->error('删除失败,请先删除子类','pictureList',5);
                    }
        }       
    }
    // 文章的修改编辑
    public function pictureListEdit(){
        $user = M('Goods');
        $type = M('type');
        $id   = $_GET['id'];
        $goodsList = $user->where(['goods_id'=>$id])->select();
        // var_dump($goodsList);
        $typeList = $type->field('id,name')->select(); 
        if (IS_POST){
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
            $upload->savePath  =      'goods/'; // 设置附件上传目录    // 上传文件  
            $info   =   $upload->upload();
            // 添加form表单数据
            $map['goods_id']    = $id;
            $map['is_on_sale']  = $_POST['is_on_sale'];
            $map['type_id']     = $_POST['type_id'];
            $map['goods_name']  = $_POST['goods_name'];
            $map['goods_brief'] = $_POST['goods_brief'];
            $map['goods_desc']  = $_POST['goods_desc'];
            $map['last_update'] = time();
            if(isset($info)){
                $map['goods_photo'] = $info['goods_photo']['savename'];
                // 删除原图
                $arr = $user->where(['goods_id'=>$id])->select();
                $url = './Uploads/goods/'.$arr[0]['goods_photo'];
                unlink($url);

            }
            // echo $id;
            $res = $user->save($map);
            if(!$info && $res) {
                // 上传错误提示错误信息  
                echo '提交失败';      
                $this->error($upload->getError());    
            }else{
            // 上传成功       
            $this->success('修改成功！','pictureList',5);    
                }
        } else {
            $this->assign('list',$typeList);
            $this->assign('goods',$goodsList);
            $this->display('pictureList'); 
        }
    }

}
