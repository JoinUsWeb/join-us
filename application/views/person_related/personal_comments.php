        <div class="personal_hd_joined">
            <?php if (!empty($activities_info)|| !empty($created_activities_info)) :
                //显示需要评价用户的活动
                foreach ($created_activities_info as $single_activity):?>
                    <!-- 应该考虑加入对进行筛选活动，例如根据活动时间，否则数据太多，显示有困难 -->
                    <div class="p_hd_main">
                        <div class="hd_img">
                            <a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><img
                                    alt="活动名称" src="<?php echo base_url($single_activity['poster']); ?>"></a>
                        </div>
                        <div class="p_hd_present">
                            <div class="p_hd_title"><a class="thisover"
                                                       href="<?= site_url('activity_detail/index/' . $single_activity['id']) ?>"><p><?= $single_activity['name']; ?></p></a>
                            </div>
                            <div class="p_hd_details"><i
                                    class="icon-time"></i><?= $single_activity['apply_expire']; ?></div>
                            <div class="p_hd_details"><i
                                    class="icon-map-marker"></i><?= $single_activity['place']; ?></div>
                            <div class="p_hd_present">
                                <div class="p_hd_comment">请为人员评分:</div>
                                <div class="comment_a"><a href="<?= site_url('user/evaluate_participant/' . $single_activity['id'])?>">点击进行评分</a></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                //显示参加过的活动以及对他们的评分
                foreach ($activities_info as $single_activity):?>
                    <!-- 应该考虑加入对进行筛选活动，例如根据活动时间，否则数据太多，显示有困难 -->
                    <div class="p_hd_main">
                        <div class="hd_img">
                            <a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><img
                                        alt="活动名称" src="<?php echo base_url($single_activity['poster']); ?>"></a>
                        </div>
                        <div class="p_hd_present">
                            <div class="p_hd_title"><a class="thisover"
                                                       href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><p><?php echo $single_activity['name']; ?></p></a>
                            </div>
                            <div class="p_hd_details"><i
                                        class="icon-time"></i><?php echo $single_activity['apply_expire']; ?></div>
                            <div class="p_hd_details"><i
                                        class="icon-map-marker"></i><?php echo $single_activity['place']; ?></div>
                            <div class="p_hd_comment">请为组织者评分:</div>
                            <?php if (-1 == $single_activity['rate']) : ?>
                            <div class="rating" data-activity-id="<?php echo $single_activity['id']?>">
                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                            </div>
                            <?php elseif (1 == $single_activity['rate']): ?>
                                <div class="rated">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span class="selected">☆</span>
                                </div>
                            <?php elseif (2 == $single_activity['rate']): ?>
                                <div class="rated">
                                    <span>☆</span><span>☆</span><span>☆</span><span class="selected">☆</span><span class="selected">☆</span>
                                </div>
                            <?php elseif (3 == $single_activity['rate']): ?>
                                <div class="rated">
                                    <span>☆</span><span>☆</span><span class="selected">☆</span><span class="selected">☆</span><span class="selected">☆</span>
                                </div>
                            <?php elseif (4 == $single_activity['rate']): ?>
                                <div class="rated">
                                    <span>☆</span><span class="selected">☆</span><span class="selected">☆</span><span class="selected">☆</span><span class="selected">☆</span>
                                </div>
                            <?php else: ?>
                                <div class="rated">
                                    <span class="selected">☆</span><span class="selected">☆</span><span class="selected">☆</span><span class="selected">☆</span><span class="selected">☆</span>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="hd_null"><span>你没有需要评价的活动！</span></div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('js/star_rate.js'); ?>"></script>
<script type="text/javascript">
    //initiating jQuery
    jQuery(function ($) {
        var arg = "<?php echo site_url();?>";
        init_rating(arg);
    });

</script>