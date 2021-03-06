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
<title>文章列表</title>
<link rel="stylesheet" href="/Public/Admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<form action="<?php echo U('productList');?>" method="post">
<body class="pos-r">
</div>
<div style="margin-left:0px;">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理 <span class="c-gray en">&gt;</span> 文章列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="text-c">
			文章名称：<input class="input-text radius" type="text" name="article_name" id="" placeholder="输入文章名" <?php if($_POST['article_name'] == '0'): ?>value=""<?php endif; ?> value="<?php echo ($_POST['article_name']); ?>" style="width:200px;margin-right:20px">   
            文章状态：<select name="status" id="" class="btn radius" ">
                <option value="">--请选择--</option>   
                <option <?php if($_POST['article_up'] === '0'): ?>selected<?php endif; ?> value="0">不置顶</option>         
                <option <?php if($_POST['article_up'] === '1'): ?>selected<?php endif; ?> value="1">置顶</option>

            </select>  
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索文章</button>
		</div>
</form>
<form action="<?php echo U('productListDel');?>" method="post">
		<div class="cl pd-5 bg-1 bk-gray mt-20"><i class="Hui-iconfont">&#xe6e2;</i><button id="buttons" class="btn btn-danger radius   
		 disabled" type="submit">批量删除</button><a class="btn btn-primary radius" onclick="productListAdd('添加文章','<?php echo U('productListAdd');?>','900','520')" ><i class="Hui-iconfont">&#xe600;</i> 添加文章</a></span></div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover">
				<thead>
					<tr class="text-c">
						<th width="40"><input class="cb" onclick="cd(this)" name="" type="checkbox" value=""></th>
						<th width="40">文章自增ID号</th>
						<th width="60">文章主图</th>
						<th width="80">文章名称</th>
						<th width="80">查看人数</th>
						<th width="100">所属分类</th>
						<th width="100">作者</th>
						<th width="100">文章描述</th>
						<th width="100">文章内容</th>
						<th width="120">更新时间</th>
						<th width="120">发布时间</th>
						<th width="100">文章的模式</th>
						<th width="60">是否置顶</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list)): foreach($list as $y=>$val): ?><tr class="text-c va-m">
							<td><input  class="cb" onclick="cd(this)" name="box[]" type="checkbox" value="<?php echo ($val['article_id']); ?>"></td>
							<td><?php echo ($val['article_id']); ?></td>
							<td><img height="100" src="/Uploads/goods/<?php echo ($val['article_photo']); ?>"></td>
							<td class="text-l"><?php echo ($val['article_name']); ?></td>
							<td class="text-l"><?php echo ($val['article_click']); ?></td>
							<td class="text-l"><?php echo ($val['type_id']); ?></td>
							<td class="text-l"><?php echo ($val['user_name']); ?></td>
							<td class="text-l"><?php echo ($val['article_des']); ?></td>

							<td class="text-l" style="width: 100px;  height: 100px; overflow: auto;display: block;"><?php echo ($val['article_content']); ?></td>
							<td class="text-l"><?php echo date('Y-m-d',$val['last_update']);?></td>
							<td><?php echo date('Y-m-d',$val['article_time']);?></td>
							<td><a href="<?php echo U(productList);?>?id=<?php echo ($val["article_id"]); ?>&status2=<?php echo ($val["article_type"]); ?>"><span class="label label-success radius"><?php if($val["article_type"] === '0'): ?>私有<?php else: ?>公开<?php endif; ?></span></a></td>
							<td class="td-status"><a href="<?php echo U(productList);?>?id=<?php echo ($val["article_id"]); ?>&status=<?php echo ($val["article_up"]); ?>"><span class="label label-success radius"><?php if($val["article_up"] === '0'): ?>不置顶<?php else: ?>置顶<?php endif; ?></span></a></td>
							<td class="td-manage"><a style="text-decoration:none" href="<?php echo U(productList);?>?id=<?php echo ($val["article_id"]); ?>&status=<?php echo ($val["article_up"]); ?>" title="文章置顶状态"><i class="Hui-iconfont">&#xe6de;</i>
							<a style="text-decoration:none" href="<?php echo U(productList);?>?id=<?php echo ($val["article_id"]); ?>&status2=<?php echo ($val["article_type"]); ?>" title="文章的模式"><i class="Hui-iconfont">&#xe6de;</i>
							</a> <a id='Edit' style="text-decoration:none" class="ml-5" onclick="productListEdit('编辑文章','<?php echo U('productListEdit');?>?id=<?php echo ($val["article_id"]); ?>','900','520')"><i class="Hui-iconfont">&#xe6df;</i></a><a style="text-decoration:none" class="ml-5"  href="javascript:if(confirm('确实要删除文章吗?'))location='<?php echo U('productListDel');?>?id=<?php echo ($val["article_id"]); ?>'"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr><?php endforeach; endif; ?>	
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- 分页按钮 -->
<div class="pagination" style="float: right;margin-right: 20px">
    <ul>
        <?php echo ($btn); ?>
    </ul>
</div>  
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/laypage/1.2/laypage.js"></script>

<script>
	function cd(obj){
	var cb = $('#buttons').removeClass('disabled');
	}
	    // 分页按钮样式
    $('.pagination span').unwrap('div').wrap('<li class="btn"></li>').last().parent().addClass('active');
    $('.pagination a').wrap('<li class="btn"></li>');
</script>

<script>



$('#Edit').click(function(){
	alert(('#Edit').val());
})
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				//demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};

var zNodes =[
	{ id:1, pId:0, name:"一级分类", open:true},
	{ id:11, pId:1, name:"二级分类"},
	{ id:111, pId:11, name:"三级分类"},
	{ id:112, pId:11, name:"三级分类"},
	{ id:113, pId:11, name:"三级分类"},
	{ id:114, pId:11, name:"三级分类"},
	{ id:115, pId:11, name:"三级分类"},
	{ id:12, pId:1, name:"二级分类 1-2"},
	{ id:121, pId:12, name:"三级分类 1-2-1"},
	{ id:122, pId:12, name:"三级分类 1-2-2"},
];
		
		
		
$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	//demoIframe = $("#testIframe");
	//demoIframe.on("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	//zTree.selectNode(zTree.getNodeByParam("id",'11'));
});

$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,12]}// 制定列不参与排序
	]
});
/*商品-添加*/
function productListAdd(title,url,w,h){
	layer_show(title,url,w,h);
}
/*产品-查看*/
function product_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-审核*/
function product_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'], 
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}

/*产品-申请上线*/
function product_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

/*商品-编辑*/
function productListEdit(title,url,w,h){
	layer_show(title,url,w,h);
}

/*产品-删除*/
function product_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script>

</body>
</form>
</html>