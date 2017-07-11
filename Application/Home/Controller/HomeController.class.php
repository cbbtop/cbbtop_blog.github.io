<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {
    public function home(){
    	$user = M('article');
    	$type = M('article_type');
    	$typeList = $type->select();
    	// if (IS_AJAX) {
    	// 	# code...
    	// 	$id = $_GET['id'];
    	// 	var_dump($id);
    	// }



    	if ($_GET['id']) {
    		$id = $_GET['id'];
    		var_dump($id);
    		// exit();
    		$total = $user
	                ->alias('a')
	                ->join('left join __ARTICLE_TYPE__ t on a.type_id=t.id')
	                ->where("a.type_id = $id")
	                ->count();
	        $page = new \Think\Page($total, 1);
	        //定制分页按钮的显示
	        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
	        $arr = $user
	        		->limit($page->firstRow.','.$page->listRows)
	        		->alias('a')
	                ->join('left join __ARTICLE_TYPE__ t on a.type_id=t.id')
	                ->where("a.type_id = $id")
	                ->select();
    	} else {
		  	$total = $user
		            ->alias('a')
		            ->join('left join __ARTICLE_TYPE__ t on a.type_id=t.id')
		            ->where(['a.type_id = t.id'])
		            ->count();

	        $page = new \Think\Page($total, 1);
	        //定制分页按钮的显示
	        $page->setConfig('theme','<span>共 %TOTAL_ROW% 条记录 第%NOW_PAGE%/%TOTAL_PAGE%页</span> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
	        $arr = $user
	        		->limit($page->firstRow.','.$page->listRows)
	        		->alias('a')
	                ->join('left join __ARTICLE_TYPE__ t on a.type_id=t.id')
	                ->where(['a.type_id = t.id'])
	                ->select();
    	}

        $this->assign('btn', $page->show());
    	$this->assign('arr',$arr);
    	// var_dump($typeList);
    	$this->assign('typeList',$typeList);
    	$this->display();
    	// $this->ajaxReturn($arr);

    }

    public function homeList(){
    	

    }

}