<table border=2 align=center width=60% height="600">
    <tr>
        <td>
            <li><a href="<?php echo site_url('user/info'); ?>">个人信息</a></li>
        </td>
        <td rowspan=5 align="center">
            <!-- 使用php代码完成这部分数据的填写 -->
            <img align="center" width=100 height=100 src="image/01.png" alt="头像">
            用户账号：123456@hotmail.com<br>
            昵称：学习<br>
            兴趣：学习，游戏<br>
            联系电话：119120110<br>
            QQ：12345678<br>
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