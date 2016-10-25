<table border=2 align=center width=60% height="600">
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/info'); ?>">个人信息</a></li>
        </td>
        <td rowspan=5 align="center">
            <!-- 使用php代码完成这部分数据的填写 -->
            <img align="center" width=100 height=100 src="image/01.png" alt="头像">
            <table cellspacing="10px">
                <tr>
                    <th>电子邮箱</th>
                    <td><?php echo $user_info['email']; ?></a></td>
                </tr>
                <tr>
                    <th>昵称</th>
                    <td><?php echo $user_info['nick_name']; ?></a></td>
                </tr>
                <tr>
                    <th>兴趣</th>
                    <td><?php foreach ($user_info['interest'] as $single_interest):
                            echo $single_interest['name'] . "  ";
                        endforeach; ?></td>
                </tr>
                <tr>
                    <th>手机号</th>
                    <td><?php echo $user_info['phone_number']; ?></td>
                </tr>
            </table>
            <input type="button" value="Submit">
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/applied'); ?>">我参加的活动</a></li>
        </td>
    </tr>
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/joined'); ?>">我报名的活动</a></li>
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