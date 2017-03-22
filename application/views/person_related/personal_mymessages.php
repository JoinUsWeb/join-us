<div class="personal_data personal_hd">

    <div class="per_message">
        <div class="per_message_block">
            <div class="per_message_title">
                <h5><i class="icon-calendar"></i>活动提醒</h5>
            </div>
            <div class="message_bar">
                <ul>
                    <?php foreach ($activity_in_three_days as $row): ?>
                        <li>您报名参加的 <?php echo $row['name'] ?> 将于 <?php echo $row['activity_start']; ?>开始活动
                        </li>
                    <?php endforeach; ?>
                    <?php foreach ($activity_in_a_week as $row): ?>
                        <li>您组织的 <?php echo $row['name']; ?> 将于 <?php echo $row['activity_start']; ?>开始活动
                        </li>
                    <?php endforeach; ?>
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
                        您所在的 转笔达人 小组更新了公告！
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
                        <li>您收到了一条来自 <?php echo $row['nick_name']; ?> 的活动邀请-<?php echo $row['name']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="per_message_block">
            <div class="per_message_title">
                <h5><i class="icon-ok-sign"></i>审核通过</h5>
            </div>
            <div class="message_bar">
                <ul>
                    <?php
                    /**
                     * @todo 需要区分活动状态
                     */
                    foreach ($verified_activity as $row): ?>
                        <li>您创建的活动 <?php echo $row['name']; ?> 已通过审核!</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>
</div>

