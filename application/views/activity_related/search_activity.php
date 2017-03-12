<?php
$time = array(array('1', '一个月内'), array('2', '两个月内'), array('3', '三个月内'));
?>
<div class="container">
    <div class="searching">
        <form id="search_hd" action="#" method="post">
            <div class="search" id="search">
                <div class="frame" id="all_labels" <?php echo $select['second_label_id'] == 0 ? : 'style="display: none;";'?>>
                    <div class="title" id="title">分类：</div>
                    <ul class="style1">
                        <?php foreach ($first_label as $first_label_item) : ?>
                            <li class="thisbe" id="<?php echo $first_label_item['id']; ?>">
                                <a class="thisover" href="javascript:;">
                                    <span><?php echo $first_label_item['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php foreach ($second_label as $second_label_set) : ?>
                    <div class="frame detail" id="<?php echo "label_" . $second_label_set['id']; ?>"
                         <?php echo $second_label_set['id'] == $select['first_label_id'] ? : 'style="display: none"' ?> >
                        <div class="title">分类：</div>
                        <ul class="style1">
                            <li class="stress">
                                <span><?php echo $first_label[$second_label_set['id'] - 1]['name']; ?></span>
                            </li>
                            <?php foreach ($second_label_set as $single_item) :
                                if (is_array($single_item)) : ?>
                                    <li class="thisbe">
                                        <a class="thisover"
                                           href="<?php echo site_url("search_activity/index") . "?second_label_id=" . $single_item['id'] . "&time=0"; ?>">
                                            <span><?php echo $single_item['name']; ?></span>
                                        </a>
                                    </li>
                                <?php endif;
                            endforeach; ?>
                            <li class="thisbe">
                                <a class="thisover" href="javascript:;">
                                    <span>
                                        <i class="icon-circle-arrow-left icon-large"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endforeach; ?>
                <div class="frame" id="frame2">
                    <div class="title" id="title">时间：</div>
                    <ul class="style1">
                        <?php
                        foreach ($time as $time_item) : ?>
                            <li>
                                <a class="thisover" href="<?php echo site_url("search_activity/index?second_label_id=" . $select['second_label_id']) . '&time='.$time_item[0]; ?>"><?php echo $time_item[1]?></a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="frame" id="frame3">
                    <div class="title">排序：</div>
                    <ul class="style1">
                        <li><a class="thisover" href="<?php echo site_url("search_activity/index?second_label_id=" . $select['second_label_id']) . "&time=0" . '&order=1'; ?>"><span>综合</span></a></li>
                        <li><a class="thisover" href="<?php echo site_url("search_activity/index?second_label_id=" . $select['second_label_id']) . "&time=0" . '&order=2'; ?>"><span>最新</span></a></li>
                        <li><a class="thisover" href="<?php echo site_url("search_activity/index?second_label_id=" . $select['second_label_id']) . "&time=0" . '&order=3'; ?>"><span>最热</span></a></li>
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
                            <div class="search_main_img"><a
                                        href="<?php echo site_url('activity_detail/index/' . $activity_item['id']) ?>">
                                    <img width="250" height="125" src="<?php echo base_url($activity_item['poster']) ?>"
                                         alt="活动海报"></a></div>
                            <div class="search_main_div">
                                <div class="hd_name"><a
                                            href="<?php echo site_url('activity_detail/index/' . $activity_item['id']) ?>">
                                        <?php echo $activity_item['name'] ?></a>
                                </div>
                                <div class="hd_creat"><a
                                            href="personal.html">活动发布者：<span><?php echo $activity_item['creator_name'] ?></span></a>
                                </div>
                                <div class="hd_label"><i class="icon-tag"></i>
                                    <span><?php echo $activity_item['first_label_name'] ?></span>
                                </div>
                                <div class="hd_time"><i
                                            class="icon-calendar "></i><span><?php echo $activity_item['activity_start'] ?></span>
                                </div>
                                <div class="people_num"><i class=" icon-group"></i>
                                    <span><?php echo $activity_item['member_number'] . '/' . $activity_item['amount_max'] ?></span>
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
                        if (!empty($hot_activity))
                            foreach ($hot_activity as $hot_activity_item) {
                                ?>
                                <div class="content_li">
                                    <div class="li_left">
                                        <a href="<?php echo site_url("activity_detail/index/" . $hot_activity_item["id"]) ?>">
                                            <img src="<?php echo base_url($hot_activity_item['poster']) ?>" alt=""
                                                 width="60px" height="60px"></a>
                                    </div>
                                    <div class="li_right">
                                        <a class="li_right_title"
                                           href="<?php echo site_url("activity_detail/index/" . $hot_activity_item["id"]) ?>">
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

<script src="<?php echo base_url("js/stickUp.min.js") ?>"></script>
<script type="text/javascript">
    //initiating jQuery
    jQuery(function ($) {
        $(document).ready(function () {
            //enabling stickUp on the '.navbar-wrapper' class
            $('.sidebar_hot').stickUp();

            var lis = document.getElementById("all_labels").getElementsByClassName("thisbe");
            var length = lis.length;
            var i;
            for (i = 0; i < length; i++) {
                lis[i].onclick = function () {
                    document.getElementById("all_labels").style.display = "none";
                    var divs = document.getElementsByClassName("detail");
                    var length = divs.length;
                    for (var j = 0; j < length; j++) {
                        divs[j].style.djsplay = "none";
                    }
                    document.getElementById("label_" + this.id).removeAttribute("style");
                }
            }

            // 我这里随便选了一个 icon-circle-arrow-left 做个样例，你确定图标之后把这个改了就可以了
            var back = document.getElementsByClassName("icon-circle-arrow-left"/*这里放图标的class*/);
            length = back.length;
            for (i = 0; i < length; i++) {
                back[i].onclick = function () {
                    document.getElementById("all_labels").removeAttribute("style");
                    var divs = document.getElementsByClassName("detail");
                    var length = divs.length;
                    for (var j = 0; j < length; j++) {
                        divs[j].style.display = "none";
                    }
                }
            }

        });
    });

</script>