<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
<title>友情链接管理</title>
<link rel="stylesheet" href="/Public/Admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body class="pos-r">
<form action="<?php echo U('linkList');?>" method="post">
</div>
<div style="margin-left:0px;">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 友情链接管理 <span class="c-gray en">&gt;</span> 友情链接 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="text-c">
			链接名称：<input class="input-text radius" type="text" name="link_name" id="" placeholder="输入链接名" <?php if($_POST['link_name'] == '0'): ?>value=""<?php endif; ?> value="<?php echo ($_POST['link_name']); ?>" style="width:200px;margin-right:20px">   
            链接状态：<select name="status" id="" class="btn radius" ">
                <option value="">--请选择--</option>   
                <option <?php if($_POST['status'] === '0'): ?>selected<?php endif; ?> value="0">隐藏</option>         
                <option <?php if($_POST['status'] === '1'): ?>selected<?php endif; ?> value="1">显示</option>

            </select>  
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		</div>
</form>
<form action="<?php echo U('linkListDel');?>" method="post">
		<div class="cl pd-5 bg-1 bk-gray mt-20"><i class="Hui-iconfont">&#xe6e2;</i><button class="btn btn-danger radius disabled" id="buttons" type="submit">批量删除</button><a class="btn btn-primary radius " onclick="linkListAdd('添加友情链接','<?php echo U('linkListAdd');?>','900','500')"><i class="Hui-iconfont">&#xe600;</i> 添加友情链接</a></span></div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover">
				<thead>
					<tr class="text-c">
						<th width="40"><input class="cb" name="" type="checkbox" onclick="cd(this)" value=""></th>
						<th width="40">ID</th>
						<th width="100">链接名称</th>
						<th width="60">链接图片</th>
						<th width="100">链接地址</th>
						<th width="60">加入时间</th>
						<th width="60">更新时间</th>
						<th width="100">排序</th>
						<th width="60">是否显示</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list)): foreach($list as $k=>$val): ?><tr class="text-c va-m">
							<td><input class="cb" name="box[]" type="checkbox" onclick="cd(this)" value="<?php echo ($val['link_id']); ?>"></td>
							<td><?php echo ($val['link_id']); ?></td>
							<td class="text-l"><?php echo ($val['link_name']); ?></td>
							<td><img height="100" src="/Uploads/link/<?php echo ($val['link_logo']); ?>" alt="图片"></td>
							<td class="text-l"><?php echo ($val['link_url']); ?></td>
							<td class="text-l"><?php echo ($val['add_time']); ?></td>
							<td class="text-l"><?php echo ($val['last_update']); ?></td>
							<td class="text-l"><?php echo ($val['oredrby']); ?></td>
							<td class="td-status"><a href="<?php echo U('linkList');?>?id=<?php echo ($val["link_id"]); ?>&is_show=<?php echo ($is_show); ?>"><span class="label label-success radius"><?php if($val["is_show"] === '0'): ?>隐藏<?php else: ?>显示<?php endif; ?></span></a></td>
							<td class="td-manage"><a style="text-decoration:none" href="<?php echo U('linkList');?>?id=<?php echo ($val["link_id"]); ?>&is_show=<?php echo ($val["is_show"]); ?>" title="链接状态"><i class="Hui-iconfont">&#xe6de;</i></a> <a id='Edit' style="text-decoration:none" class="ml-5"
							onclick="linkListEdit('编辑友情链接','<?php echo U('linkListEdit');?>?id=<?php echo ($val["link_id"]); ?>','900','500')"
							 ><i class="Hui-iconfont">&#xe6df;</i></a> 
							<a style="text-decoration:none" class="ml-5"  href="javascript:if(confirm('确实要删除吗?'))location='<?php echo U('linkListDel');?>?id=<?php echo ($val['link_id']); ?>'" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
							</td>
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
    // 分页按钮样式
    $('.pagination span').unwrap('div').wrap('<li class="btn"></li>').last().parent().addClass('active');
    $('.pagination a').wrap('<li class="btn"></li>');
</script>
<script type="text/javascript">
function cd(obj){
var cb = $('#buttons').removeClass('disabled');
}


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
	  {"orderable":false,"aTargets":[0,9]}// 制定列不参与排序
	]
});
// 链接添加
function linkListAdd(title,url,w,h){
	layer_show(title,url,w,h);

	}
// 链接编辑
function linkListEdit(title,url,w,h){
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