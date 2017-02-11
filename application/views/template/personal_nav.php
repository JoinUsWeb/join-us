<div class="personal_body">
    <div class="personal_cover">
        <img src="<?php echo base_url('img/01.jpg');?>" alt="" width="1280" height="200">
    </div>
    <div class="personal_row">
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 hidden-xs">
            <div class="personal_nav">
                <div class="personal_portrait">
                    <img alt="头像" src="<?php echo base_url($avatar); ?>">
                    <div class="p_show">
                        <ul>
                            <li><i class=" icon-user-md"></i>账号:
                                <ul class="p_present">
                                    <li>
                                        <?php echo $email; ?>
                                    </li>
                                </ul>
                            </li>
                            <li><i class="icon-info-sign"></i>昵称:
                                <ul class="p_present">
                                    <li>
                                        <?php echo $nick_name; ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="p_nav">
                    <ul>
                        <li><a class="thisover" href="<?php echo site_url('user/info'); ?>">个人信息</a></li>
                        <li><a class="thisover" href="<?php echo site_url('user/activities'); ?>">我的活动</a></li>
                        <li><a class="thisover" href="<?php echo site_url('user/group'); ?>">我的小组</a></li>
                        <li><a class="thisover" href="<?php echo site_url('message/personal_mymessages'); ?>">我的消息</a></li>
                        <li><a></a></li>
                    </ul>
                </div>
            </div>