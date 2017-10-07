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
            $('#dialog_add').removeAttr('class').addClass('animated ' + className + '').fadeIn();
        });


        $('.claseDialogBtn').click(function () {
            $('#dialogBg').fadeOut(300, function () {
                $('#dialog_add').addClass('bounceOutUp').fadeOut();
            });
        });
    });
</script>

<div class="container">
    <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs">
            <div class="xxxx">
                <div class="content_head_l">
                    <img src="
                    <?php echo base_url($activity['poster']); ?>" alt="海报海报photo">
                </div>

                <div class="content_head_r">
                    <div class="detail_title">
                        <h2>
                            <?php
                            echo $activity['name'];
                            ?>
                        </h2>
                    </div>
                    <hr>

                    <div id="detail_block">
                        <div class="detail">
                            <div class="title_txt">开始时间：<span>
                                    <?php
                                    echo $activity['activity_start'];
                                    ?>
                                </span></div>

                        </div>
                        <div class="detail">
                            <div class="title_txt">截止报名时间：<span>
                                    <?php
                                    echo $activity['apply_expire'];
                                    ?>
                                </span></div>
                        </div>


                        <div class="detail">
                            <div class="title_txt">地点：<span>
                             <?php
                             echo $activity['place'];
                             ?>
                            </span></div>
                        </div>
                        <div id="detail_joinnum" class="detail" ms-controller="detail_join_party_list_controller">

                            <div class="title_txt">报名人数：<span class="num">已有
                                    <?php
                                    echo $activity['member_number'];
                                    ?>
                                    人报名</span>
                                <span id="limit_num">限
                                    <?php
                                    echo $activity['amount_max'];
                                    ?>
                                    人报名</span></div>
                        </div>

                        <?php
                        if ($is_creator) { ?>
                            <form action="
                            <?php
                            echo site_url('activity_detail/end/' . $activity['id']);
                            ?>" method="post">
                                <p class="center">
                                    <input type="submit" id="apply" value="结束活动">
                                </p>
                            </form>
                        <?php } else if ($is_joined) { ?>
                            <form action="
                            <?php
                            echo site_url('activity_detail/quit/' . $activity['id'] . '/' . $isRecommended);
                            ?>" method="post">
                                <p class="center">
                                    <input type="submit" id="apply" value="退出活动">
                                </p>
                            </form>
                        <?php } else if ($activity['member_number'] >= $activity['amount_max'])
                            echo '<p>报名人数已满</p>';
                        else { ?>
                            <form action="
                            <?php
                            if (isset($this->session->user_id))
                                echo site_url('activity_detail/enter/' . $activity['id'] . '/' . $isRecommended);
                            else
                                echo site_url('login/index');
                            ?>" method="post">
                                <p class="center">
                                    <input type="submit" id="apply" value="我要报名">
                                </p>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="detail_description">
                <div class="hdxq">
                    <div class="information"><p>活动详情</p></div>
                    <div class="context"><p>
                            <?php
                            echo $activity['brief'];
                            ?>
                        </p></div>
                </div>

                <div class="cyyh">
                    <div class="information"><p>参与用户</p></div>
                    <div class="context">

                        <ul class="member_review_list">
                            <?php
                            $count = 0;
                            foreach ($member as $member_item) {
                                $count = ($count + 1) % 8; ?>
                                <li class="member_review_main">
                                    <div class="member_review_person">
                                        <div class="person_headphoto">
                                            <a href="html/details_page.html"><img src="
                                                    <?php
                                                echo base_url($member_item['avatar']);
                                                ?>" alt="" width="70px" height="70px"></a>
                                        </div>
                                        <div class="person_id_name">
                                            <a href="html/details_page.html">
                                                <h5>
                                                    <?php
                                                    echo $member_item['nick_name'];
                                                    ?>
                                                </h5></a>
                                        </div>
                                    </div>
                                </li>
                                <?php if ($count == 0) echo '<br/>';
                            } ?>


                            <li>
                                <div class="box">
                                    <div class="demo">
                                        <div class="add_member"><a class="bounceIn" href="javascript:;">
                                                <i class="icon-plus-sign icon-5x"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="dialogBg"></div>
                                    <div id="dialog_add" class="animated">
                                        <img class="dialogIco" width="50" height="50"
                                             src="<?php echo base_url('img/ico.png') ?>" alt=""/>
                                        <div class="dialogTop">
                                            <a href="javascript:;" class="claseDialogBtn"
                                               style=" text-decoration: none;color: black;">关闭</a>
                                        </div>
                                        <form action="" method="post" id="editForm">

                                            <ul class="friends_list">
                                                <li><label for="checkbox1">用户1</label>
                                                    <input type="checkbox" name="" id="checkbox1"></li>
                                                <li><label for="checkbox2">用户2</label>
                                                    <input type="checkbox" name="" id="checkbox2"></li>
                                                <li><label for="checkbox2">用户3</label>
                                                    <input type="checkbox" name="" id="checkbox2"></li>
                                                <li><label for="checkbox2">用户4</label>
                                                    <input type="checkbox" name="" id="checkbox2"></li>
                                                <li><label for="checkbox2">用户5</label>
                                                    <input type="checkbox" name="" id="checkbox2"></li>
                                                <li><label for="checkbox2">用户6</label>
                                                    <input type="checkbox" name="" id="checkbox2"></li>
                                            </ul>


                                            <p class="button_invite">
                                                <input type="submit" value="发送邀请" class="submitBtn">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li style="clear: both"></li>

                        </ul>
                    </div>
                </div>

                <div class="hdxq">
                    <div class="information"><p>用户评论</p></div>
                    <div class="context">
                        <div class="pinglun">
                            <div class="comment_left">
                                <img src="<?php echo base_url('img/IMG_1035.jpg') ?>" alt="" width="70px" height="70px"
                                     class="member_review_main">
                            </div>
                            <div class="comment_right">
                                <textarea name="comment" id="yh_comments" placeholder="来说两句吧~"
                                          style="resize:none"></textarea>
                                <div class="submit_comment">
                                    <input type="button" id="submit_comment" value="发表评论">
                                </div>
                            </div>
                        </div>


                        <?php
                        if (empty($comment))
                            echo '暂时没有评论';
                        else
                            foreach ($comment as $comment_item) {
                                ?>
                                <div class="comments">
                                    <div>
                                        <div class="comment_left">
                                            <img src="<?php echo base_url($comment_item['creator']['avatar']); ?>"
                                                 alt="头像无法显示" width="60px" height="60px" class="comment_left_img">
                                        </div>
                                        <div class="comment_right">
                                            <div class="comment_right_name"><h5>
                                                    <?php echo $comment_item['creator']['nick_name'] ?></h5></div>
                                            <div class="comment_right_time"><h5>
                                                    <?php echo $comment_item['date_time']; ?>
                                                    发表</h5></div>
                                        </div>
                                    </div>

                                    <div class="comment_frame"><p>
                                            <?php
                                            echo $comment_item['content'];
                                            ?>
                                        </p></div>
                                </div>
                                <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <!--<div class="sidebar">-->
        <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
            <div class="changeheight"></div>
            <div class="sidebar_hot">
                <div class="well">
                    <div class="hot_hd">
                        <p>热门活动</p>
                    </div>
                    <div class="hot_hd_content">
                        <?php
                        if (!empty($hot_activity))
                            foreach ($hot_activity as $hot_activity_item) :
                                if (!empty($hot_activity_item)):?>

                                <div class="content_li">
                                    <div class="li_left">
                                        <a href="<?php echo site_url("activity_detail/index/" . $hot_activity_item["id"]) ?>">
                                            <img src="<?php echo base_url($hot_activity_item['poster']) ?>" alt=""
                                                 width="60px" height="60px"></a>
                                    </div>
                                    <div class="li_right">
                                        <a class="li_right_title"
                                           href="<?php echo site_url("activity_detail/index/" . $hot_activity_item["id"]) ?>">
                                            <h5>
                                                <?php
                                                echo $hot_activity_item['name'];
                                                ?>
                                            </h5></a>
                                        <p><?php
                                            echo $hot_activity_item['activity_start'];
                                            ?></p>
                                    </div>
                                </div>
                            <?php endif;
                            endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url("js/stickUp.min.js") ?>"></script>
<script type="text/javascript">
    //initiating jQuery
    jQuery(function ($) {
        $(document).ready(function () {
            //enabling stickUp on the '.navbar-wrapper' class
            $('.sidebar_hot').stickUp({
                topMargin: '70px'
            });
        });
    });

    $("#submit_comment").click(function () {
        var comment = $("#yh_comments").val();
        $.ajax({
            type: "post",
            url: '<?php echo site_url("activity_detail/comment_check"); ?>',
            data: {'comment': comment, 'activity_id': <?php echo $activity['id']; ?>},
            success: function () {
                location.reload(true);
            }
        });
    })

</script>