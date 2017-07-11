<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
    public function article(){
    	$this->display('article-list');
    }
}