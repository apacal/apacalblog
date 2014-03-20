<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo ($title); ?></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="<?php echo ($keywords); ?>" />
    <meta name="description" content="<?php echo ($description); ?>" />
    <meta name="author" content="apacal">

    <link rel="shortcut icon" href="http://218.244.140.70/Public/images/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="http://218.244.140.70/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="http://218.244.140.70/Public/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->

    <link href="http://218.244.140.70/Public/css/home.css" rel="stylesheet">
<!-- 暂时不用
<link href="http://218.244.140.70/Public/js/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://218.244.140.70/Public/js/google-code-prettify/prettify.js"></script>
-->
    <!-- Link javascript -->
    <script src="http://218.244.140.70/Public/js/home.js"></script>
    <script src="http://218.244.140.70/Public/js/jquery.js"></script>
    
    <script src="http://218.244.140.70/Public/bootstrap/js/bootstrap.js"></script>

  </head>
<!-- NAVBAR
================================================== -->
  <body>
<div class="navbar-wrapper">
      <div class="container">

        <div id="nav-home" role="navigation" class="navbar navbar-inverse navbar-fixed-top">
        <!--
        <div id="nav-home" role="navigation" class="navbar navbar-inverse navbar-fixed-top">
        -->
          <div class="container">
            <div class="navbar-header">
              <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            <a class="navbar-brand" href="/">ApacalBlog</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">

              <ul class="nav navbar-nav" id="home-nav">
                <li><a href="/">首页</a></li>
                <!-- 
                    <li class="active"><a href="/">首页</a></li>
                    -->
                <?php if(is_array($navList)): $i = 0; $__LIST__ = $navList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(empty($vo['subNav'])): ?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cname"]); ?></a>
                    <?php else: ?>
                        <li class="dropdown">
                        <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cname"]); ?></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <?php if(is_array($vo['subNav'])): $i = 0; $__LIST__ = $vo['subNav'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo2["url"]); ?>"><?php echo ($vo2['cname']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
            </ul>
              <ul class="nav navbar-nav navbar-right">
                <li>
                <form class="navbar-form" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                     <button type="submit" class="btn btn-default">Submit</button>
                </form>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
</div>

            <!-- 广告轮播 -->
            <div style="height:70px"></div>
            
    <!-- ===============================   当前位置 ================================-->

    <div class="container marketing">
        <div class="row view-summary-list">
            <div class="col-lg-12">
               <span class="glyphicon glyphicon-home"><a href="/index.php">首页</a></span>
                <?php if(is_array($position)): $i = 0; $__LIST__ = $position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>&nbsp;»&nbsp;<span><?php if(!empty($vo["url"])): ?><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cname"]); ?></a><?php else: echo ($vo["cname"]); endif; ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>      <!-- end Position  -->
    <div style="height:10px"></div>

            
<div class="container marketing" >
    <div class="row">
        <!-- Carousel
        ================================================== -->
        <div class="col-lg-8" style=" padding-left: 6px; padding-right: 13px; ">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <?php $__FOR_START_1870897252__=1;$__FOR_END_1870897252__=$advertListCount;for($i=$__FOR_START_1870897252__;$i < $__FOR_END_1870897252__;$i+=1){ ?><li data-target="#myCarousel" data-slide-to="<?php echo ($i); ?>"></li><?php } ?>
                </ol>
                <div class="carousel-inner">
                    <?php if(is_array($advertList)): $i = 0; $__LIST__ = $advertList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class='item <?php if(($i) == "1"): ?>active<?php endif; ?>'>
                            <img src="http://218.244.140.70/Uploads<?php echo (getthunmname($vo["image"])); ?>" class="advertImg" lt="<?php echo ($vo["title"]); ?>">
                            <div class="container">
                                <div class="carousel-caption" id="mycarousel-caption">
                                <?php if(empty($vo["url"])): ?><h3><?php echo ($vo["title"]); ?></h3>
                                <?php else: ?>
                                    <a href="<?php echo ($vo["url"]); ?>">
                                    <h3><?php echo ($vo["title"]); ?></h3>
                                    </a><?php endif; ?>
                                </div>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div><!-- /.carousel -->
        </div>
        <div class="col-lg-4">
            <h3 style=" margin-top: 0px; ">热门文章<span class="hot-count"><?php echo ($hotArticleCount); ?></span></h3>
            <ul class="unstyled">
                <?php if(is_array($hotArticleList)): $i = 0; $__LIST__ = $hotArticleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span class="pull-right">[<?php echo (date('m-d',$vo["createtime"])); ?>]</span><a data-toggle="tooltip"  title="<?php echo ($vo["cname"]); ?>" href="<?php echo U('Home/Article/view', array('id' => $vo['id']));?>"><?php echo (msubstr($vo["title"],0,15)); ?>【<?php echo ($vo["click"]); ?>】</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>

            <!-- 首页主题-->
            
<script type="text/javascript">
    $(function(){
        $(window).bind('scroll',function(){show()});
        function show() { 
            if($(window).scrollTop()+$(window).height()>=$(document).height()) {
                leadMoreArticle();
            }               
        }
    });

    function leadMoreArticle() {
    	var num = document.getElementById("articleParam").value;
    	refreshAjaxDiv('/index.php/Home/Article/more', 'cid=<?php echo ($cid); ?>&p=' + num, 'article-list-autoadd', true);
	 	num++;
	 	document.getElementById("articleParam").value = num;
    }
    function showTip(mark, msg){
    if(!mark)
        $("#postTemp").html('<div class="alert alert-warning alert-dismissable">' + 
            '<button data-dismiss="alert" class="close" type="button">&times;</button>' +
            '<strong>错误提示：</strong> ' + msg +
          '</div>');
    else
        $("#postTemp").html('<div class="alert alert-info alert-dismissable">' + 
            '<button data-dismiss="alert" class="close" type="button">&times;</button>' +
            '<strong>温馨提示：</strong> ' + msg +
          '</div>');
    }
</script>
<div class="container marketing page-body">
    <div class="row view-summary-list" id="article-list-autoadd">
        <h3 style=" padding-left: 20px; ">最近文章<span class="hot-count"><?php echo ($articleCount); ?></span></h3>       
		<input type="hidden" name="articleParam" id="articleParam" value="1" />
        
    <?php if(!empty($articleList)): if(is_array($articleList)): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-lg-4 view-summary-div">
                <div class="view-summary">
                    <div class="view-summary-1">
                        <a href="<?php echo U('Home/Article/view',array('id' => $vo['id']));?>" class="view-img-a"><?php if(empty($vo["image"])): ?><img alt="<?php echo ($vo["title"]); ?>"  class="img-thumbnail" src="http://218.244.140.70/Public/images/default.jpg"><?php else: ?><img alt="<?php echo ($vo["title"]); ?>"  src="http://218.244.140.70/Uploads<?php echo (getthunmname($vo["image"])); ?>"><?php endif; ?></a>
                        <span class="interaction-count"><span class="dt">Interaction count:</span><?php echo ($vo["click"]); ?><span class="glyphicon glyphicon-share-alt"></span></span>
                        <div class="view-content">
                            <span class="tags" ><a href="<?php echo U('Home/Category/index', array('cid' => $vo['cid']));?>" class="parsed" ><?php echo ($vo["cname"]); ?></a></span>
                            <a href="<?php echo U('Home/Article/view',array('id' => $vo['id']));?>"><h5 class="view-h2"><?php echo ($vo["title"]); ?></h5></a>
                            <p class="article-description"><?php echo (msubstr($vo["description"],0,80)); ?></p>
                        </div>
                    </div>
                    <div class="meta">
                        <span class="author"><span class="dt">Author:</span> <a href="<?php echo U('Home/User/admin', array('id' => $vo['adminid']));?>"><?php echo ($vo["adminname"]); ?></a></span>
                        <span class="publish-date pull-right"><span class="dt">Publish date:</span> <span class="dd" itemprop="datePublished"><?php echo (date('F d, Y', $vo["createtime"])); ?></span></span>
                    </div>
                </div>
            </div><!-- /.col-lg-4 --><?php endforeach; endif; else: echo "" ;endif; endif; ?>



    </div><!-- /.row -->
    <div class="row view-summary-list" id="postTemp">
    </div>
</div>


    <!-- FOOTER -->
    <div class="container marketing" id="footer">
                <script type="text/javascript">
                    $(document).ready(function(){
                        // 到底部
                        $('a.scrollToBottom').click(function(){
                            $('html, body, .content').animate({scrollTop: $(document).height()}, 300);
                            return false;
                        });
                        // 到顶部
                       $('a.scrollToTop').click(function(){
                            $('html, body').animate({scrollTop:0}, 'slow');
                            return false;
                        });
                        $('#friendlink').change(function(){
                        if(this.value)
                            window.open(this.value);
                     });
                    })
                </script> 
                <div id="scrollBtn"> <!-- 滚动屏幕 -->
                    <a href="#" class="scrollToTop" title="顶部" ><p class="scrollBtn-top"></p></a>
                    <a  href="#" class="scrollToCenter" title="留言反馈"><p class="scrollBtn-SNS"></p></a>
                    <a href="#" class="scrollToBottom" title="底部"><p class="scrollBtn-bottom"></p></a>
                </div>
            
                <div class="col-md-7">
                    <div class="footerInfo">
                        <p>Copyright © 2014 Apacal All rights reserved</p>	
                        <p>技术支持: Apacal &nbsp; <a href="http://218.244.140.70/index.php/Admin"> 管理入口</a></p>	
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="friendLink">
                        <select  id="friendlink" class="seo_links">
                            <option value="">友情链接</option>
                            <?php if(is_array($linkList)): $i = 0; $__LIST__ = $linkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
    </div> <!-- end footer -->
        



  </body>
</html>