            <div class="personal_data personal_hd">
                <div class="personal_hd_joined">
                <?php
                    if(isset($joined_groups)&&!empty($joined_groups)) 
                    foreach ($joined_groups as $joined_group_item):
                        $group_members=$joined_group_item['members'];
                    ?>
                    <div class="p_group_main">
                        <div class="g_leftbar">
                            <div class="pg_img">
                                <a href="<?php echo site_url('user/group_detail/'.$joined_group_item['id']);?>">
                                    <img src="<?php echo base_url($joined_group_item['poster']);?>" alt="小组海报"></a>
                            </div>
                            <div class="group_infor">       <!--小组简介-->
                                <a class="#" href="<?php echo site_url('user/group_detail/'.$joined_group_item['id']);?>">
                                    <span class="hd_title"><?php echo $joined_group_item['name'];?></span>
                                </a>
                                <hr>
                                <div class="hd_details"><i class="icon-tag"></i>兴趣标签：
                                    <span><?php echo $joined_group_item['first_label']['name'];?></span></div>
                                <div class="hd_details"><i class="icon-user-md"></i>创建时间：
                                    <span><?php echo $joined_group_item['created_time'];?></span></div>
                            </div>
                        </div>
                        <div class="g_rightbar">
                            <div class="group_posts">       <!--小组公告-->
                                <h3>小组公告</h3>
                                <hr>
                                <p class="group_posts_details"><?php echo $joined_group_item['announcement'];?></p>
                            </div>
                            <div class="group">
                                <h3>小组成员</h3>
                                <hr>
                                <div class="group_creater">     <!--组长-->
                                    <a href="../html/personal_data.html"><img src="<?php echo base_url($joined_group_item['leader']['avatar']); ?>"></a>
                                    <p><?php echo $joined_group_item['leader']['nick_name']; ?></p>
                                </div>
                                <div class="group_member">      <!--成员-->
                                    <ul>
                                    <?php
                                    if(isset($joined_group_item['members'])&&!empty($joined_group_item['members']))
                                    foreach ($joined_group_item['members'] as $member_item):
                                        ?>
                                        <li>
                                            <a href="../html/personal_data.html">
                                                <img src="<?php echo base_url($member_item['avatar']); ?>"></a>
                                            <p><?php echo $member_item['nick_name']; ?></p>
                                        </li>
                                        <?php
                                    endforeach;
                                    else
                                        echo '小组还没有任何成员';
                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
                else echo '未参加任何小组';
                ?>

                </div>
            </div>
        </div>
    </div>
</div>