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

<!--个人中心导航栏-->
<div class="container">
    <div class="main">
        <div class="side">
            <?php echo $nav; ?>
        </div>
        <!--个人中心导航栏-->
        <!--个人中心主页-->
        <div>
            <div class="group_gg personal-data">
                <h3>小组公告</h3>
                <hr>
                <div class="gg_present">11月9日英美文化体验前九周期末考试！？！<br>
                    11月9日英美文化体验前九周期末考试！？！<br>
                    11月9日英美文化体验前九周期末考试！？！
                </div>

                <!--小组组长可见（修改公告）
      <form action="#" method="post" class="gg_review_main">
      <textarea name="g_notice" id="g_notice" placeholder="请填写公告" resize: none;></textarea>
      <div class="submit_comment">
        <input type="submit" id="submit_comment" value="张贴公告">
      </div>
    </form>-->

            </div>
            <div class="group_member personal-data">
                <h3>小组成员</h3>
                <hr>
                <ul class="member_review_list">
                    <li class="member_review_main">
                        <div class="member_review_person">
                            <div class="person_headphoto">
                                <a href="#"><img src="<?php echo base_url("img/adobe.png") ?>" alt="" width="70px"
                                                 height="70px"></a>
                            </div>
                            <div class="person_id_name">
                                <a href="#"><h5>金鑫</h5></a>
                            </div>
                        </div>
                    </li>

                    <li class="member_review_main">
                        <div class="member_review_person">
                            <div class="person_headphoto">
                                <a href="#"><img src="<?php echo base_url("img/adobe.png") ?>" alt="" width="70px"
                                                 height="70px"></a>
                            </div>
                            <div class="person_id_name">
                                <a href="#"><h5>金鑫</h5></a>
                            </div>
                        </div>
                    </li>

                    <li class="member_review_main">
                        <div class="member_review_person">
                            <div class="person_headphoto">
                                <a href="#"><img src="<?php echo base_url("img/adobe.png") ?>" alt="" width="70px"
                                                 height="70px"></a>
                            </div>
                            <div class="person_id_name">
                                <a href="#"><h5>金鑫</h5></a>
                            </div>
                        </div>
                    </li>
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
                                        <li><label for="checkbox1">小石榴</label>
                                            <input type="checkbox" name="" id="checkbox1"></li>
                                        <li><label for="checkbox2">小石榴</label>
                                            <input type="checkbox" name="" id="checkbox2"></li>
                                        <li><label for="checkbox2">小石榴</label>
                                            <input type="checkbox" name="" id="checkbox2"></li>
                                        <li><label for="checkbox2">小石榴</label>
                                            <input type="checkbox" name="" id="checkbox2"></li>
                                        <li><label for="checkbox2">小石榴</label>
                                            <input type="checkbox" name="" id="checkbox2"></li>
                                        <li><label for="checkbox2">小石榴</label>
                                            <input type="checkbox" name="" id="checkbox2"></li>
                                    </ul>


                                    <p class="button_invite">
                                        <input type="submit" value="发送邀请" class="submitBtn">
                                    </p>
                                </form>
                            </div>
                        </div>

                    </li>


                </ul>
            </div>

        </div>
        <div style="clear:both"></div>
    </div>
    <!--个人中心主页-->
    <!-- /container -->
    <script src="<?php echo base_url("js/ytmenu.js") ?>"></script>

    <div class="Clear"><!-- 清除浮动 --></div>
</div>
