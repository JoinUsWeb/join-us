            <div class="personal_data personal_hd">
                <div class="personal_hd_joined">
                    <div class="p_group_main">
                        <div class="g_rightbar">
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
                            <div class="group">
                                <h3>小组成员</h3>
                                <hr>
                                <div class="group_creater">     <!--组长-->
                                    <a href="../html/personal_data.html">
                                        <img src="<?php echo base_url($group['creator']['avatar']);?>"></a>
                                    <p><?php echo $group['creator']['nick_name'];?></p>
                                </div>
                                <div class="group_member">      <!--成员-->
                                    <ul>
                                        <?php
                                        if(!empty($group['members']))
                                        foreach ($group['members'] as $member_item):?>
                                            <li>
                                                <a href="../html/personal_data.html">
                                                    <img src="<?php echo base_url($member_item['creator']['avatar']);?>"></a>
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
                                                    <img class="dialogIco" width="50" height="50" src="../img/ico.png" alt="" />
                                                    <div class="p_dialogTop">
                                                        <a href="javascript:;" class="claseDialogBtn" style=" text-decoration: none;color: black;">关闭</a>
                                                    </div>
                                                    <form action="" method="post" id="editForm">

                                                        <ul class="p_friends_list">
                                                            <li><label for="checkbox1"><img src="../img/01.jpg">小石榴</label>
                                                                <input type="checkbox" name="" id="checkbox1"></li>
                                                            <li><label for="checkbox2"><img src="../img/01.jpg">小石榴</label>
                                                                <input type="checkbox" name="" id="checkbox2"></li>
                                                            <li><label for="checkbox2"><img src="../img/01.jpg">小石榴</label>
                                                                <input type="checkbox" name="" id="checkbox2"></li>
                                                            <li><label for="checkbox2"><img src="../img/01.jpg">小石榴</label>
                                                                <input type="checkbox" name="" id="checkbox2"></li>
                                                            <li><label for="checkbox2"><img src="../img/01.jpg">小石榴</label>
                                                                <input type="checkbox" name="" id="checkbox2"></li>
                                                            <li><label for="checkbox2"><img src="../img/01.jpg">小石榴</label>
                                                                <input type="checkbox" name="" id="checkbox2"></li>
                                                        </ul>
                                                        <p class="p_button_invite">
                                                            <input type="submit" value="发送邀请" class="submitBtn" >
                                                        </p>

                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="g_recent_hd">
                            <h3>小组近期活动</h3>
                            <hr>
                            <div class="hd_null">
                                <span>最近没有小组活动</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>