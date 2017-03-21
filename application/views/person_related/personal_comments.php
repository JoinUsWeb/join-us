    <div class="personal_hd_joined">
        <?php if (count($activities_info) != 0) : ?>
            <?php foreach ($activities_info as $single_activity): ?>
                <!-- 应该考虑加入对进行筛选活动，例如根据活动时间，否则数据太多，显示有困难 -->
                <div class="p_hd_main">
                    <div class="hd_img">
                        <a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><img
                                    alt="活动名称" src="<?php echo base_url($single_activity['poster']); ?>"></a>
                    </div>
                    <div class="p_hd_present">
                        <div class="p_hd_title"><a class="thisover"
                                                   href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>"><span><?php echo $single_activity['name']; ?></span></a>
                        </div>
                        <div class="p_hd_details"><i
                                    class="icon-time"></i><?php echo $single_activity['apply_expire']; ?></div>
                        <div class="p_hd_details"><i
                                    class="icon-map-marker"></i><?php echo $single_activity['place']; ?></div>
                        <div class="p_hd_comment">请为组织者评分:</div>
                        <div class="rating">
                            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        else : ?>
            <span>你没有需要评价的活动！</span>
        <?php endif; ?>

    </div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url('js/star_rate.js'); ?>"></script>
<script type="text/javascript">
    //initiating jQuery
    jQuery(function ($) {
        init_rating();
    });

</script>