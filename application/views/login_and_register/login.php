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
<script type="text/javascript" src="<?php echo base_url("js/form_validation/login.js")?>"></script>