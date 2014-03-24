/*
 * @author Apacal
 * 判断ie版本，小于10跳出提示升级到10或者使用firefox浏览器
 *
 */
function getIE() {
    if(navigator.appName == "Microsoft Internet Explorer") {
        if(navigator.appVersion.match(/10\./i) == '10.'){
        }else{
            confirm("请使用IE10或者firefox浏览器！谢谢");
            window.location.href="http://www.firefox.com.cn/";
        }
    }
}
getIE();
