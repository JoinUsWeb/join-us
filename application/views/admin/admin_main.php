<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>管理员界面</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('css/mainpage.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/admin.css'); ?>">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>


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
                    <a id="cancel_p" href="<?php echo site_url("log_off/index/a"); ?>">注销</a>
                </li>

            </ul>


        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div style="height: 52px;"></div>

<div class="container_admin">
    <div class="left_bar">
        <ul style="display: block;">
            <li class="active">
                <a href="admin_main.php">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
            <li>
                <a href="admin_main.php">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
            <li>
                <a href="admin_main.php">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
            <li>
                <a href="admin_main.php">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="right_content">
        <div class="check-box">
            <div class="check-title">
                <h3><i class="icon-th"></i> 待审核</h3>
            </div>
            <div class="check-content">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="52%">活动名称</th>
                        <th width="12%">创建者</th>
                        <th width="12%">活动日期</th>
                        <th width="10%">审核状态</th>
                        <th width="14%">按钮</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($to_verify as $item) { ?>

                        <tr>
                            <td>
                                <a href="<?php echo site_url('admin/check/' . $item['id']); ?>"><?php echo $item['name'] ?></a>
                            </td>
                            <td class="center"><?php echo $item['creator_name']; ?></td>
                            <td class="center"><?php echo $item['date_start']; ?></td>
                            <td class="center"><?php echo $item['isVerified'] == 1 ? '已审核' : '未审核'; ?></td>
                            <td class="center">
                                <form method="post" action="#">
                                    <input type="submit" class="pass_button" value="通过">
                                    <input type="submit" class="pass_button" value="不通过">

                                </form>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

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