<div id="container">

    <?php echo form_open("register/", array('id' => 'register_form')); ?>
    <fieldset>
        <h3>用户注册</h3>
        <ul>
            <li>
                <label for="email" class="title">邮箱：</label>
                <input type="email" id="email" name="_email" placeholder="请输入邮箱" autocomplete="off"
                       value="<?php echo set_value("_email"); ?>">
                <?php echo form_error('_email', '<span>', '</span>'); ?>
            </li>
            <li>
                <label for="nickname" class="title">昵称：</label>
                <input type="text" id="nickname" name="_nickName" placeholder="请输入昵称"
                       value="<?php echo set_value("_nickName"); ?>">
                <?php echo form_error('_nickName', '<span>', '</span>'); ?>
            </li>
            <li>
                <label for="password" class="title">密码：</label>
                <input type="password" id="password" name="_password" placeholder="请输入密码"
                       value="<?php echo set_value("_password"); ?>">
                <?php echo form_error('_password', '<span>', '</span>'); ?>
            </li>
            <li>
                <label for="password2" class="title">确认密码：</label>
                <input type="password" id="password2" name="_password2" placeholder="请再次输入密码"
                       value="<?php echo set_value("_password"); ?>">
                <?php echo form_error('_password2', '<span>', '</span>'); ?>
            </li>
            <li>
                <label for="phone_number" class="title">手机号：</label>
                <input type="tel" id="phone_number" name="_phoneNumber"
                       value="<?php echo set_value("_phoneNumber"); ?>" placeholder="请输入手机号">
                <?php echo form_error('_phoneNumber', '<span>', '</span>'); ?>
            </li>
        </ul>

        <p class="button">
            <input type="submit" id="sign_up" value="注册">
        </p>

        <p class="words">已有账号？<a href="<?php echo site_url('login'); ?>">请登录</a></p>
    </fieldset>

    </form>
</div>
<script type="text/javascript">
    document.getElementById("email").onblur = function () {
        var required_check = false;
        var reg_check = false;
        var unique_check = false;
        var email_text = this.value;
        if (email_text.length <= 0) {
            // 显示错误信息
            return;
        }
        required_check = true;
        var reg = new RegExp("(([a-zA-Z]?[0-9]+)|([a-zA-Z]+[0-9]?))@([a-zA-z0-9]{1,}.){1,3}[a-zA-z]{1,}");
        if (reg.test(email_text)) {
            reg_check = true;
        } else {
            // 显示错误提示
            return;
        }
        $.ajax({
            url: '<?php echo site_url('separated_info/register_info_check/email'); ?>',
            type: 'POST',
            data: {'_email': email_text},
            success: function (info) {
                if (info == "true")
                    unique_check = true;
                else {
                    // 显示错误提示
                }
            }
        });
        if (reg_check && unique_check && required_check) {
            // 错误信息置为空
        }
    };
    document.getElementById("nickname").onblur = function () {
        var required_check = false;
        var unique_check = false;
        var nickname_text = this.value;
        if (nickname_text.length <= 0) {
            //显示错误信息
            return;
        }
        required_check = true;
        $.ajax({
            url: '<?php echo site_url('separated_info/register_info_check/nickname'); ?>',
            type: 'POST',
            data: {'_nickName': nickname_text},
            success: function (info) {
                if (info == "true")
                    unique_check = true;
                else {
                    // 显示错误提示
                }
            }
        });
        if (required_check && unique_check) {
            // 错误信息置为空
        }
    };
    document.getElementById("password").onblur = function () {
        var password = this.value;
        if (password.length <= 0) {
            // 显示错误信息
            return;
        } else if (password.length <= 6) {
            // 显示错误信息
            return;
        }
    }
    document.getElementById("password2").onblur = function () {
        var password2 = this.value;
        var password = document.getElementById("password").value;
        if (password2.length <= 0) {
            // 显示错误信息
            return;
        } else if (password2 != password) {
            // 显示错误信息
            return;
        } else if (password2 == password) {
            // 显示错误信息
            return;
        }

    };
    document.getElementById("phone_number").onblur = function () {
        var phone_number = this.value;
        if (phone_number.length == 11) {
            var reg = new RegExp("[0-9]{11}");
            if (reg.test(phone_number) != true) {
                // 显示错误消息
                return;
            }
        } else {
            // 显示错误消息
            return;
        }
    };
</script>