<div id="container">

    <?php echo form_open("login/", array('id' => 'login_form')); ?>
    <fieldset>
        <h3>登录</h3>
        <ul>
            <li>
                <label for="email" class="title">邮箱：</label>
                <input type="email" id="email" name="_email" placeholder="请输入邮箱"
                       value="">
                <?php echo form_error('_email', '<span>', '</span>') ?>
            </li>
            <li>
                <label for="password" class="title">密码：</label>
                <input type="password"  id="password" name="_password" placeholder="请输入密码"
                       value=""">
                <?php echo form_error('_password', '<span>', '</span>') ?>
            </li>
        </ul>

        <p class="button">
            <input type="submit" id="login_button" value="登录" onclick="encrypt();">
        </p>

        <p class="words">还没有账号？<a href="<?php echo site_url('register'); ?>">免费注册</a></p>
    </fieldset>

    </form>
</div>
<script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/core-min.js"></script>
<script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/md5-min.js"></script>
<script type="text/javascript">
    function encrypt() {
        var doc = document;
        var password = doc.getElementById('password').value;
        document.getElementById('password').value =  CryptoJS.MD5(password);
    }
    document.getElementById("email").onblur = function () {
        var required_check = false;
        var reg_check = false;
        var unique_check = false;
        var email_text = this.value;
        if (email_text.length <= 0 || email_text.trim() == 0) {
            // 显示错误信息
            alert("邮箱不能为空或全为空格！");
            return;
        }
        required_check = true;
        var reg = new RegExp("(([a-zA-Z]?[0-9]+)|([a-zA-Z]+[0-9]?))@([a-zA-z0-9]{1,}.){1,3}[a-zA-z]{1,}");
        if (reg.test(email_text)) {
            reg_check = true;
        } else {
            // 显示错误提示
            alert("邮箱格式错误！");
            return;
        }
        if (reg_check && required_check) {
            // 错误信息置为空
        }
    };
    document.getElementById("password").onblur = function () {
        var required_check = false;
        var password = this.value;
        if (password.length <= 0) {
            // 显示错误信息
            alert("请输入密码！");
            return;
        }
        required_check = true;
        if (required_check) {
            // 错误信息置为空
        }
    };
</script>