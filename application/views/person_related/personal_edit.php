<div class="container">
    <?php echo form_open('user/edit', array('id' => "create_hd")); ?>
    <ul>
        <li>
            <label for="email" class="label_style">账号：</label>
            <input type="text" value="<?php echo $user_info['email']; ?>" disabled="disabled" id="email"
                   style="background-color:transparent;border: 0;color:white">
        </li>
        <li>
            <label for="nickname" class="label_style">昵称：</label>
            <input type="text" id="nickname" name="nick_name" value="<?php echo $user_info['nick_name']; ?>">
            <?php echo form_error('nick_name', '<span>', '</span>'); ?>
        </li>
        <li>
            <label for="password" class="title">密码：</label>
            <input type="password" id="password" name="password" placeholder="请输入密码"><br>
            <?php echo form_error('password2', '<span>', '</span>'); ?>
        </li>
        <li>
            <label for="password2" class="title">确认密码：</label>
            <input type="password" id="password2" name="password2" placeholder="请再次输入密码"
                   onchange="confirm_password()">
            <br>
            <span id="confirm_error"></span>
        </li>
        <li>
            <label for="phone_number" class="title">手机号：</label>
            <input type="tel" id="phone_number" name="phone_number"
                   value="<?php echo $user_info['phone_number']; ?>">
            <?php echo form_error('phone_number', '<span>', '</span>'); ?>
        </li>
        <li>
            <label for="personal_img" class="label_style">个人头像：</label>
            <div id="personal_img">
                <img src="<?php echo base_url($user_info['avatar']); ?>" alt="这是一张海报">
            </div>
            <div id="create_button">
                <input type="file" id="personal_img" name="personal_img">
            </div>
        </li>
        <li>
            <label for="personal_jj" class="label_style">个人简介：</label>
            <textarea name="personal_jj" id="personal_jj" style="resize:none" placeholder="（不超过50字）"></textarea>
        </li>
    </ul>
    <p id="publish">
        <input type="submit" value="确认修改">
    </p>

    </form>
</div>
<script type="text/javascript">
    var nick_name_check = false, password_check = false,
        password_confirm_check = false, phone_check = false;
    function check() {
        check_nick_name(false);
        check_password();
        check_password_confirm();
        check_phone();
        if (nick_name_check && password_check &&
            password_confirm_check && phone_check) {
            var password = document.getElementById('password').value;
            document.getElementById('password').value = CryptoJS.MD5(password);
            var password2 = document.getElementById('password2').value;
            document.getElementById('password2').value = CryptoJS.MD5(password2);
            return true;
        }
        return false;
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
            url: '<?php echo site_url('separated_info/register_info_check/nickname'); ?>',
            type: 'POST',
            async: sync == undefined,
            data: {'_nickName': nickname_text},
            success: function (info) {
                if (info == "true")
                    unique_check = true;
                else {
                    // 显示错误提示
                    alert("昵称已被使用！");
                }
            }
        });
        if (unique_check) {
            // 错误信息置为空
            nick_name_check = true;
        }
    }
    function check_password() {
        password_check = false;
        var password = document.getElementById("password").value;
        if (password.length == 0) {
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
        if (password2.length == 0) {
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
    function check_brief() {
        var brief = document.("personal_jj").value;
        brief_check = false;
        if (brief.length != 0) {
            if (brief.length > 50) {
                // 显示错误信息
                alert("个人简历最多50字！");
                document.("personal_jj").value = brief.substring(0, 50);
                return;
            }
        }
        // 清空错误信息
        brief_check = true;
    }
</script>