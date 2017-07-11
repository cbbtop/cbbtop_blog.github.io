<?php
namespace Admin\Controller;

use Think\Controller;

class ProductController extends Controller {
    // 分类管理
    public function productCategory(){
        $user = D('article_type');
        //分页搜索条件
        if (isset($_POST['type_name']) && strlen($_POST['type_name']) > 0) {
            $map['name'] = ['like', '%'.I('type_name').'%'];
        }
        $total = $user->where($map)->count();
        $page = new \Think\Page($total, 5);
        //定制分页按钮的显示
        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $arr = $user->where($map)->order('id')->limit($page->firstRow.','.$page->listRows)->select();

        $this->assign('list',$arr);
        $this->assign('btn', $page->show());
        $this->display('productCategory');
        
    }
    // 添加子分类
    public function productCategoryAdd(){
        $user = D('article_type');   
        if (IS_GET) {
            $id = $_GET['id'];
            $res  = $user->where(['id'=>$id])->find();
            $this->assign('info',$res);
            $this->display();
        } elseif(IS_POST) {
            // $preg = '/\w{2,16}/';
            // $mat  = preg_match($preg, $_POST['name']);
            //验证规则
            $rule=array(
            array('name','require','请输入分类名',1),
            // array('name', '/\w{2,16}/', '分类名不合法,请输入2~16位'),
            array('name', '', '分类名已经存在', 0, 'unique'),
            );
            if (!$user->validate($rule)->create()){
                $this->error($user->getError());
            } else{
                $arr['name'] = $_POST['name'];
                $arr['pid'] = $_POST['pid'];
                $arr['path'] = $_POST['path'].$_POST['pid'].',';
                $res = $user->add($arr);
                if ($res) {
                     $this->success('增加成功','productCategory');
                } else {
                    $this->error('添加失败');
                }
            }
        }  
    }
    // 删除分类
    public function productCategoryDel(){
        //批量删除:post 
        //选择删除:get
        $user = M('article_type');
        if (IS_GET) {
            //判断是否存在子类(id如果能在父类的pid里面查到说明有子类)
            $pid['pid'] = $_GET['id'];
            $type = $user->where($pid)->select();
            if ($type == null) {
                 // 删除操作 
                 $res = $user->where($_GET)->delete();
                 if ($res) {                 
                  $this->success('删除成功','productCategory',60);
                 }else {
                    $this->error('删除失败','productCategory');
                 }
            } else {
                $this->error('删除失败,请先删除子类','productCategory');
            }
        } elseif (IS_POST){
            //操作：批量删除
            //判断是否存在子分类
            if (!empty($_POST)){
                $pid = $_POST['box'];
                // var_dump($pid);
                foreach ($pid as $k => $val) {
                    $pid = $val;
                    $res[] = $user->where(['pid'=>$pid])->select();
                }               
            } else {
                $this->error('批量删除失败,请选择需要删除的','productCategory',5);
            }
            // 遍历判断查询的数组中是否有子分类，true：不可删 false：可以删
            foreach ($res as $key => $val) {
                if ($val !== null) {
                    $str = true;
                    break;
                }
                $str = false;
            }
            //如何不存在子分类，删除操作
            if (!$str) {
                $arr = $_POST['box'];
                foreach ($arr as $k => $val) {
                    $id = $val; 
                    $res = $user->where(['id'=>$id])->delete();
                    if ($res) {
                           $this->success('批量删除成功','productCategory',5);
                        } else {
                            $this->error('批量删除失败','productCategory',5);
                        }             
                    } 
            }else {
                        $this->error('删除失败,请先删除子类','productCategory',5);
                    }
        }       
    }
    // 修改分类页面
    public function productEdit(){       
            $user = M('article_type');
            $id = $_GET['id'];
            $res  = $user->where(['id'=>$id])->find();
            $this->assign('info',$res);
            if (IS_POST){
                $id = $_POST['id'];
                $arr['name'] = $_POST['name'];
                $res = $user->where(['id'=>$id])->save($arr);
                if ($res) {
                     $this->success('修改成功','productCategory',5);
                } else {
                    $this->error('修改失败');
                }
            } else {
                $this->display();
            }       
    }
    // 添加顶级分类
    public function parentAdd(){
        $user = M('article_type');
        if (IS_POST) {
            //验证规则
            $rule=array(
            array('name','require','请输入顶级分类名',1),
            // array('name', '/\w{2,16}/', '顶级分类名不合法,请输入2~16位'),
            array('name', '', '顶级分类名已经存在', 0, 'unique'),
            );
            if (!$user->validate($rule)->create()){
                $this->error($user->getError());
            } else{
                $arr['name'] = $_POST['name'];
                $arr['pid'] = 0;
                $arr['path'] = '0,';
                $res = $user->add($arr);
                if ($res) {
                     $this->success('增加顶级分类成功', 'productCategory');
                } else {
                    $this->error('添加顶级分类失败');
                }
            }
        } else {
            $this->display();
        }
    }  
    // 文章列表
    public function productList(){       
        $user = M('article');
        //搜索条件
        if (isset($_POST['article_name']) && strlen($_POST['article_name']) > 0) {
            $maps['article_name'] = ['like', '%'.I('article_name').'%'];
        }
        if (isset($_POST['status']) && strlen($_POST['status']) > 0) {
            $maps['article_up'] = $_POST['status'];
        }
        $total = $user->where($maps)->count();
        $page = new \Think\Page($total, 2);

        //定制分页按钮的显示
        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        // 文章状态
        // 不置顶
        if (!empty($_GET['id']) && $_GET['status'] === '1'){
           $map['article_id'] = $_GET['id'];
           $map['article_up'] =  0;
           $res = $user->save($map);
        // 置顶
        } elseif(!empty($_GET['id']) && $_GET['status'] === '0') {
           $map['article_id'] = $_GET['id'];
           $map['article_up'] =  1;
           $res = $user->save($map);
        }
        // 文章的模式
        // 私有
        if (!empty($_GET['id']) && $_GET['status2'] === '1'){
            // var_dump($_GET);
           $map['article_id'] = $_GET['id'];
           $map['article_type'] =  0;
           $res = $user->save($map);
        // 公开
        } elseif(!empty($_GET['id']) && $_GET['status2'] === '0') {
           $map['article_id'] = $_GET['id'];
           $map['article_type'] =  1;
           $res = $user->save($map);
        }
        $arr = $user->where($maps)->limit($page->firstRow.','.$page->listRows)->select();        
        $this->assign('list',$arr);
        $this->assign('btn', $page->show());
        $this->display('productList');  
    }
    // 文章添加
    public function productListAdd(){
        // $username = $_SESSION;
        // exit();
        $user = M('article');
        $type = M('article_type');
        $typeList = $type->field('id,name')->select(); 
        if (IS_POST){
            // var_dump($_POST);
            // exit();

             //验证规则
            $rule=array(
            // 文章名称
            array('article_name','require','请输入文章名称',1),
            array('article_name','','文章名称已经存在！',0,'unique',1),
  
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
                $upload->savePath  =      'goods/'; // 设置附件上传目录    // 上传文件  
                $info   =   $upload->upload();

                // 添加form表单数据
                $map['article_up']  = $_POST['article_up'];
                $map['article_des'] = $_POST['article_des'];
                $map['article_type']= $_POST['article_type'];
                $map['user_name']  = $_POST['user_name'];
                $map['type_id']     = $_POST['type_id'];
                $map['article_name']  = $_POST['article_name'];
                $map['article_content']  = $_POST['article_content'];
                $map['article_photo'] = $info['article_photo']['savename'];
                $map['article_time']    = time();
                $map['last_update'] = time();
                $map['tags'] = $_POST['tags'];

                // var_dump($map);
                // exit();
                $res = $user->add($map);
                // var_dump($res);
                // dump($info);
                // exit;
                if($info && $res) {
                    // 上传成功       
                    $this->success('上传成功！','productList',5);    
                }else{
                    // 上传错误提示错误信息  
                    // echo '提交失败';      
                    $this->error($upload->getError());    
                }
            }
        } else {
            $this->assign('list',$typeList);
             $this->display('productListAdd'); 
        }
       
    }
    // 文章删除
    public function productListDel(){
        //批量删除:post 
        //选择删除:get
        $user = M('article');
        // $attr = M('goods_attr');
        if (IS_GET) {
            //判断是否存在子类(id如果能在父类的pid里面查到说明有子类)
            $id = $_GET['id'];
            // $type = $attr->where("goods_uid=$id")->select();
            // var_dump($type);
            // if ($type == null) {
                // 删除本地文件夹图片
            $arr = $user->where("article_id=$id")->select();  
            $url = './Uploads/goods/'.$arr[0]['article_photo'];
            unlink($url);
            $res = $user->where("article_id=$id")->delete();
            // 删除操作
            if ($res) {
              $this->success('删除成功','productList',60);
            }else {
                $this->error('删除失败','productList',60);
            }
            // } else {
                // $this->error('删除失败,请先删除子类','productList');
            // }
        } elseif (IS_POST){
            // var_dump($_POST);
            // 功能：批量删除
            //判断是否存在属性商品
            // if (!empty($_POST['box'])){
            //     $pid = $_POST['box'];
            //     foreach ($pid as $k => $val) {
            //         $pid = $val;
            //         $res[] = $attr->where(['goods_uid'=>$pid])->select();
            //     }               
            // } else {
            //       $this->error('批量删除失败,请选择需要删除的','productList',5);

            // }
            // 遍历判断查询的数组中是否有商品分类的商品，true：不可删，有子属性商品 false：可以删
            // foreach ($res as $key => $val) {
            //     if ($val !== null) {
            //         $str = true;
            //         break;
            //     }
            //     $str = false;
            // }
            //如何不存在属性商品，删除操作
            // if (!$str) {
            $arr = $_POST['box'];
            foreach ($arr as $k => $val) {
                $id = $val; 
                // 删除本地文件夹图片
                $arr = $user->where(['article_id'=>$id])->select();  
                $url = './Uploads/goods/'.$arr[0]['article_photo']; 
                unlink($url);
                $res = $user->where(['article_id'=>$id])->delete();
                if ($res) {
                       $this->success('批量删除成功','productList',5);
                    } else {
                        $this->error('批量删除失败','productList',5);
                    }                    
            } 
            // }else {
            //             $this->error('删除失败,请先删除子类','productList',5);
            //         }
        }       
    }
    // 文章的修改编辑
    public function productListEdit(){
        $user = M('article');
        $type = M('article_type');
        if ($_GET) {
           $id   = $_GET['id'];
           $goodsList = $user->where(['article_id'=>$id])->select();
        }
        
        // var_dump($goodsList);
        $typeList = $type->field('id,name')->select(); 
        if (IS_POST){
            //验证规则
            $rule=array(
            // 文章名称
            array('article_name','require','请输入商品名',1),
            // array('goods_name', '/\w{2,16}/', '商品名称不合法,请输入2~16位'),
            // array('goods_name', '', '商品名已经存在', 1, 'unique'),
            // 选择分类
            // array('type_id','require','请选择分类',1),
            // 状态
            // array('is_on_sale','require','请选择下状态',1),
            // 库存
            // array('goods_photo','require','请输选择商品图片',1),
  
            );
            if (!$user->validate($rule)->create()){
                $this->error($user->getError());
            } else{
                $id = $_POST['id'];
                // 图片文件上传
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;//设置附件上传大小   
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
                $upload->saveName  =     date('Y-m-d',time()).mt_rand(); 
                $upload->autoSub = false;// 关闭子目录
                $upload->savePath  =      'goods/'; // 设置附件上传目录    // 上传文件  
                $info   =   $upload->upload();
                // 添加form表单数据
                $map['article_id']  = $id;
                $map['article_des'] = $_POST['article_des'];
                $map['article_up']  = $_POST['article_up'];
                $map['article_type']= $_POST['article_type'];
                $map['user_name']  = $_POST['user_name'];
                $map['type_id']     = $_POST['type_id'];
                $map['article_name']  = $_POST['article_name'];
                $map['article_content']  = $_POST['article_content'];
                $map['article_photo'] = $info['article_photo']['savename'];
                $map['last_update'] = time();
                $map['tags'] = $_POST['tags'];


                if($info){
                    $map['article_photo'] = $info['article_photo']['savename'];
                    // 删除原图
                    $arr = $user->where(['article_id'=>$id])->select();
                    $url = './Uploads/goods/'.$arr[0]['article_photo'];
                    unlink($url);

                }
                $res = $user->save($map);
                if(!$res) {
                    // 上传错误提示错误信息  
                    echo '提交失败';      
                    $this->error($upload->getError());    
                }else{
                // 上传成功       
                $this->success('修改成功！','productList',5);    
                }
            }
        } else {
            $this->assign('list',$typeList);
            $this->assign('goods',$goodsList);
            $this->display('productListEdit'); 
        }
    }

    // 商品属性管理
    public function productAttr(){
        $user = M('goods');
        // $type = M('goods_attr');
        // $arr = $type->select();
        // $res = $type->getfield('goods_uid',true);
        // foreach ($res as $key => $value) {
        //     $res['goods_id'] = $value;
        // }
        // $goods = $user->where($val)->select();
        // foreach ($goods as $key => $value) {
        //     $arr[$key]['goods_name'] = $value['goods_name'];
        // }
        // 联查
         $res= $user
                // ->field('g.*,t.name as tname')
                ->alias('g')
                ->join('left join __GOODS_ATTR__ t on g.goods_id=t.goods_uid')
                ->where(['g.goods_id = t.goods_uid'])
                ->select();
        // var_dump($res);
        $this->assign('attrList',$res);
        // $this->assign('goods',$goods);


        $this->display('productAttr'); 
    }

    // 删除商品属性操作
    public function productAttrDel(){
        //批量删除:post 
        //选择删除:get
        $attr = M('goods_attr');
        if (IS_GET) {
            $id = $_GET['id'];   
            $res = $attr->where(['attr_id'=>$id])->delete();
            // 删除操作
            if ($res) {
              $this->success('删除成功','productAttr',60);
            }else {
                $this->error('删除失败','productAttr',60);
            }         
        } elseif (IS_POST){
            if (empty($_POST['box'])) {
                $this->error('批量删除失败,请选择需要删除的','productAttr',50);
            }
            // 功能：批量删除
            $arr = $_POST['box'];
            foreach ($arr as $k => $val) {
                $id = $val;
                $res = $attr->where(['attr_id'=>$id])->delete();
                if ($res) {
                       $this->success('批量删除成功','productAttr',50);
                    } else {
                        $this->error('批量删除失败','productAttr',50);
                }                    
            }          
        }       
    }

    // 添加商品属性
    public function productAttrAdd(){
        $attr = M('Goods_attr');
        $user = M('Goods');
        $userList = $user->field('goods_id,goods_name')->select(); 
        if (IS_POST){
            // 验证规则
            $rule=array(
            // 颜色
            array('attr_color','require','请输入颜色',1),
            // array('attr_color', '/^[A-Za-z]+$/', '颜色名称不合法,请输入2~16位'),
            // 尺寸
            array('attr_size','require','请输入尺寸',1),
            // array('attr_size', '/\w{2,16}/', '尺寸命名名不合法,请输入2~16位'),
            // 库存
            array('attr_size','require','请输入库存',1),
            array('attr_size', 'number', '库存输入不合法,只能是正数、数字'),
            );
            if (!$attr->validate($rule)->create()){
                $this->error($attr->getError());
            } else{         
                $map['attr_color']  = $_POST['attr_color'];
                $map['attr_size']   = $_POST['attr_size'];
                $map['goods_uid']   = $_POST['goods_id'];
                $map['attr_number'] = $_POST['attr_number'];
                $map['add_time']    = time();
                $map['last_update'] = time();
                $res = $attr->add($map);
                if($res) { 
                    $this->success('上传成功！','productAttr',60);  
                }else{
                    $this->error('提交失败！','productAttr',60);    
                }
            }
        } else {
            $this->assign('list',$userList);
             $this->display('productAttrAdd'); 
        }       
    }
    // 编辑修改商品属性
    public function productAttrEdit(){
        $attr = M('Goods_attr');
        $user = M('Goods');
        $id = $_GET['attr_id'];
        // $id  = $_GET['id'];
        // var_dump($id);
        $attrList = $attr->where(['attr_id'=>$id])->select()[0];
        // var_dump($attrList);
        $goodsList = $user->field('goods_id,goods_name')->select(); 
        // var_dump($goodsList);
        if (IS_POST){
            // 验证规则
            $rule=array(
            // 颜色
            array('attr_color','require','请输入颜色',1),
            array('attr_color', '/\w{2,16}/', '颜色名称不合法,请输入2~16位'),
            // 尺寸
            array('attr_size','require','请输入尺寸',1),
            // 库存
            array('attr_size','require','请输入库存',1),
            );
            if (!$attr->validate($rule)->create()){
                $this->error($attr->getError());
            } else{     
                $attr_id = $_POST['id'];
                // echo $attr_id;    
                $map['attr_color']  = $_POST['attr_color'];
                $map['attr_size']   = $_POST['attr_size'];
                $map['goods_uid']   = $_POST['goods_id'];
                $map['attr_number'] = $_POST['attr_number'];
                $map['add_time']    = time();
                $map['last_update'] = time();
                // var_dump($map);
                // exit();
                $res = $attr->where("attr_id=$attr_id")->save($map);
                // var_dump($res);
                // var_dump($map);
                if($res) { 
                    $this->success('上传成功！','productAttr',60);  
                }else{
                    $this->error('提交失败！','productAttr',60);    
                }
            }
        } else {
            $this->assign('list',$attrList);
            $this->assign('goodsList',$goodsList);
            $this->display('productAttrEdit'); 
        }       
    }
}
