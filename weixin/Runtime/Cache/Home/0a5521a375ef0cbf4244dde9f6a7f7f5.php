<?php if (!defined('THINK_PATH')) exit();?><!-- 头部 -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/weixin/Public/Home/css/mobile_module.css?v=<?php echo SITE_VERSION;?>" media="all">
    <script type="text/javascript" src="/weixin/Public/static/jquery-2.0.3.min.js?v=<?php echo SITE_VERSION;?>"></script>
    <script type="text/javascript" src="/weixin/Public/static/mobile_module.js?v=<?php echo SITE_VERSION;?>"></script>
	<title><?php echo C('WEB_SITE_TITLE');?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="Keywords" content="weiphp 微信公众平台开发框架">
    <meta name="Description" content="weiphp 微信公众平台开发框架">
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" href="<?php echo SITE_UEL;?>/favicon.ico">
</head>	
<link rel="stylesheet" type="text/css" href="<?php echo ADDON_PUBLIC_PATH;?>/suggest.css" media="all">

<body>
	<div class="container body">
    	<img src="<?php echo ADDON_PUBLIC_PATH;?>/images/suggest_head.png" width="100%"/>
    	<div class="p_10"> 
            <!-- 表单 -->
            <form method="post">
              <!-- 基础文档模型 -->
              <div id="tab1" class="tab-pane">
                   <?php if($need_truename): ?><div class="form-item cf">
                        <label class="item-label">姓名</label>
                        <div class="controls">
                          <input type="text" class="text input-medium" name="truename" value="<?php echo ($user["truename"]); ?>">
                         </div>
                   </div><?php endif; ?>
                   <?php if($need_mobile): ?><div class="form-item cf">
                        <label class="item-label">联系方式</label>
                        <div class="controls">
                          <input type="text" class="text input-large" name="mobile" value="<?php echo ($user["mobile"]); ?>">
                      	</div>
                   </div><?php endif; ?>
                   <div class="form-item cf">
                        <label class="item-label">内容</label>
                        <div class="controls">
                          <label class="textarea input-large"><textarea name="content"></textarea></label>
                        </div>
                   </div>                
                   <div class="form-item cf tb pt_10">
                		<button class="home_btn submit-btn ajax-post mb_10 flex_1 mr_10" id="submit" type="submit" target-form="form-horizontal">提  交</button>
                		<a class="home_btn btn-return mb_10 flex_1 ml_10" href="javascript:;">返  回</a>
                  </div>
          	</div>
            </form>
        </div>
        <p class="copyright">2014&copy;WeiPHP</p>
    </div>
</body>
</html>