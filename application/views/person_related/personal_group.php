<!--个人中心导航栏-->
<div class="container">
    <script src="/adsense.js" type="text/javascript"></script>
    <div class="main">
        <div class="side">
            <nav class="dr-menu">
                <div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">我的主页</a></div>
                <ul>
                    <li><a class="dr-icon dr-icon-user" href="<?php echo site_url('user/info'); ?>">个人信息</a></li>
                    <li><a class="dr-icon dr-icon-camera" href="<?php echo site_url('user/joined'); ?>">已参加活动</a></li>
                    <li><a class="dr-icon dr-icon-heart" href="<?php echo site_url('user/applied'); ?>">已报名活动</a></li>
                    <li><a class="dr-icon dr-icon-bullhorn" href="<?php echo site_url('user/comments'); ?>">评价活动</a>
                    </li>
                    <li><a class="dr-icon dr-icon-download"
                           href="<?php echo site_url('message/personal_mymessages'); ?>">我的消息</a></li>
                    <li><a class="dr-icon dr-icon-settings" href="<?php echo site_url('user/group'); ?>">我的小组</a></li>
                    <li><a class="dr-icon dr-icon-switch" href="#">退出登录</a></li>
                </ul>
            </nav>

        </div>
        <!--个人中心导航栏-->
        <!--个人中心主页-->
        <div class="personal_main">
            <h3><div class="dr-icon dr-icon-settings"> 我的小组</div></h3>
            <hr>
            <div class="hd_present">
                <div>
                    <a href="<?php echo site_url("user/detail") ?>"><img src="<?php echo base_url("img/400X200.gif") ?>" alt="nihao" class="hd_img"></a>
                    <div>
                        <a class="#" href="<?php echo site_url("user/detail") ?>">
                            <span class="hd_title">华师大第二届创新创业大赛</span>
                        </a>
                        <hr>
                        <div class="hd_details"><i class="icon-tag icon-large"></i>兴趣标签：<span>经济学</span></div>
                        <div class="hd_details"><i class="icon-user-md icon-large"></i>小组组长：<span>无说明</span></div>

                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    <!--个人中心主页-->
    <!-- /container -->
    <script src="<?php echo base_url("js/ytmenu.js") ?>"></script>

    <div class="Clear"><!-- 清除浮动 --></div>
</div>

