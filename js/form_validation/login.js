/**
 * Created by zhang on 2017/2/12.
 */
var email_check = false, password_check = false;
function check() {
    check_email();
    check_password();
    if (email_check && password_check) {
        var password = document.getElementById('password').value;
        document.getElementById('password').value = CryptoJS.MD5(password);
        return true;
    }
    return false;
}
function check_email() {
    email_check = false;
    var email_text = document.getElementById('email').value;
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
    // 错误信息置为空
    email_check = true;
}
function check_password() {
    password_check = false;
    var password = document.getElementById('password').value;
    if (password.length <= 0) {
        // 显示错误信息
        alert("请输入密码！");
        return;
    }
    // 错误信息置为空
    password_check = true;
}