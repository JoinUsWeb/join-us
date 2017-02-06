<!--个人中心导航栏-->
<div class="container">
    <script src="/adsense.js" type="text/javascript"></script>
    <div class="main">
        <div class="side">
            <?php echo $nav; ?>
        </div>
        <!--个人中心导航栏-->
        <!--个人中心主页-->
        <div class="personal_main personal-data">
            <h3><div class="dr-icon dr-icon-settings"> 我的小组</div></h3>
            <hr>
            <div class="hd_present">
                <div>
                    <a href="<?php echo site_url("user/detail") ?>"><img src="<?php echo base_url("img/paobu.jpg") ?>" alt="nihao" class="hd_img"></a>
                    <div>
                        <a class="#" href="<?php echo site_url("user/detail") ?>">
                            <span class="hd_title">华师大第二届创新创业大赛</span>
                        </a>
                        <hr>
                        <div class="hd_details"><i class="icon-tag icon-large"></i>兴趣标签：<span>运动健身</span></div>
                        <div class="hd_details"><i class="icon-user-md icon-large"></i>小组组长：<span>用户1</span></div>

                    </div>
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

