<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>开源项目-钟伟建博客,技术博客,个人博客, php博客，钟伟建的个人博客</title>
<meta name="keywords" content="个人博客,thinkphp博客,php博客,技术博客,钟伟建"/><meta name="description" content="钟伟建的php博客,个人技术博客"/>
<link rel="shortcut icon" type="image/x-icon" href="style/images/favicon.png" />
<link rel="stylesheet" type="text/css" href="/Public/Home/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/Public/Home/style/css/prettyPhoto.css"  />
<link rel="stylesheet" type="text/css" href="/Public/Home/style/css/nivo-slider.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/Public/Home/style/type/classic.css" media="all" />
<link rel="stylesheet" type="text/css" href="/Public/Home/style/type/goudy.css" media="all" />
<script type="text/javascript" src="/Public/Home/style/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/Public/Home/style/js/superfish.js"></script>
<script type="text/javascript" src="/Public/Home/style/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/Public/Home/style/js/jquery.nivo.slider.js"></script>
</head>


<body>
<div id="body-wrapper"> 
  <!-- Begin Header -->
  <div id="header">
    <div class="logo">
      <a href="<?php echo U('Index/index');?>""><img src="/Public/Home/style/images/logo1.png" alt="" /></a>
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
  
   <div class="intro">Phasellus vitae lectus sit amet ipsum fringilla viverra at et leo. Cras iaculis, sem vel venenatis sodales, elit dui elementum lorem, ut semper ligula ipsum at sapien.</div>
   
  	<!-- Begin Blog -->
  	<div class="container">   

    <?php if(is_array($arr)): foreach($arr as $k=>$vo): ?><div class="post text">
    <div class="icon-text"></div>
    <div class="content">
      <div class="top"></div>
      <div class="middle">
        <div class="post-text">
          <h2 class="title"><a href="#"><?php echo ($vo["article_name"]); ?></a></h2>
          <p><?php echo ($vo["article_content"]); ?>
        <br /><br />
        <?php echo ($vo["article_des"]); ?>
        </p>
        </div>
        <div class="meta-wrapper">
      <div class="meta">
          <ul class="post-info">
            <!-- <li><span class="glyphicon glyphicon-user"><?php echo ($vo["user_name"]); ?></span></li> -->
            <li><span class="post-link"></span><a href="#"><span class="glyphicon glyphicon-user"><?php echo ($vo["user_name"]); ?></span> | <?php echo date('Y-m-d H:i',$vo['article_time']);?></a></li>
            <li><span class="post-comment"></span><a href="#">人气(<?php echo ($vo["article_click"]); ?>)</a></li>
            <li><span class="post-tag"></span><a href="#"><?php echo ($vo["tags"]); ?></a></li>
          </ul>
          <!-- <div class="share"><span class="post-share"></span><a href="">点赞</a></div> -->
          <div class="clear"></div>
        </div>
        </div>
      </div>
      <div class="bottom"></div>
    </div>
    </div><?php endforeach; endif; ?>
    
    
    
    <!-- Begin Comments Section -->
		<!-- Begin Comments -->
        
        <h3 class="line">留言板</h3>
        
        <!-- Begin Comments -->
        <div id="comments">
          <ol id="singlecomments" class="commentlist">
          <?php if(is_array($messageList)): foreach($messageList as $k=>$vo): ?><li class= "clearfix">
              <div class="user"><img alt="" src="/Public/Home/style/images/art/ad1.jpg" height="48" width="48" class="avatar" />
                <!-- <a class="reply-link" href="#"><?php echo ($vo["user_name"]); ?></a> -->
              </div>
              <div class="message">
              <div class="top"></div>
              <div class="middle">
                <div class="info">
                  <h4><a href="#"><?php echo ($vo["user_name"]); ?></a></h4>
                  <span class="date"><?php echo date('Y-m-d H:i:s',$vo['message_stay_time']);?></span>  </div>
                <p><?php echo ($vo["message_content"]); ?></p>
                </div>
                <div class="bottom"></div>
              </div>
              <div class="clear"></div>

              <?php if((strlen($vo["reply"])) == "1"): else: ?>
              <ul class="children">
                <li class= "clearfix">
                  <div class="user"><img alt="" src="/Public/Home/style/images/art/ad2.jpg" height="48" width="48" class="avatar" /><a class="reply-link" href="#">博主</a></div>
                  <div class="message">
                    <div class="info">
                      <!-- <h4><a href="#">Mathieu</a></h4> -->
                      <span class="date"><?php echo date('Y-m-d H:i:s',$vo['message_stay_time']);?></span></div>
                    <p><?php echo ($vo["reply"]); ?></p>
                  </div>
                  <div class="clear"></div><?php endif; ?>


              <!--     <ul class="children">
                    <li class= "clearfix">
                      <div class="user"><img alt="" src="/Public/Home/style/images/art/ad3.jpg" height="48" width="48" class="avatar" /><a class="reply-link" href="#">Reply</a></div>
                      <div class="message">
                        <div class="info">
                          <h4><a href="#">Charlene</a></h4>
                          <span class="date">April 4, 2010</span></div>
                        <p>Quisque tristique tincidunt metus non aliquam. Quisque ac risus sit amet quam sollicitudin vestibulum vitae malesuada libero. Mauris magna elit, suscipit non ornare et, blandit a tellus. Pellentesque dignissim ornare elit, quis mattis eros.</p>
                      </div>
                      <div class="clear"></div>
                    </li>
                  </ul> -->
                </li>
              </ul>
            </li>
           <!--  <li class= "clearfix">
              <div class="user"><img alt="" src="/Public/Home/style/images/art/ad1.jpg" height="48" width="48" class="avatar" /><a class="reply-link" href="#">Reply</a></div>
              <div class="message">
                <div class="info">
                  <h4><a href="#">Isabel</a></h4>
                  <span class="date">April 4, 2010</span></div>
                <p>Quisque tristique tincidunt metus non aliquam. Quisque ac risus sit amet quam sollicitudin vestibulum vitae malesuada libero. Mauris magna elit, suscipit non ornare et, blandit a tellus. Pellentesque dignissim ornare elit, quis mattis eros sodales ac.</p>
              </div>
              <div class="clear"></div>
            </li>
            <li class= "clearfix">
              <div class="user"><img alt="" src="/Public/Home/style/images/art/ad4.jpg" height="48" width="48" class="avatar" /><a class="reply-link" href="#">Reply</a></div>
              <div class="message">
                <div class="info">
                  <h4><a href="#">Jack</a></h4>
                  <span class="date">April 4, 2010</span></div>
                <p>Quisque tristique tincidunt metus non aliquam. Quisque ac risus sit amet quam sollicitudin vestibulum vitae malesuada libero. Mauris magna elit, suscipit non ornare et, blandit a tellus. Pellentesque dignissim ornare elit, quis mattis eros sodales ac.</p>
              </div>
              <div class="clear"></div>
            </li> --><?php endforeach; endif; ?>
          </ol>
        </div>
        <!-- End Comments --> 
        
        <!-- Begin Form -->
        <div class="comment-form">
          <h3 class="line">我要留言</h3>
          <div class="form-container">
            <form class="forms" action="<?php echo U('Post/postAdd');?>?id=<?php echo ($arr[0]['article_id']); ?>&user_id=12" method="post">
              <fieldset>
                <ol>
                  <li class="form-row text-input-row">
                    <label>Name</label>
                    <input type="text" name="user_name" value="" class="text-input required" title="" />
                  </li>
                 <!--  <li class="form-row text-input-row">
                    <label>Email</label>
                    <input type="text" name="email" value="" class="text-input required email" title="" />
                  </li> -->
                  <li class="form-row text-area-row">
                    <label>Message</label>
                    <textarea name="message_content" class="text-area required"></textarea>
                  </li>
                  <li class="form-row hidden-row">
                    <!-- <input type="hidden" name="hidden" value="" /> -->
                  </li>
                  <li class="button-row">
                    <input type="submit" value="Submit" class="btn-submit" />
                  </li>
                </ol>
                <!-- <input type="hidden" name="v_error" id="v-error" value="Required" />
                <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" /> -->
              </fieldset>
            </form>
            <div class="response"></div>
          </div>
        </div>
        <!-- End Form --> 
        
        <!-- End Comments -->
    <!-- End Comments Section -->
    
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
                    <a href="#"><img src="/Public/Home/style/images/art/ad1.jpg" alt="钟伟建的博客" /></a>
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
					<a href="<?php echo U('Post/post');?>?id=<?php echo ($vo["article_id"]); ?>"><img src="/Public/Home/style/images/art/ad1.jpg" alt="钟伟建的博客" /></a>
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
    <script type="text/javascript" src="/Public/Home/style/js/scripts.js"></script>

</html>