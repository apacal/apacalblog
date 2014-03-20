<?php if (!defined('THINK_PATH')) exit();?>        <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>ApacalBlog-后台管理系统</title>
		<meta name="keywords" content="ApacalBlog-后台管理系统<?php echo ($keywords); ?>" />
		<meta name="description" content="ApacalBlog-后台管理系统<?php echo ($description); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="http://218.244.140.70/Public/css/admin.css" rel="stylesheet" />
		<link href="http://218.244.140.70/Public/ace/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="http://218.244.140.70/Public/ace/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="http://218.244.140.70/Public/ace/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->
        <!--  开发去掉字体
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

-->
		<!-- ace styles -->

		<link rel="stylesheet" href="http://218.244.140.70/Public/ace/css/ace.min.css" />
		<link rel="stylesheet" href="http://218.244.140.70/Public/ace/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="http://218.244.140.70/Public/ace/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="http://218.244.140.70/Public/ace/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="http://218.244.140.70/Public/ace/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="http://218.244.140.70/Public/ace/js/html5shiv.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/respond.min.js"></script>
		<![endif]-->

		<!-- basic scripts -->

		<!--[if !IE]> -->


		<!-- <![endif]-->
		<script src="http://218.244.140.70/Public/ace/js/jquery-2.0.3.min.js"></script> 
		<!-- <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        -->

		<!--[if IE]>
            <script src="http://218.244.140.70/Public/ace/js/jquery-1.10.2.min.js"></script>
        <![endif]-->


		<script src="http://218.244.140.70/Public/ace/js/bootstrap.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="http://218.244.140.70/Public/ace/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="http://218.244.140.70/Public/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/jquery.ui.touch-punch.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/jquery.slimscroll.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/jquery.easy-pie-chart.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/jquery.sparkline.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/flot/jquery.flot.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/flot/jquery.flot.pie.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->

		<script src="http://218.244.140.70/Public/ace/js/ace-elements.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/ace.min.js"></script>
        <!-- ajax 异步上传文件　-->
		<script src="http://218.244.140.70/Public/js/ajaxfileupload.js"></script>

	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							ApacalBlog-后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
                        <!--
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-ok"></i>
									还有4个任务完成
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">软件更新</span>
											<span class="pull-right">65%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:65%" class="progress-bar "></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">硬件更新</span>
											<span class="pull-right">35%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:35%" class="progress-bar progress-bar-danger"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">单元测试</span>
											<span class="pull-right">15%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:15%" class="progress-bar progress-bar-warning"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">错误修复</span>
											<span class="pull-right">90%</span>
										</div>

										<div class="progress progress-mini progress-striped active">
											<div style="width:90%" class="progress-bar progress-bar-success"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看任务详情
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-bell-alt icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-warning-sign"></i>
									8条通知
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												新闻评论
											</span>
											<span class="pull-right badge badge-info">+12</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="btn btn-xs btn-primary icon-user"></i>
										切换为编辑登录..
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												新订单
											</span>
											<span class="pull-right badge badge-success">+8</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												粉丝
											</span>
											<span class="pull-right badge badge-info">+11</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看所有通知
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
                        -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="http://218.244.140.70/Uploads<?php echo ($_SESSION['image']); ?>" alt="<?php echo ($_SESSION['adminname']); ?>" />
								<span class="user-info">
									<small>欢迎光临,</small>
									<?php echo ($_SESSION['adminname']); ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="/index.php/Admin/Admin/manage">
										<i class="icon-cog"></i>
										管理员管理
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Admin/index/">
										<i class="icon-user"></i>
										个人资料
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="/index.php/Admin/Public/logout">
										<i class="icon-off"></i>
										退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

        			<ul class="nav nav-list">
						<li>
							<a href="/index.php/Admin/Index/index">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
							</a>
						</li>

						<li>
							<a href="/index.php/Admin/Article/add">
								<i class="icon-text-width"></i>
								<span class="menu-text"> 添加博客 </span>
							</a>
						</li>

						<li class="active open">
							<a href="#" class="dropdown-toggle">
								<i class="icon-list"></i>
								<span class="menu-text"> 博客管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu" >
								<li>
									<a href="/index.php/Admin/Article/add">
										<i class="icon-double-angle-right"></i>
										添加博客
									</a>
								</li>

								<li class="active">
									<a href="/index.php/Admin/Article/manage">
										<i class="icon-double-angle-right"></i>
										博客管理
									</a>
								</li>
								<li>
									<a href="/index.php/Admin/Article/verify">
										<i class="icon-double-angle-right"></i>
										博客审核
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-picture"></i>
								<span class="menu-text"> 相册 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="/index.php/Admin/Photo/add">
										<i class="icon-double-angle-right"></i>
										添加相册
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Photo/manage">
										<i class="icon-double-angle-right"></i>
										相册管理
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-book"></i>
								<span class="menu-text"> 栏目分类 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/index.php/Admin/Category/add">
										<i class="icon-double-angle-right"></i>
										添加栏目
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Category/manage">
										<i class="icon-double-angle-right"></i>
										栏目管理
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-comments"></i>
								<span class="menu-text"> 评论&amp;留言 </span>
								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/index.php/Admin/Comment/manage">
										<i class="icon-double-angle-right"></i>
										评论管理
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Comment/verify">
										<i class="icon-double-angle-right"></i>
										评论审核
									</a>
								</li>
								<li>
									<a href="/index.php/Admin/Message/manage">
										<i class="icon-double-angle-right"></i>
										留言管理
									</a>
                                </li>
								<li>
									<a href="/index.php/Admin/Message/reply">
										<i class="icon-double-angle-right"></i>
										留言回复
									</a>
                                </li>
							</ul>
						</li>
						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text"> 广告管理 </span>
								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/index.php/Admin/Advert/add">
										<i class="icon-double-angle-right"></i>
										添加广告
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Advert/manage">
										<i class="icon-double-angle-right"></i>
										广告管理
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 友情链接 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/index.php/Admin/Link/add">
										<i class="icon-double-angle-right"></i>
										添加友情链接
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Link/manage">
										<i class="icon-double-angle-right"></i>
										友情链接管理
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="/index.php/Admin/Calendar/index">
								<i class="icon-calendar"></i>

								<span class="menu-text">
									日历
									<span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
										<i class="icon-warning-sign red bigger-130"></i>
									</span>
								</span>
							</a>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-tag"></i>
								<span class="menu-text"> 管理员 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/index.php/Admin/Admin/index">
										<i class="icon-double-angle-right"></i>
										用户信息
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Admin/add">
										<i class="icon-double-angle-right"></i>
										添加管理员
									</a>
								</li>

								<li>
									<a href="/index.php/Admin/Admin/manage">
										<i class="icon-double-angle-right"></i>
										管理员管理
									</a>
								</li>

							</ul>
						</li>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>

		

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/index.php/Admin">首页</a>
							</li>
							<li class="active"><a href="/index.php/Admin/Article/manage">博客管理</a></li>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								<a href="/index.php/Admin/Article/manage">博客管理</a>
								<small>
									<i class="icon-double-angle-right"></i>
									 编辑博文
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                          <div class="control-group">
							<div class="col-xs-12">
                                <form id="myform" class="form-horizontal" role="form" enctype="multipart/form-data" action="/index.php/Admin/Article/update/id/<?php echo ($vo["id"]); ?>" method="post">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">分类 </label>
										<div class="col-sm-9">
                                                <select class="col-xs-10 col-sm-5" name="cid"  id="form-field-select-1" required>
                                                    <option value="<?php echo ($vo["cid"]); ?>" >当前分类(<?php echo ($vo["cname"]); ?>)</option>
                                                    <?php echo ($categoryTree); ?>
												</select>
										</div>
									</div>
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">标题 </label>
										<div class="col-sm-9">
                                            <span class="input-icon input-icon-right">
											    <input type="text" placeholder="标题" style="width:348px"name="title" value="<?php echo ($vo["title"]); ?>" required />
                                                <i class="icon-leaf green"></i>
                                             </span>
										</div>
									</div>
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">关键字 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="关键字" name="keywords" value="<?php echo ($vo["keywords"]); ?>" class="col-xs-10 col-sm-5" required />
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" > 描述 </label>
										<div class="col-sm-9">
                                            <textarea row="10" placeholder="描述" style="height:100px" name="description" class="autosize-transition col-xs-10 col-sm-5"><?php echo ($vo["description"]); ?></textarea>
										</div>
									</div>
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" > 排序值 </label>
										<div class="col-sm-9">
											<input type="text" value="<?php echo ($vo["sort"]); ?>" name="sort" class="col-xs-10 col-sm-5">
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" > 图片 </label>
										<div class="col-sm-9">
                                                <img data-toggle="modal" data-target="#modal-<?php echo ($vo["id"]); ?>" src="http://218.244.140.70/Uploads<?php echo ($vo["image"]); ?>" alt="暂无图片" width="100px" class="img-thumbnail"></br>
                                                <input type="hidden"  name="old-image" value="<?php echo ($vo["image"]); ?>" />
                                        </div>
									    <div class="space-4"></div>
                                        <div class="col-sm-3"></div>
										<div class="col-sm-9">
                                                <input type="text" readonly="true" id="viewfile" onmouseout="document.getElementById('upload').style.display='none';" class="inputstyle"> 
                                                <label for="unload" class="btn btn-xs btn-info"  onmouseover="document.getElementById('upload').style.display='block';" class="file1">点击上传新图...</label> 
                                                <input type="file" name="image" onchange="document.getElementById('viewfile').value=this.value;this.style.display='none';" class="file" id="upload" style="display: block;left: 220px; width: 110px;"> 
										</div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal-<?php echo ($vo["id"]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">查看图片</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <img data-toggle="modal" data-target="#modal-<?php echo ($vo["id"]); ?>" src="http://218.244.140.70/Uploads<?php echo ($vo["image"]); ?>" alt="暂无图片" class="img-thumbnail">
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <a><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <a href="#"><button type="button" class="btn btn-primary">确定</button></a>
                                                                  </div>
                                                                </div><!-- /.modal-content -->
                                                              </div><!-- /.modal-dialog -->
                                                            </div><!-- /.mod -->
									</div>
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" > 内容 </label>
										<div style="margin-left: 47px;" class="col-sm-11">
                                            <span class="block pull-right">
                                                <small class="grey middle">选择主题: &nbsp;</small>

                                                <span class="btn-toolbar inline middle no-margin">
                                                    <span data-toggle="buttons" class="btn-group no-margin">
                                                        <label class="btn btn-sm btn-yellow">
                                                            1
                                                            <input type="radio" value="1" />
                                                        </label>

                                                        <label class="btn btn-sm btn-yellow active">
                                                            2
                                                            <input type="radio" value="2" />
                                                        </label>

                                                        <label class="btn btn-sm btn-yellow">
                                                            3
                                                            <input type="radio" value="3" />
                                                        </label>
                                                    </span>
                                                </span>
                                            </span>
								        </h4>

								        <div class="wysiwyg-editor autosize-transition" id="editor1"><?php echo ($vo['content']); ?></div>

                                        <div style='visibility: hidden;'><textarea name="content" id="content"></textarea></div>
										</div>
									</div>
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" > 是否显示 </label>
										<div class="col-sm-9">
                                            <label>
                                                <input name="status" class="ace ace-switch ace-switch-7" type="checkbox">
											    <span class="lbl"></span>
										    </label>
										</div>
									</div>
									<div class="space-4"></div> 

                                    
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												提交
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i>
												清除
											</button>
										</div>
									</div>

								</form>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->


        
        <!-- insertFile modal ========================file===================-->
        <div class="modal fade" id="modal-insertFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" >插入文件</h3>
              </div>
              <div class="modal-body form-horizontal">

                <div class="form-group">                               
					<label class="col-sm-3 control-label no-padding-right" > 网络文件 </label>
				    <div class="col-sm-7">
                        <input class="form-control" value="" name="insertFile" id="insertFile" placeholder="URL" type="text" >                               
                    </div>
                </div>
                <div class="form-group">                               
					<label class="col-sm-3 control-label no-padding-right" > 文件说明 </label>
				    <div class="col-sm-7">
                        <input class="form-control" value="" name="fileint" id="fileint" placeholder="文件说明" type="text" >                               
                    </div>
                </div>
                <div class="form-group">                               
                        <span class="input-group-btn">                                  
                            <button style="margin-left: 72%" class="btn btn-sm btn-primary insertFile" type="button"> ADD </button>                             
                        </span>                         
                </div> <!-- 上传文件 ======================= -->
                <div class="form-group">                               
                    <h4>上传本地文件</h4>
					    <label class="col-sm-3 control-label no-padding-right" > 文件 </label>
				        <div class="col-sm-8">
                            <input type="text" readonly="true" id="arfile" onmouseout="document.getElementById('arupload').style.display='none';" class="inputstyle"> 
                            <label for="unload" class="btn btn-xs btn-info"  onmouseover="document.getElementById('arupload').style.display='block';" class="file1">点击浏览...</label> 
                            <input type="file" name="file" onchange="document.getElementById('arfile').value=this.value;this.style.display='none';" class="file" id="arupload" style="display: block; top: 0px;"> 
                            <button style="margin-left: 6px;" class="btn btn-xs btn-primary uploadFile" type="button">上传</button>                             
                        </div>
                </div>
              </div>
              <div class="modal-footer">
                <a><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="insertFile btn btn-primary" data-dismiss="modal">确定</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.mod -->

        <!-- insertCode modal============================Code================== -->
        <div class="modal fade" id="modal-insertCode" tabindex="-1" role="dialog" aria-labelledby="myModalLabeCode" aria-hidden="true">

          <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" >插入代码</h3>
              </div>
              <div class="modal-body form-horizontal">
                <div class="form-group">                               
				    <div class="col-sm-12">
                        <textarea rows="16" cols="63" id="addCode" placeholder="写入代码" style="" ></textarea>
                    </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-default clearCode" >清空</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="insertCode btn btn-primary" >添加</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.mod -->

        <!-- insertImage modal ===============================Image=============-->
        <div class="modal fade" id="modal-insertImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" >插入图片</h3>
              </div>
              <div class="modal-body form-horizontal">

                <div class="form-group">                               
					<label class="col-sm-3 control-label no-padding-right" > 网络图片 </label>
				    <div class="col-sm-7">
                        <input class="form-control" value="" name="insertImage" id="insertImage" placeholder="URL" type="text" >                               
                    </div>
                </div>
                <div class="form-group">                               
                        <span class="input-group-btn">                                  
                            <button style="margin-left: 72%" class="btn btn-sm btn-primary insertImage" type="button"> ADD </button>                             
                        </span>                         
                </div> <!-- 上传图片 ======================= -->
                <div class="form-group">                               
                    <h4>上传本地图片</h4>
					    <label class="col-sm-3 control-label no-padding-right" > 图片 </label>
				        <div class="col-sm-8">
                            <input type="text" readonly="true" id="arimage" onmouseout="document.getElementById('imageupload').style.display='none';" class="inputstyle"> 
                            <label for="unload" class="btn btn-xs btn-info"  onmouseover="document.getElementById('imageupload').style.display='block';" class="file1">点击浏览...</label> 
                            <input type="file" name="imageupload" onchange="document.getElementById('arimage').value=this.value;this.style.display='none';" class="file" id="imageupload" style="display: block; top: 0px;"> 
                            <button style="margin-left: 6px;" class="btn btn-xs btn-primary uploadImage" type="button">上传</button>                             
                        </div>
                </div>
              </div>
              <div class="modal-footer">
                <a><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="insertImage btn btn-primary" data-dismiss="modal">确定</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.mod -->
        <script> //插入文件js
        $(document).ready(function(){
            $(".insertFile").on('click', function(){ //添加文件
			    $('#insertFile').attr('value',$(this).attr('insertFile'));//文件链接
			    $('#fileint').attr('value',$(this).attr('fileint')); //文件说明
                var add = $("#insertFile").val();
                var content = $("#fileint").val();
                if(content == '') {
			        $('#fileint').focus();
                    alert("说明必须!");
                    return false;
                }
                if(add == '') {
			        $('#insertFile').focus();
                    alert("文件必须!");
                    return false;
                }
                add = '<a href="http://218.244.140.70/Uploads' + add + '">' + content + '</a>';
				$("#editor1").append(add);
			    $('#insertFile').val("");//文件链接
			    $('#fileint').val("");//文件链接
			    $('#arfile').val("");//文件链接
                $('#modal-insertFile').modal('hide')
            });
            $(".uploadFile").on('click', function(){ //上传文件
                var url = "/index.php/Admin/Article/upload";
                articleupload(url, 'arupload', 'insertFile');
            });
            $(".insertImage").on('click', function(){ //添加图片
			    $('#insertImage').attr('value',$(this).attr('insertImage'));//图片
                var add = $("#insertImage").val();
                if(add == '') {
			        $('#insertImage').focus();
                    alert("图片必须!");
                    return false;
                }
                add = '<img src="http://218.244.140.70/Uploads' + add + '">';
				$("#editor1").append(add);
			    $('#insertImage').val("");//文件链接
			    $('#arimage').val("");//文件链接
                $('#modal-insertImage').modal('hide')
            });
            $(".insertCode").on('click',function(){  //插入代码
                var add = $("#addCode").val();
                add = '<pre>' + add + '</pre>' + '<font face="Comic Sans MS" size="3">apacal</font>';
			    $('#addCode').val("");
				$("#editor1").append(add);
                $('#modal-insertCode').modal('hide');
            });
            $(".clearCode").on('click',function(){ //clear代码
			    $('#addCode').val("");
            });
            $(".uploadImage").on('click', function(){ //上传图片
                var url = "/index.php/Admin/Article/uploadimage";
                articleupload(url, 'imageupload', 'insertImage');
            });
        });
        </script>

    <!-- insertFile modal -->
	<!-- page specific plugin scripts -->
	<script src="http://218.244.140.70/Public/ace/js/jquery.hotkeys.min.js"></script>
    <script src="http://218.244.140.70/Public/ace/js/bootbox.min.js"></script>
	<script src="http://218.244.140.70/Public/ace/js/bootstrap-wysiwyg.min.js"></script>
	<script type="text/javascript">
    /*  ajax 上传文件　*/
        function articleupload(url, fileid, inputid){
            $.ajaxFileUpload({
                url: url,//用于文件上传的服务器端请求的Action地址
                type: "post",//请求方法
                secureuri: false,//一般设置为false
                fileElementId: fileid,//文件id属性  <input type="file" id="upload" name="upload" />
                dataType: "JSON",
                success: function(msg){
			        $('#'+inputid).val(msg);//文件链接
                }
            });
        } 
    $(document).ready(function(){
        $("form").submit(function(e){
            $("#content").html($("#editor1").html()); 
        });
    });
        jQuery(function($){

	
        function showErrorAlert (reason, detail) {
            var msg='';
            if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
            else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
             '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
        }

        //$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

        //but we want to change a few buttons colors for the third style
        $('#editor1').ace_wysiwyg({
            toolbar:
            [
                'font',
                null,
                'fontSize',
                null,
                            {name:'bold', className:'btn-info'},
                            {name:'italic', className:'btn-info'},
                            {name:'strikethrough', className:'btn-info'},
                            {name:'underline', className:'btn-info'},
                            null,
                            {name:'insertunorderedlist', className:'btn-success'},
                            {name:'insertorderedlist', className:'btn-success'},
                            {name:'outdent', className:'btn-purple'},
                            {name:'indent', className:'btn-purple'},
                            null,
                            {name:'justifyleft', className:'btn-primary'},
                            {name:'justifycenter', className:'btn-primary'},
                            {name:'justifyright', className:'btn-primary'},
                            {name:'justifyfull', className:'btn-inverse'},
                            null,
                            {name:'createLink', className:'btn-pink'},
                            {name:'unlink', className:'btn-pink'},
                            null,
                            {name:'insertImage', className:'btn-success'},
                            null,
                            'insertFile',
                            null,
                            'insertCode',
                            null,
                            'foreColor',
                            null,
                            'backColor',
                            null,
                            //'backColor',
                            {name:'undo', className:'btn-grey'},
                            {name:'redo', className:'btn-grey'},
                            'viewSource'
                        ],
                        'wysiwyg': {
                            fileUploadError: showErrorAlert
                        }
                    }).prev().addClass('wysiwyg-style2');

                    


                    $('[data-toggle="buttons"] .btn').on('click', function(e){
                        var target = $(this).find('input[type=radio]');
                        var which = parseInt(target.val());
                        var toolbar = $('#editor1').prev().get(0);
                        if(which == 1 || which == 2 || which == 3) {
                            toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
                            if(which == 1) $(toolbar).addClass('wysiwyg-style1');
                            else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
                        }
                    });


                    

                    //Add Image Resize Functionality to Chrome and Safari
                    //webkit browsers don't have image resize functionality when content is editable
                    //so let's add something using jQuery UI resizable
                    //another option would be opening a dialog for user to enter dimensions.
                    if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {
                        
                        var lastResizableImg = null;
                        function destroyResizable() {
                            if(lastResizableImg == null) return;
                            lastResizableImg.resizable( "destroy" );
                            lastResizableImg.removeData('resizable');
                            lastResizableImg = null;
                        }

                        var enableImageResize = function() {
                            $('.wysiwyg-editor')
                            .on('mousedown', function(e) {
                                var target = $(e.target);
                                if( e.target instanceof HTMLImageElement ) {
                                    if( !target.data('resizable') ) {
                                        target.resizable({
                                            aspectRatio: e.target.width / e.target.height,
                                        });
                                        target.data('resizable', true);
                                        
                                        if( lastResizableImg != null ) 
                                        lastResizableImg = target;
                                    }
                                }
                            })
                            .on('click', function(e) {
                                if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
                                    destroyResizable();
                                }
                            })
                            .on('keydown', function() {
                                destroyResizable();
                            });
                        }
                        
                        enableImageResize();

                        /**
                        //or we can load the jQuery UI dynamically only if needed
                        if (typeof jQuery.ui !== 'undefined') enableImageResize();
                        else );
                                } else	enableImageResize();
                            });
                        }
                        */
                    }


         });
	</script>
    
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; 选择皮肤</span>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl">切换到左边</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								切换窄屏
								<b></b>
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

			<a href="#" style="position: fixed;" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

</body>
</html>