            <div class="personal_data personal_hd">
                <div class="personal_hd_joined">
                    <div class="p_group_main">
                        <div class="g_title">
                            <div class="group_posts">       <!--小组公告-->
                                <h3>小组公告</h3>
                                <hr>
                                <p class="group_posts_details"><?php echo $group['announcement']; ?></p>

                                <!--小组组长可见（修改公告）
                                    <form action="#" method="post" class="gg_review_main">
                                        <textarea name="g_notice" id="g_notice" placeholder="请填写公告" resize: none;></textarea>
                                    <div class="submit_comment">
                                        <input type="submit" id="submit_comment" value="张贴公告">
                                    </div>
                                </form>-->

                            </div>
                            <div class="group width_lg">
                                <h3>小组成员</h3>
                                <hr>
                                <div class="group_creater">     <!--组长-->
                                    <a href="../html/personal_data.html">
                                        <img src="<?php echo base_url($group['leader']['avatar']);?>"></a>
                                    <p><?php echo $group['leader']['nick_name'];?></p>
                                </div>
                                <div class="group_member min-width-lg">      <!--成员-->
                                    <ul>
                                        <?php
                                        if(!empty($group['members']))
                                        foreach ($group['members'] as $member_item):?>
                                            <li>
                                                <a href="../html/personal_data.html">
                                                    <img src="<?php echo base_url($member_item['avatar']);?>"></a>
                                                <p><?php echo $member_item['nick_name'];?></p>
                                            </li>
                                        <?php endforeach;
                                        else
                                            echo "还没有任何成员";
                                        ?>
                                        <li>
                                            <div class="box">
                                                <div class="demo">
                                                    <div class="p_add_member"><a class="bounceIn" href="javascript:;">
                                                            <i class="icon-plus-sign icon-5x" style="width: auto"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div id="dialogBg"></div>
                                                <div id="dialog_add" class="animated">
                                                    <img class="dialogIco" width="50" height="50" src="<?php echo base_url('img/ico.png');?>" alt="" />
                                                    <div class="p_dialogTop">
                                                        <a href="javascript:;" class="claseDialogBtn" style=" text-decoration: none;color: black;">关闭</a>
                                                    </div>
                                                    <form action="" method="post" id="editForm">

                                                        <ul class="p_friends_list">
                                                        <?php
                                                            if(!empty($group['invite_users']))
                                                                foreach ($group['invite_users'] as $invite_user_item):
                                                                ?>
                                                                <li><label for="checkbox<?php echo $invite_user_item['id'];?>">
                                                                        <img src="<?php echo base_url($invite_user_item['avatar']);?>">
                                                                        <?php echo $invite_user_item['nick_name'];?></label>
                                                                    <input type="checkbox" name="invited_users" id="checkbox<?php echo $invite_user_item['id'];?>"
                                                                        value="<?php echo $invite_user_item['id']?>"></li>
                                                            <?php
                                                            endforeach;
                                                            else{
                                                                echo '没有可以邀请的对象';
                                                            }
                                                        ?>
                                                        </ul>
                                                        <p class="p_button_invite">
                                                            <button onclick="invite()" value="发送邀请" class="submitBtn" >
                                                        </p>

                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="group_quit">
                                    <input type="button" value="退出小组" class="quit_button">
                                </div>
                            </div>
                        </div>
                        <div class="g_recent_hd">
                            <h3 id="test">小组近期活动</h3>
                            <hr>
                            <div class="g_recent_hdshow">
                                <div class="recenthd_leftbar">
                                    <div class="rhd_creater">
                                        <img src="<?php echo base_url("img/01.jpg");?>">
                                        <div class="rhd_creater_name">JoinUs</div>
                                    </div>

                                </div>
                                <div class="recenthd_rightbar">
                                    <div class="recent_hd_title">
                                        <a class="recent_hd" href="../html/details_page.html">华东师范大学第一届ColorRun比赛</a>
                                    </div>
                                    <div class="recent_hd_detials">
                                        （活动简介大约50字左右）我们在用户注册时提供一级兴趣选择（一级兴趣包括：娱乐、体育、科技、美食、军事、历史、社会、旅游、影视、其他等，一级兴趣下再细化二级兴趣），多级区域选择，及其所处年龄层等信息......
                                    </div>
                                    <div class="img_outter">
                                        <div class="img_inner">
                                            <a class="show" href="#">
                                                <img src="<?php echo base_url("img/back01.jpg");?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="recent_hd_tags">2016-11-23</div>
                                    <div class="recent_hd_tags tag_right"><i class="icon-bookmark"></i>科技美学</div>
                                </div>
                            </div>
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
                            location.reload();
                        }
                    });
                }
            </script>
        </div>