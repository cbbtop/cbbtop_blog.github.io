<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>添加顶级分类</title>
		<!-- <link rel="stylesheet" rev="stylesheet" href="../css/style.css" type="text/css" media="all" /> -->
		<link rel="Bookmark" href="/favicon.ico" >
		<link rel="Shortcut Icon" href="/favicon.ico" />
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
		<!--/meta 作为公共模版分离出去-->

		<link href="/Public/Admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
	</head>

	<body class="ContentBody">
		<form action="<?php echo U('Product/parentAdd');?>" method="post" target="_parent">
			<!-- 隐藏域 -->
			<input type="hidden" name="pid" value="<?php echo ($info['id']); ?>" /><!--传父类的ID(pid)-->
			<input type="hidden" name="path" value="<?php echo ($info['path']); ?>" /><!--传路径-->
			<div>
				<table  class="table table-border table-bordered table-hover">
					<tr>
						<td class="text-c f-16" >添加到:</td>
						<td class="f-16">顶级分类</td>
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