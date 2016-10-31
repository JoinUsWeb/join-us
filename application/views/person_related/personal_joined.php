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
        <div class="personal-data personal_main">
            <h3>
                <div class="dr-icon dr-icon-camera"> 已参加活动</div>
            </h3>
            <hr>
            <?php if (count($activities_info) != 0) : ?>
                <?php foreach ($activities_info as $single_activity): ?>
                    <!-- 应该考虑加入对进行筛选活动，例如根据活动时间，否则数据太多，显示有困难 -->
                    <div class="hd_present">
                        <div>
                            <a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><img
                                    src="<?php echo $single_activity['poster']; ?>" alt="nihao" class="hd_img"></a>
                            <div>
                                <a class="#"
                                   href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>">
                                    <span class="hd_title"><?php echo $single_activity['name']; ?></span>
                                </a>
                                <hr>
                                <div class="hd_details"><i
                                        class="icon-time icon-large"></i><?php echo $single_activity['date_expire'], " ", $single_activity['time_expire']; ?>
                                </div>
                                <div class="hd_details"><i
                                        class="icon-map-marker icon-large"></i><?php echo $single_activity['place']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            else : ?>
                <span>你还没有参加任何活动！</span>
            <?php endif; ?>
        </div>
        <div style="clear:both"></div>
    </div>
    <!--个人中心主页-->
    <!-- /container -->
    <script src="<?php echo base_url("js/ytmenu.js") ?>"></script>

    <div class="Clear"><!-- 清除浮动 --></div>
</div>
