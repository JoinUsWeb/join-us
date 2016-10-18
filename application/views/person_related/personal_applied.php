<table border=2 align=center width=60% height="600">
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/info'); ?>">个人信息</a></li>
        </td>
        <td rowspan="5">
            <?php foreach ($activities_info as $single_activity): ?>
                <table cellspacing="10px">
                    <tr>
                        <th>活动名称</th>
                        <td><a href="<?php echo site_url('activity/detail/'.$single_activity['id'])?>">
                                <?php echo $single_activity['name']; ?></a></td>
                    </tr>
                    <tr>
                        <th>活动时间</th>
                        <td><?php echo $single_activity['time_expire']; ?></td>
                    </tr>
                    <tr>
                        <th>活动地点</th>
                        <td><?php echo $single_activity['place']; ?></td>
                    </tr>
                    <tr>
                        <th>活动评分</th>
                        <td><?php echo $single_activity['score']; ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/joined'); ?>">我参加的活动</a></li>
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/applied'); ?>">我报名的活动</a></li>
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