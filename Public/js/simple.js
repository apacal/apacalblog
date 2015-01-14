$(document).ready(function(){

    initCodeMirror();


    initHash();

    initCalendar();

    /**
     * 多级菜单显示效果
     */
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

    $(window).bind('scroll',function(){showBlogInfo()});

});

function initCodeMirror() {
    $("pre").each(function() {
        var $this = $(this),
            $code = $this.html();

        $this.empty();

        CodeMirror(this, {
            value: $code,
            mode: 'clike',
            lineNumbers: !$this.is('.inline'),
            theme: "eclipse",
            readOnly: false
        });
    });
}

function initCalendar() {
    var options = {
        title:"Apacal.cn",
        events: [],
        firstDayOfWeek: "Monday",
        showDays: true,
        url: "http://apacal.cn",
        color: "black"
    };
    $("#calendar").kalendar(options);
}

function initHash() {
    var type = window.location.hash.substr(1);
    window.location.hash = type;

}


var opacity = 1;
var prev = 0;
var topSize = 15;

function showBlogInfo() {

    var prev = window.prev;
    var opacity = window.opacity;
    var topSize = window.topSize;
    var height = $(".wrapper").height();
    var step = 1 / 7;
    var topStep = 4;

    var curr = $(document).scrollTop();
    if ( 0 <= opacity && opacity <= 1 && curr != 0) {
        if (curr >= prev) {
            opacity -= step;
            topSize += topStep;
        } else {
            opacity += step;
            topSize -= topStep;
        }
    }
    if (curr == 0) {
        opacity = 1;
        topSize = 15;
    }

    //console.log("opacity: " + opacity);
    //console.log("prev: " + prev);
    //console.log("curr: " + curr);
    //console.log("height: " + height);
    prev = $(document).scrollTop();
    if (curr <= height) {
        $(".blog-info").css("opacity", opacity);
        $(".blog-info").css("bottom", curr / 2);
        $("#header-info").css("top", topSize + "%");
    } else {
        opacity = 0;
        topSize = 40;

    }
    window.topSize = topSize;
    window.prev = prev;
    window.opacity = opacity;

    //console.log("topSize:" + topSize);



}

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

