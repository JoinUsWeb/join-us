<div style="height: 72px;"></div>
<div id="container">

    <?php echo form_open("login/"); ?>
    <fieldset>
        <h3>登录</h3>
        <ul>
            <li>
                <label for="email" class="title">邮箱：</label>
                <input type="email" id="email" name="_email" placeholder="请输入邮箱"
                       value="<?php echo set_value("_email"); ?>">
                <?php echo form_error('_email', '<span>', '</span>') ?>
            </li>
            <li>
                <label for="password" class="title">密码：</label>
                <input type="password" id="password" name="_password" placeholder="请输入密码"
                       value="<?php echo set_value("_password"); ?>">
                <?php echo form_error('_password','<span>','</span>')?>
            </li>
        </ul>

        <p class="button">
            <input type="submit" id="login_button" value="登录">
        </p>

        <p class="words">还没有账号？<a href="<?php echo site_url('register'); ?>">免费注册</a></p>
    </fieldset>

    </form>
</div>