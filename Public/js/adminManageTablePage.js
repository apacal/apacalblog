
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

window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        addTab(row.editTab + '-' + row.pkey, row.editUrl);
        console.log(value, row, index);
    },
    'click .remove': function (e, value, row, index) {
        window.bsTableDom =  $(this).parents(".bootstrap-table");

        var data = {
            'id': row.pkey
        };
        ajaxChangeRows(row.delUrl, data, "delete row that pk is " + row.pkey + " success!");

    }
};




function refreshTableData(dom) {
    $(dom).parents(".bootstrap-table").bootstrapTable("refresh");
}

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
            //console.log(!window.switchState);
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

function initSwitch() {
    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $.fn.bootstrapSwitch.defaults.onColor = 'success';
    $.fn.bootstrapSwitch.defaults.offColor = 'danger';

    $(".switch-checkbox").bootstrapSwitch();

    $('.switch-checkbox').on('switchChange.bootstrapSwitch', function(event, state) {
        setStatus(event, state, this);

    });

}

function iconFormatter(value, row) {
    return '<span class="' + value + '"></span>';
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
    console.log(ids);
    console.log(ids.length);
    return {
        ids: JSON.stringify(ids),
        len: ids.length
    };
}


function deleteRows(dom) {
    window.bsTableDom =  $(dom).parents(".bootstrap-table").find(".bootstrap-table");
    var ret = getSelectIds(window.bsTableDom);
    var ids = ret.ids;
    var len = ret.len;
    var url = $(window.bsTableDom).parents(".container-table").attr('delUrl');
    ajaxChangeRows(url, {ids:ids}, "delete " + len + ' row success' )

}

function ajaxChangeRows(url, data, success) {
    //console.log("url: " + url);

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
