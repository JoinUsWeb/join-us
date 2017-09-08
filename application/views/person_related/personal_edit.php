<div class="personal_data personal_hd">
    <nav class="personal_hd_nav">
        <ul>
            <li class="special"><a href="#edit">基本信息<span class="pipe">|</span></a></li>
            <li><a href="#password">密码安全<span class="pipe">|</span></a></li>
            <li><a href="#personal_img">修改头像</a></li>
        </ul>
    </nav>
    <div class="">
        <section id="edit">
            <?php echo form_open(site_url('separated_info/change_user_info/0'), array('id' => 'personal_edit')); ?>
            <ul>
                <li>
                    <label for="nickname" class="title">昵称：</label>
                    <input type="text" id="nickname" name="nickname" placeholder="请输入昵称">
                </li>
                <li>
                    <label for="phone_number" class="title">手机号：</label>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="请输入手机号码"><br>
                </li>
                <li>
                    <label for="personal_jj" class="title">个人简介：</label>
                    <textarea name="personal_jj" id="personal_jj" style="resize:none" placeholder="（不超过50字）"></textarea>
                </li>
            </ul>
            <p id="p_publish">
                <input type="submit" value="确认修改">
            </p>

            </form>
        </section>
        <section id="password">
            <?php echo form_open(site_url('separated_info/change_user_info/1'), array('id' => 'personal_edit')); ?>
            <ul>
                <li>
                    <label for="password" class="title">密码：</label>
                    <input type="password" id="_password" name="password" placeholder="请输入密码" value=""><br>
                </li>
                <li>
                    <label for="password2" class="title">确认密码：</label>
                    <input type="password" id="password2" name="password2" placeholder="请再次输入密码" value=""
                           onchange="confirm_password()">
                    <br>
                    <span id="confirm_error"></span>
                </li>
            </ul>
            <p id="p_publish">
                <input type="submit" value="确认修改" onclick="pwdEncode()">
            </p>

            </form>
        </section>
        <section id="personal_img">
            <?php echo form_open(site_url('separated_info/change_user_info/2'), array('id' => 'personal_edit')); ?>
            <ul>
                <li>
                    <label for="personal_img" class="title">个人头像：</label>
                    <div id="personal_img">
                        <img src="<?php echo base_url($user_info['avatar']); ?>" alt="这是一张海报">
                    </div>
                    <div id="create_button">
                        <input type="file" id="personal_img" name="personal_img">
                    </div>
                </li>
            </ul>
            <p id="p_publish">
                <input type="submit" value="确认修改">
            </p>

            </form>
        </section>
    </div>
</div>
</div>

<!--<script type="text/javascript">
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
                        url: '<?php /*echo site_url('separated_info/register_info_check/nickname'); */ ?>',
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
                    var brief = document.getElementById("personal_jj").value;
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
            </script>-->

<script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/core-min.js"></script>
<script src="https://cdn.bootcss.com/crypto-js/3.1.2/components/md5-min.js"></script>
<script type="text/javascript">
    /*把相应section的id和用户点击的导航栏href值比较，改变各个section的display属性*/
    function showSection(id) {
        var sections = document.getElementsByTagName("section");
        for (var i = 0; i < sections.length; i++) {
            if (sections[i].getAttribute("id") != id) {
                sections[i].style.display = "none";
            } else {
                sections[i].style.display = "block";
            }
        }
    }

    /*把导航栏href和用户点击href比较，改变相应元素的父元素的className*/
    function changeColor(id) {
        var navs = document.getElementsByTagName("nav");
        var links = navs[1].getElementsByTagName("a");
        for (var i = 0; i < links.length; i++) {
            var sectionId = links[i].getAttribute("href").split("#")[1];
            if (sectionId == id) {
                links[i].parentNode.className = "special";
            } else {
                links[i].parentNode.className = "";
            }
        }
    }

    function getId() {
        var navs = document.getElementsByTagName("nav");
        var links = navs[1].getElementsByTagName("a");
        for (var i = 0; i < links.length; i++) {
            //获取导航栏的href值
            var secId = links[i].getAttribute("href").split("#")[1];
            if (!document.getElementById(secId)) continue;
            //设置最初的演示
            document.getElementById(secId).style.display = "none";
            document.getElementById("edit").style.display = "block";
            /*这里存在作用域问题，secId是个局部变量，它在getId函数执行期间存在，
             到时间处理函数执行的时候就不存在了，故在这里为每个链接创建了一个自定义的属性destination*/
            links[i].destination = secId;
            links[i].onclick = function () {
                showSection(this.destination);
                changeColor(this.destination);
                return false;
            }

        }
        ;
    }

    window.onload = function () {
        getId();
    }

    function pwdEncode() {
        var password = document.getElementById('_password').value;
        document.getElementById('_password').value = CryptoJS.MD5(password);
        var password2 = document.getElementById('password2').value;
        document.getElementById('password2').value = CryptoJS.MD5(password2);
        return true;
    }

</script>

