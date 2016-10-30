<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myInverseNavbar2"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="index.html">Join Us</a> </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="myInverseNavbar2">
            <ul class="nav navbar-nav navbar-right">
                <li></li>
                <li><a href="html/searching.html">查找活动</a></li>
                <li><a href="html/create.html">创建活动</a></li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">地区 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="html/details_page.html">上海</a></li>
                    </ul>
                </li>
                <?php if(!isset($this->session->user_id)){ ?>
                <li>
                    <a id="login_p" href="html/login.html">登录</a>
                </li>
                <li><p>|</p></li>
                <li>
                    <a id="register_p" href="html/register.html">注册</a>
                </li>
                <?php }else{ ?>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">个人中心 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="html/personal_applied.html">我报名的</a></li>
                        <li><a href="html/personal_joined.html">我参加的</a></li>
                        <li><a href="html/personal_favorites.html">收藏</a></li>
                        <li><a href="html/personal_comments.html">评论</a></li>
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