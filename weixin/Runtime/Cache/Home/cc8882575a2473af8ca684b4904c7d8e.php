<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
<meta content="遵循Apache2开源协议,免费提供使用,微信功能插件化开发,多公众号管理,配置简单" name="keywords"/>
<meta content="weiphp 首家开源的微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单" name="description"/>
<title><?php echo C('WEB_SITE_TITLE');?></title>
<link href="/weixin/Public/static/bootstrap/css/bootstrap.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weixin/Public/static/bootstrap/css/bootstrap-responsive.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weixin/Public/static/bootstrap/css/docs.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weixin/Public/static/bootstrap/css/onethink.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weixin/Public/Home/css/weiphp.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/weixin/Public/static/bootstrap/js/html5shiv.js?v=<?php echo SITE_VERSION;?>"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="/weixin/Public/static/jquery-1.10.2.min.js?v=<?php echo SITE_VERSION;?>"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/weixin/Public/static/jquery-2.0.3.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weixin/Public/static/bootstrap/js/bootstrap.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weixin/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });
        }();
</script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<!-- 导航条
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" title="<?php echo C('WEB_SITE_TITLE');?>" href="<?php echo U('index/index');?>"><img src="/weixin/Public/Home/images/weiphp_logo.png?v=<?php echo SITE_VERSION;?>" title="<?php echo C('WEB_SITE_TITLE');?>"/></a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): ?><li>
                            <a href="<?php echo (get_nav_url($nav["url"])); ?>" target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($nav["title"]); ?></a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="nav-collapse collapse pull-right">
                <?php if(is_login()): ?><ul class="nav" style="margin-right:0">
                    	<li class="dropdown">
                            <a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo ($member_public["public_name"]); ?><b class="caret"></b></a>
                            <ul class="dropdown-menu" style="display:none">
                            	<li><a href="<?php echo U('home/MemberPublic/lists');?>">公众号管理</a></li>
                                <?php if(is_array($member_public_list)): $i = 0; $__LIST__ = $member_public_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('home/MemberPublic/changPublic','id='.$vo['id']);?>"><?php echo ($vo["public_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo get_username();?> <b class="caret"></b></a>
                            <ul class="dropdown-menu" style="display:none">
                                <li><a href="<?php echo U('Admin/index/index');?>">后台管理</a></li>
                                <li><a href="<?php echo U('User/profile');?>">修改密码</a></li>
                                <li><a href="<?php echo U('User/logout');?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav" style="margin-right:0">
                    	<li style="padding-right:20px">你好!欢迎来到<?php echo C('WEB_SITE_TITLE');?></li>
                        <li>
                            <a href="<?php echo U('User/login');?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/register');?>">注册</a>
                        </li>
                        <li>
                            <a href="<?php echo U('admin/index/index');?>" style="padding-right:0">后台入口</a>
                        </li>
                    </ul><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<link href="/weixin/Public/Home/css/module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<script type="text/javascript" src="/weixin/Public/static/uploadify/jquery.uploadify.min.js?v=<?php echo SITE_VERSION;?>"></script>
	<!-- /头部 -->
	
	<!-- 主体 -->
	
<div id="main-container" class="container">
  <div class="row">
<!--    
      <div class="span3 bs-docs-sidebar">
        
        <ul class="nav nav-list bs-docs-sidenav">
          <?php echo W('Category/lists', array($category['id'], ACTION_NAME == 'index'));?>
        </ul>
      </div>
    -->
     
  <div class="span3 bs-docs-sidebar">
<?php $m = strtolower(MODULE_NAME); $c = strtolower(CONTROLLER_NAME); $a = strtolower(ACTION_NAME); $ad = ucfirst ( parse_name ( $_REQUEST['_addons'], 1 ) ); $navClass[$ad] = 'active'; $navClass[$m.'_'.$c.'_'.$a] = 'active'; $addonList = D ( 'Addons' )->getWeixinList (); ?>
    <ul class="nav nav-list bs-docs-sidenav">
      <li class="<?php echo ($navClass['home_memberpublic_lists']); ?>"> <a href="<?php echo U('Home/MemberPublic/lists');?>"> <i class="icon-chevron-right"></i>公众号管理 </a> </li>
      <li class="<?php echo ($navClass['home_index_main']); ?>"> <a href="<?php echo U('Home/Index/main');?>"> <i class="icon-chevron-right"></i>功能设置 </a> </li>
      <?php if(is_array($addonList)): $i = 0; $__LIST__ = $addonList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($navClass[$vo[name]]); ?>"> <a href="<?php echo ($vo[addons_url]); ?>" title="<?php echo ($vo["description"]); ?>"> 
      <i class="icon-chevron-right"><?php if(!empty($vo['icon'])) { ?> <img src="<?php echo ($vo["icon"]); ?>" /> <?php } ?> </i>
      <?php echo ($vo["title"]); ?> </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>

    
<div class="span9 page_message">
	<section id="contents">
      <ul class="tab-nav nav">
  <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["class"]); ?>"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div id="top-alert" class="fixed alert alert-error" style="display: none;">
  <button class="close fixed" style="margin-top: 4px;">&times;</button>
  <div class="alert-content">这是内容</div>
</div>

      <div class="tab-content"> 
	<form action="<?php echo U('config');?>" class="form-horizontal" method="post">
		<?php if(empty($custom_config)): if(is_array($data['config'])): foreach($data['config'] as $o_key=>$form): ?><div class="form-item cf">
					<label class="item-label">
						<?php echo ((isset($form["title"]) && ($form["title"] !== ""))?($form["title"]):''); ?>
						<?php if(isset($form["tip"])): ?><span class="check-tips"><?php echo ($form["tip"]); ?></span><?php endif; ?>
					</label>
						<?php switch($form["type"]): case "text": ?><div class="controls">
								<input type="text" name="config[<?php echo ($o_key); ?>]" class="text input-large" value="<?php echo ($form["value"]); ?>">
							</div><?php break;?>
							<?php case "password": ?><div class="controls">
								<input type="password" name="config[<?php echo ($o_key); ?>]" class="text input-large" value="<?php echo ($form["value"]); ?>">
							</div><?php break;?>
							<?php case "hidden": ?><input type="hidden" name="config[<?php echo ($o_key); ?>]" value="<?php echo ($form["value"]); ?>"><?php break;?>
							<?php case "radio": ?><div class="controls">
								<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><label class="radio">
										<input type="radio" name="config[<?php echo ($o_key); ?>]" value="<?php echo ($opt_k); ?>" <?php if(($form["value"]) == $opt_k): ?>checked<?php endif; ?>><?php echo ($opt); ?>
									</label><?php endforeach; endif; ?>
							</div><?php break;?>
							<?php case "checkbox": ?><div class="controls">
								<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><label class="checkbox">
										<?php is_null($form["value"]) && $form["value"] = array(); ?>
										<input type="checkbox" name="config[<?php echo ($o_key); ?>][]" value="<?php echo ($opt_k); ?>" <?php if(in_array(($opt_k), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?>><?php echo ($opt); ?>
									</label><?php endforeach; endif; ?>
							</div><?php break;?>
							<?php case "select": ?><div class="controls">
								<select name="config[<?php echo ($o_key); ?>]">
									<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><option value="<?php echo ($opt_k); ?>" <?php if(($form["value"]) == $opt_k): ?>selected<?php endif; ?>><?php echo ($opt); ?></option><?php endforeach; endif; ?>
								</select>
							</div><?php break;?>
							<?php case "textarea": ?><div class="controls">
								<label class="textarea input-large">
									<textarea name="config[<?php echo ($o_key); ?>]"><?php echo ($form["value"]); ?></textarea>
								</label>
							</div><?php break;?>
							<?php case "group": ?><ul class="tab-nav nav">
									<?php if(is_array($form["options"])): $i = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li data-tab="tab<?php echo ($i); ?>" <?php if(($i) == "1"): ?>class="current"<?php endif; ?>><a href="javascript:void(0);"><?php echo ($li["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							    </ul>
							    <div class="tab-content">
							    <?php if(is_array($form["options"])): $i = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><div id="tab<?php echo ($i); ?>" class="tab-pane <?php if(($i) == "1"): ?>in<?php endif; ?> tab<?php echo ($i); ?>">
							    		<?php if(is_array($tab['options'])): foreach($tab['options'] as $o_tab_key=>$tab_form): ?><label class="item-label">
											<?php echo ((isset($tab_form["title"]) && ($tab_form["title"] !== ""))?($tab_form["title"]):''); ?>
											<?php if(isset($tab_form["tip"])): ?><span class="check-tips"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
										</label>
							    		<div class="controls">
							    			<?php switch($tab_form["type"]): case "text": ?><input type="text" name="config[<?php echo ($o_tab_key); ?>]" class="text input-large" value="<?php echo ($tab_form["value"]); ?>"><?php break;?>
												<?php case "password": ?><input type="password" name="config[<?php echo ($o_tab_key); ?>]" class="text input-large" value="<?php echo ($tab_form["value"]); ?>"><?php break;?>
												<?php case "hidden": ?><input type="hidden" name="config[<?php echo ($o_tab_key); ?>]" value="<?php echo ($tab_form["value"]); ?>"><?php break;?>
												<?php case "radio": if(is_array($tab_form["options"])): foreach($tab_form["options"] as $opt_k=>$opt): ?><label class="radio">
															<input type="radio" name="config[<?php echo ($o_tab_key); ?>]" value="<?php echo ($opt_k); ?>" <?php if(($tab_form["value"]) == $opt_k): ?>checked<?php endif; ?>><?php echo ($opt); ?>
														</label><?php endforeach; endif; break;?>
												<?php case "checkbox": if(is_array($tab_form["options"])): foreach($tab_form["options"] as $opt_k=>$opt): ?><label class="checkbox">
															<?php is_null($tab_form["value"]) && $tab_form["value"] = array(); ?>
            												<input type="checkbox" name="config[<?php echo ($o_tab_key); ?>][]" value="<?php echo ($opt_k); ?>" <?php if(in_array(($opt_k), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?>><?php echo ($opt); ?>
        												</label><?php endforeach; endif; break;?>
												<?php case "select": ?><select name="config[<?php echo ($o_tab_key); ?>]">
														<?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $opt_k=>$opt): ?><option value="<?php echo ($opt_k); ?>" <?php if(($tab_form["value"]) == $opt_k): ?>selected<?php endif; ?>><?php echo ($opt); ?></option><?php endforeach; endif; ?>
													</select><?php break;?>
												<?php case "textarea": ?><label class="textarea input-large">
														<textarea name="config[<?php echo ($o_tab_key); ?>]"><?php echo ($tab_form["value"]); ?></textarea>
													</label><?php break; endswitch;?>
											</div><?php endforeach; endif; ?>
							    	</div><?php endforeach; endif; else: echo "" ;endif; ?>
							    </div><?php break; endswitch;?>

					</div><?php endforeach; endif; ?>
		<?php else: ?>
			<?php if(isset($custom_config)): echo ($custom_config); endif; endif; ?>
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" readonly>
		<button type="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
		<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
	</form>
      </div>
    </section>
 </div>

  </div>
</div>
<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 241);
        }).resize();
    })
</script>
	<!-- /主体 -->

	<!-- 底部 -->
	
    <!-- 底部
    ================================================== -->
<footer class="footer">
      <div class="container">
      	  <p class="foot_nav"><a href="<?php echo U('Home/Index/about');?>" target="_blank">关于我们</a><a href="<?php echo U('home/index/help');?>">使用说明</a></p>
          <p> 本系统由 <strong><a href="http://www.weiphp.cn" target="_blank">weiphp</a></strong> 强力驱动</p>
      </div>
</footer>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "/weixin", //当前网站地址
		"APP"    : "/weixin/index.php?s=", //当前项目地址
		"PUBLIC" : "/weixin/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

<script type="text/javascript" charset="utf-8">
	//导航高亮
    $('.side-sub-menu').find('a[href="<?php echo U('Addons/index');?>"]').closest('li').addClass('current');
    if($('ul.tab-nav').length){
    	//当有tab时，返回按钮不显示
    	$('.btn-return').hide();
    }
	$(function(){
		//支持tab
		showTab();
	})
</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>