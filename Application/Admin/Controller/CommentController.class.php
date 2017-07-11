<?php
namespace Admin\Controller;

class CommentController extends CommonController {
    public function comment_list(){
        $user = D('stay_message');
        //搜索条件
        if (isset($_GET['username']) && strlen($_GET['username']) > 0) {
            $map['user_name'] = ['like', '%'.I('get.username').'%'];
        }
        $total = $user->where($map)->count();
        $page = new \Think\Page($total, 3);

        //定制分页按钮的显示
        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        $arr = $user->where($map)->limit($page->firstRow, $page->listRows)->select();

        $this->assign('total',$total);
        $this->assign('list', $arr);
        $this->assign('btn', $page->show());
    	$this->display('comment-list');
    }


    //删除用户
    public function del($id)
    {
        //通过id值删除对应数据库中的数据
        //1 删除用户表中的数据
        $res = M('stay_message')->delete($id);
        
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
        //1 删除评价表中的数据
        //注意：delete中只能传字符串
        $res = M('stay_message')->delete($map);     
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }


    //编辑回复
    public function comment_reply()
    { 
        if (IS_GET) { 
            //接收修改页面传过来的id值
            $id = $_GET['comment_id'];
            $user = M('stay_message');
            //根据id值查出要修改数据的值
            $res = $user->where(['stay_id'=>$id])->find();
            //分配查到的数据
            $this->assign('res',$res);
            $this->display();
        }
    
        if (IS_POST) { 
            //create方法触发自动验证
            $user = D('stay_message');
            if (!$user->create()){
                $this->error($user->getError());
            } else{ 
                //1.接收隐藏域传送的id
                $id = $_POST['id'];
                //3.将更新的数据插入数据库
                $map['reply'] = $_POST['reply'];
                //修改评论回复状态
                $map['rep_status'] = 1;
                $res = M('stay_message')->where(['stay_id'=>$id])->save($map);
                if (!$res) { 
                    $this->error('修改失败');
                }
                $this->success('修改成功',U('comment_list'));
            }
        }
    }


    //修改显示状态
    public function mod_status()
    { 
        //获取需要修改的用户的id
        $id = $_GET['id'];
        $user = M('Comment');
        //查找到该用户当前状态值
        $res = $user->where(['comment_id'=>$id])->getField('is_show');
        //修改状态值
        if ($res == 0) { 
            $res = 1;
        } else { 
            $res = 0;
        } 
        //将修改的状态值写入数据库
        $map['is_show'] = $res;
        $str = $user->where(['comment_id'=>$id])->save($map);
        if (!$str) { 
            $this->error('状态修改失败');
        }
        $this->success('状态修改成功',U('comment_list'));
    }

    //ajax修改显示状态
    public function getData()
    { 
        $id = $_GET['comment_id'];
        $is_show = $_GET['is_show'];
        if ($is_show == 1) { 
            $is_show = 0;
        } else { 
            $is_show = 1;
        } 
        $map['is_show'] = $is_show;
        $type = M('Comment');
        $type->where(['comment_id'=>$id])->save($map);
        
        $this->ajaxReturn($is_show);
        //return true;
    }
}