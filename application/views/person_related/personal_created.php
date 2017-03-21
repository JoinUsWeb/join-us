                <div class="personal_hd_joined">
                    <?php
                    if (isset($activities_info) && !empty($activities_info)):
                        foreach ($activities_info as $activity_item):
                            ?>
                            <div class="p_hd_main">
                                <div class="hd_img">
                                    <a href="<?php echo site_url('activity_detail/' . $activity_item['id']); ?>">
                                        <img alt="活动海报" src="<?php echo base_url($activity_item['poster']); ?>"></a></div>
                            </div>
                            <div class="p_hd_present">
                                <div class="p_hd_title"><a class="thisover"
                                                           href="<?php echo site_url('activity_detail/' . $activity_item['id']); ?>">
                                        <span><?php echo $activity_item['name']; ?></span></a></div>
                                <div class="p_hd_details"><i class="icon-time"></i>
                                    <?php echo $activity_item['activity_start']; ?></div>
                                <div class="p_hd_details"><i class="icon-map-marker"></i><?php echo $activity_item['place']; ?></div>
                                <div class="p_hd_bd">
                                    <?php echo $activity_item['brief']; ?>
                                </div>
                                    <?php
                                    if($activity_item['isVerified']):
                                        if($activity_item['status']):?>
                                            <div class="p_hd_condition">
                                                <button onclick="create_group()" value="已结束 是否创建小组" class="creat_button">
                                            </div>
                                        <?php else:?>
                                            <div class="p_hd_condition">活动还未开始...</div>
                                        <?php endif;?>
                                        <?php else:?>
                                        <div class="p_hd_condition">活动还在审核中...</div>
                                    <?php endif;?>
                            </div>
                        <?php endforeach;
                    else : ?>
                        <div class="hd_null"><span>还没有创建过活动</span></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

                <script>
                    function create_group() {

                    }
                </script>