<?php if (!defined('THINK_PATH')) exit(); if(empty($articleAddList)): ?><script type="text/javascript">
    $(function(){
        showTip(1, "已经到底了!");
    });
</script>
<?php else: ?>
        <?php if(is_array($articleAddList)): $i = 0; $__LIST__ = $articleAddList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-lg-4 view-summary-div">
                <div class="view-summary">
                    <div class="view-summary-1">
                        <a href="/index.php/Home/Article/view/id/<?php echo ($vo["id"]); ?>" class="view-img-a"><?php if(empty($vo["image"])): ?><img alt="<?php echo ($vo["title"]); ?>"  class="img-thumbnail" src="http://218.244.140.70/Public/images/default.jpg"><?php else: ?><img alt="<?php echo ($vo["title"]); ?>" class="img-thumnail" src="<?php echo (getthunmname($vo["image"])); ?>"><?php endif; ?></a>
                        <span class="interaction-count"><span class="dt">Interaction count:</span><?php echo ($vo["click"]); ?><span class="glyphicon glyphicon-share-alt"></span></span>
                        <div class="view-content">
                            <span class="tags" ><a href="http://218.244.140.70/index.php/Category/index/cid/<?php echo ($vo["cid"]); ?>" class="parsed" ><?php echo ($vo["cname"]); ?></a></span>
                            <a href="/index.php/Home/Article/view/id/<?php echo ($vo["id"]); ?>"><h5 class="view-h2"><?php echo ($vo["title"]); ?></h5></a>
                            <p class="article-description"><?php echo (msubstr($vo["description"],0,80)); ?></p>
                        </div>
                    </div>
                    <div class="meta">
                        <span class="author"><span class="dt">Author:</span> <a href="/index.php/Home/User/admin/id/<?php echo ($vo["adminid"]); ?>"><?php echo ($vo["adminname"]); ?></a></span>
                        <span class="publish-date pull-right"><span class="dt">Publish date:</span> <span class="dd" itemprop="datePublished"><?php echo (date('F d, Y', $vo["createtime"])); ?></span></span>
                    </div>
                </div>
            </div><!-- /.col-lg-4 --><?php endforeach; endif; else: echo "" ;endif; endif; ?>