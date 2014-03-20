<?php if (!defined('THINK_PATH')) exit();?>

</script>
<!DOCTYPE html>
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

    <div class="view-main">
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

        
        <!-- main -->
        
    
<div class="container marketing">

    <div class="row view-summary-list">
        <div class="col-lg-9" style=" padding-right: 30px;  margin-bottom: 30px;">
            <h1 class="article-view-h1"><?php echo ($article["title"]); ?><a class="btn btn-default pull-right" style="margin-right: 50px;margin-top: 8px;"href="<?php echo U('Home/Article/index', array('cid' => $article['cid']));?>" role="button"><?php echo ($article["cname"]); ?> »</a></h1>
            <div class="meta-author" style="margin-left:20%;" >
                <span class="avatar" style=" margin-left: 50px; ">
                    <?php if(empty($article["adminimage"])): ?><img style="width:30px;height:30px" class="img-circle" src="http://218.244.140.70/Public/images/admin.png" alt="<?php echo ($article["adminname"]); ?>" >
                    <?php else: ?>
                        <img style="width:30px;height:30px" class="img-circle" src="http://218.244.140.70/Uploads<?php echo (getthunmname($article["adminimage"])); ?>" alt="<?php echo ($article["adminname"]); ?>" ><?php endif; ?>
                </span>
                <span class="author"><span class="dt">Author:</span> <span class="dd" ><a href="<?php echo U('Home/User/admin', array('id' => $article['adminid']));?>" style="color:black"><?php echo ($article["adminname"]); ?></a> · </span></span>
                <span class="publishdate"><span class="dt">Publish date:</span> <span class="dd" ><?php echo (date('F d, Y', $article["createtime"])); ?></span></span>
                <span >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;人气：<?php echo ($article["click"]); ?>次&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-comment"></i><a href="#checkComment">评论（<?php echo ($article["commentCount"]); ?>）</a></span>
            </div>
            <div id="content">
                <?php echo ($article["content"]); ?>
            </div>

            <!--           文章标签　＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
            <ul class="article-tags unstyled">
                <li><a class="btn btn-default" href="#" role="button">#Linux</a></li>
                <li><a class="btn btn-default" href="#" role="button">#C++</a></li>
                <li><a class="btn btn-default" href="#" role="button">#PHP</a></li>
                <li><a class="btn btn-default" href="#" role="button">#Python</a></li>
            </ul>
            -->
        </div>

        <div class="col-lg-3">
                <h3 style=" margin-top: 40px; ">热门文章<span class="hot-count"><?php echo ($hotCount); ?></span></h3>
                <?php if(is_array($hotArticle)): $i = 0; $__LIST__ = $hotArticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="hot-summary">
                            <span><a href=":U('Home/Article/view', array('id' => $vo['id']))}" class="hot-img-a">
                            <?php if(empty($vo["image"])): ?><img alt="暂无图片"  class="img-rounded" src="http://218.244.140.70/Public/images/default.jpg"></a>
                            <?php else: ?>
                                <img alt="<?php echo ($vo["title"]); ?>"  class="img-rounded" src="http://218.244.140.70/Uploads<?php echo (getthunmname($vo["image"])); ?>"></a><?php endif; ?>
                            </span>
                            <span class="hot-interaction-count"><span class="dt">Interaction count:</span><?php echo ($vo["click"]); ?><span class="glyphicon glyphicon-share"></span></span>
                            <span class="hot-header"><a href="<?php echo U('Home/Article/view', array('id' => $vo['id']));?>"><?php echo ($vo["title"]); ?></a></span>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <!--      文章分类　=========================================
                <div class="article-seprate">
                <h3>文章分类<span class="hot-count">4</span></h3>
                <ul class="article-class unstyled">
                    <li><a href="#" >Linux<span class="article-span">(12)</span></a></li>
                    <li><a href="#" >Linux<span class="article-span">(12)</span></a></li>
                    <li><a href="#" >Linux<span class="article-span">(12)</span></a></li>
                    <li><a href="#" >Linux<span class="article-span">(12)</span></a></li>
                </ul>
                </div>
                -->
                <div class="article-seprate">
                <h3>文章归档<span class="hot-count">4</span></h3>
                <ul class="article-class unstyled">
                    <?php if(is_array($dataArticle)): $i = 0; $__LIST__ = $dataArticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Article/dataArc', array('cid' => $vo['cid'], 'time' => $vo['time']));?>"><?php echo ($vo["time"]); ?><span class="article-span">(<?php echo ($vo["count"]); ?>)</span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                </div>
        </div>



    </div>
</div>


    </div>
    
    
<div class="view-footer">
    <div class="container marketing">
        <div class="row view-summary-list">
            <div class="read-next">
                    <h2 style="margin-left: 16px;">Read Next</h2>
            <?php if(!empty($articleList)): if(!empty($articleList)): if(is_array($articleList)): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-lg-4 view-summary-div">
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


            <?php else: ?>
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>温馨提示</strong> 暂无上一篇和下两篇
                </div><?php endif; ?>
            </div> <!-- end  read-next  -->
            <div class="view-comment">
                <script type="text/javascript">
  	var aid = "<?php echo ($article["id"]); ?>";        
    var cid = "<?php echo ($article["cid"]); ?>";
      $(document).ready(function(){
      	$('#pid').attr('value',0);
		$('.comment-reply-link').click(function(){
			$('#pid').attr('value',$(this).attr('pid'));
			$('#rid').attr('value',$(this).attr('rid'));
			$('#publish_comment').html('&nbsp;&nbsp;回复评论给：'+$(this).attr('author'));
			$('#msgcontent').focus();
		})
      });  
      
      /**
       *判断提交的评论
       */
      function addComment(){
		if($('#adder_name').val()==''){
			showTip(false, '请填您的名字！');
			$('#adder_name').focus();
			return false;
		}
		if($('#msgcontent').val()==''){
			showTip(false, '请填写评论内容！');
			$('#msgcontent').focus();
			return false;
		}
		showTip(true, '正在提交，请稍等...');
		$.post("<?php echo U('Home/Comment/add');?>", {"content":$("#commentcontent").val(),"author":$("#author").val(),"oid":$("#aid").val(),"pid":$("#pid").val(),"author_id":$("#author_id").val(),"cid":$("#cid").val(),"rid":$("#rid").val()}, function(msg) {
			if(msg.ret == 0){
				showTip(true, '评论成功！');
                location.reload(true);
			}else{
				showTip(false, '评论失败，' + msg.error);
			}
		});
      }      
      /**
       * 赞成或不赞成评论
       * @param commentid , typeid, num, hot(是否为hot评论)
       */
      function commentVote(commentid, typeid,num, hot) {
         num++;
         if(hot == 2)
            hot = "-hot";
         else
             hot = "";
         $.ajax({
             type: "POST",
             url: "<?php echo U('Home/Comment/vote');?>",
             data: "id=" + commentid + "&typeid=" + typeid,
             success: function (msg) {
                     if (typeid == 1) {
                         // $("#agree" + commentid).replaceWith('<a>支持(' + msg + ')</a>');
                         $("#agree" + commentid + hot).text('支持(' + num + ')');
                         $("#agree" + commentid + hot).removeAttr("href");

                         $("#agree" + commentid + hot).css({ "position": "relative" });
                         $("#agree" + commentid + hot).append("<span class='flower'></span>");
                         $("#agree" + commentid + hot).find(".flower").css({ "position": "absolute", "text-align": "center", "left": "6px", "top": "-10px", "display": "block", "width": "30px", "height": "30px", "background": "url(http://218.244.140.70/Public/images/agree.gif) left center no-repeat", "opacity": "0" }).animate({ top: '-30px', opacity: '1' }, 300, function () { $(this).delay(300).animate({ top: '-35px', opacity: '0' }, 300) });
                         $("#agree" + commentid + hot).find(".flower").removeClass();

                     }
                     else {
                         //  $("#disagree" + commentid).replaceWith('<a>反对(' + msg + ')</a>');
                         $("#disagree" + commentid + hot).text('反对(' + num + ')');
                         // $("#disagree" + commentid).attr("href", "javascript:void(0);");
                         $("#disagree" + commentid + hot).removeAttr("href");

                         $("#disagree" + commentid + hot).css({ "position": "relative" });
                         $("#disagree" + commentid + hot).append("<span class='shit'></span>");
                         $("#disagree" + commentid + hot).find(".shit").css({ "position": "absolute", "text-align": "center", "left": "6px", "top": "-60px", "display": "block", "width": "30px", "height": "30px", "background": "url(http://218.244.140.70/Public/images/disagree.gif) left center no-repeat", "opacity": "0" }).animate({ top: '-30px', opacity: '1' }, 300, function () { $(this).delay(300).animate({ top: '-5px', opacity: '0' }, 300) });
                         $("#disagree" + commentid + hot).find(".shit").removeClass();
                 }
             }
         });
      }
      /**
       * 显示消息
       * @param mark 信息类型标记 msg 消息
       **/
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
      
      function loadMoreComment(){
    	  var num = document.getElementById("loadMoreCommentParam").value;
    	  refreshAjaxDiv("<?php echo U('Home/Comment/more');?>", 'id=<?php echo ($article["id"]); ?>&cid=<?php echo ($article["cid"]); ?>&p=' + num, 'commentlist', true);
	 	  num++;
	 	  document.getElementById("loadMoreCommentParam").value = num;
      }
      
      function replyComment(cid) {
    	  $('#pid').attr('value',cid);
    	  document.getElementById("publish_comment").click();
      }
</script>

<div class="msg">
<div class="col-md-8">
    <div class="comments" id="main-comments">
        <div id="checkComment">
        <div id="publishComment" class="msghr" >
		<h3>
			<img src="http://218.244.140.70/Public/images/write.gif"><span id="publish_comment" >&nbsp;&nbsp发表评论</span> <span class="pull-right"><a class="show-all" href="#">查看所有<?php echo ($commentCount); ?>条评论</a></span>
		</h3>
        </div>
        <p style="padding-top: 10px;">愿您的每句评论，都能给大家的生活添色彩，带来共鸣，带来思索，带来快乐。</p>
            <div class="add_comm">

                    <textarea class="form-control" rows="5" cols="60" id="commentcontent" placeholder="（必须）请说几句吧，200字以内..."></textarea>
                    <div class="comm-con">
                    <?php if(empty($CURUSER["name"])): ?><strong style="color: #BA141D;">署名：</strong>
                    <input type="text" onblur="if(this.value=='')this.value='匿名';" onfocus="if(this.value=='匿名')this.value='';" value="匿名" class="ipt-txt" size="36" id="author" name="author">
                    </ else>
					<input type="hidden" name="author" id="author" value="<?php echo ($CURUSER["name"]); ?>" />
					<input type="hidden" name="author_id" id="author_id" value="<?php echo ($CURUSER["id"]); ?>" /><?php endif; ?>
					<input type="hidden" name="pid" id="pid" value="0" />
					<input type="hidden" name="rid" id="rid" value="0" />
					<input type="hidden" name="aid" id="aid" value="<?php echo ($article["id"]); ?>" />
					<input type="hidden" name="cid" id="cid" value="<?php echo ($article["cid"]); ?>" />
                    <button type="submit" class="btn btn-info" id="btnComment"  name="btnComment" onclick="return addComment()">提交</button>
                    </div>
            </div>
            <div id="postTemp"></div>
        </div>

        <div class="check">
        <div class="msghr">
		<h3>
			<img src="http://218.244.140.70/Public/images/commlist.gif"><span>&nbsp;&nbsp评论列表</span>
		</h3>
		</div> 
        <div class="commentlist unstyled" id="commentlist">
						<?php if(!empty($commentList)): ?><ul class="comments-list unstyled">
                    <?php if(is_array($commentList)): $i = 0; $__LIST__ = $commentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="comment" id="comment-content">
                            <?php if(empty($vo["author_id"])): ?><img width="40" height="40" alt="" src="http://218.244.140.70/Public/images/gravatar.png" class="avatar">
							<?php else: ?>
								<a href="/index.php/Home/User/index/id/<?php echo ($vo["author_id"]); ?>"><img width="40" height="40" alt="" src="http://218.244.140.70/Public/images/gravatar.png" class="avatar"></a><?php endif; ?>
						
							<div class="comment-entry">
								<div class="comment-meta" >
                                    <div class="comment-author">
                                        <span class="author" style="font-size:16px; line-height:1.5em;" ><?php if(!empty($vo["author_id"])): ?><a href="/index.php/Home/User/index/id/<?php echo ($vo["author_id"]); ?>"><?php echo ($vo["author"]); ?></a><?php else: ?><span class="author-span"><?php echo ($vo["author"]); ?></span><?php endif; ?>
                                    回复于：<?php echo (date('Y-m-d H:i',$vo["createtime"])); ?></span>
                                    </div>
								</div><!--/ .comment-meta -->
								<div class="comment-body">
									<p><?php echo ($vo["content"]); ?></p>
                                    <div class="reply">
                                        <span class="reply-body">
                                            <a href="javascript:commentVote(<?php echo ($vo["id"]); ?>,1,<?php echo ($vo["agree"]); ?>)" id="agree<?php echo ($vo["id"]); ?>">支持(<?php echo ($vo["agree"]); ?>)</a>
                                            |
                                            <a href="javascript:commentVote(<?php echo ($vo["id"]); ?>,2,<?php echo ($vo["disagree"]); ?>)" id="disagree<?php echo ($vo["id"]); ?>">反对(<?php echo ($vo["disagree"]); ?>)</a>
                                            |
								            <a class="comment-reply-link" rid="<?php echo ($vo["id"]); ?>" pid="<?php echo ($vo["id"]); ?>" author="<?php echo ($vo["author"]); ?>" href="#publish_comment">回复</a>
                                        </span>
                                    </div>
								</div><!--/ .comment-body -->
							</div><!--/ .comment-entry-->

                        <?php if(!empty($vo["reply"])): ?><div class="comment-children">
				        <ul class="children unstyled">
                            <?php if(is_array($vo["reply"])): $key = 0; $__LIST__ = $vo["reply"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($key % 2 );++$key;?><li class="comment">

                            <?php if(empty($reply["author_id"])): ?><img width="40" height="40" alt="" src="http://218.244.140.70/Public/images/gravatar.png" class="avatar">
							<?php else: ?>
								<a href="__ MODULE__/User/index/id/<?php echo ($reply["author_id"]); ?>"><img width="40" height="40" alt="" src="http://218.244.140.70/Public/images/gravatar.png" class="avatar"></a><?php endif; ?>
						
							<div class="comment-entry" id="comment-entry-child">
								<div class="comment-meta" >
                                    <div class="comment-author">
                                        <span class="author" style="font-size:16px; line-height:1.5em;" ><?php if(!empty($reply["author_id"])): ?><a href="/index.php/Home/User/index/id/<?php echo ($vo["author_id"]); ?>"><?php echo ($reply["author"]); ?></a><?php else: ?><span class="author-span"><?php echo ($reply["author"]); ?></span><?php endif; ?>
                                    回复&nbsp;
<?php if(!empty($reply["parent_author_id"])): ?><a href="/index.php/Home/User/index/id/<?php echo ($reply["parent_author_id"]); ?>"><?php echo ($reply["parentName"]); ?></a><?php else: ?><span class="author-span"><?php echo ($reply["parentName"]); ?></span><?php endif; ?>
                                    于：<?php echo (date('Y-m-d H:s',$reply["createtime"])); ?></span>
                                    </div>
								</div><!--/ .comment-meta -->
								<div class="comment-body">
									<p><?php echo ($reply["content"]); ?></p>
                                    <div class="reply">
                                        <span class="reply-body">
                                            <a href="javascript:commentVote(<?php echo ($reply["id"]); ?>,1,<?php echo ($reply["agree"]); ?>)" id="agree<?php echo ($reply["id"]); ?>">支持(<?php echo ($reply["agree"]); ?>)</a>
                                            |
                                            <a href="javascript:commentVote(<?php echo ($reply["id"]); ?>,2,<?php echo ($reply["disagree"]); ?>)" id="disagree<?php echo ($reply["id"]); ?>">反对(<?php echo ($reply["disagree"]); ?>)</a>
                                            |
								            <a class="comment-reply-link" rid="<?php echo ($reply["id"]); ?>" pid="<?php echo ($vo["id"]); ?>" author="<?php echo ($reply["author"]); ?>" href="#publish_comment">回复</a>

                                            
                                        </span>
                                    </div>
								</div><!--/ .comment-body -->
							</div><!--/ .comment-entry-->

							</li><!--/ .comment--><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul><!--/ .children -->
                        </div><?php endif; ?>
					</li><!--/ .comment--><?php endforeach; endif; else: echo "" ;endif; ?><!-- msg_list -->
				</ul><!--/ .comments-list-->

	            
            <?php else: ?>
               	<div style="clear:both" class="alert alert-dismissable alert-info" id="noCommentAlert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
 		            <strong>温馨提示：</strong>暂无评论！
 		          </div><?php endif; ?>
			

		</div>
		<div class="loadMoreComment">
		<?php if($commentMore == 1): ?><input type="hidden" name="loadMoreCommentParam" id="loadMoreCommentParam" value="0" />
			<a href="javascript:void(0)" class="btn btn-primary btn-lg btn-block" onclick="loadMoreComment()">加载更多评论</a><?php endif; ?>
		
		</div>
        </div>
    </div>
</div>
<div class="col-md-4" id="hotmsg">
    <div class="comments">
        <div class="msghr">
		<h3>
			<img src="http://218.244.140.70/Public/images/commlist.gif"><span>&nbsp;&nbsp最热评论</span>
		</h3>
		</div> 
        <div class="commentlist" id="commentlist">
						<?php if(!empty($hotComment)): ?><ul class="comments-list unstyled">
                    <?php if(is_array($hotComment)): $i = 0; $__LIST__ = $hotComment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="comment" id="comment-content">
                            <?php if(empty($vo["author_id"])): ?><img width="40" height="40" alt="" src="http://218.244.140.70/Public/images/gravatar.png" class="avatar">
							<?php else: ?>
								<a href="/index.php/Home/User/index/id/<?php echo ($vo["author_id"]); ?>"><img width="40" height="40" alt="" src="http://218.244.140.70/Public/images/gravatar.png" class="avatar"></a><?php endif; ?>
						
							<div class="comment-entry" style="width:85%;">
								<div class="comment-meta" >
                                    <div class="comment-author">
                                        <span class="author" style="font-size:16px; line-height:1.5em;" ><?php if(!empty($vo["author_id"])): ?><a href="/index.php/Home/User/index/id/<?php echo ($vo["author_id"]); ?>"><?php echo ($vo["author"]); ?></a><?php else: ?><span class="author-span"><?php echo ($vo["author"]); ?></span><?php endif; ?>
                                    回复&nbsp;
<?php if(!empty($reply["parent_author_id"])): ?><a href="/index.php/Home/User/index/id/<?php echo ($reply["parent_author_id"]); ?>"><?php echo ($reply["parentName"]); ?></a><?php else: ?><span class="author-span"><?php echo ($reply["parentName"]); ?></span><?php endif; ?>
                                    于：<?php echo (date('Y-m-d H:s',$reply["createtime"])); ?></span>
                                    </div>
								</div><!--/ .comment-meta -->
								<div class="comment-body">
									<p><?php echo ($vo["content"]); ?></p>
                                    <div class="reply">
                                        <span class="reply-body">
                                            <a href="javascript:commentVote(<?php echo ($vo["id"]); ?>,1,<?php echo ($vo["agree"]); ?>, 2)" id="agree<?php echo ($vo["id"]); ?>-hot">支持(<?php echo ($vo["agree"]); ?>)</a>
                                            |
                                            <a href="javascript:commentVote(<?php echo ($vo["id"]); ?>,2,<?php echo ($vo["disagree"]); ?>, 2)" id="disagree<?php echo ($vo["id"]); ?>-hot">反对(<?php echo ($vo["disagree"]); ?>)</a>
                                            |
								            <a class="comment-reply-link" rid="<?php echo ($vo["id"]); ?>" pid="<?php echo ($vo["id"]); ?>" author="<?php echo ($vo["author"]); ?>" href="#publish_comment">回复</a>
                                        </span>
                                    </div>
								</div><!--/ .comment-body -->
							</div><!--/ .comment-entry-->

					</li><!--/ .comment--><?php endforeach; endif; else: echo "" ;endif; ?><!-- msg_list -->
				</ul><!--/ .comments-list-->

	            
            <?php else: ?>
               	<div style="clear:both" class="alert alert-dismissable alert-info" id="noCommentAlert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
 		            <strong>温馨提示：</strong>暂无评论！
 		          </div><?php endif; ?>

		</div>
    </div>
</div>

</div>

                           
            </div>
        </div>
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