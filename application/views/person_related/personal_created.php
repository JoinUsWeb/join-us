                <div class="personal_hd_joined">
                    <?php
                    if (isset($activities_info) && !empty($activities_info)):
                        foreach ($activities_info as $activity_item):
                            if (!empty($activity_item)):
                            ?>
                            <div class="p_hd_main">
                                <div class="hd_img">
                                    <a href="<?php echo site_url('activity_detail/index/' . $activity_item['id']); ?>">
                                        <img alt="活动海报" src="<?php echo base_url($activity_item['poster']); ?>"></a>
                                </div>

                                <div class="p_hd_present">
                                    <div class="p_hd_title"><a class="thisover"
                                                               href="<?php echo site_url('activity_detail/index/' . $activity_item['id']); ?>">
                                            <p><?php echo $activity_item['name']; ?></p></a></div>
                                    <div class="p_hd_details"><i class="icon-time"></i>
                                        <?php echo $activity_item['activity_start']; ?></div>
                                    <div class="p_hd_details"><i class="icon-map-marker"></i><p><?php echo $activity_item['place']; ?></p>
                                    </div>
                                    <div class="p_hd_bd">
                                        <p class="p_hd_text">
                                        <!-- 初步的字符截断 -->
                                        <?php echo $activity_item['brief'];/*mb_strlen($activity_item['brief'], "utf-8") > 220 ? mb_substr($activity_item['brief'], 0, 210, "utf-8") . '...' : $activity_item['brief'];*/ ?>
                                        </p>
                                    </div>
                                    <?php
                                    if ($activity_item['isVerified']):
                                        if ($activity_item['status']==1):?>
                                            <div class="p_hd_condition">
                                                <input type="button" onclick="create_group(<?php echo $activity_item['id'] ?>)"
                                                       value="已结束 是否创建小组" class="creat_button">
                                            </div>
                                        <?php elseif($activity_item['status']==0): ?>
                                            <div class="p_hd_condition">活动还未开始...</div>
                                        <?php elseif($activity_item['status']==2): ?>
                                        <div class="p_hd_condition"><a href="
                                            <?php echo site_url('user/group_detail/'.$activity_item['id']);?>">查看此活动的小组</a></div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="p_hd_condition">活动还在审核中...</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif;
                            endforeach;
                    else : ?>
                        <div class="hd_null"><span>还没有创建过活动</span></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

<script>
    function create_group(activity_id) {
        location.href = "<?php echo site_url('user/create_group/');?>" + activity_id;
    }
</script>