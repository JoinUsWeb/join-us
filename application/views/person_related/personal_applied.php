<!--个人中心导航栏-->
<div class="container">
    <script src="/adsense.js" type="text/javascript"></script>
    <div class="main">
        <div class="side">
            <?php echo $nav; ?>
        </div>
        <!--个人中心导航栏-->
        <!--个人中心主页-->
        <div class="personal-data personal_main">
            <h3>
                <div class="dr-icon dr-icon-heart"> 已报名活动</div>
            </h3>
            <hr>
            <?php if (count($activities_info) != 0) : ?>
                <?php foreach ($activities_info as $single_activity): ?>
                    <!-- 应该考虑加入对进行筛选活动，例如根据活动时间，否则数据太多，显示有困难 -->
                    <div class="hd_present">
                        <div>
                            <a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><img
                                    src="<?php echo base_url($single_activity['poster']); ?>" alt="nihao" class="hd_img"></a>
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
                                <div class="rating">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            else : ?>
                <span>你还没有报名任何活动！</span>
            <?php endif; ?>
        </div>
        <div style="clear:both"></div>
    </div>
    <!--个人中心主页-->
    <!-- /container -->
    <script src="<?php echo base_url("js/ytmenu.js") ?>"></script>


    <div class="Clear"><!-- 清除浮动 --></div>
</div>