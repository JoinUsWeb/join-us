<script type="text/javascript">
    var w, h, className;
    function getSrceenWH() {
        w = $(window).width();
        h = $(window).height();
        $('#dialogBg').width(w).height(h);
    }

    window.onresize = function () {
        getSrceenWH();
    };
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
                    <?php $num = count($hot_activity);
                    for ($count = 0; $count < $num; $count++) : ?>
                        <div class="<?php echo $count == 1 ? "item active" : "item"; ?>">
                            <a href="<?php echo site_url("activity_detail/index/" . $hot_activity[$count]["id"]); ?>">
                                <img class="img-responsive"
                                     src="<?php
                                     echo base_url($hot_activity[$count]['poster']); ?>"
                                     alt="thumb">
                                <div class="carousel-caption"><?php echo $hot_activity[$count]['name']; ?></div>
                            </a>
                        </div>
                    <?php endfor; ?>
                </div>
                <a class="left carousel-control" href="#carousel-299058" data-slide="prev"><span
                            class="icon-prev"></span></a> <a class="right carousel-control" href="#carousel-299058"
                                                             data-slide="next"><span class="icon-next"></span></a></div>
        </div>
    </div>
    <hr>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div>
                <div class="box home_block">
                    <div class="demo">
                        <h3 style="float: left;">推荐活动</h3>
                        <?php if ($need_first_label) : ?>
                        <a class="bounceIn" href="javascript:;">请选择兴趣爱好</a>
                    </div>
                    <div id="dialogBg"></div>
                    <div id="dialog" class="animated">
                        <img class="dialogIco" width="50" height="50" src="<?php echo base_url('img/ico.png'); ?>"
                             alt=""/>
                        <div class="dialogTop">
                            <a href="javascript:;" class="claseDialogBtn" style=" text-decoration: none;color: black;">关闭</a>
                        </div>
                        <p class="editInfos">
                            <?php foreach ($all_first_label as $single_label) : ?>
                                <label for="<?php echo $single_label['id'] ?>">
                                    <?php echo $single_label['name'] ?>
                                </label>
                                <input type="checkbox" name="first_label[]"
                                       value="<?php echo $single_label['id'] ?>"
                                       id="<?php echo $single_label['id'] ?>">
                            <?php endforeach; ?>
                        </p>
                        <p class="button_choose">
                            <button id="select_label" class="submitBtn">确定</button>
                        </p>
                    </div>
                    <?php else : ?>
                </div>
                <?php endif; ?>
            </div>

            <br>

            <!-- 推荐的活动 -->
            <div class="content">
                <div class="wrap">
                    <div id="main" role="main">
                        <ul id="tiles">
                            <!-- <img src="img/400X200.gif" alt="Thumbnail Image 1" class="img-responsive">These are our grid blocks -->
                            <?php foreach ($recommended_activity as $single_activity) : ?>
                                <li>
                                    <a href="<?php echo site_url("activity_detail/index/" . $single_activity["id"]); ?>">
                                        <img src="<?php echo base_url($single_activity['poster']); ?>" width="200"
                                             height="200"></a>
                                    <div class="caption">
                                        <a class="hd_title_block"
                                           href="<?php echo site_url("activity_detail/index/" . $single_activity["id"]); ?>">
                                            <h3 class="hd_title"><?php echo $single_activity["name"]; ?></h3>
                                        </a>
                                        <hr>
                                        <p>
                                            <i class="icon-time icon-large"></i><?php echo $single_activity["apply_expire"]; ?>
                                        </p>
                                        <p>
                                            <i class="icon-map-marker icon-large"></i><?php echo $single_activity["place"]; ?>
                                        </p>

                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- 推荐的活动 -->

            <!--
            <?php if (!$need_first_label) : ?>
                <div id="page-navigation" class="hide clear">
                    <span class="disabled page-navigation-prev" title="上一页">«上一页</span>
                    <a href="?&p=1" data-target="page" data-page="1" class="cur">1</a>
                    <a href="?&p=2" data-target="page" data-page="2">2</a>
                    <a href="?&p=3" data-target="page" data-page="3">3</a>
                    <a href="?&p=4" data-target="page" data-page="4">4</a>
                    <a href="?&p=5" data-target="page" data-page="5">5</a>
                    <a href="?&p=6" data-target="page" data-page="6">6</a>
                    <a href="?&p=7" data-target="page" data-page="7">7</a>
                    <a href="?&p=8" data-target="page" data-page="8">8</a>
                    <a href="?&p=9" data-target="page" data-page="9">9</a>
                    <a href="?&p=10" data-target="page" data-page="10">10</a>
                    <a href="?&p=2" class="page-navigation-next" data-page="2" title="下一页">下一页»</a>
                </div>
            <?php endif; ?> -->

        </div>


    </div>

    <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
        <div class="messagebox">
            <div class="my_message">
                <p>我的消息</p>
            </div>
            <a href="<?php echo site_url("message/personal_mymessages"); ?>">
                <div class="my_message_hd">

                    <p><i class="icon-calendar"></i>活动提醒<!--2016-11-23创新创业大赛--></p>
                </div>
                <div class="my_message_pl">
                    <p><i class="icon-comments"></i>小组动态</p>
                </div>
                <div class="my_message_yq">
                    <p><i class="icon-user"></i>我的邀请</p>
                </div>
                <div class="my_message_sh">
                    <p><i class="icon-ok-sign"></i>审核通过</p>
                </div>
            </a>

        </div>
        <br>
        <div class="sidebar_hot">
            <div class="well">
                <div class="hot_hd">
                    <p>热门活动</p>
                </div>
                <div class="hot_hd_content">
                    <?php
                    if (!empty($hot_activity))
                        foreach ($hot_activity as $hot_activity_item) {
                            ?>
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
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url("js/jquery.imagesloaded.js") ?>"></script>
<script src="<?php echo base_url("js/jquery.wookmark.js") ?>"></script>
<script type="text/javascript">
    var count = 1;
    (function ($) {
        var $tiles = $('#tiles'),
            $handler = $('li', $tiles),
            $main = $('#main'),
            $window = $(window),
            $document = $(document),
            options = {
                autoResize: true, // This will auto-update the layout when the browser window is resized.
                container: $main, // Optional, used for some extra CSS styling
                offset: 20, // Optional, the distance between grid items
                itemWidth: 269 // Optional, the width of a grid item
            };

        /**
         * Reinitializes the wookmark handler after all images have loaded
         */
        function applyLayout() {
            $tiles.imagesLoaded(function () {
                // Destroy the old handler
                if ($handler.wookmarkInstance) {
                    $handler.wookmarkInstance.clear();
                }

                // Create a new layout handler.
                $handler = $('li', $tiles);
                $handler.wookmark(options);
            });
        }

        /**
         * When scrolled all the way to the bottom, add more tiles
         */
        /*   function($loading, isBeyondMaxPage) {
         if ( !isBeyondMaxPage ) {
         $loading.fadeOut();
         } else {
         $loading.hide();
         $('#page-navigation').show();
         }
         }
         */

        function onScroll() {

            // Check if we're within 100 pixels of the bottom edge of the broser window.
            var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
                closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

            if (closeToBottom) {
                // Get the first then items from the grid, clone them, and add them to the bottom of the grid
                count++;
                if (count > 1) {
                    return;
                }
                var $items = $('li', $tiles),
                    $firstTen = $items.slice(0, 10);
                $tiles.append($firstTen.clone());

                applyLayout();

            }

        }

        // Call the layout function for the first time
        applyLayout();

        // Capture scroll event.
        $window.bind('scroll.wookmark', onScroll);
    })(jQuery);
</script>
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

    $("#select_label").click(function () {
        var first_labels = new Array();
        $("input:checkbox").each(function () {
            if (this.checked == true)
                first_labels.push(this.value);
        });
        var user_id = '<?php echo $_SESSION['user_id']; ?>';
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('separated_info/select_first_label/'); ?>',
            data: {'first_label[]': first_labels, 'user_id': user_id},
            success: function () {
                location.reload(true);
            }
        });
        $('#dialogBg').fadeOut(300, function () {
            $('#dialog').addClass('bounceOutUp').fadeOut();
        });
    })

</script>