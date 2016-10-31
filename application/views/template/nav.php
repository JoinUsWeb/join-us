<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#myInverseNavbar2"><span class="sr-only">Toggle navigation</span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="<?php echo site_url("home"); ?>">Join Us</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="myInverseNavbar2">
            <ul class="nav navbar-nav navbar-right">
                <li></li>
                <li><a href="<?php echo site_url("home"); ?>">主页</a></li>
                <li><a href="<?php echo site_url("search_activity"); ?>">查找活动</a></li>
                <li><a href="<?php echo site_url("create_activity"); ?>">创建活动</a></li>
                <?php if(!isset($this->session->user_id)){ ?>
                <li>
                    <a id="login_p" href="<?php echo site_url("login"); ?>">登录</a>
                </li>
                <li><p>|</p></li>
                <li>
                    <a id="register_p" href="<?php echo site_url("register"); ?>">注册</a>
                </li>
                <?php }else{ ?>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">个人中心 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo site_url('user/applied'); ?>">我报名的</a></li>
                        <li><a href="<?php echo site_url('user/joined'); ?>">我参加的</a></li>
                        <li><a href="<?php echo site_url('user/favorites'); ?>">收藏</a></li>
                        <li><a href="<?php echo site_url('user/comments'); ?>">评论</a></li>
                        <li><a href="<?php echo site_url("log_off"); ?>">注销</a></li>
                        <li class="divider"></li>
                        <li><a href="#">关于我们</a></li>
                    </ul>
                </li>
                <?php }?>
            </ul>



        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div style="height: 72px;"></div>