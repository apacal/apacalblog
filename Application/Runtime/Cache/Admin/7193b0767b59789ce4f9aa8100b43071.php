<?php if (!defined('THINK_PATH')) exit();?>﻿        <!DOCTYPE html>
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

						<li>
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

								<li>
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
						<li class="active">
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
							<li class="active">日历</li>
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
                                日历
								<small>
									<i class="icon-double-angle-right"></i>
									 查看日历
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-sm-9">
										<div class="space"></div>

										<div id="calendar"></div>
									</div>

									<div class="col-sm-3">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4>Draggable events</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="external-events">
														<div class="external-event label-grey" data-class="label-grey">
															<i class="icon-move"></i>
															My Event 1
														</div>

														<div class="external-event label-success" data-class="label-success">
															<i class="icon-move"></i>
															My Event 2
														</div>

														<div class="external-event label-danger" data-class="label-danger">
															<i class="icon-move"></i>
															My Event 3
														</div>

														<div class="external-event label-purple" data-class="label-purple">
															<i class="icon-move"></i>
															My Event 4
														</div>

														<div class="external-event label-yellow" data-class="label-yellow">
															<i class="icon-move"></i>
															My Event 5
														</div>

														<div class="external-event label-pink" data-class="label-pink">
															<i class="icon-move"></i>
															My Event 6
														</div>

														<div class="external-event label-info" data-class="label-info">
															<i class="icon-move"></i>
															My Event 7
														</div>

														<label>
															<input type="checkbox" class="ace ace-checkbox" id="drop-remove" />
															<span class="lbl"> Remove after drop</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->


		<script src="http://218.244.140.70/Public/ace/js/fullcalendar.min.js"></script>
		<script src="http://218.244.140.70/Public/ace/js/bootbox.min.js"></script>
		<script type="text/javascript">
		jQuery(function($) { 
            /* initialize the external events
            -----------------------------------------------------------------*/

            $('#external-events div.external-event').each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
                
            });




            /* initialize the calendar
            -----------------------------------------------------------------*/

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            
            var calendar = $('#calendar').fullCalendar({
                 buttonText: {
                    prev: '<i class="icon-chevron-left"></i>',
                    next: '<i class="icon-chevron-right"></i>'
                },
            
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    className: 'label-important'
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d-5),
                    end: new Date(y, m, d-2),
                    className: 'label-success'
                },
                {
                    title: 'Some Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false
                }]
                ,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
                
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    var $extraEventClass = $(this).attr('data-class');
                    
                    
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
                    
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                    
                }
                ,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    
                    bootbox.prompt("New Event Title:", function(title) {
                        if (title !== null) {
                            calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                                true // make the event "stick"
                            );
                        }
                    });
                    

                    calendar.fullCalendar('unselect');
                    
                }
                ,
                eventClick: function(calEvent, jsEvent, view) {

                    var form = $("<form class='form-inline'><label>Change event name &nbsp;</label></form>");
                    form.append("<input class='middle' autocomplete=off type=text value='" + calEvent.title + "' /> ");
                    form.append("<button type='submit' class='btn btn-sm btn-success'><i class='icon-ok'></i> Save</button>");
                    
                    var div = bootbox.dialog({
                        message: form,
                    
                        buttons: {
                            "delete" : {
                                "label" : "<i class='icon-trash'></i> Delete Event",
                                "className" : "btn-sm btn-danger",
                                "callback": function() {
                                    calendar.fullCalendar('removeEvents' , function(ev){
                                        return (ev._id == calEvent._id);
                                    })
                                }
                            } ,
                            "close" : {
                                "label" : "<i class='icon-remove'></i> Close",
                                "className" : "btn-sm"
                            } 
                        }

                    });
                    
                    form.on('submit', function(){
                        calEvent.title = form.find("input[type=text]").val();
                        calendar.fullCalendar('updateEvent', calEvent);
                        div.modal("hide");
                        return false;
                    });
                    
                
                    //console.log(calEvent.id);
                    //console.log(jsEvent);
                    //console.log(view);

                    // change the border color just for fun
                    //$(this).css('border-color', 'red');

                }
                
            });
        })
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