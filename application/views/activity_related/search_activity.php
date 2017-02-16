<?php
    $time=array(array('1','一个月内'),array('2','两个月内'),array('3','三个月内'));
?>
<div class="container">
    <div class="searching">
        <form id="search_hd" action="#" method="post">
            <div class="search" id="search">
                <div class="frame" id="frame1">
                    <div class="title" id="title">兴趣分类：</div>
                    <ul class="style1">
                        <?php
                        foreach ($first_label as $first_label_item) {
                            echo '<li><a class="thisover" href="'.site_url('search_activity/index').'?first_label_id=';

                            if($select['first_label_id']==$first_label_item['id'])
                                echo '0'.'&time=' . $select['time']
                            . '&city=' . $select['city']
                            . '"><b style="color : rgb(205,237,18);">' . $first_label_item['name'] . '</b></a></li>';
                            else
                                echo $first_label_item['id'].'&time=' . $select['time']
                                . '&city=' . $select['city']
                                . '"><span>' . $first_label_item['name'] . '</span></a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="frame" id="frame2">
                    <div class="title" id="title">时间：</div>
                    <ul class="style1">
                        <?php
                        foreach ($time as $time_item) {
                            echo '<li><a class="thisover" href="';
                            echo site_url('search_activity/index?first_label_id=' . $select['first_label_id']);
                            echo '&time=';
                            if ($select['time'] == $time_item[0])
                                echo '0'. '&city=' . $select['city']
                                    . '"><b style="color : rgb(205,237,18);">' . $time_item[1] . '</b></a></li>';
                            else
                                echo $time_item[0]. '&city=' . $select['city']
                                    . '"><span>' . $time_item[1] . '</span></a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="frame" id="frame3">
                    <div class="title" id="title">地区：</div>
                    <ul class="style1">
                        <li><a class="thisover" href="#"><span>上海</span></a></li>
                        <li><a class="thisover" href="#"><span>其他</span></a></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- ／搜索导航栏结束 -->

<!-- /搜索主页开始 -->
<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="search_out" id="search_out"><?php
            if (!empty($activity))
                foreach ($activity as $activity_item) {
                    ?>
                <div class="search_main">
                    <div class="search_main_img"><a href="<?php echo site_url('activity_detail/index/' . $activity_item['id'])?>">
                            <img width="250" height="125" src="<?php echo base_url($activity_item['poster'])?>"  alt="活动海报" ></a></div>
                    <div class="search_main_div">
                        <div class="hd_name"><a href="<?php echo site_url('activity_detail/index/' . $activity_item['id'])?>">
                                <?php echo $activity_item['name']?></a>
                        </div>
                        <div class="hd_creat"><a href="personal.html">活动发布者：<span><?php echo $activity_item['creator_name']?></span></a>
                        </div>
                        <div class="hd_label"><i class="icon-tag"></i> <span><?php echo $activity_item['first_label_name']?></span>
                        </div>
                        <div class="hd_time"><i class="icon-calendar "></i><span><?php echo $activity_item['activity_start']?></span>
                        </div>
                        <div class="people_num"><i class=" icon-group"></i> <span><?php echo $activity_item['member_number'] . '/' . $activity_item['amount_max'] ?></span>
                        </div>
                    </div>
                </div>
            <?php }
            else if (isset($activity))
                echo '未找到符合条件的活动';
            ?>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
            <div class="changeheight"></div>
            <div class="sidebar_hot">
                <div class="well">
                    <div class="hot_hd">
                        <p>热门活动</p>
                    </div>
                    <div class="hot_hd_content">
                        <?php
                        if(!empty($hot_activity))
                            foreach ($hot_activity as $hot_activity_item){
                                ?>
                                <div class="content_li">
                                    <div class="li_left">
                                        <a href="<?php echo site_url("activity_detail/index/" . $hot_activity_item["id"]) ?>" >
                                            <img src="<?php echo base_url($hot_activity_item['poster'])?>" alt="" width="60px" height="60px"></a>
                                    </div>
                                    <div class="li_right">
                                        <a class="li_right_title" href="<?php echo site_url("activity_detail/index/" . $hot_activity_item["id"]) ?>">
                                            <h5>
                                                <?php
                                                echo $hot_activity_item['name'];
                                                ?>
                                            </h5></a>
                                        <p><?php
                                            echo $hot_activity_item['activity_start'];
                                            ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //initiating jQuery
    jQuery(function($) {
        $(document).ready( function() {
            //enabling stickUp on the '.navbar-wrapper' class
            $('.sidebar_hot').stickUp();
        });
    });

</script>