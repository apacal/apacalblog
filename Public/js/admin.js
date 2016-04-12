$(document).ready(function () {
    /**
     * Remove a Tab
     */
    $('#page-tab').on('click', ' li a .close', function() {
        var tabId = $(this).parent('a').attr('href');
        $(this).parent('a').parent('li').remove();
        $(tabId).remove();
        $('#page-tab a:first').tab('show');
    });

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

/**
 * add a tab
 */
function addTab(tabName, url, multiple) {
    window.addTabName = tabName;
    if (multiple != undefined && multiple  == true) {
        if (window.tabCount) {
            tabName += '-' + window.tabCount;
            window.tabCount++;

        } else {
            window.tabCount = 1;
        }
    }

    var tabListHead = '<li role="presentation"><a href="#page-' + tabName + '" role="tab" data-toggle="tab">' + tabName +
        '&nbsp;&nbsp;<button class="close" title="Remove this page" type="button">×</button>'
        + '</a></li>';
    // tab is not exit
    if (!($("#page-" + tabName).length)) {
        $("#page-tab").append(
            tabListHead
        );
        var tabContent = '<div class="tab-pane" id="page-' + tabName + '"></div>';
        $('#tab-content').append(tabContent);
    }
    refreshAsyncDataToDiv(url, "page-" + tabName);
    $('#page-tab a[href="#page-' + tabName + '"]').tab('show');

}


function removeTabByTabName(tabName) {
    $("#page-tab").find("[href='#" + tabName + "']").parent('li').remove();
    //$(linkDom).parent('li').remove();
    $("#" + tabName).remove();
    $('#page-tab a:first').tab('show');

}

function refreshAsyncDataToDiv(url, divId) {
    $.ajax({
        url: url,
        type: 'get',
        error: function(XMLHttpRequest, textStatus, errorThrown){
            removeTabByTabName(divId);
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


/**
 * add value to input, input id must save in window.inputId when modal show
 * @param val
 */
function addValueToInput(val) {
    $("#" + window.inputId).val(val);
    $("#modal-tree").modal('hide');
}

/**
 * show tree in edit page
 * @param inputId
 * @param url
 */
function showTree(inputId, url) {
    window.inputId = inputId;

    $('#js-tree').jstree('destroy');



    $.ajax({
        url: url,
        type: 'get',
        error: function(XMLHttpRequest, textStatus, errorThrown){
            sweetAlert( "Server Status: " + XMLHttpRequest.status, XMLHttpRequest.statusText, "error");

        },
        success: function(data,status){
            if (status == 'success') {
                data = JSON.parse(data);
                $('#js-tree').jstree({
                    "plugins" : [ "wholerow"],
                    'core': {
                        'data': data
                        ,
                        'themes': {
                            'name': 'proton',
                            'responsive': true
                        }
                    }
                });
                $("#modal-tree").modal('show');


            } else {
                $("#modal-tree").modal('hide');
                error("Server Statue: " + status);
            }
        }
    });
};


/**
 * show tree in edit page
 * @param inputId
 * @param url
 */
function showAuthRulesTree(inputId, url) {
    window.inputId = inputId;

    $('#js-rules-tree').jstree('destroy');



    $.ajax({
        url: url,
        type: 'get',
        error: function(XMLHttpRequest, textStatus, errorThrown){
            sweetAlert( "Server Status: " + XMLHttpRequest.status, XMLHttpRequest.statusText, "error");

        },
        success: function(data,status){
            if (status == 'success') {
                data = JSON.parse(data);
                $('#js-rules-tree').jstree({
                    "plugins" : ["checkbox"],
                    'core': {
                        'data': data
                        ,
                        'themes': {
                            'name': 'proton',
                            'responsive': true
                        }
                    }
                });
                $("#modal-tree-rules").modal('show');


            } else {
                $("#modal-tree-rules").modal('hide');
                error("Server Statue: " + status);
            }
        }
    });
};
function saveRulesToInput() {
    var checked_ids = $("#js-rules-tree").jstree("get_checked",null,true)
    $("#" + window.inputId).val(JSON.stringify(checked_ids));
    $('#js-rules-tree').jstree('destroy');
    $("#modal-tree-rules").modal('hide');

}

/**
 * manage table formatter operate
 * @param value
 * @param row
 * @param index
 * @returns {string}
 */
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
        '<i class="glyphicon glyphicon-edit"></i>',
        '</a>',
        '&nbsp;&nbsp;&nbsp;',
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
        '<i class="glyphicon glyphicon-trash"></i>',
        '</a>'
    ].join('');
}

/**
 * manage table in operate action
 * @type {{click .edit: Function, click .remove: Function}}
 */
window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        addTab(row.editTab + '-' + row.pkey, row.editUrl);
    },
    'click .remove': function (e, value, row, index) {
        window.bsTableDom =  $(this).parents(".bootstrap-table");

        var data = {
            'id': row.pkey
        };
        ajaxChangeRows(row.delUrl, data, "delete row that pk is " + row.pkey + " success!");

    }
};


/**
 * manage table formatter operate in gallery
 * @param value
 * @param row
 * @param index
 * @returns {string}
 */
function operateFormatterInGallery(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
        '<i class="glyphicon glyphicon-edit"></i>',
        '</a>',
        '&nbsp;&nbsp;&nbsp;',
        '<a class="edit_items ml10" href="javascript:void(0)" title="EditItems">',
        '<i class="glyphicon glyphicon-picture"></i>',
        '</a>',
        '&nbsp;&nbsp;&nbsp;',
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
        '<i class="glyphicon glyphicon-trash"></i>',
        '</a>'
    ].join('');
}

/**
 * manage table in operate action
 * @type {{click .edit: Function, click .remove: Function}}
 */
window.operateEventsInGallery = {
    'click .edit': function (e, value, row, index) {
        addTab(row.editTab + '-' + row.pkey, row.editUrl);
    },
    'click .edit_items': function (e, value, row, index) {
        addTab(row.editItemsTab + '-' + row.pkey, row.editItemsUrl);
    },
    'click .remove': function (e, value, row, index) {
        window.bsTableDom =  $(this).parents(".bootstrap-table");

        var data = {
            'id': row.pkey
        };
        ajaxChangeRows(row.delUrl, data, "delete row that pk is " + row.pkey + " success!");

    }
};

/**
 * refresh bs-table data by switch dom
 * @param dom
 */
function refreshTableData(dom) {
    $(dom).parents(".bootstrap-table").bootstrapTable("refresh");
}

/**
 * refresh bs-table data by bs-table dom
 * @param dom
 */
function refreshTableDataByTableDom(dom)  {
    $(dom).bootstrapTable("refresh");
}

/**
 * set status by async
 */
function setStatus(event, state, dom) {
    var url = $(dom).attr('data-url');
    var id = $(dom).attr('data-id');
    window.switchDom = dom;

    $.ajax({
        url: url,
        type: 'get',
        data: {
            'id' : id,
            'status' : state
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            refreshTableData(window.switchDom);


            sweetAlert( "Server Status: " + XMLHttpRequest.status, XMLHttpRequest.statusText, "error");

        },
        success: function(data,status){
            if (status == 'success') {
                data = JSON.parse(data);
                if (data.code != '0') {
                    error(data.data);
                    refreshTableData(window.switchDom);
                }
            } else {
                error("Server Statue: " + status);
                refreshTableData(window.switchDom);
            }
        }
    });

}

/**
 * init switch in manage table
 */
function initSwitch() {
    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $.fn.bootstrapSwitch.defaults.onColor = 'success';
    $.fn.bootstrapSwitch.defaults.offColor = 'danger';

    $(".switch-checkbox").bootstrapSwitch();

    $('.switch-checkbox').on('switchChange.bootstrapSwitch', function(event, state) {
        setStatus(event, state, this);

    });

}

/**
 * formatter icon in manage table
 * @param value
 * @param row
 * @returns {string}
 */
function iconFormatter(value, row) {
    return '<span class="' + value + '"></span>';
}


/**
 * formatter image in manage table
 * @param value
 * @param row
 * @returns {string}
 */
function imageFormatter(value, row) {
    if (value == undefined || value == null || value == '') {

        return '<img style="max-width:50px" alt="404" src="">';

    } else {

        return '<img style="max-width:50px" alt="404" src="' + value + '">';
    }
}

/**
 * status formatter
 * @param value
 * @param row
 * @returns {string}
 */
function statusFormatter(value, row) {
    if (value == '0') {
        return '<input type="checkbox" class="switch-checkbox" data-url="' + row.statusUrl + '" data-id="' + row.id + '">' ;
    } else {

        return '<input type="checkbox" class="switch-checkbox" data-url="' + row.statusUrl + '" data-id="' + row.id + '" / checked>' ;
    }
}


/**
 * get select ids
 * @param dom bs-table dom
 */
function getSelectIds(dom) {
    var ids = new Array();
    $(dom).find("input:checkbox[name=btSelectItem]:checked").each(function () {
        ids.push($(this).val());
    });
    return {
        ids: JSON.stringify(ids),
        len: ids.length
    };
}


/**
 * delete rows in manage table
 * @param dom
 */
function deleteRows(dom) {
    window.bsTableDom =  $(dom).parents(".bootstrap-table").find(".bootstrap-table");
    var ret = getSelectIds(window.bsTableDom);
    var ids = ret.ids;
    var len = ret.len;
    var url = $(window.bsTableDom).parents(".container-table").attr('delUrl');
    ajaxChangeRows(url, {ids:ids}, "delete " + len + ' row success' )

}

/**
 * ajax post data to server to delete and fresh bs-table data
 * @param url
 * @param data
 * @param success
 */
function ajaxChangeRows(url, data, success) {

    $.ajax({
        url: url,
        type: 'post',
        data: data,
        error: httpError,
        success: function(data,status){
            if (status == 'success') {
                data = JSON.parse(data);
                if (data.code != '0') {
                    error(data.data);
                } else {

                    refreshTableDataByTableDom(window.bsTableDom);
                    info(success);
                }
            } else {
                error("Server Statue: " + status);
            }
        }
    });
}


function saveCreatePwdInfo(inputId, url) {
    window.pwdInput = inputId;
    window.pwdUrl = url;
}

function createPwd() {
    var data = $("#pwd-form").serialize();
    $.ajax({
        url: window.pwdUrl,
        data: data,
        type: 'post',
        error: httpError,
        success: function(data,status){
            if (status != 'success') {
                error(status);
            } else {
                data = JSON.parse(data);
                if (data.code != '0') {
                    error(data.data);
                } else {
                    $("#modal-pwd").modal('hide');
                    $('#' + window.pwdInput).val(data.data);
                    info("create success, pwd is " + data.data);
                }
            }
        }
    });
}

/**
 * bs-table status disable
 * @param dom
 */
function statusDisable(dom) {
    window.bsTableDom =  $(dom).parents(".bootstrap-table").find(".bootstrap-table");
    var ret = getSelectIds(window.bsTableDom);
    var ids = ret.ids;
    var len = ret.len;
    var url = $(window.bsTableDom).parents(".container-table").attr('statusUrl');
    ajaxChangeRows(url, {ids:ids,status:false},"disable " + len + ' row success')

}

function statusEnable(dom) {
    window.bsTableDom =  $(dom).parents(".bootstrap-table").find(".bootstrap-table");
    var ret = getSelectIds(window.bsTableDom);
    var ids = ret.ids;
    var len = ret.len;
    var url = $(window.bsTableDom).parents(".container-table").attr('statusUrl');
    ajaxChangeRows(url, {ids:ids,status:true},"enable " + len + ' row success')

}


/**
 * CKFinder select image
 * @param imageInputId
 * @constructor
 */
function BrowseServer(imageInputId) {
    window.imageInputId = imageInputId;
    // You can use the "CKFinder" class to render CKFinder in a page:
    //var finder = new CKFinder();
    //CKFinder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
    //CKFinder.finder.selectActionFunction = SetFileField;
    //CKFinder.finder.popup();
    // It can also be done in a single line, calling the "static"
    // popup( basePath, width, height, selectFunction ) function:
    // CKFinder.popup( '../', null, null, SetFileField ) ;
    //
    // The "popup" function can also accept an object as the only argument.
    CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
}

/**
 * This is a sample function which is called when a file is selected in CKFinder.
 * @param fileUrl
 * @constructor
 */
function SetFileField( fileUrl ) {

    document.getElementById( window.imageInputId ).value = fileUrl;
}


/**
 * article tags js
 * @param showId
 */
function showSystemTags(showId) {
    if ($("#" + showId).css("display") == "none") {
        $("#" + showId).css("display", "block");
    } else {
        $("#" + showId).css("display", "none");
    }
}

function addTag(addId, saveId, showId) {
    var tag = $("#" + addId).val();
    addTagByName(tag, saveId, showId);
}

function addTagByName(tag, saveId, showId) {
    var tagJson = $("#" + saveId).val();
    if (tagJson == '') {
        var tagArray = new Array();
    } else {
        var tagArray = JSON.parse(tagJson);
    }

    if (include(tagArray, tag) < -1) {
        tagArray.push(tag);
        $("#" + showId).append(getTagHtml(tag));
        $("#" + saveId).val(JSON.stringify(tagArray));
    }
}

/**
 * find obj is in array
 * @param arr
 * @param obj
 * @returns {boolean}
 */
function include(arr, obj) {
    for(var i=0; i<arr.length; i++) {
        if (arr[i] == obj) return i;
    }
    return -2;
}

/**
 * init tags html when edit a forum
 * @param arr
 */
function initTagsHtml(saveId, showId) {
    var tagsJson = $("#" + saveId).val();
    if (tagsJson == '') {
        return true;
    }
    var arr = JSON.parse($("#" + saveId).val());
    var html = "";
    for(var i=0; i<arr.length; i++) {
        html += getTagHtml(arr[i])
    }
    $("#" + showId).html(html);
}


/**
 * get a tag html
 * @param tag
 * @returns {string}
 */
function getTagHtml(tag) {
    var html = '<span><i class="glyphicon glyphicon-remove"  onclick="removeTag(this);"></i><button type="button" style="margin-right: 10px" class="btn btn-xs btn-info selected-tag text-uppercase">' + tag
        + '</button></span>';
    return html;
}

function removeTag(iconDom) {
    var tag = $(iconDom).nextAll('button').text();
    var saveDom = $(iconDom).parent().parent().parent().prev().find("[type='hidden']");

    var tagArray = JSON.parse($(saveDom).val());
    var index = include(tagArray,tag);
    if (index < -1) {
        return true;
    }
    if (index > -1) {
        tagArray.splice(index, 1);

        $(saveDom).val(JSON.stringify(tagArray));
    }
    $(iconDom).parent('span').remove();

}

/**
 * alert error when http request happen
 * @param XMLHttpRequest
 * @param textStatus
 * @param errorThrown
 */
function httpError(XMLHttpRequest, textStatus, errorThrown) {
    sweetAlert("Server Status: " + XMLHttpRequest.status, XMLHttpRequest.statusText, "error");
}
