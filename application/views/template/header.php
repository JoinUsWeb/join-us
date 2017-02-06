<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="<?php echo base_url("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php switch ($page_name) {
        case "login": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/login&register.css"); ?>">
            <?php break;
        case "register": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/login&register.css"); ?>">
            <?php break;
        case "home": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/common.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/mainpage.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/main.css"); ?>">
            <?php break;
        case "detail": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/detail.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/common.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/mainpage.css"); ?>">
            <?php break;
        case "create": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/create.css"); ?>">
            <link rel="stylesheet"
                  href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.45/css/bootstrap-datetimepicker.min.css">
            <?php break;
        case "search": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/searching.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/mainpage.css"); ?>">
            <?php break;
        case "info": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;
        case "joined": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;
        case "applied": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;
        case "comments": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;
        /*case "favorites": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;*/
        case "group": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;
        case "group_detail": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/detail.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/common.css"); ?>">
            <link rel="stylesheet" href="<?php echo base_url("css/mainpage.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;
        case "edit": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/create.css"); ?>">
            <?php break;
        case "message": ?>
            <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
            <?php break;
        case 'personal':?>
        <link rel="stylesheet" href="<?php echo base_url("css/personal.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/default.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/component.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("css/detail.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("css/common.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("css/mainpage.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("css/font-awesome.min.css"); ?>">
        <script type="text/javascript" src="<?php echo base_url("js/jquery-3.1.1.min.js");?>"></script>
        <script type="text/javascript">
                var w,h,className;
                function getSrceenWH(){
                        w = $(window).width();
                        h = $(window).height();
                        $('#dialogBg').width(w).height(h);
                }
                window.onresize = function(){
                        getSrceenWH();
                }
                $(window).resize();
                $(function(){
                        getSrceenWH();
                        $('.box a').click(function(){
                                className = $(this).attr('class');
                                $('#dialogBg').fadeIn(300);
                                $('#dialog_add').removeAttr('class').addClass('animated '+className+'').fadeIn();
                        });
                        $('.claseDialogBtn').click(function(){
                                $('#dialogBg').fadeOut(300,function(){
                                        $('#dialog_add').addClass('bounceOutUp').fadeOut();
                                });
                        });
                });
        </script>
        <script src="<?php echo base_url("js/modernizr.custom.js");?>"></script>
        <?php break;
    } ?>

    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="<?php echo base_url("js/modernizr.custom.js"); ?>"></script>
    <!--HTML5 shim and Respond . js for IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond . js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
