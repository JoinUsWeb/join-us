        <div class="personal_data personal_hd" xmlns:resize="http://www.w3.org/1999/xhtml">
            <div class="personal_hd_joined">
                <div class="p_group_main">
                    <div class="g_title">
                        <div class="group_posts">       <!--小组公告-->
                            <h3>小组公告</h3>
                            <hr>
                            <p class="group_posts_details"><?=$group['announcement']?></p>

                            <?php if ($_SESSION['user_id']==$group['leader']['id']):?>
                                <h3>修改公告</h3>
                                <form action="<?= site_url('user/set_group_announcement/'.$group['id'])?>" method="post" class="gg_review_main">
                                    <textarea name="announcement" id="g_notice" placeholder="请填写公告" style="resize: none; "  rows="3" cols="94" required></textarea>
                                    <div class="submit_comment">
                                        <input type="submit" id="submit_comment" value="张贴公告">
                                    </div>
                                </form>
                            <?php endif;?>

                        </div>
                        <div id="dialogBg"></div>
                        <div id="dialog_add" class="animated">
                            <img class="dialogIco" width="50" height="50" src="<?php echo base_url('img/ico.png');?>" alt="" />
                            <div class="dialogTop">
                                <a href="javascript:;" class="claseDialogBtn" style=" text-decoration: none;color: black;">关闭</a>
                            </div>
                            <form action="" method="post" id="editForm">
                                <div class="over">
                                    <ul class="friends_list">
                                    <?php if(!empty($group['invite_users'])):
                                        foreach ($group['invite_users'] as $invite_user_item):?>
                                            <li><label for="checkbox<?php echo $invite_user_item['id'];?>">
                                                    <?php echo $invite_user_item['nick_name'];?></label>
                                                <input type="checkbox" name="invited_users" id="checkbox<?php echo $invite_user_item['id'];?>"
                                                       value="<?php echo $invite_user_item['id']?>"></li>
                                        <?php endforeach;
                                    else:
                                        echo '没有可以邀请的对象';
                                    endif; ?>
                                    </ul>
                                </div>

                                <p class="button_invite">
                                    <input type="submit" onclick="invite()" value="发送邀请" class="submitBtn" >
                                </p>

                            </form>
                        </div>
                        <div class="group width_lg">
                            <h3>小组成员</h3>
                            <hr>
                            <div class="group_creater">     <!--组长-->
                                <a href="../html/personal_data.html">
                                    <img src="<?php echo base_url($group['leader']['avatar']);?>"></a>
                                <p><?php echo $group['leader']['nick_name'];?>(组长)</p>
                            </div>
                            <div class="group_member min-width-lg">      <!--成员-->
                                <ul>
                                    <?php if(!empty($group['members'])):
                                        $member_count = count($group['members']);
                                        for ($i = 0; $i<3 && $i<$member_count; $i++):
                                        $member_item = $group['members'][$i];?>
                                            <li>
                                                <a href="../html/personal_data.html">
                                                    <img src="<?=base_url($member_item['avatar'])?>"></a>
                                                <p><?=$member_item['nick_name']?></p>
                                            </li>
                                        <?php endfor;
                                    else:
                                        echo "<li>还没有任何成员</li>";
                                    endif;?>
                                    <li>
                                        <div class="box">
                                            <div class="demo">
                                                <div class="p_add_member"><a class="bounceIn" href="javascript:;">
                                                        <i class="icon-plus-sign icon-5x" style="width: auto"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <?php if($this->session->user_id!=$group['leader_id']):?>
                                <div class="group_quit">
                                    <input type="button" onclick="quit()" value="退出小组" class="quit_button">
                                </div>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="g_recent_hd">
                        <h3>小组相关活动</h3>
                        <hr>
                        <?php if (!empty($group['related_activities'])):
                            foreach ($group['related_activities'] as $related_activity):?>
                                <div class="g_recent_hdshow">
                                    <div class="recenthd_leftbar">
                                        <div class="rhd_creater">
                                            <img src="<?php echo base_url($group['leader']['avatar']);?>">
                                            <div class="rhd_creater_name"><?=$group['leader']['nick_name']?></div>
                                        </div>

                                    </div>
                                    <div class="recenthd_rightbar">
                                        <div class="recent_hd_title">
                                            <a class="recent_hd" href="<?=site_url('activity_detail/index/'.$related_activity['id'])?>"><?=$related_activity['name']?></a>
                                        </div>
                                        <div class="recent_hd_detials"><?=$related_activity['brief']?></div>
                                        <div class="img_outter">
                                            <div class="img_inner">
                                                <a class="show" href="#">
                                                    <img src="<?=base_url($related_activity['poster']); ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="recent_hd_tags"><?=$related_activity['activity_start'] ?></div>
                                        <!--<div class="recent_hd_tags tag_right"><i class="icon-bookmark"></i>科技美学</div>-->
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach;
                        else:?>
                            <div class="hd_null">
                                <span>最近没有小组活动</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


            </div>
        </div>
        <script type="application/javascript">
        function invite() {
            var check_box=document.getElementsByName("invited_users");
            var chosed_users=new Array();
            for(var i=0;i<check_box.length;i++){
                if(check_box[i].checked==true)
                    chosed_users.push(check_box[i].value);
                }
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('user/invite_users/'); ?>',
                data: {'invited_users[]': chosed_users, 'group_id': <?php echo $group['id'];?>},
                success: function () {
                    location.reload();}
            });
        }

        function quit() {
            location.href="<?php echo site_url('user/quit_group/'.$group['id']);?>";
        }
        </script>
    </div>