/**
 * 通用的 from表单提交数据的方法
 */
function singwaapp_save(form) {
    var data = $(form).serialize();
    url = $(form).attr('url');
    $.post(url, data, function (result) {
        if (result.code == 0) {
            layer.msg(result.msg, {icon: 5, time: 2000});
        } else if (result.code == 1) {
            self.location = result.data.jump_url;
        }
    }, 'JSON');

}

/**
 * 时间插件适配方法
 * @param flag
 */
function selecttime(flag) {
    if (flag == 1) {
        var endTime = $("#countTimeend").val();
        if (endTime != "") {
            WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm', maxDate: endTime})
        } else {
            WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm'})
        }
    } else {
        var startTime = $("#countTimestart").val();
        if (startTime != "") {
            WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm', minDate: startTime})
        } else {
            WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm'})
        }
    }
}

/**
 * 通用化的删除操作
 * @param obj
 */
function app_del(obj) {
    url = $(obj).attr('del_url');
    //alert(url);
    layer.confirm('确认要删除吗？', function (index) {
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    self.location = data.data.jump_url;
                } else if (data.code == 0) {
                    layer.msg(data.msg, {icon: 2, time: 2000});
                }
            },
            error: function (data) {
                console.log(data.msg);
            }
        });
    });
}

/**
 * 通用化修改状态操作
 * @param obj
 */
function app_status(obj) {
    url = $(obj).attr('status_url');
    layer.confirm('确认要修改吗？', function (index) {
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                if (data.code == 1) {
                    self.location = data.data.jump_url;
                } else if (data.code == 0) {
                    layer.msg(data.msg, {icon: 2, time: 2000});
                }
            },
            error: function (data) {
                console.log(data.msg);
            }
        });
    });
}
