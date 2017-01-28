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
                <input type="password" id="password" name="_password" placeholder="请输入密码"
                       value="">
                <?php echo form_error('_password', '<span>', '</span>') ?>
            </li>
        </ul>

        <p class="button">
            <input type="button" id="login_button" value="登录" onclick="encrypt();">
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
        var url = doc.getElementById('login_form').action;
        $.post(url, {
                _email: doc.getElementById('email').value,
                _password: password
            }
        );
//        doc.getElementById('login_button').setAttribute('type','submit');
//        doc.getElementById('login_button').click();
    }
</script>