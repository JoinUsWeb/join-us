/**
 * Created by zhang on 2017/2/12.
 */

function getRoot() {
    var url = window.document.location.href;
    var pathname = window.document.location.pathname;
    return url.substr(0, url.indexOf(pathname));
}

var root = getRoot();

var topic_check = false, start_date_check = false, close_date_check = false, place_check = false, num_limit_check = false,
    detail_check = false;

function check() {
    check_topic();
    check_start_date();
    check_close_date();
    check_num_limit();
    check_place();
    check_detail();
    if ($('#hd_style_1st').val() == -1 || $('#hd_style_2nd').val() == -1) {
        document.getElementById("style_error").innerHTML="请选择活动标签！";
        return false;
    }
    return topic_check && start_date_check && close_date_check && place_check && num_limit_check &&
        detail_check;
}

function verify_string(data) {
    return (data.length <= 0 || data.trim().length <= 0 || data == null || data == undefined);
}
function check_topic() {
    topic_check = false;
    var topic = document.getElementById("hd_topic").value;
    if (verify_string(topic)) {
        // 显示错误信息
        document.getElementById("topic_error").innerHTML="活动主题不能为空！";
        return;
    }
    else document.getElementById("topic_error").innerHTML="";
    // 清空错误信息
    topic_check = true;
}
function check_start_date() {
    start_date_check = false;
    var start_date = document.getElementById("start_date").value;
    if (verify_string(start_date)) {
        // 显示错误信息
        document.getElementById("start_error").innerHTML="请填写活动开始时间！";
        return;
    }
    // 清空错误信息
    start_date_check = true;
}
function check_end_date() {
    end_date_check = false;
    var end_date = document.getElementById("end_date").value;
    if (verify_string(end_date)) {
        // 显示错误信息
        document.getElementById("end_error").innerHTML="请填写活动结束时间！";
        return;
    }
    // 清空错误信息
    end_date_check = true;
}
function check_close_date() {
    close_date_check = false;
    var close_date = document.getElementById("close_date").value;
    if (verify_string(close_date)) {
        // 显示错误信息
        document.getElementById("close_error").innerHTML="请填写截止报名时间！";
        return;
    }
    // 清空错误信息
    close_date_check = true;
}
function check_place() {
    place_check = false;
    var hd_place = document.getElementById("hd_place").value;
    if (verify_string(hd_place)) {
        // 显示错误信息
        document.getElementById("place_error").innerHTML="请填写活动举办地点！";
    }
    else document.getElementById("place_error").innerHTML="";
    // 清空错误信息
    place_check = true;
}
function check_num_limit() {
    num_limit_check = false;
    var num_limit = document.getElementById("num_limit").value;
    if (num_limit.length == 0) {
        // 显示错误信息
        document.getElementById("num_error").innerHTML="请填写活动人数上限！";
    }
    if (isNaN(num_limit)) {
        // 显示错误信息
        document.getElementById("num_error").innerHTML="请用数字填写活动人数上限！";
        
        return;
    }
    else document.getElementById("num_error").innerHTML="";
    // 清空错误信息
    num_limit_check = true;
}
function check_detail() {
    detail_check = false;
    var hd_detail = document.getElementById("hd_detail").value;
    if (verify_string(hd_detail)) {
        // 显示错误信息
        document.getElementById("detail_error").innerHTML="请填写活动详情！";
        return;
    }
    // 清空错误信息
    else document.getElementById("detail_error").innerHTML="";
    detail_check = true;
}