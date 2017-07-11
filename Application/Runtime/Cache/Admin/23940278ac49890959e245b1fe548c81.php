<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>添加分类</title>
		<!-- <link rel="stylesheet" rev="stylesheet" href="../css/style.css" type="text/css" media="all" /> -->
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
	</head>
	<body class="ContentBody">
		<form action="<?php echo U('Product/productCategoryAdd');?>" method="post" target="_parent">
			<!-- 隐藏域 -->
			<input type="hidden" name="pid" value="<?php echo ($info['id']); ?>" /><!--传父类的ID(pid)-->
			<input type="hidden" name="path" value="<?php echo ($info['path']); ?>" /><!--传路径-->
			<div>
				<table  class="table table-border table-bordered table-hover">
					<tr>
						<td class="text-c f-16" >添加到:</td>
						<td class="f-16"><?php echo ($info['name']); ?></td>
					</tr>
					<tr>
						<td class="text-c f-16">分类名：</td>
						<td class="f-16"><input class="input-text" type="text" name="name" autofocus="" placeholder="请输入中文或英文分类名"/></td>
					</tr>
				</table><br>
				<div style="text-align:center" colspan="2" height="50px">
				<input type="submit" value="添加" class="btn btn-success radius"/>　
				<input type="reset" value="重置" class="btn btn-success radius" />
				</div>
			</div>
		</form>
	</body>
</html>