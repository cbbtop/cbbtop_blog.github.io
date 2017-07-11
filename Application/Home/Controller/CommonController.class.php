<?php
namespace Home\Controller;

class CommonController extends \Think\Controller {
    public function _initialize(){
        $men = new \Memcache();
        $res = $men->connect('localhost', 11211);
        // var_dump($res);

        //存内容: (键，值，是否压缩，有效期)
        // $mem->set('name', '杨胖子');
        // $mem->set('key', 'YaMaDie', 0, 10);
        //存的是数组，拿出来的也是数组
        // $mem->set('key', [1,2,3,4,5], 0, 10);


        // $res = $mem->get('key');
        $comment = M('stay_message');
        $user = M('article');
        $type = M('article_type');
        $link = M('friendly_link');
        // Memcache缓存设置
        $typeList = $men->get('typeList');
        $typetwo = $men->get('typetwo');
        $articleList = $men->get('articleList');
        $tagsList = $men->get('tagsList');
        $linkList = $men->get('linkList');
        $commentList = $men->get('commentList');  

        if(empty($typeList))
        {
            // echo '进来了';
            // 导航条
            $typeList = $type->where('pid=0')->select();
            $typetwo = $type->where('pid>0')->select();
            // 右侧最新文章
            $articleList = $user->order('article_time desc')->limit(5)->select();
            $tagsList    = $user->field('tags')->select();
             //友情链接
            $linkList   = $link->select();
            //评论列表
            $commentList = $comment->order('message_stay_time desc')->limit(5)->select();
            foreach ($tagsList as $key => $value) {
            $arr[] = $value['tags'];
            $tags = array_unique($arr);

            }
            // Memcache设置值
            $men->set('typeList', $typeList, 0, 10);
            $men->set('typetwo', $typetwo, 0, 10);
            $men->set('articleList', $articleList, 0, 10);
            $men->set('tagsList', $tagsList, 0, 10);
            $men->set('linkList', $linkList, 0, 10);
            $men->set('commentList', $commentList, 0, 10);
            // Memcache获取值
            $typeList = $men->get('typeList');
            $typetwo = $men->get('typetwo');
            $articleList = $men->get('articleList');
            $tagsList = $men->get('tagsList');
            $linkList = $men->get('linkList');
            $commentList = $men->get('commentList');   
        }
      
       // var_dump($tags);
        $this->assign('typetwo',$typetwo);
        $this->assign('tags',$tags);
        $this->assign('typeList',$typeList);
        $this->assign('articleList',$articleList);
        $this->assign('linkList',$linkList);
        $this->assign('commentList',$commentList);



        // $this->display('public/_menu');

    }
}