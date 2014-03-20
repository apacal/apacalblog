<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WeiPHP-简洁而强大的开源微信公众平台开发框架 weiphp.cn</title>
<meta content="遵循Apache2开源协议,免费提供使用,微信功能插件化开发,多公众号管理,配置简单" name="keywords"/>
<meta content="weiphp 简洁而强大的开源微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单" name="description"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link type="text/css" rel="stylesheet" href="/weixin/Public/Home/css/about.css?v=<?php echo SITE_VERSION;?>" />
<link type="text/css" rel="stylesheet" href="/weixin/Public/Home/css/forum.css?v=<?php echo SITE_VERSION;?>" />
<script type="text/javascript" src="/weixin/Public/static/jquery-2.0.3.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weixin/Public/static/bootstrap/js/bootstrap.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weixin/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
</head>
<body>
	<div class="head">
    	<div class="wrap">
        	<h1 class="fl"><a class="logo" href="<?php echo SITE_URL;?>" title="返回首页">首家开源的微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单</a></h1>
            <div class="nav">
            	<a <?php if(ACTION_NAME == 'index' and CONTROLLER_NAME == 'Index'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/index/index');?>">首页</a>
                <a <?php if(ACTION_NAME == 'help'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/index/help');?>">帮助中心</a>
                <a href="<?php echo U('home/index/main');?>">管理中心</a>
                <a href="http://www.weiphp.cn/wiki" target="_blank">二次开发手册</a>
            </div>
        </div>
    </div>

    <div class="wrap">
    	<div class="content">
    	<h5>在WeiPHP里增加公众账号<a name="member_pubic_set"></a></h5>
 
        <p>1.点击进入<a href="https://mp.weixin.qq.com" target="_blank">微信公众平台</a>并进入公众号信息页面</p>
        <p><img src="<?php echo SITE_URL;?>/Public/Home/images/help01.png" width="1005" height="133"></p>
        <p>2.在WeiPHP里增加公众号, 需要填写的信息来源如下图所示。图中右边是增加公众号的表单，左边是上一步打开的公众号信息页面</p>
        <DIV> <IMG src="<?php echo SITE_URL;?>/Public/Home/images/help02.jpg" ></DIV>
        <p>&nbsp;</p>
        <h5>微信接口配置<a name="weixin_set"></a></h5>
        <p>1.先从这里公众号管理列表里进入接口配置</p>
        <DIV> <IMG src="<?php echo SITE_URL;?>/Public/Home/images/help04.jpg" ></DIV>
        
        <p>&nbsp;</p>
        <p>2.以下是你的公众号的配置信息<br>
          你的接口URL是：<span style="color: #FF0000"><?php echo SITE_URL;?>/index.php?s=/home/weixin/index.html&amp;token=<?php echo ($token); ?></span><br>
          您的Token是：<span style="color: #F00"><?php echo ($token); ?></span></p>
        <p>3. 在微信公众管理平台里进入开发模式，并把开发模型开启，开启后成为开发者，接着配置URL和Token,这两个值就是上面标红的内容</p>
        <p><img src="<?php echo SITE_URL;?>/Public/Home/images/help03.png" width="1020" height="689"></p>
        <p>至此配置完毕，如果配置过程中有问题，可查看<a href="http://mp.weixin.qq.com/wiki/index.php?title=%E6%8E%A5%E5%85%A5%E6%8C%87%E5%8D%97" target="_blank">微信的说明文档</a>	</p>
   	  </div>
    </div>
    <div class="footer">
    	<div class="wrap foot_wrap">
        	<p class="foot_nav">
            	<a href="<?php echo U('about');?>">关于我们</a>
                <a href="<?php echo U('about');?>">联系方式</a>
<!--                <a href="#">友情链接</a>
                <a href="#">版权声明</a>-->
                <a href="<?php echo U('license');?>">授权协议</a>
            </p>
            <p style="14px; padding-bottom:10px;">WeiPHP官方QQ交流群：329650736</p>
            <p class="copyright">@ 2013 - 2015 weiphp <?php echo C('WEB_SITE_ICP');?></p>
            <div class="getqrcode">
            	<img src="/weixin/Public/Home/images/getqrcode.jpg"/>
                <p>微信扫码左侧二维码<br/>并加关注WeiPHP官方微信公众号<br/>体验WeiPHP的最新功能</p>
            </div>
            <div class="foot_logo"></div>
        </div>
    </div>
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>    
</body>
</html>