<div class="searching">
    <form id="search_hd" action="#" method="post">
        <ul>
            <li>
                <div class="search_main" id="search_main">
                    <div class="hobbyy" id="hobbyy">
                        <div class="hobby" id="hobby">兴趣分类：</div>
                        <ul class="select_hb" id="select_hb" data-id="-1">
                            <?php
                            foreach ($first_label as $first_label_item) {
                                echo '<li><a class="thisover" href="http://localhost/index.php/search_activity/index?first_label_id=' . $first_label_item['id']
                                    . '&time=' . $select['time']
                                    . '&city=' . $select['city']
                                    . '"><span>' . $first_label_item['name'] . '</span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="time" id="time">
                        <div class="time" id="time">时间：</div>
                        <ul class="select_hb" id="select_hb" data-id="-1">
                            <?php

                            ?>
                            <li><a class="thisover" href="http://localhost/index.php/search_activity/index?first_label_id=
                            <?php echo $select['first_label_id']; ?>
                            &time=1&city=
                            <?php echo $select['city']; ?>"><span>一个月内</span></a></li>

                            <li><a class="thisover" href="http://localhost/index.php/search_activity/index?first_label_id=
                            <?php echo $select['first_label_id']; ?>
                            &time=2&city=
                            <?php echo $select['city']; ?>"><span>三个月内</span></a></li>

                            <li><a class="thisover" href="http://localhost/index.php/search_activity/index?first_label_id=
                            <?php echo $select['first_label_id']; ?>
                            &time=3&city=
                            <?php echo $select['city']; ?>"><span>六个月内</span></a></li>
                        </ul>
                    </div>
                    <div class="local" id="local">
                        <div class="hobby" id="hobby">地区：</div>
                        <ul class="select_hb" id="select_hb" data-id="-1">
                            <?php

                            ?>
                            <li><a class="thisover" href="#"><span>上海</span></a></li>
                            <li><a class="thisover" href="#"><span>其他</span></a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </form>
</div>
<!-- ／搜索导航栏结束 -->

<!-- /搜索主页开始 -->
<div class="search_out" id="search_out">
    <div class="search_main">
        <ul class="search_main_ul">
            <?php
            if (!empty($activity))
                foreach ($activity as $activity_item) {
                    echo '<li class="search_main_li">'
                        . '<a href="http://localhost/index.php/activity_detail/' . $activity_item['id'] . '" target="_blank">'
                        . '<img alt="活动名称" title="活动名称" class="hd_pic" src="' . base_url($activity_item['poster']) . '" style="display:block"></a>'
                        . '<div class="search_main_div">'
                        . '<div class="活动名称"><a href="http://localhost/index.php/activity_detail/' . $activity_item['id'] .
                        '">' . $activity_item['name'] . '</a></div>'
                        . '<div class="活动发布者"><a href="personal.html">' . $activity_item['creator_name'] . '</a></div>'
                        . '<div class="兴趣标签">' . $activity_item['first_label_name'] . '</div>'
                        . '<div class="活动时间">' . $activity_item['date_start'] . '-' . $activity_item['time_start'] . '</div>'
                        . '<div class="活动报名截止时间">' . $activity_item['date_expire'] . '-' . $activity_item['time_expire'] . '</div>'
                        . '<div class="活动参与人数">' . $activity_item['member_number'] . '/' . $activity_item['amount_max'] . '</div></div></li>';
                }
            else if (isset($activity))
                echo '未找到符合条件的活动';
            ?>
        </ul>
    </div>
</div>
<!-- /搜索主页结束 -->

</body>
</html>
