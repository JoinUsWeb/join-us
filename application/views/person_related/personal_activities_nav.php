            <div class="personal_data personal_hd">
                <div class="personal_hd_nav">
                    <ul>
                        <?php
                        $tags=array('','','');
                        $tags[$model]='class="hd_a"';
                        ?>
                        <li></li>
                        <li><a <?php echo $tags[0].' href="'.site_url('user/activities/0'); ?>">创建活动<span class="pipe">|</span></a></li>
                        <li><a <?php echo $tags[1].' href="'.site_url('user/activities/1'); ?>">参与活动<span class="pipe">|</span></a></li>
                        <li><a <?php echo $tags[2].' href="'.site_url('user/activities/2'); ?>">评价活动</a></li>
                    </ul>
                </div>