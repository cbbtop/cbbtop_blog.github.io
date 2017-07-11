<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends CommonController {
    public function post(){
    	$id = $_GET['id'];
    	$user = M('article');
    	//文章详情
    	$arr = $user->where("article_id = $id")->select();
    	// dump($arr);
    	// 文章留言
    	$message = M('stay_message');
    	$messageList = $message->where("article_id = $id")->select();
    	// dump($messageList);


    	$this->assign('arr',$arr);
    	$this->assign('messageList',$messageList);

    	$this->display();
    }
   public function postAdd(){
    $message = M('stay_message');

   	// dump($_GET);
   	// dump($_POST);
   	$id = $_GET['id'];
   	$user_id = $_GET['user_id'];
   	$map['user_name'] = I('post.user_name');
   	$map['message_content'] = I('post.message_content');
   	$map['message_stay_time'] = time();
   	$map['user_id'] = I('get.user_id');
   	$map['article_id'] = I('get.id');

   	$res = $message->add($map);
   	// dump($res);
   	if ($res) {
   		$this->redirect('Post/post', array('id' => $id), 5, '留言成功页面跳转中...');
   	}else {
   		$this->error('留言失败','Post/post');
   	}
   }
}