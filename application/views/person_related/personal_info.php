            <div class="personal_data">
                <div class="p_data p_data_width">
                    <ul>
                        <li><i class=" icon-map-marker"></i>所在地区:
                            <div class="p_present">上海</div>
                        </li>
                        <li><i class=" icon-tags"></i>兴趣标签:
                            <div style="clear:both"></div>
                            <?php
                            foreach ($interests as $interest_item):?>
                            <div class="p_tag" style="display:block"><?php echo $interest_item['name'];?></div>
                            <?php endforeach;
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="p_data">
                    <ul>
                        <li><i class=" icon-bookmark"></i>个人介绍:
                            <div class="p_details_present">他静悄悄的来过，但没有留下任何消息。</div>
                        </li>
                    </ul>
                </div>
                <div class="p_data">
                    <a class="p_button" href="<?php echo site_url("user/edit");?>">
                        <div class="p_data_button">
                            点击修改个人信息
                        </div>
                    </a>
                </div>
            </div>
        </div>