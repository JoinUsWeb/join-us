<!--个人中心导航栏-->
<div class="container">
    <script src="/adsense.js" type="text/javascript"></script>
    <div class="main">
        <div class="side">
            <?php echo $nav; ?>
        </div>
        <!--个人中心导航栏-->
        <!--个人中心主页-->

        <div class="per_message personal-data personal_main">
            <div class="per_message_block">
                <div class="per_message_title">
                    <h5><i class="icon-calendar"></i>活动提醒</h5>
                </div>
                <div class="message_bar">
                    <ul>
                        <?php foreach ($activity_in_three_days as $row): ?>
                            <li>您报名参加的 <?= $row['name'] ?> 将于 <?= $row['date_start'] . ' ' . $row['time_start'] ?>开始活动
                            </li>
                        <? endforeach; ?>
                        <?php foreach ($activity_in_a_week as $row): ?>
                            <li>您组织的 <?= $row['name'] ?> 将于 <?= $row['date_start'] . ' ' . $row['time_start'] ?>开始活动
                            </li>
                        <? endforeach; ?>
                        <!-- <li>
                            您报名参加的华东师范大学第二届创新创业大赛将于2016-11-23开始活动
                        </li>
                        <li>
                            您报名参加的沉迷php研讨会已经结束，请前往评论！
                        </li>
                        <li>
                            您报名参加的 新生汇演 有新公告啦！
                        </li> -->
                    </ul>
                </div>
            </div>

            <div class="per_message_block">
                <div class="per_message_title">
                    <h5><i class="icon-comments"></i>小组动态</h5>
                </div>
                <div class="message_bar">
                    <ul>
                        <li>
                            您所在的 吃瓜群众 小组更新了公告！
                        </li>
                        <li>

                        </li>
                        <li>
                            您报名参加的华东师范大学第二届创新创业大赛将于2016-11-23开始活动
                        </li>
                    </ul>
                </div>
            </div>

            <div class="per_message_block">
                <div class="per_message_title">
                    <h5><i class="icon-user"></i>我的邀请</h5>
                </div>
                <div class="message_bar">
                    <ul>
                        <?php foreach ($invitation as $row): ?>
                            <li>您收到了一条来自 <?= $row['nick_name'] ?> 的活动邀请-<?= $row['name'] ?></li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="per_message_block">
                <div class="per_message_title">
                    <h5><i class="icon-ok-sign"></i>审核通过</h5>
                </div>
                <div class="message_bar">
                    <ul>
                        <li>
                            您创建的活动 华东师范大学第二届创新创业大赛 已通过审核！
                        </li>
                        <li>
                            您创建的活动 夏雨艺苑万圣节party 已通过审核！
                        </li>
                        <li>

                        </li>
                    </ul>
                </div>
            </div>

        </div>


        <div style="clear:both"></div>
    </div>
    <!--个人中心主页-->
    <!-- /container -->
    <script src="<?php echo base_url("js/ytmenu.js") ?>"></script>


    <div class="Clear"><!-- 清除浮动 --></div>
</div>

