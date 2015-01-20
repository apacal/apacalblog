$(document).ready(function () {

});


function info(msg) {

    swal({
        title: msg,
        text: "I will close in 2 seconds.",
        timer: 2000,
        type:"success"
    });
}

function error(msg) {
    sweetAlert("Oops...", msg, "error");
}



function refreshAsyncDataToDiv(url, divId) {
    $.ajax({
        url: url,
        type: 'get',
        error: function(XMLHttpRequest, textStatus, errorThrown){
            sweetAlert( "Server Status: " + XMLHttpRequest.status, XMLHttpRequest.statusText, "error");
        },
        success: function(data,status){
            if (status == 'success') {
                $('#' + divId).html(data);
            } else {
                info(status)
            }
        }
    });
}

function ajaxPublish(formId) {
    var action = $("#" + formId).attr('action');
    var data = $("#" + formId).serialize();
    $.ajax({
        url: action,
        data: data,
        type: 'post',
        error: function(XMLHttpRequest, textStatus, errorThrown){
            sweetAlert( "Server Status: " + XMLHttpRequest.status, XMLHttpRequest.statusText, "error");
        },
        success: function(data,status){
            if (status != 'success') {
                error(status);
            } else {
                data = JSON.parse(data);
                if (data.code != '0') {
                    error(data.data);
                } else {
                    info("publish success!");
                }
            }
        }
    });

}



/**
 * ajax function to post data to server
 * @param url
 * @param data post data
 * @param success success message
 */
function ajaxFunc(url, data, success) {
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        error: function(XMLHttpRequest, textStatus, errorThrown){
            sweetAlert( "Server Status: " + XMLHttpRequest.status, XMLHttpRequest.statusText, "error");

        },
        success: function(data,status){
            if (status == 'success') {
                data = JSON.parse(data);
                if (data.code != '0') {
                    error(data.msg);
                } else {
                    info(success);
                }
            } else {
                error("Server Statue: " + status);
            }
        }
    });

}


/**
 * save icon input id in edit page
 * @param iconInputId
 */
function saveIconId(iconInputId) {
    window.iconInputId = iconInputId;
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







