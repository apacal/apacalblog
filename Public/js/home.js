/**
 * 多级菜单显示效果
 */
$(document).ready(function(){
    $(".dropdown").hover(function(){
        $(this).children("ul.dropdown-menu").css("display", "block");
    });
    $(".dropdown").mouseleave(function(){
        $(this).children("ul.dropdown-menu").css("display", "none");
    });
    $(".nav-a").click(function(){
        var url = $(this).attr("href");
        window.location.href = url;
    });
});

/**
  * 局部刷新DIV
  * @param url（相应url）, divId，执行局部刷新。
  * @author apacal
  * @last
  */
 function refreshAjaxDiv(url, data, divId, isAppend) {
	 $.ajax({
			url: url,
			data: data, 
			type: 'POST',
			dataType: 'html',
			timeout: 5000,
			error: function(ajaxStr) {
				alert('请重试');
			},
			success: function(ajaxStr) {
				if(isAppend) {
					$("#" + divId).append(ajaxStr);
                } else {
					$("#" + divId).html(ajaxStr);
                }
                // reflash bg
                //change_bg_3d('#000000', '#CCCCCC');
                change_bg_3d('#44b549', '#2d8e31');
                
			}
		});	
 } 

 /**
  *sleep 暂停
  * @param n 秒
  */
function sleep(n){
    n = n * 1000;
    var start=new Date().getTime();
    while(true) 
        if(new Date().getTime()-start>n) 
            break;
}

