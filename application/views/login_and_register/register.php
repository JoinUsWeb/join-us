<div id="container">

    <?php echo form_open("register/"); ?>
    <fieldset>
        <h3>用户注册</h3>
        <ul>
            <li>
                <label for="email" class="title">邮箱：</label>
                <input type="email" id="email" name="_email" placeholder="请输入邮箱" autocomplete="off"
                       value="<?php echo set_value("_email"); ?>">
                <?php echo form_error('_email', '<span>', '</span>') ?>
            </li>
            <li>
                <label for="nickname" class="title">昵称：</label>
                <input type="text" id="nickname" name="_nickName" placeholder="请输入昵称"
                       value="<?php echo set_value("_nickName"); ?>">
                <?php echo form_error('_nickName', '<span>', '</span>') ?>
            </li>
            <li>
                <label for="password" class="title">密码：</label>
                <input type="password" id="password" name="_password" placeholder="请输入密码"
                       value="<?php echo set_value("_password"); ?>">
                <?php echo form_error('_password', '<span>', '</span>') ?>
            </li>
            <li>
                <label for="password2" class="title">确认密码：</label>
                <input type="password" id="password2" name="_password2" placeholder="请再次输入密码"
                       value="<?php echo set_value("_password"); ?>">
                <?php echo form_error('_password2', '<span>', '</span>') ?>
            </li>
            <li>
                <label for="phone_number" class="title">手机号：</label>
                <input type="tel" id="phone_number" name="_phoneNumber"
                       value="<?php echo set_value("_phoneNumber"); ?>">
                <?php echo form_error('_phoneNumber', '<span>', '</span>') ?>
            </li>
        </ul>

        <p class="button">
            <input type="submit" id="sign_up" value="注册">
        </p>

        <p class="words">已有账号？<a href="<?php echo site_url('login'); ?>">请登录</a></p>
    </fieldset>

    </form>
</div>