<?php
namespace Home\Controller;
use Think\Controller;
class BlogController extends CommonController {
    public function blog(){
    	$this->display('Blog/blog');
    }
}