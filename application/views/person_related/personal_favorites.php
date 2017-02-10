<table border=2 align=center width=60% height="600">
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/info'); ?>">个人信息</a></li>
        </td>
        <td rowspan="5">
                <?php if (count($activities_info) != 0) { ?>
                <?php foreach ($activities_info as $single_activity): ?>
                    <!-- 应该考虑加入对进行筛选活动，例如根据活动时间，否则数据太多，显示有困难
                     同时需要对活动是否被收藏进行判断  或者让数据保证是推荐的活动-->
                    <table cellspacing="10px">
                        <tr>
                            <th>活动名称</th>
                            <td><a href="<?php echo site_url('activity_detail/index/' . $single_activity['id']) ?>">
                                    <?php echo $single_activity['name']; ?></a></td>
                        </tr>
                        <tr>
                            <th>活动时间</th>
                            <td><?php echo $single_activity['date_time_expire']; ?></td>
                        </tr>
                        <tr>
                            <th>活动地点</th>
                            <td><?php echo $single_activity['place']; ?></td>
                        </tr>
                    </table>
                <?php endforeach;
            } else {
                ?>
                <span>你还没有收藏任何活动！</span>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/applied'); ?>">我参加的活动</a></li>
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/joind'); ?>">我报名的活动</a></li>
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/favorites'); ?>">收藏活动</a></li>
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/comments'); ?>">评论活动</a></li>
        </td>
    </tr>

</table>