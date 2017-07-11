<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends Controller {
	// 文章详情
    public function article(){

    	// var_dump($_GET);
    	// exit;
    	if (!empty($_GET)) {
    		$_SESSION['id'] = $_GET['id'];
    		$_SESSION['type_id'] = $_GET['type_id'];
    		$id = $_SESSION['id'];
    		$type_id = $_SESSION['type_id'];
    	}else {
    		$id = $_SESSION['id'];
    		$type_id = $_SESSION['type_id'];
    	}
    	
    	$comment = M('user_comment');
    	$commentList = $comment->where("type_id=$type_id AND commit_id=$id")->select();
    	// var_dump($commentList);
    	// // exit();

    	$user = M('article');
    	$type = M('article_type');
    	$arr = $user->where("article_id=$id")->select()[0];
    	$typeList = $type->where("id=$type_id")->select()[0];
	    // var_dump($arr);
	    // var_dump($typeList);
    	$this->assign('typeList',$typeList);
    	$this->assign('comment',$commentList);
    	$this->assign('arr',$arr);
    	$this->display();
    }
    // 用户评论
    public function comment(){
    	// var_dump($_GET);
    	$user = M('user_comment');
    	if (IS_POST) {
    		var_dump($_POST);
    		$map['type_id'] = $_POST['type_id'];
    		$map['commit_id'] = $_POST['article_id'];
    		$map['commit_user_name'] = $_POST['commit_user_name'];
    		$map['commit_content'] = $_POST['commit_content'];
    		$map['commit_time'] = time();
    		$res = $user->add($map);
    		$url =  $_SERVER['HTTP_REFERER'];
    		// var_dump($url);
    		// exit();
    		// var_dump($map);
    		if (!$res) {
    			$this->error('评论失败！','article',60);    
            }else{
            // 成功       
            	$this->success('上传成功！','article',60);    
                }
    	}
    	// $arr = $user->select();
    	// var_dump($arr);
    }
}