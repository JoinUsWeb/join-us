<div class="personal_cover">
    <img src="<?php echo base_url('img/back03.jpg');?>" alt="">
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-9 hidden-xs">
            <div class="personal_nav">
                <div class="personal_portrait">
                    <img alt="头像" src="<?php echo base_url($avatar); ?>">
                    <div class="p_show">
                        <ul>
                            <li><i class=" icon-user-md"></i>账号:
                                <ul class="p_present"><li><?php echo $email; ?></li></ul></li>
                            <li><i class="icon-info-sign"></i>昵称:
                                <ul class="p_present"><li><?php echo $nick_name; ?></li></ul></li>
                        </ul>
                    </div>

                </div>
                <div class="p_nav">
                    <ul>
                        <?php
                            $tags=array('个人信息','我的活动','我的小组','我的消息');
                            $tag_index=0;
                            switch ($tag){
                                case 'info':
                                    $tag_index=0;break;
                                case 'activities':
                                    $tag_index=1;break;
                                case 'group':
                                    $tag_index=2;break;
                                case 'message':
                                    $tag_index=3;break;
                            }
                            $tags[$tag_index]='<p>'.$tags[$tag_index].'</p>';
                        ?>
                        <li><a class="thisover" href="<?php echo site_url('user/info'); ?>"><?php echo $tags[0];?></a></li>
                        <li><a class="thisover" href="<?php echo site_url('user/activities'); ?>"><?php echo $tags[1];?></a></li>
                        <li><a class="thisover" href="<?php echo site_url('user/group'); ?>"><?php echo $tags[2];?></a></li>
                        <li><a class="thisover" href="<?php echo site_url('message/personal_mymessages'); ?>"><?php echo $tags[3];?></a></li>
                        <li><a></a></li>
                    </ul>
                    <h2 class="page_title"></h2>
                </div>
            </div>