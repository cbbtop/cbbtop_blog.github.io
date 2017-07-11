<?php
namespace Admin\Controller;

use Think\Controller;

class OrderController extends CommonController {

    // 订单列表
    public function orderList(){
        // var_dump($_GET);
        // exit;
        $user = M('order_info');

        //搜索条件
        if (isset($_POST['consignee']) && strlen($_POST['consignee']) > 0) {
            $map['consignee'] = ['like', '%'.I('consignee').'%'];
        }
        if (isset($_POST['status']) && strlen($_POST['status']) > 0) {
            $map['order_status'] = $_POST['status'];
        }
        $total = $user->where($map)->count();
        $page = new \Think\Page($total, 10);

        //定制分页按钮的显示
        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $arr = $user->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$arr);
        // var_dump($arr);
        $this->assign('btn', $page->show());
        $this->display('orderList');  
    }
    // ajax传值
    public function orderAjax(){
        $user = M('order_info');
        $status = $user->field('order_status')->select();
        $id = $user->field('order_id')->select();

        // var_dump($id); 
        foreach ($id as $key => $value) {
            $idt[] = $value['order_id'];
        }
        // var_dump($id);
        foreach ($status as $key => $value) {
            switch ($value['order_status']) {
                case '0':
                    $str[] = '待付款';
                    break;
                case '1':
                    $str[] = '待发货';
                    break;
                case '2':
                    $str[] = '已发货';
                    break;
                case '3':
                    $str[] = '取消订单';
                    break;           
            }         
        }

        $data[] = $str;
        $data[] = $idt;
        // var_dump($data);
        $this->ajaxReturn($data);
        exit;
    }

    // 删除订单
    public function orderListDel(){
        //批量删除:post 
        //选择删除:get
        $user = M('order_info');
        $attr = M('order_goods');
        if (IS_GET) {
            // var_dump($_GET);
            $pid['order_id'] = $_GET['id'];
            $type = $attr->where($pid)->select();
            // var_dump($type);
            // exit();
            if ($type !== null) {
                $arr = $attr->where($pid)->delete();  
            }
            $res = $user->where($pid)->delete();
            // 删除操作
            if ($res) {
              $this->success('删除成功','orderList',60);
            }else {
                $this->error('删除失败','orderList',60);
            }
        } elseif (IS_POST){
            if (empty($_POST['box'])) {
                $this->error('批量删除失败,请选择需要删除的','orderList',5);
            }
            // 功能：批量删除
            $arr = $_POST['box'];
            // var_dump($arr);
            // exit();
            foreach ($arr as $k => $val) {
                $id = $val; 
                $arr = $attr->where(['order_id'=>$id])->select();
                // var_dump($arr);
                // exit();
                if ($arr) {
                      $attr = $attr->while (['order_id'=>$id])->delete();
                      }
            }  
            $res = $user->where(['order_id'=>$id])->delete();
            if ($res) {
                   $this->success('批量删除成功','orderList',5);
                } else {
                    $this->error('批量删除失败','orderList',5);
                }                                       
        }  
    }

    // 查看订单详情
    public function orderGoods(){
        $id   = $_GET['id'];
        $userid = $_GET['userid'];
        // var_dump($id);
        // var_dump($userid);
        $user  = M('user');
        $order = M('order_info');
        $orderGoods = M('order_goods');
        $userList = $user->where("id=$userid")->select()[0];
        $goodsList = $orderGoods->where(['order_id'=>$id])->select();
        $orderList =  $order->where(['order_id'=>$id])->select()[0];
        // 计算总价格
        $goods_total = 0;
        foreach ($goodsList as $key => $val) {
            $goods_total = $goods_total + ($val['goods_number']*$val['goods_price']);
        }
            $this->assign('orderList',$orderList);
            $this->assign('userList',$userList);
            $this->assign('goodsList',$goodsList);
            $this->assign('goods_total',$goods_total);
            $this->display('orderGoods');
    }
}