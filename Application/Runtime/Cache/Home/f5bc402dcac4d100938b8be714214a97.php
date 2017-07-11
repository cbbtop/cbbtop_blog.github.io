<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>开源项目-钟伟建博客,技术博客,个人博客, php博客，钟伟建的个人博客</title>
<meta name="keywords" content="个人博客,thinkphp博客,php博客,技术博客,钟伟建"/><meta name="description" content="钟伟建的php博客,个人技术博客"/>
<link rel="shortcut icon" type="image/x-icon" href="style/images/favicon.png" />
<link rel="stylesheet" type="text/css" href="/jian/Public/Home/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/jian/Public/Home/style/css/prettyPhoto.css"  />
<link rel="stylesheet" type="text/css" href="/jian/Public/Home/style/css/nivo-slider.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/jian/Public/Home/style/type/classic.css" media="all" />
<link rel="stylesheet" type="text/css" href="/jian/Public/Home/style/type/goudy.css" media="all" />
<script type="text/javascript" src="/jian/Public/Home/style/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/jian/Public/Home/style/js/superfish.js"></script>
<script type="text/javascript" src="/jian/Public/Home/style/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/jian/Public/Home/style/js/jquery.nivo.slider.js"></script>
</head>


<body>
<div id="body-wrapper"> 
  <!-- Begin Header -->
  <div id="header">
    <div class="logo">
      <a href="<?php echo U('Index/index');?>""><img src="/jian/Public/Home/style/images/logo1.png" alt="" /></a>
    </div>

<block ncame="menu">
    <!-- Begin Menu -->
    
     <div class="menu">
      <ul class="sf-menu">
      <li><a href="<?php echo U('Index/index');?>">首页</a>
        </li>
      <?php if(is_array($typeList)): foreach($typeList as $k=>$val): ?><li><a href="#"><?php echo ($val["name"]); ?></a>
          <ul>
          <?php if(is_array($typetwo)): foreach($typetwo as $key=>$v): if($v['pid'] == $val['id'] ): ?><li><a href="<?php echo U('Index/url');?>?id=<?php echo ($v['id']); ?>&pid=<?php echo ($val['id']); ?>"><?php echo ($v["name"]); ?></a></li>
            <?php else: endif; endforeach; endif; ?>
          </ul>
        </li><?php endforeach; endif; ?>
         <li><a href="#">开源</a>
          <ul>
            <li><a href="https://github.com/wilkins007">Github</a></li>
            <!-- <li><a href="#">码云</a></li> -->
          </ul>
        </li>
     <!--    <li><a href="<?php echo U('Gallery/gallery');?>">Gallery</a></li>
        <li><a href="<?php echo U('Typegraphy/typegraphy');?>">Typography</a></li>
        <li><a href="<?php echo U('Columns/columns');?>">Columns</a></li>
        <li><a href="<?php echo U('Contact/contact');?>">Contact</a></li> -->
     
      </ul>
    </div>
    <div class="clear"></div>
    <!-- End Menu -->  

  </div>
  <!-- End Header --> 


 
  <!-- Begin Wrapper -->
  <div id="wrapper">
  
   <div class="intro">The most difficult thing is the decision to act. And the rest is merely tenacity.</div>
   
  	<!-- Begin Container -->
  	<div class="container">

    <?php if(is_array($arr)): foreach($arr as $k=>$vo): ?><div class="post photo">
    <!-- <div class="icon-photo"></div> -->
    <div class="icon-text"></div>
    <div class="content">
    	<div class="top"></div>
    	<div class="middle">
            <a href="<?php echo U('Post/post');?>?id=<?php echo ($vo["article_id"]); ?>">
    		    <img src="/jian/Uploads/goods/<?php echo ($vo["article_photo"]); ?>" alt="" />
            </a>
    		<div class="post-text">
    			<a href="<?php echo U('Post/post');?>?id=<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_name"]); ?>
                </a>
    		</div>
			<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
                    <li><span></span>作者：钟伟建</li>

    				<li><span class="post-link"></span><a href="#"><?php echo date('Y-m-d H:i:s',$vo['article_time']);?></a></li>
    				<!-- <li><span class="post-comment"></span><a href="#">人气(<?php echo ($vo["article_click"]); ?>)</a></li> -->
    				<li><span class="post-tag"></span><?php echo ($vo["tags"]); ?></li>

    			</ul>
    			<div class="share"><span class="post-share"></span><a href="<?php echo U('Post/post');?>?id=<?php echo ($vo["article_id"]); ?>">阅读全文</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div><?php endforeach; endif; ?>
    
    <!-- 
    <div class="post text">
    <div class="icon-text"></div>
    <div class="content">
    	<div class="top"></div>
    	<div class="middle">
    		<div class="post-text">
    			<h2 class="title"><a href="#">An Example Post</a></h2>
    			<p>Cras adipiscing fringilla gravida. Quisque lectus nisl, blandit dictum aliquam vel, porttitor sit amet quam. Donec sed mauris ante, commodo purus. Nunc condimentum, sapien a aliquet elementum, dui neque facilisis arcu, 				eu cursus nunc velit at orci. Nunc congue, nisi sed elementum aliquam, 
				<br /><br />
				Etiam condimentum lacinia bibendum. Sed tempor feugiat purus, idetsen dapibus eros sagittis sed nulla lacina. Pellentesque habitant morbi laciros.
				</p>
    		</div>
    		<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
    				<li><span class="post-link"></span><a href="#">26 August 2011</a></li>
    				<li><span class="post-comment"></span><a href="#">15</a></li>
    				<li><span class="post-tag"></span><a href="#">quote</a>, <a href="#">library</a></li>
    			</ul>
    			<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div>
    
    <div class="post video">
    <div class="icon-video"></div>
    <div class="content">
    	<div class="top"></div>
    	<div class="middle">
    		<iframe src="http://player.vimeo.com/video/26028186?title=0&amp;byline=0&amp;portrait=0&amp;color=a7b5a6" frameborder="0" height="335" width="595"></iframe>
    		<div class="post-text">
    			<h2 class="title"><a href="#">An Example Post</a></h2>
    			<p>Cras adipiscing fringilla gravida. Quisque lectus nisl, blandit dictum aliquam vel, porttitor sit amet quam. Donec sed mauris ante, commodo purus. Nunc condimentum, sapien a aliquet elementum, dui neque facilisis arcu, 				eu cursus nunc velit at orci. Nunc congue, nisi sed elementum aliquam, 
				<br /><br />
				Etiam condimentum lacinia bibendum. Sed tempor feugiat purus, idetsen dapibus eros sagittis sed nulla lacina. Pellentesque habitant morbi laciros.</p>
    		</div>
    		<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
    				<li><span class="post-link"></span><a href="#">26 August 2011</a></li>
    				<li><span class="post-comment"></span><a href="#">15</a></li>
    				<li><span class="post-tag"></span><a href="#">quote</a>, <a href="#">library</a></li>
    			</ul>
    			<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div> -->
 <!--    
    <div class="post audio">
    <div class="icon-audio"></div>
    <div class="content">
    	<div class="top"></div>
    	<div class="middle">
    		<div class="post-text">
    			<h2 class="title"><a href="#">Icona Pop - Nights Like Bonita</a></h2>
    			<iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F29449040&show_artwork=true"></iframe>
    		</div>
    		<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
    				<li><span class="post-link"></span><a href="#">26 August 2011</a></li>
    				<li><span class="post-comment"></span><a href="#">15</a></li>
    				<li><span class="post-tag"></span><a href="#">quote</a>, <a href="#">library</a></li>
    			</ul>
    			<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div>
    
    <div class="post link">
    <div class="icon-link"></div>
    <div class="content">
    	<div class="top"></div>
    	<div class="middle">
    		<div class="post-text">
    			<h2 class="title"><a href="#">My Favorite Website Link →</a></h2>
    			<p>Cras adipiscing fringilla gravida. Quisque lectus nisl, blandit dictum aliquam vel, porttitor sit amet quam. Donec sed mauris ante, commodo purus. Nunc condimentum, sapien a aliquet elementum, dui neque facilisis arcu, eu cursus nunc velit at orci. Nunc congue, nisi sed elementum aliquam</p>
    		</div>
    		<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
    				<li><span class="post-link"></span><a href="#">26 August 2011</a></li>
    				<li><span class="post-comment"></span><a href="#">15</a></li>
    				<li><span class="post-tag"></span><a href="#">quote</a>, <a href="#">library</a></li>
    			</ul>
    			<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div>
    
    <div class="post quote">
    <div class="icon-quote"></div>
    <div class="content">
    	<div class="top"></div>
    	<div class="middle">
    		<div class="post-text">
    			<p>Pellentesque ultricies nunc sedor duir aliquet, sed elit justo, lacinia neco commodo vitarem. Quisque convallis, nulla eu semper ultrices fringilla viverra.</p>
    		</div>
    		<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
    				<li><span class="post-link"></span><a href="#">26 August 2011</a></li>
    				<li><span class="post-comment"></span><a href="#">15</a></li>
    				<li><span class="post-tag"></span><a href="#">quote</a>, <a href="#">library</a></li>
    			</ul>
    			<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div>
    
    <div class="post chat">
    <div class="icon-chat"></div>
    <div class="content">
    	<div class="top"></div>c
    	<div class="middle">
    		<div class="post-text">
    			<ul class="chat-text">
  					<li class="odd user_1"> <span class="speaker">John:</span> <span class="says">Sed neque nulla, eleifend eu laoreet sit?</span> </li>
  					<li class="even user_2"> <span class="speaker">Lora:</span> <span class="says">Curabitur hendrerit euismod mauris sit amet porta.</span> </li>
  					<li class="odd user_1"> <span class="speaker">John:</span> <span class="says">Curabitur rutrum, elit sit amet varius pellentesque, purus nisi tristique leo, et suscipit arcu.</span> </li>
				</ul>
    		</div>
    		<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
    				<li><span class="post-link"></span><a href="#">26 August 2011</a></li>
    				<li><span class="post-comment"></span><a href="#">15</a></li>
    				<li><span class="post-tag"></span><a href="#">quote</a>, <a href="#">library</a></li>
    			</ul>
    			<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div> -->
    
    <!-- Begin Page Navi -->
    <div class="page-navi">
    		<!-- <ul>
    			<li><a href="#" class="current">1</a></li>
    			<li><a href="#">2</a></li>
    			<li><a href="#">3</a></li>
    		</ul> -->
            <?php echo ($btn); ?>
    </div>
    <!-- End Page Navi -->
    
	</div> <!-- End Container -->

	<div class="sidebar">
    <!-- 搜索 -->
	    <div class="sidebox">
            <h3 class="line">Search</h3>
            <form class="searchform" action="<?php echo U('Index/url');?>" method="post">
                <input type="text" id="s" name="search" value="搜索文章" onfocus="this.value=''" onblur="this.value='搜索文章'"/>
            </form>
        </div>
    <!-- 搜索结束 -->
    	<div class="sidebox">
			<h3 class="line">热门标签</h3>
			<ul class="cat-list">
			<?php if(is_array($tags)): foreach($tags as $key=>$vo): ?><li><a href="<?php echo U('Index/url');?>?tags=<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li><?php endforeach; endif; ?>
			</ul>
		</div>
		<div class="sidebox">
			<h3 class="line">最新评论</h3>
			<ul class="popular-posts">
                <?php if(is_array($commentList)): foreach($commentList as $k=>$vo): ?><li>
                    <a href="#"><img src="/jian/Public/Home/style/images/art/ad1.jpg" alt="钟伟建的博客" /></a>
                    <h5><a href="<?php echo U('Post/post');?>?id=<?php echo ($vo['article_id']); ?>"><?php echo ($vo["user_name"]); ?></a></h5>
                    <h5><a href="#">留言：<?php echo ($vo["message_content"]); ?></a></h5>
                    <span><?php echo date('Y-m-d H:i:s',$vo['message_stay_time']);?> | <a href="<?php echo U('Post/post');?>?id=<?php echo ($vo['article_id']); ?>"><?php echo ($vo["user_name"]); ?></a></span>
                </li><?php endforeach; endif; ?>
            </ul>
		</div>
		
		<div class="sidebox">
			<h3 class="line">最新文章</h3>
			<ul class="popular-posts">
                <?php if(is_array($articleList)): foreach($articleList as $k=>$vo): ?><li>
					<a href="<?php echo U('Post/post');?>?id=<?php echo ($vo["article_id"]); ?>"><img src="/jian/Public/Home/style/images/art/ad1.jpg" alt="钟伟建的博客" /></a>
					<h5><a href="<?php echo U('Post/post');?>?id=<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_name"]); ?></a></h5>
					<span><?php echo date('Y-m-d H:i:s',$vo['article_time']);?> | <a href="#"><?php echo ($vo["user_name"]); ?></a></span>
				</li><?php endforeach; endif; ?>
			</ul>
		</div>
		
		
		
        <div class="sidebox">
            <h3 class="line">友情链接</h3>
            <ul class="cat-list">
                <?php if(is_array($linkList)): foreach($linkList as $k=>$vo): ?><li><a href="<?php echo ($vo["link_url"]); ?>"><?php echo ($vo["link_name"]); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </div>
		
		
		
	</div>
    <div class="clear"></div>
    
  </div>
  <!-- End Wrapper -->
  
  <div class="push"></div>
</div>
<!-- End Body Wrapper -->





<div id="footer">
  <div class="footer">
    <p>本站由博主自主搭建 © 2016-2017 www.cbbtop.com 版权所有 ICP证：粤ICP备17021590号-1
联系邮箱：cbbtop@163.com<a href="http://www.cbbtop.com/" title="钟伟建个人博客" target="_blank">钟伟建个人博客</a></p>
  </div>
</div>


</body>

    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
            directionNavHide: false,
            captionOpacity: 1.0
            });
        });
        </script>
    <script type="text/javascript" src="/jian/Public/Home/style/js/scripts.js"></script>

</html>