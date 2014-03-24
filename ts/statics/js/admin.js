/*  
 *  删除文章
 *  @param url 当前模块的URL
 *  @param id 文章ID
 *  @param title 文章标题
 */
function checkDel(url,id,title) {
    var str;
    str = '确定删除' + '编号' + id + "--" + title + '"?';
    if(confirm(str)){
         window.location.href = url + '/delete/id/' + id;
    }
}
/* 
 * 文章通过
 */
function checkPass(url,id,title) {
    var str;
    str = '确定通过' + '"' + id + "-" + title + '"?';
    if(confirm(str)){
        window.location.href = url + '/pass/id/' + id;
    }
}
/*  
 *  文章不通过
 *
 */
function checkUnpass(url,id,title) {
    var str;
    str = '确定不通过' + '"' + id + "-" + title + '"?';
    if(confirm(str)){
        window.location.href = url + '/unpass/id/' + id;
    }
}
/*
 * 设置为超级管理员
 *
 */
function setRoot(url,id,title) {
    var str;
    str = '确定设置' + '"' + id + "-" + title + '"为超级管理员?';
    if(confirm(str)){
        window.location.href = url + '/setRoot/id/' + id;
    }
}
/*
 * 设置为管理员
 *
 */
function unSetRoot(url,id,title) {
    var str;
    str = '确定设置' + '"' + id + "-" + title + '"为管理员?';
    if(confirm(str)){
        window.location.href = url + '/unSetRoot/id/' + id;
    }
}
