<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>空气质量收集系统</title>
<link type="text/css" rel="stylesheet" href="__ROOT__/statics/css/templatemo_style.css">
<script type="text/javascript" src="__ROOT__/statics/js/ie.js"></script>
</head>
<body>

<!--  Free CSS Template from cssMoban.com  --> 
	<div id="templatemo_background_section_top">
		<div class="templatemo_container">
			<div id="templatemo_header">
				<div id="templatemo_logo">
                    <a href="__ROOT__" id="first">
					<h1>&nbsp;&nbsp;&nbsp;&nbsp;空气质量收集系统</h1>
                    <h2>以广州地区为例</h2></a>
				</div>
                <div id="templatemo_search_box">
           	    	
                        <p>
                        <?php
 if(isset($_SESSION[C('USER_AUTH')])){ echo $_SESSION['user_name']; echo "&nbsp;&nbsp;欢迎回来&nbsp;&nbsp;&nbsp;&nbsp;"; echo '<a href="__ROOT__/index.php/Index/logout" target="_top"> 注销</a>'; }else{ echo '<a href="__ROOT__/index.php/Index/login">登录</a>'; } ?>
                       </p>
               	  
				</div>
                <div id="templatemo_menu">
                	<div id="templatemo_menu_bg_l"></div>
                    <div id="templatemo_menu_bg_r">
                    	<ul>
    						<li class="current"><a href="__ROOT__/index.php/Index/index"><b>首页</b></a></li>
        					<li><a href="__ROOT__/index.php/AboutUs/menu"><b>关于我们</b></a></li>
                            <li><a href="__ROOT__/index.php/Progress/menu"><b>相关文章</b></a></li>
        					<li><a href="__ROOT__/index.php/Index/input_data"><b>上报数据</b></a></li>
        					<li><a href="__ROOT__/index.php/Data/menu"><b>数据查看</b></a></li>	
        					<li><a href="__ROOT__/index.php/Index/autoData"><b>自动上报数据</b></a></li>	
    					</ul>
                    </div>
                </div>
			</div><!--  End Of Header  -->
		</div><!--  End Of Container  -->        
        
	</div><!--  End Of Back Ground Section Top  -->

 <div id="templatemo_background_section_middle">
    
  <div class="templatemo_container">
			
            <div id="templatemo_content_area">
            	
                <div id="templatemo_left">
					<div class="templatemo_section">
						<div class="templatemo_section_top_pc"><a href="__ROOT__/index.php/AboutUs/menu">文章</a></div>
						<div class="templatemo_section_middle">
                           
                            <ul>
                                
                                <?php if(is_array($home_about_us)): foreach($home_about_us as $key=>$vo): ?><li><a href="__ROOT__/index.php/AboutUs/details/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
                            </ul>
                            <ul>
                                <?php if(is_array($home_progress)): foreach($home_progress as $key=>$vo): ?><li><a href="__ROOT__/index.php/Progress/details/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
                        	</ul>
						  <div class="cleaner_with_height">&nbsp;</div>
                	    </div>
                        
                    	<div class="templatemo_section_bottom">
	                    </div>
					</div><!--  End Of Section-->
                    <div class="templatemo_section">
						<div class="templatemo_section_top_pic"><a href="__ROOT__/index.php/Data/menu">数据</a></div>
						<div class="templatemo_section_middle">
                        	<ul>
                                <?php if(is_array($data)): foreach($data as $key=>$vo): ?><li><a href="__ROOT__/index.php/Data/details/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
                        	</ul>
                            <div class="cleaner_with_height">&nbsp;</div>
                	    </div>
                    	<div class="templatemo_section_bottom">
	                    </div>
					</div><!--  End Of Section-->
                
				</div><!--  End Of Left-->

<div id="templatemo_right">
    
    <div id="content">
        <div id="daohang">
            <span>
            <a href="__ROOT__">首页</a>
            <span> > </span>
            <a href="#">刚刚自动收集的数据</a>
            > 列表
            </span>
        </div>
        <table class="data_menu_table">
            <thead>
                <tr>
                    <th width=20%>数据编号</th>
                    <th width=50%>监测点</th>
                    <th width=30%>添加时间</th>
                </tr>

             <tbody>
                <?php if(is_array($autoData)): $i = 0; $__LIST__ = $autoData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["id"]); ?></td><td><a href="__ROOT__/index.php/Data/details/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td><td><span>[ <?php echo (date('Y-m-d H:i:s',$vo["publish_time"])); ?> ]</span> </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
   
    <div>
</div>
</div>

          </div><!--  End Of Content Area-->
            
	  </div><!--  End Of Container-->    
        
	</div><!--  End Of Back Ground Section Middle  -->

    <div id="templatemo_background_section_bottom"> 
		<div class="templatemo_container">
       	  <div id="templatemo_footer_section" >
           	 
                <div class="templatemo_footer_section_box_2">
                    <b><p id="footer">Copyright &copy; 2013 一气化三清科研小组 All rights reserved<br />技术支持: ThinkChina开发小组&nbsp;&nbsp;<script src="http://s6.cnzz.com/stat.php?id=5291009&web_id=5291009&show=pic" language="JavaScript"></script></p></b></div>
          </div>
            
        </div>
    </div><!--  End Of Back Ground Section bottom  -->

 
</body>
</html>