                <div class="personal_hd_joined">
                    <?php if (empty($activities_info)) :
                        foreach ($activities_info as $single_activity): ?>
                            <div class="p_hd_main">
                                <div class="hd_img">
                                    <a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>">
                                        <img alt="活动名称" src="<?php echo base_url($single_activity['poster']); ?>"></a>
                                </div>
                                <div class="p_hd_present">
                                    <div class="p_hd_title"><a class="thisover"
                                                               href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>">
                                            <span><?php echo $single_activity['name']; ?></span></a></div>
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
                        <div class="hd_null">
                            <span>近期没有待评价的活动</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>