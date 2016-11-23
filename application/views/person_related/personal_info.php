<!--个人中心导航栏-->
<div class="container">
    <div class="main">
        <div class="side">
            <?php echo $nav; ?>
        </div>
        <!--个人中心导航栏-->
        <!--个人中心主页-->
        <div>
            <div class="personal-data personal_main">
                <h3>
                    <div class="dr-icon dr-icon-user">个人信息</div>
                </h3>
                <hr>
                <div class="head_portrait" align="center">
                    <img alt="用户头像" src="<?php echo base_url($user_info['avatar']); ?>" width="150px" height="150px"
                         style="border-radius:50%;">
                </div>
                <div class="p_data">
                    <ul>
                        <li><i class=" icon-user-md"></i>账号:
                            <div class="p_present"><?php echo $user_info['email']; ?></div>
                        </li>
                        <li><i class="icon-info-sign"></i>昵称:
                            <div class="p_present"><?php echo $user_info['nick_name']; ?></div>
                        </li>
                    </ul>
                </div>
                <div class="p_data">
                    <ul>
                        <li><i class=" icon-map-marker"></i>所在地区:
                            <div class="p_present">上海</div>
                        </li>
                        <li><i class=" icon-bookmark"></i>个人介绍:
                            <div class="p_present">这个人好烂，还没写个人介绍！</div>
                        </li>
                    </ul>
                </div>
                <div class="p_data">
                    <ul>
                        <li><i class=" icon-tags"></i>兴趣标签:
                            <div style="clear:both"></div>
                            <?php foreach ($user_info['interest'] as $single_interest): ?>
                                <div class="p_tag" style="display:block"><?php echo $single_interest['name']; ?></div>
                            <?php endforeach; ?>
                        </li>
                        <li><a href="<?php echo site_url('user/edit'); ?>"><i class="icon-pencil"></i>编辑个人信息</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div style="clear:both"></div>
    </div>
    <!--个人中心主页-->
    <!-- /container -->
    <!--<script src="<?php echo base_url("js/ytmenu.js") ?>"></script>-->

    <div class="Clear"><!-- 清除浮动 --></div>
</div>
