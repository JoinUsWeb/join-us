        <div class="sidebar_col">
            <div class="personal_height"></div>
            <div class="personalbar">
                <div class="personal_wall">
                    <div class="personal_recent_hd">
                        <p>—近期参加活动—</p>
                    </div>

                    <div class="pr_hd_content">
                        <div class="content_li">
                            <div class="li_left">
                                <a href="details_page.html"><img src="<?php echo base_url("img/adobe.png");?>" alt="" width="60px"
                                                                 height="60px"></a>
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
                                <a href="details_page.html"><img src="<?php echo base_url("img/adobe.png");?>" alt="" width="60px"
                                                                 height="60px"></a>
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
                                <a href="personal.html"><img src="<?php echo base_url("img/huaban.jpg");?>" alt="" width="60px" height="60px"></a>
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
                                <a href="personal.html"><img src="<?php echo base_url("img/huaban.jpg");?>" alt="" width="60px" height="60px"></a>
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
<script src="<?php echo base_url("js/stickUp.min.js");?>"></script>
<script type="text/javascript">
    //initiating jQuery
    jQuery(function ($) {
        $(document).ready(function () {
            //enabling stickUp on the '.navbar-wrapper' class
            $('.personalbar').stickUp({
                topMargin: '70px'
            });
        });
    });
</script>