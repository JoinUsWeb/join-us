<?php
$hot_activity_count = 0;
$recommended_activity_count = 0;
$class_array = array(
    "col-lg-4 col-md-4 col-sm-6 col-xs-6",
    "col-lg-4 col-md-4 col-sm-6 col-xs-6",
    "col-lg-4 col-md-4 col-sm-6 hidden-sm hidden-xs",
    "col-lg-4 col-md-4 col-sm-6 col-xs-6",
    "col-lg-4 col-md-4 col-sm-6 col-xs-6",
    "col-lg-4 col-md-4 col-sm-6 hidden-sm hidden-xs"
);
?>

<script type="text/javascript">
    var w, h, className;
    function getSrceenWH() {
        w = $(window).width();
        h = $(window).height();
        $('#dialogBg').width(w).height(h);
    }

    window.onresize = function () {
        getSrceenWH();
    }
    $(window).resize();

    $(function () {
        getSrceenWH();


        $('.box a').click(function () {
            className = $(this).attr('class');
            $('#dialogBg').fadeIn(300);
            $('#dialog').removeAttr('class').addClass('animated ' + className + '').fadeIn();
        });


        $('.claseDialogBtn').click(function () {
            $('#dialogBg').fadeOut(300, function () {
                $('#dialog').addClass('bounceOutUp').fadeOut();
            });
        });
    });
</script>

<!-- Hot activities MUST be shown here!  -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs">
            <div id="carousel-299058" class="carousel slide">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-299058" data-slide-to="0" class=""></li>
                    <li data-target="#carousel-299058" data-slide-to="1" class="active"></li>
                    <li data-target="#carousel-299058" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item">
                        <img class="img-responsive"
                             src="<?php echo base_url($hot_activity[$hot_activity_count]['poster']); ?>"
                             alt="thumb">
                        <div class="carousel-caption"><?php echo $hot_activity[$hot_activity_count]['name'];
                            $hot_activity_count++; ?></div>
                    </div>
                    <div class="item active">
                        <img class="img-responsive"
                             src="<?php echo base_url($hot_activity[$hot_activity_count]['poster']); ?>"
                             alt="thumb">
                        <div class="carousel-caption"><?php echo $hot_activity[$hot_activity_count]['name'];
                            $hot_activity_count++; ?></div>
                    </div>
                    <div class="item">
                        <img class="img-responsive"
                             src="<?php echo base_url($hot_activity[$hot_activity_count]['poster']); ?>"
                             alt="thumb">
                        <div class="carousel-caption"><?php echo $hot_activity[$hot_activity_count]['name'];
                            $hot_activity_count++; ?></div>
                    </div>
                </div>
                <?php $hot_activity_count = 0; ?>
                <a class="left carousel-control" href="#carousel-299058" data-slide="prev"><span
                        class="icon-prev"></span></a> <a class="right carousel-control" href="#carousel-299058"
                                                         data-slide="next"><span class="icon-next"></span></a></div>
        </div>
    </div>
    <hr>
</div>

<!-- Recommended activities are shown here! -->
<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div>
                <div class="box">
                    <div class="demo">
                        <h3 style="float: left;">推荐活动</h3>
                        <a class="bounceIn" href="javascript:;">请选择兴趣爱好</a>
                    </div>
                    <div id="dialogBg"></div>
                    <div id="dialog" class="animated">
                        <img class="dialogIco" width="50" height="50" src="img/ico.png" alt=""/>
                        <div class="dialogTop">
                            <a href="javascript:;" class="claseDialogBtn" style=" text-decoration: none;color: black;">关闭</a>
                        </div>
                        <form action="" method="post" id="editForm">
                            <p class="editInfos">
                                <label for="checkbox1">娱乐</label>
                                <input type="checkbox" name="checkbox1" id="checkbox1">
                                <label for="checkbox2">体育</label>
                                <input type="checkbox" name="checkbox2" id="checkbox2">
                                <label for="checkbox3">科技</label>
                                <input type="checkbox" name="checkbox3" id="checkbox3">
                            </p>
                            <p class="button">
                                <input type="submit" value="确定" class="submitBtn">
                            </p>

                        </form>
                    </div>
                </div>

                <br>
                <!--
                <div>
                    <p>选择标签：</p>
                    <form method="post" action="#">
                        <input type="submit" value="娱乐">
                        <input type="submit" value="体育">
                        <input type="submit" value="科技">

                    </form>
                    <br>
                </div>
            -->
            </div>
            <?php foreach ($recommended_activity as $single_activity) :
                if ($recommended_activity_count % 3 == 0): ?>
                    <div class="row">
                <?php endif; ?>
                <div class="<?php echo $class_array[$recommended_activity_count]; ?>">
                    <div class="thumbnail">
                        <a href="<?php echo site_url("activity_detail/index/" . $single_activity["id"]) ?>">
                            <!-- 图片的路径未修改 应当修改-->
                            <img src="img/400X200.gif" alt="Thumbnail Image 1"
                                 class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block"
                               href="<?php echo site_url("activity_detail/index/" . $single_activity["id"]) ?>">
                                <h3 class="hd_title"><?php echo $single_activity["name"]; ?></h3>
                            </a>
                            <hr>
                            <!-- 此处应放什么时间？ -->
                            <p>
                                <i class="icon-time icon-large"></i><?php echo $single_activity["time_expire"]; ?>
                            </p>
                            <p>
                                <i class="icon-map-marker icon-large"></i><?php echo $single_activity["place"]; ?>
                            </p>

                        </div>
                    </div>
                </div>
                <?php $recommended_activity_count++;
                if ($recommended_activity_count % 3 == 0): ?>
                    </div>
                <?php endif;
            endforeach;
            if ($recommended_activity_count % 3 != 0) : ?>
        </div>
        <?php endif; ?>
        <!-- 推荐的活动在此处结束 -->

        <!--
        <hr>
        <div>
            <div>
                <h3>热门活动</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail">
                        <a href="html/details_page.html"><img src="img/400X200.gif" alt="Thumbnail Image 1"
                                                              class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block" href="html/details_page.html">
                                <h3 class="hd_title">华东师范大学第二届创新创业大赛</h3>
                            </a>
                            <hr>
                            <p><i class="icon-time icon-large"></i>2016-11-23 13:00</p>
                            <p><i class="icon-map-marker icon-large"></i>华东师范大学</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail">
                        <a href="html/details_page.html"><img src="img/400X200.gif" alt="Thumbnail Image 1"
                                                              class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block" href="html/details_page.html">
                                <h3 class="hd_title">华东师范大学第二届创新创业大赛</h3>
                            </a>
                            <hr>
                            <p><i class="icon-time icon-large"></i>2016-11-23 13:00</p>
                            <p><i class="icon-map-marker icon-large"></i>华东师范大学</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 hidden-sm hidden-xs">
                    <div class="thumbnail">
                        <a href="html/details_page.html"><img src="img/400X200.gif" alt="Thumbnail Image 1"
                                                              class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block" href="html/details_page.html">
                                <h3 class="hd_title">华东师范大学第二届创新创业大赛</h3>
                            </a>
                            <hr>
                            <p><i class="icon-time icon-large"></i>2016-11-23 13:00</p>
                            <p><i class="icon-map-marker icon-large"></i>华东师范大学</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail">
                        <a href="html/details_page.html"><img src="img/400X200.gif" alt="Thumbnail Image 1"
                                                              class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block" href="html/details_page.html">
                                <h3 class="hd_title">华东师范大学第二届创新创业大赛</h3>
                            </a>
                            <hr>
                            <p><i class="icon-time icon-large"></i>2016-11-23 13:00</p>
                            <p><i class="icon-map-marker icon-large"></i>华东师范大学</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail">
                        <a href="html/details_page.html"><img src="img/400X200.gif" alt="Thumbnail Image 1"
                                                              class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block" href="html/details_page.html">
                                <h3 class="hd_title">华东师范大学第二届创新创业大赛</h3>
                            </a>
                            <hr>
                            <p><i class="icon-time icon-large"></i>2016-11-23 13:00</p>
                            <p><i class="icon-map-marker icon-large"></i>华东师范大学</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs">
                    <div class="thumbnail">
                        <a href="html/details_page.html"><img src="img/400X200.gif" alt="Thumbnail Image 1"
                                                              class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block" href="html/details_page.html">
                                <h3 class="hd_title">华东师范大学第二届创新创业大赛</h3>
                            </a>
                            <hr>
                            <p><i class="icon-time icon-large"></i>2016-11-23 13:00</p>
                            <p><i class="icon-map-marker icon-large"></i>华东师范大学</p>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>

    <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
        <div class="messagebox">
            <div class="my_message">
                <p>我的消息</p>
            </div>
            <div class="my_message_hd">

                <p><i class="icon-calendar"></i>活动提醒<!--2016-11-23创新创业大赛--></p>
            </div>
            <div class="my_message_pl">
                <p><i class="icon-comments"></i>评论提醒</p>
            </div>
            <div class="my_message_yq">
                <p><i class="icon-user"></i>新的邀请</p>
            </div>
            <div class="my_message_sh">
                <p><i class="icon-ok-sign"></i>审核通过<!--您创建的2016-11-23创新创业大赛已审核通过--></p>
            </div>

        </div>
        <br>
        <div class="well">
            <div class="hot_hd">
                <p>热门活动</p>
            </div>

            <div class="hot_hd_content">

                <div class="content_li">
                    <div class="li_left">
                        <a href="#"><img src="img/01.png" alt="" width="70px" height="70px"></a>
                    </div>
                    <div class="li_right">
                        <a class="li_right_title" href="#"><h5>校运会</h5></a>
                        <p>2016-11-2 9:00</p>
                    </div>
                </div>


                <div class="content_li">
                    <div class="li_left">
                        <a href="#"><img src="img/01.png" alt="" width="70px" height="70px"></a>
                    </div>
                    <div class="li_right">
                        <a class="li_right_title" href="#"><h5>华东师范大学第二届创新创业大赛</h5></a>
                        <p>2016-11-23 13:00</p>
                    </div>
                </div>


                <div class="content_li">
                    <div class="li_left">
                        <a href="#"><img src="img/01.png" alt="" width="70px" height="70px"></a>
                    </div>
                    <div class="li_right">
                        <a class="li_right_title" href="#"><h5>可怕的辅修</h5></a>
                        <p>2016-10-28 18:00</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>