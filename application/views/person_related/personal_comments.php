<div class="personal_data personal_hd">
    <div class="personal_hd_nav">
        <ul>
            <li></li>
            <li><a href="<?php site_url('joined/1'); ?>">创建活动<span class="pipe">|</span></a></li>
            <li><a class="hd_a" href="<?php site_url('joined/4'); ?>">参与活动<span class="pipe">|</span></a></li>
            <li><a href="<?php site_url('joined/2'); ?>">评价活动<span class="pipe">|</span></a></li>
            <li><a href="<?php site_url('joined/3'); ?>">收藏活动</a></li>
        </ul>
    </div>
    <div class="personal_hd_joined">
        <?php if (count($activities_info) != 0) : ?>
        <?php foreach ($activities_info as $single_activity): ?>
        <!-- 应该考虑加入对进行筛选活动，例如根据活动时间，否则数据太多，显示有困难 -->
        <div class="p_hd_main">
            <div class="hd_img">
                <a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><img alt="活动名称" src="<?php echo base_url($single_activity['poster']); ?>"></a>
            </div>
            <div class="p_hd_present">
                <div class="p_hd_title"><a class="thisover" href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><span><?php echo $single_activity['name']; ?></span></a></div>
                <div class="p_hd_details"><i class="icon-time"></i><?php echo $single_activity['apply_expire']; ?></div>
                <div class="p_hd_details"><i class="icon-map-marker"></i><?php echo $single_activity['place']; ?></div>
                <div class="p_hd_bd"><a class="thisover" href="../html/details_page.html">（活动简介大约100字左右）我们在用户注册时提供一级兴趣选择（一级兴趣包括：娱乐、体育、科技、美食、军事、历史、社会、旅游、影视、其他等，一级兴趣下再细化二级兴趣），多级区域选择，及其所处年龄层等信息。根据以上用户数据收集，推荐其喜好的活动。在推荐活动时，优先考虑二级兴趣标签及所在区域......</a></div>
            </div>
        </div>
            <?php endforeach;
        else : ?>
            <span>你没有需要评价的活动！</span>
        <?php endif; ?>

    </div>
</div>
</div>

<!--<div class="sidebar">-->
<div class="col-lg-2 col-md-2 col-md-offset-0 col-lg-offset-0">
    <div class="personal_height"></div>
    <div class="personalbar">
        <div class="personal_wall">
            <div class="personal_recent_hd">
                <p>—近期参加活动—</p>
            </div>

            <div class="pr_hd_content">
                <div class="content_li">
                    <div class="li_left">
                        <a href="details_page.html" ><img src="../img/adobe.png" alt="" width="60px" height="60px"></a>
                    </div>
                    <div class="li_right">
                        <a class="li_right_title" href="details_page.html"><h5>校运会</h5></a>
                        <p>2016-11-2 9:00</p>
                    </div>
                </div>
            </div>
            <div class="pr_hd_content">
                <div class="content_li">
                    <div class="li_left">
                        <a href="details_page.html" ><img src="../img/adobe.png" alt="" width="60px" height="60px"></a>
                    </div>
                    <div class="li_right">
                        <a class="li_right_title" href="details_page.html"><h5>校运会</h5></a>
                        <p>2016-11-2 9:00</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="personal_wall">

            <div class="personal_recent_member">
                <p>—近期小组成员—</p>
            </div>

            <div class="pr_hd_content">
                <div class="content_li">
                    <div class="li_left">
                        <a href="personal.html" ><img src="../img/huaban.jpg" alt="" width="60px" height="60px"></a>
                    </div>
                    <div class="li_right">
                        <a class="li_right_title" href="details_page.html"><h5>飞翔的企鹅</h5></a>
                        <p>小组名称或活动名称</p>
                    </div>
                </div>
            </div>
            <div class="pr_hd_content">
                <div class="content_li">
                    <div class="li_left">
                        <a href="personal.html" ><img src="../img/huaban.jpg" alt="" width="60px" height="60px"></a>
                    </div>
                    <div class="li_right">
                        <a class="li_right_title" href="details_page.html"><h5>飞翔的企鹅</h5></a>
                        <p>小组名称或活动名称</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>


</div>

<div class="Clear"><!-- 清除浮动 --></div>
<hr>

<footer class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Copyright © JoinUs Web. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/jquery-3.1.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/stickUp.min.js"></script>
<script type="text/javascript">
    //initiating jQuery
    jQuery(function($) {
        $(document).ready( function() {
            //enabling stickUp on the '.navbar-wrapper' class
            $('.personalbar').stickUp();
        });
    });

</script>