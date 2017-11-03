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
    <link rel="stylesheet" href="<?php echo base_url('css/detail.css'); ?>">
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
        <ul>
            <li class="active">
                <a href="<?php echo site_url('admin/main'); ?>">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/main'); ?>">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/main'); ?>">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/main'); ?>">
                    <i class="icon-ok-circle icon-large"></i>
                    <span>活动审核</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="right_content">
        <div class="back"><a
                    href="<?php echo site_url('admin/main'); ?>">返回上一页</a><span> > <?php echo $activity_info['name']; ?></span>
        </div>
        <div class="check_content">
            <div class="content_head_l">
                <img src="<?php echo base_url($activity_info['poster']); ?>" alt="海报海报photo">
            </div>

            <div class="content_head_r">
                <div class="detail_title">
                    <h2>
                        <?php echo $activity_info['name']; ?>
                    </h2>
                </div>
                <hr>

                <div id="detail_block">
                    <div class="detail">
                        <div class="title_txt">
                            开始时间：<span><?php echo $activity_info['activity_start']; ?></span>
                        </div>

                    </div>
                    <div class="detail">
                        <div class="title_txt">
                            截止报名时间：<span><?php echo $activity_info['apply_expire']; ?></span>
                        </div>

                    </div>


                    <div class="detail">
                        <div class="title_txt">地点：<span>
                    <?php echo $activity_info['place']; ?>
                  </span></div>

                    </div>

                    <div id="detail_joinnum" class="detail" ms-controller="detail_join_party_list_controller">

                        <div class="title_txt">人数上限：<span class="num"><?php echo $activity_info['amount_max']; ?></span>
                        </div>

                    </div>
                    <div class="detail">
                        <div class="title_txt">活动类型：<span>
                    <?php echo $activity_info['first_label_id']; ?>
                  </span></div>

                    </div>

                </div>

            </div>
        </div>
        <div class="hdxq">
            <div class="information"><p>活动详情</p></div>
            <div class="context">
                <p>
                    <?php echo $activity_info['brief']; ?>
                </p>
            </div>


        </div>
        <div class="check_button">
            <?php echo form_open('admin/is_approved/' . $activity_info['id'] . '/' . $activity_info['creator_id'], array('class' => 'form-inline'));?>
            <?php
            switch ($activity_info['isVerified']) {
                case 0: ?>
                    <span class="center">
                <label for="score" style="font-size: 18px">活动综合评分：</label>
                    <input class="form-control" type="text" id="score" placeholder="请输入60 - 100的整数"  name="origin_score" required>
                </span>
                    <span class="center">
                    <input type="submit" id="check_yes" name="approve" value="审核通过">
                </span>
                    <span class="center">
                    <input type="submit" id="check_no" name="disapprove" value="审核不通过">
                </span>
                    <?php break;
                case 1: ?>
                    <span class="center">
                    <input class="form-control" type="submit" id="check_yes" name="approve" value="审核通过" disabled>
                </span>
                    <span class="center">
                    <input type="submit" id="check_no" name="disapprove" value="审核不通过">
                </span>
                    <?php break;
                case 2: ?>
                    <span class="center">
                <label for="score" style="font-size: 18px">活动综合评分：</label>
                    <input class="form-control" type="text" id="score" name="origin_score" placeholder="请输入60 - 100的整数" required>
                </span>
                    <span class="center">
                    <input type="submit" id="check_yes" name="approve" value="审核通过">
                </span>
                    <span class="center">
                    <input type="submit" id="check_no" name="disapprove" value="审核不通过" disabled>
                </span>
                    <?php break;
            } ?>

            </form>

        </div>


    </div>

</div>
<script type="text/javascript">
    document.getElementById('check_no').onclick = function () {
        document.getElementById('score').removeAttribute('required');
    };
    document.getElementById('check_yes').onclick = function () {
        if (document.getElementById('score').value < 60 || document.getElementById('score').value > 100){
            alert("请输入60 - 100的整数！");
            return false;
        }
    }
</script>

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