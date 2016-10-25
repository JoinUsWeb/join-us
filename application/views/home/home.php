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

<!-- Hot activities MUST be shown here!  -->
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs">
            <div id="carousel-299058" class="carousel slide">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-299058" data-slide-to="0" class=""></li>
                    <li data-target="#carousel-299058" data-slide-to="1" class="active"></li>
                    <li data-target="#carousel-299058" data-slide-to="2" class=""></li>
                </ol>
                <!--<div class="carousel-inner">
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
                </div>-->
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
                        <a href="<?php echo site_url("activity_detail/" . $single_activity["id"]) ?>">
                            <!-- 图片的路径未修改 应当修改-->
                            <img src="img/400X200.gif" alt="Thumbnail Image 1"
                                 class="img-responsive"></a>
                        <div class="caption">
                            <a class="hd_title_block"
                               href="<?php echo site_url("activity_detail/" . $single_activity["id"]) ?>">
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
        </div>

    </div>

    <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
        <div class="well">
            <h3 class="text-center">我的消息</h3>
            <hr>
            <div>
                <ul>
                    <li>
                        <img src="" alt="photo">
                        <p>交作品</p><br>
                        <p>时间：2016-11-7</p><br>
                    </li>
                    <li>
                        <img src="" alt="photo">
                        <p>交作品</p><br>
                        <p>时间：2016-11-7</p><br>
                    </li>
                    <li>
                        <img src="" alt="photo">
                        <p>交作品</p><br>
                        <p>时间：2016-11-7</p><br>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="well">
            <h3 class="text-center">热门活动</h3>
            <hr>
            <div>
                <ul>
                    <li>
                        <img src="" alt="photo">
                        <p>院运会</p>
                    </li>
                    <li>
                        <a href="html/details_page.html">
                            <img src="" alt="photo">
                            <p>创新创业大赛</p>
                        </a>

                    </li>
                    <li>
                        <img src="" alt="photo">
                        <p>可怕的辅修</p>
                    </li>
                </ul>
            </div>
        </div>

    </div>


</div>
</div>


<hr>
<div class="container well">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-lg-4 col-md-4"> <span class="text-right">
		</span>
            <h3>About Us</h3>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, consequatur neque exercitationem
                distinctio esse! Cupiditate doloribus a consequatur iusto illum eos facere vel iste iure maxime.
                Velit,
                rem, sunt obcaecati eveniet id nemo molestiae. In.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, consequatur neque exercitationem
                distinctio esse! Cupiditate doloribus a consequatur iusto illum eos facere vel iste iure maxime.
                Velit,
                rem, sunt obcaecati eveniet id nemo molestiae. In.</p>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-4 col-md-4 hidden-sm hidden-xs"><span class="text-right"> </span>
            <h3>Latest News</h3>
            <hr>
            <div class="media-object-default">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">Heading 1</h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, quod temporibus
                        veniam
                        deserunt deleniti accusamus voluptatibus at illo sunt quisquam.
                    </div>
                    <div class="media-right"><a href="#"> <img class="media-object" src="img/75X.gif"
                                                               alt="placeholder image"></a></div>
                </div>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">Heading 2</h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, iure nemo earum quae
                        aliquid
                        animi eligendi rerum rem porro facilis.
                    </div>
                    <div class="media-right"><a href="#"> <img class="media-object" src="img/75X.gif"
                                                               alt="placeholder image"></a></div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-4 col-md-4"><span class="text-right"> </span>
            <h3>Contact Us</h3>
            <hr>

            <address>
                <strong>MyStoreFront, Inc.</strong><br>
                Indian Treasure Link<br>
                Quitman, WA, 99110-0219<br>
                <abbr title="Phone">P:</abbr> (123) 456-7890
            </address>

            <address>
                <strong>Full Name</strong><br>
                <a href="mailto:#">first.last@example.com</a>
            </address>
        </div>
    </div>
</div>