/**
 * Created by zhang on 2017/2/12.
 */

function getRoot() {
    var url = window.document.location.href;
    var pathname = window.document.location.pathname;
    return url.substr(0, url.indexOf(pathname));
}

var root = getRoot();
var email_check = false, nick_name_check = false, password_check = false,
    password_confirm_check = false, phone_check = false;

function check() {
    check_email(false);
    check_nick_name(false);
    check_password();
    check_password_confirm();
    check_phone();
    if (email_check && nick_name_check && password_check &&
        password_confirm_check && phone_check) {
        var password = document.getElementById('password').value;
        document.getElementById('password').value = CryptoJS.MD5(password);
        var password2 = document.getElementById('password2').value;
        document.getElementById('password2').value = CryptoJS.MD5(password2);
        return true;
    }
    return false;
}

function check_email(sync) {
    email_check = false;
    var unique_check = false;
    var email_text = document.getElementById("email").value;
    if (email_text.length <= 0 || email_text.trim() == 0) {
        // 显示错误信息
        alert("邮箱不能为空或全为空格！");
        return;
    }
    var reg = new RegExp("(([a-zA-Z]?[0-9]+)|([a-zA-Z]+[0-9]?))@([a-zA-z0-9]{1,}.){1,3}[a-zA-z]{1,}");
    if (!reg.test(email_text)) {
        // 显示错误提示
        alert("邮箱格式错误！");
        return;
    }
    $.ajax({
        url: root + "separated_info / register_info_check / email",
        type: 'POST',
        async: sync == undefined,
        data: {
            '_email': email_text
        }
        ,
        success: function (info) {
            if (info == "true")
                unique_check = true;
            else {
                // 显示错误提示
                alert("该邮箱已注册，请登录！");
            }
        }
    })
    ;
    if (unique_check) {
        // 错误信息置为空
        email_check = true;
    }
}

function check_nick_name(sync) {
    nick_name_check = false;
    var unique_check = false;
    var nickname_text = document.getElementById("nickname").value;
    if (nickname_text.length <= 0 || nickname_text.trim() == 0) {
        //显示错误信息
        alert("昵称不能为空或全为空格！");
        return;
    }
    $.ajax({
        url: root + "separated_info / register_info_check / nickname",
        type: 'POST',
        async: sync == undefined,
        data: {
            '_nickName': nickname_text
        }
        ,
        success: function (info) {
            if (info == "true")
                unique_check = true;
            else {
                // 显示错误提示
                alert("昵称已被使用！");
            }
        }
    })
    ;
    if (unique_check) {
        // 错误信息置为空
        nick_name_check = true;
    }
}

function check_password() {
    password_check = false;
    var password = document.getElementById("password").value;
    if (password.length <= 0) {
        // 显示错误信息
        alert("密码不能为空！");
        return;
    } else if (password.length < 6) {
        // 显示错误信息
        alert("密码长度至少6位！");
        return;
    }
    password_check = true;
}

function check_password_confirm() {
    password_confirm_check = false;
    var password2 = document.getElementById("password2").value;
    var password = document.getElementById("password").value;
    if (password2.length <= 0) {
        // 显示错误信息
        alert("请确认密码！");
    } else if (password2 != password) {
        // 显示错误信息
        alert("两次密码不匹配！");
    } else if (password2 == password) {
        // 清空错误信息
        password_confirm_check = true;
    }
}

function check_phone() {
    phone_check = false;
    var phone_number = document.getElementById("phone_number").value;
    if (phone_number.length == 11) {
        var reg = new RegExp("[0-9]{11}");
        if (reg.test(phone_number) != true) {
            // 显示错误消息
            alert("手机号格式错误，请输入11位手机号！");
            return;
        }
    } else {
        // 显示错误消息
        alert("请输入11位手机号！");
        return;
    }
    // 清空错误信息
    phone_check = true;
}
