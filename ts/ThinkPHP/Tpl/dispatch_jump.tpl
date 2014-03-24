<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>空气质量收集系统-跳转提示</title>
<link type="text/css" rel="stylesheet" href="__ROOT__/statics/css/templatemo_style.css">
<script type="text/javascript" language="javascript">
function clearText(field){

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;

}
</script>
</head>
<body>
	<div id="templatemo_background_section_top">
		<div class="templatemo_container">
			<div id="templatemo_header">
				<div id="templatemo_logo">
                    <a href="__ROOT__" id="first">
					<h1>&nbsp;&nbsp;&nbsp;&nbsp;空气质量收集系统</h1>
                    <h2>以广州地区为例</h2></a>
				</div>
            </div>
        </div>
    </div>

<div class="system-message">
<h1>
<present name="message">

<p class="success"><?php echo($message); ?>!!</p>
<else/>

<p class="error"><?php echo($error); ?>!!</p>
</present>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
<h1>
</div>



<div id="templatemo_background_section_bottom"> 
		<div class="templatemo_container">
       	  <div id="templatemo_footer_section" >
           	 
                <div class="templatemo_footer_section_box_2">
                    <b><p id="footer">Copyright &copy; 2013 Apacal All rights reserved<br />技术支持: Apacal</p></b></div>
          </div>
            
        </div>
</div><!--  End Of Back Ground Section bottom  -->

<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>
