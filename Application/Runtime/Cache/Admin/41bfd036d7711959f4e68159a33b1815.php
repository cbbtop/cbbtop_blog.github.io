<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/Admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>广告列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 广告管理 <span class="c-gray en">&gt;</span> 广告列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
	<form action="<?php echo U('Ad/ad_list');?>" method="get">
		<input type="text" name="ad_title" placeholder=" 广告主题" style="width:250px" class="input-text">
		<button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    </form>
	</div>
    <form action="<?php echo U('Ad/alldel');?>" method="post">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><button type="submit" class="btn btn-danger radius"><i class="Hui-iconfont"  class="btn btn-danger radius">&#xe6e2;</i> 批量删除</button> <a class="btn btn-primary radius" onclick="ad_add('添加广告','<?php echo U('Ad/ad_add');?>','700','320')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加广告</a></span> <span class="r"><?php echo ($btn); ?></span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="40"><input type="checkbox" value=""></th>
					<th width="80">ID</th>
                    <th>广告主题</th>	
                    <th width="200">链接地址</th>
					<th width="220">广告图片</th>
					<th width="60">是否显示</th>
                    <th width="150">添加时间</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
            <?php if(is_array($list)): foreach($list as $k=>$v): ?><tr class="text-c">
					<td><input name="box[]" type="checkbox" value="<?php echo ($v["ad_id"]); ?>"></td>
					<td><?php echo ($v["ad_id"]); ?></td>
                    <td><?php echo ($v["ad_title"]); ?></td>
                    <td><?php echo ($v["ad_link"]); ?></td>
					<td><img width="150" class="picture-thumb" src="/Uploads/link/<?php echo ($v["ad_img"]); ?>" height="200"></td>
                    <?php if($v["enabled"] == 1): ?><td class="td-status"><span class="label label-success radius">显示</span><span style="text-decoration:none"  onclick="modify_status(this,'修改状态',<?php echo ($v['ad_id']); ?>)" title="屏蔽" value="1"><i class="Hui-iconfont" style="cursor:pointer">&#xe631;</i></span></td>
                    <?php else: ?>
                        <td class="td-status"><span class="label label-success radius">屏蔽</span><span style="text-decoration:none"  onclick="modify_status(this,'修改状态',<?php echo ($v['ad_id']); ?>)" title="显示" value="0"><i class="Hui-iconfont" style="cursor:pointer">&#xe631;</i></span></td><?php endif; ?>
                    <td><?php echo ($v["add_time"]); ?></td>
					<td class="td-manage"><a style="text-decoration:none" class="ml-5" onClick="ad_edit('编辑广告','<?php echo U('Ad/ad_edit',['id'=>$v['ad_id']]);?>','800','500')" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" href="<?php echo U('Ad/del',['id'=>$v['ad_id']]);?>" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

/*图片-添加*/
function ad_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*图片-查看*/
function ad_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*图片-编辑*/
function ad_edit(title,url,w,h){
    layer_show(title,url,w,h);
}

/*状态修改*/
function modify_status(obj,title,id){ 
    var enabled = $(obj).attr('value');
    $.ajax({ 
        type:"get",
        url:"<?php echo U('Ad/getData');?>",
        data:"ad_id="+id+"&enabled="+enabled,
        success:function(arr) {
            console.dir(arr);
            if (arr) {   
                $(obj).prev().html('显示'); 
                $(obj).attr('value','1');       
            } else { 
                $(obj).prev().html('屏蔽');
                $(obj).attr('value','0');
            }
        }
    });
}
</script>
</body>
</html>