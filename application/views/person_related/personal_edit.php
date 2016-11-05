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
            <input type="password" id="password" name="_password" placeholder="请输入密码"><br>
            <?php echo form_error('_password2', '<span>', '</span>'); ?>
        </li>
        <li>
            <label for="password2" class="title">确认密码：</label>
            <input type="password" id="password2" name="_password2" placeholder="请再次输入密码"
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