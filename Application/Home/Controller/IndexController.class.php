<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use ThinkOauth;
class IndexController extends CommonController {
    public function index(){
        $user = M('article');
        $stayMessage = M('stay_message');
        // $arr = M('user_comment');

        //留言列表
        $stayList = $stayMessage->limit(3)->select();

        // $type = M('article_type');
        // $typeList = $type->where('pid=0')->select();
        // $typetwo = $type->where('pid>0')->select();

        // dump($typetwo);
        // dump($typeList);
        // $this->assign('typetwo',$typetwo);
        // $this->assign('typeList',$typeList);
        // 文章列表
        $commentList = $user->limit(3)->select();
        // var_dump($commentList);
        foreach ($stayList as $key => $value) {
            $id = $value['article_id'];
            $maps[] = $user->where("article_id=$id")->select();
            // $map[]='commit_id';
            // $maps = array_combine($map, $id);


        }
        // echo count($maps);
        // for ($i=0; $i <count($maps) ; $i++) { 
        //     $maps = $maps[$i];           
        // }
       
        // var_dump($id);
        // var_dump($commentList);
        // var_dump($stayList);
        // var_dump($maps);

        $this->assign('commentList',$commentList);
        $this->assign('stayList',$stayList);

        $this->assign('maps',$maps);

        $this->display('Index/index');
        // $this->ajaxReturn($arr);

    }

    public function url(){

        $user = M('article');
        $type = M('article_type');
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $pid = $_GET['pid'];
            $total = $user
                    ->alias('a')
                    ->join('left join __ARTICLE_TYPE__ t on a.type_id=t.id')
                    ->where("a.type_id = $id")
                    ->count();
            // dump($pid);
            $page = new \Think\Page($total, 5);
            //定制分页按钮的显示
            $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $arr = $user
                    ->limit($page->firstRow.','.$page->listRows)
                    ->alias('a')
                    ->join('left join __ARTICLE_TYPE__ t on a.type_id=t.id')
                    ->where("a.type_id = $id")
                    ->order('article_time desc')
                    ->select();
        }
            // $arr = $user->select();
        if (!empty($_GET['tags']) || !empty($_POST)) {
             $search = $_POST['search'];
             $tags = $_GET['tags'];


            if(isset($_POST['search']) && strlen($_POST['search']) > 0){
                $map['article_name'] = ['like', '%'.$search.'%'];
            }
            if(isset($_GET['tags']) && strlen($_GET['tags']) > 0){
                $map['tags'] = ['like', '%'.$tags.'%'];
            }
                $total = $user->where($map)->count();
                // echo $total;
                $page  = new \Think\Page($total,5);

                $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
                $arr = $user
                    ->limit($page->firstRow.','.$page->listRows)
                    ->where($map)
                    ->order('article_time desc')
                    ->select();
                
            
        }
        $this->assign('btn', $page->show());
        $this->assign('arr',$arr);
        $this->display('Blog/blog');
        

    }
}