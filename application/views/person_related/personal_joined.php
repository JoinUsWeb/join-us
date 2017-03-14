            <div class="personal_data personal_hd">
                <div class="personal_hd_nav">
                    <ul>
                        <li></li>
                        <li><a href="<?php site_url('joined/0'); ?>">创建活动<span class="pipe">|</span></a></li>
                        <li><a class="hd_a" href="<?php site_url('joined/1'); ?>">参与活动<span class="pipe">|</span></a></li>
                        <li><a href="<?php site_url('join/2'); ?>">评价活动<span class="pipe">|</span></a></li>
                        <li><a href="<?php site_url('joined/3'); ?>">收藏活动</a></li>
                    </ul>
                </div>
                <div class="personal_hd_joined">
                    <!--

                    -->
                    <?php
                    if(isset($activities_info)&&!empty($activities_info))
                    foreach ($activities_info as $activity_item):
                    ?>
                    <div class="p_hd_main">
                        <div class="hd_img">
                            <a href="<?php echo site_url('activity_detail/'.$activity_item['id']); ?>">
                                <img alt="活动海报" src="<?php echo base_url($activity_item['poster']); ?>"></a></div>
                        </div>
                        <div class="p_hd_present">
                            <div class="p_hd_title"><a class="thisover" href="<?php echo site_url('activity_detail/'.$activity_item['id']); ?>">
                                    <span><?php echo $activity_item['name']; ?></span></a></div>
                            <div class="p_hd_details"><i class="icon-time"></i>
                                <?php echo $activity_item['activity_start'];?></div>
                            <div class="p_hd_details"><i class="icon-map-marker"></i><?php echo $activity_item['place']; ?></div>
                            <div class="p_hd_bd">
                                <?php echo $activity_item['brief']; ?>
                            </div>
                            <div class="p_hd_condition">活动正在进行...</div>
                        </div>
                    </div>
                    <?php endforeach;
                    else
                        echo "<div class=\"hd_null\"><span>近期没有参与活动，快去寻找你的专属活动</span></div>";
                    ?>
                </div>
            </div>
        </div>