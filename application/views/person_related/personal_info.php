<div style="height: 72px;"></div>
<!--个人中心导航栏-->
<div class="personal_nav">
    <div class="personal_title">
        <li><a class="thisover" href="<?php echo site_url('user/info'); ?>"><span>个人信息</span></a></li>
    </div>
    <div class="personal_title">
        <li><a class="thisover" href="<?php echo site_url('user/applied'); ?>"><span>我参加的活动</span></a></li>
    </div>
    <div class="personal_title">
        <li><a class="thisover" href="<?php echo site_url('user/joined'); ?>"><span>我报名的活动</span></a></li>
    </div>
    <div class="personal_title">
        <li><a class="thisover" href="<?php echo site_url('user/favorites'); ?>"><span>收藏活动</span></a></li>
    </div>
    <div class="personal_title">
        <li><a class="thisover" href="<?php echo site_url('user/comments'); ?>"><span>评论活动</span></a></li>
    </div>
</div>
<!--个人中心导航栏-->
<!--个人中心主页-->
<div class="personal_main">
    <div class="personal-data">
        <div class="head_portrait" align="center">
            <img alt="用户昵称" src="../img/IMG_1035.JPG" width="150px" height="150px" style="border-radius:50%;">
        </div>
        <div class="p_data">
            <ul>
                <li>邮箱:<div class="p_present"><?php echo $user_info['email']; ?></div></li>
                <li>昵称:<div class="p_present"><?php echo $user_info['nick_name']; ?></div></li>
            </ul>
        </div>
        <div class="p_data">
            <ul>
                <li>所在地区:<div class="p_present">上海</div></li>
                <li><i class="icon-camera-retro"></i>个人介绍:<div class="p_present">大脚好！</div></li>
            </ul>
        </div>
        <div class="p_data">
            <ul>
                <li>兴趣标签:
            <?php foreach ($user_info['interest'] as $single_interest): ?>
            <div class="p_present" style="display:block"><?php echo $single_interest['name']; ?></div>
        <?php endforeach; ?>
        </li>
        </ul>
    </div>
</div>
</div>
<!--个人中心主页-->


<div class="Clear"><!-- 清除浮动 --></div>