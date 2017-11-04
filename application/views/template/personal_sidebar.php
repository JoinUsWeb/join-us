        <div class="sidebar_col">
            <div class="personal_height"></div>
            <div class="personalbar">
                <div class="personal_wall">
                    <div class="personal_recent_hd">
                        <p>—近期参加活动—</p>
                    </div>
                    <?php if (!empty($recent_activities)):
                        foreach ($recent_activities as $recent_activity):?>
                            <div class="pr_hd_content">
                                <div class="content_li">
                                    <div class="li_left">
                                        <a href="<?=site_url('activity_detail/index/'.$recent_activity['id'])?>">
                                            <img src="<?php echo base_url($recent_activity['poster']);?>" width="60px" height="60px"></a>
                                    </div>
                                    <div class="li_right">
                                        <a class="li_right_title" href="<?=site_url('activity_detail/index/'.$recent_activity['id'])?>">
                                            <h5><?=$recent_activity['name']?></h5></a>
                                        <p><?=$recent_activity['activity_start']?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    else:?>
                        <div class="pr_hd_content">近期没有活动</div>
                    <?php endif;?>

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