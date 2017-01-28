<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/login&register.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css'); ?>">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:;"><img src="<?php echo base_url('img/logo.png'); ?>" alt=""
                                                             width="102" height="27"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="myInverseNavbar2">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a id="login_p" href="<?php echo site_url('admin/login'); ?>">登录</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div style="height: 72px;"></div>
<div id="container" style="margin-top: 125px">

    <?php echo form_open("admin/login", array('id' => 'register_form')); ?>
    <fieldset>
        <h3><i class="icon-user"></i> 管理员登录</h3>
        <ul>
            <li>
                <label for="user_name" class="title">用户名：</label>
                <input type="text" id="user_name" name="_user_name" placeholder="请输入用户名" value="">
            </li>
            <li>
                <label for="password" class="title">密码：</label>
                <input type="password" id="password" name="_password" placeholder="请输入密码" value="">
            </li>
        </ul>

        <p class="button">
            <input type="submit" id="login_button" value="登录">
        </p>

    </fieldset>
    </form>
</div>
<hr>

<footer class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Copyright © JoinUs Web. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>