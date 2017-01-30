<div id="container">

    <?php echo form_open("login/", array('id' => 'login_form')); ?>
    <fieldset>
        <h3>登录</h3>
        <ul>
            <li>
                <label for="email" class="title">邮箱：</label>
                <input type="email" id="email" name="_email" placeholder="请输入邮箱"
                       value="" onblur="check_email()" required>
                <?php echo form_error('_email', '<span>', '</span>') ?>
            </li>
            <li>
                <label for="password" class="title">密码：</label>
                <input type="password" id="password" name="_password" placeholder="请输入密码"
                       value="" onblur="check_password()" required>
                <?php echo form_error('_password', '<span>', '</span>') ?>
            </li>
        </ul>

        <p class="button">
            <input type="submit" id="login_button" value="登录" onclick="return check();">
        </p>

        <p class="words">还没有账号？<a href="<?php echo site_url('register'); ?>">免费注册</a></p>
    </fieldset>

    </form>
</div>
<script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/core-min.js"></script>
<script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/md5-min.js"></script>
<script type="text/javascript">
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
</script>