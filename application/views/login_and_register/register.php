<div id="container">

    <?php echo form_open("register/", array('id' => 'register_form')); ?>
    <fieldset>
        <h3>用户注册</h3>
        <ul>
            <li>
                <label for="email" class="title">邮箱：</label>
                <input type="email" id="email" name="_email" placeholder="请输入邮箱" autocomplete="off"
                       value="<?php echo set_value("_email"); ?>" onblur="check_email()" required>
                <br>
                <div id="email_error"><?php echo form_error('_email'); ?></div>
            </li>
            <li>
                <label for="nickname" class="title">昵称：</label>
                <input type="text" id="nickname" name="_nickName" placeholder="请输入昵称"
                       value="<?php echo set_value("_nickName"); ?>" onblur="check_nick_name()" required>
                <br>
                <div id="nickname_error"><?php echo form_error('_nickName'); ?></div>

            </li>
            <li>
                <label for="password" class="title">密码：</label>
                <input type="password" id="password" name="_password" placeholder="请输入密码"
                       value="<?php echo set_value("_password"); ?>" onblur="check_password()" required>
                <br>
                <div id="psd_error"><?php echo form_error('_password'); ?></div>

            </li>
            <li>
                <label for="password2" class="title">确认密码：</label>
                <input type="password" id="password2" name="_password2" placeholder="请再次输入密码"
                       value="<?php echo set_value("_password"); ?>" onblur="check_password_confirm()" required>
                <br>
                <div id="confirm_error"><?php echo form_error('_password2'); ?></div>

            </li>
            <li>
                <label for="phone_number" class="title">手机号：</label>
                <input type="tel" id="phone_number" name="_phoneNumber"
                       value="<?php echo set_value("_phoneNumber"); ?>" onblur="check_phone()"
                       placeholder="请输入手机号" required>
                <br>
                <div id="number_error"><?php echo form_error('_phoneNumber'); ?></div>

            </li>
        </ul>

        <p class="button">
            <input type="submit" id="sign_up" value="注册" onclick="return check()">
        </p>

        <p class="words">已有账号？<a href="<?php echo site_url('login'); ?>">请登录</a></p>
    </fieldset>

    </form>

    <script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/core-min.js"></script>
    <script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/md5-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url("js/form_validation/register.js") ?>"></script>
    <script type="text/javascript">
        getRoot("<?php echo site_url(); ?>");
    </script>
</div>