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




  <!-- Begin Slider -->
  <div class="slider-wrapper theme-default">

            <div id="slider" class="nivoSlider">
                <img src="/Public/Home/style/images/art/s1.jpg" alt="钟伟建的博客" title="欢迎来到钟伟建的博客！" />
                <img src="/Public/Home/style/images/art/s2.jpg" alt="钟伟建的博客" title="欢迎来到钟伟建的博客！" />
                <img src="/Public/Home/style/images/art/s3.jpg" alt="钟伟建的博客" title="欢迎来到钟伟建的博客！"/>
                <img src="/Public/Home/style/images/art/s4.jpg" alt="钟伟建的博客" title="欢迎来到钟伟建的博客！"/>
            </div>
        </div>
  <!-- End Slider --> 
  
  <!-- Begin Wrapper -->
  <div id="wrapper">
    <div class="intro">The most difficult thing is the decision to act. And the rest is merely tenacity.</div>
    <div class="two-third">
      <h3 class="line">最近评论</h3>
      <?php if(is_array($stayList)): foreach($stayList as $k=>$vo): ?><img style="width:42px;height:50px;" src="/Public/Home/style/images/art/m9.jpg" alt="钟伟建的博客"  class="left"/>
      <h4><a href="<?php echo U('Post/post');?>?id=<?php echo ($maps[$k][0]['article_id']); ?>"><?php echo ($maps[$k][0]['article_name']); ?></a></h4>
      <p>留言:<?php echo ($vo["message_content"]); ?></p>
      <span><?php echo ($vo["user_name"]); ?> | <?php echo date('Y-m-d H:i:s',$vo['message_stay_time']);?></span>
      <div class="clear"></div>
      <br />
      <br /><?php endforeach; endif; ?>

    </div>
    <div class="one-third last">
      <h3 class="line">最新文章</h3>
      <ul class="latest-posts">
      <?php if(is_array($commentList)): foreach($commentList as $k=>$vo): ?><li> <span class="date"><em class="day"><?php echo date('Y',$vo['article_time']);?></em><em class="month"><?php echo date('m-d',$vo['article_time']);?></em></span>
          <h5><?php echo ($vo["article_name"]); ?></h5><!-- <?php echo substr($vo['article_content'],0,30);?> -->
          <p><a href="<?php echo U('Post/post');?>?id=<?php echo ($vo["article_id"]); ?>" class="more">点击查看 →</a></p>
        </li><?php endforeach; endif; ?>
      <!--   <li> <span class="date"><em class="day">14</em><em class="month">Jun</em></span> 
          <h5>Sit Fringilla Vulputate Purus</h5>
          <p>Maecenas faucibus mollis interdum. Lorem ipsum… <a href="#" class="more">Continue Reading →</a></p>
        </li>
        <li> <span class="date"><em class="day">18</em><em class="month">Aug</em></span> 
          <h5>Sit Fringilla Vulputate Purus</h5>
          <p>Maecenas faucibus mollis interdum. Lorem ipsum… <a href="#" class="more">Continue Reading →</a></p>
        </li> -->
      </ul>
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