<?php
$flag=0;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs">
            <div id="carousel-299058" class="carousel slide">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-299058" data-slide-to="0" class=""> </li>
                    <li data-target="#carousel-299058" data-slide-to="1" class="active"> </li>
                    <li data-target="#carousel-299058" data-slide-to="2" class=""> </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item"> <img class="img-responsive" src="img/1920x500.gif" alt="thumb">
                        <div class="carousel-caption"> Carousel caption. Here goes slide description. Lorem ipsum dolor set amet. </div>
                    </div>
                    <div class="item active"> <img class="img-responsive" src="img/1920x500.gif" alt="thumb">
                        <div class="carousel-caption"> Carousel caption 2. Here goes slide description. Lorem ipsum dolor set amet. </div>
                    </div>
                    <div class="item"> <img class="img-responsive" src="img/1920x500.gif" alt="thumb">
                        <div class="carousel-caption"> Carousel caption 3. Here goes slide description. Lorem ipsum dolor set amet. </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-299058" data-slide="prev"><span class="icon-prev"></span></a> <a class="right carousel-control" href="#carousel-299058" data-slide="next"><span class="icon-next"></span></a></div>
        </div>
    </div>
    <hr>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail"> <img src="<?php echo $recommended_activity[$flag]['poster']; ?>" alt="图片显示错误" class="img-responsive">
                        <div class="caption">
                            <?php echo $recommended_activity[$flag]['name']; ?>
                            <h3><?php echo $recommended_activity[$flag]['name']; ?></h3>
                            <p><?php echo $recommended_activity[$flag]['brief']; ?></p>
                            <hr>
                            <p class="text-center"><a href="http://localhost/index.php/activity_detail/<?php echo $recommended_activity[0]['id']; ?>" class="btn btn-success" role="button">查看详情</a></p>
                        </div>
                    </div>
                    <?php $flag++;?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail"> <img src="<?php echo $recommended_activity[$flag]['poster']; ?>" alt="图片显示错误" class="img-responsive">
                        <div class="caption">
                            <?php echo $recommended_activity[$flag]['name']; ?>
                            <h3><?php echo $recommended_activity[$flag]['name']; ?></h3>
                            <p><?php echo $recommended_activity[$flag]['brief']; ?></p>
                            <hr>
                            <p class="text-center"><a href="http://localhost/index.php/activity_detail/<?php echo $recommended_activity[0]['id']; ?>" class="btn btn-success" role="button">查看详情</a></p>
                        </div>
                    </div>
                    <?php $flag++;?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 hidden-sm hidden-xs">
                    <div class="thumbnail"> <img src="<?php echo $recommended_activity[$flag]['poster']; ?>" alt="图片显示错误" class="img-responsive">
                        <div class="caption">
                            <?php echo $recommended_activity[$flag]['name']; ?>
                            <h3><?php echo $recommended_activity[$flag]['name']; ?></h3>
                            <p><?php echo $recommended_activity[$flag]['brief']; ?></p>
                            <hr>
                            <p class="text-center"><a href="http://localhost/index.php/activity_detail/<?php echo $recommended_activity[0]['id']; ?>" class="btn btn-success" role="button">查看详情</a></p>
                        </div>
                    </div>
                    <?php $flag++;?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail"> <img src="<?php echo $recommended_activity[$flag]['poster']; ?>" alt="图片显示错误" class="img-responsive">
                        <div class="caption">
                            <?php echo $recommended_activity[$flag]['name']; ?>
                            <h3><?php echo $recommended_activity[$flag]['name']; ?></h3>
                            <p><?php echo $recommended_activity[$flag]['brief']; ?></p>
                            <hr>
                            <p class="text-center"><a href="http://localhost/index.php/activity_detail/<?php echo $recommended_activity[0]['id']; ?>" class="btn btn-success" role="button">查看详情</a></p>
                        </div>
                    </div>
                    <?php $flag++;?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="thumbnail"> <img src="<?php echo $recommended_activity[$flag]['poster']; ?>" alt="图片显示错误" class="img-responsive">
                        <div class="caption">
                            <?php echo $recommended_activity[$flag]['name']; ?>
                            <h3><?php echo $recommended_activity[$flag]['name']; ?></h3>
                            <p><?php echo $recommended_activity[$flag]['brief']; ?></p>
                            <hr>
                            <p class="text-center"><a href="http://localhost/index.php/activity_detail/<?php echo $recommended_activity[0]['id']; ?>" class="btn btn-success" role="button">查看详情</a></p>
                        </div>
                    </div>
                    <?php $flag++;?>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs">
                    <div class="thumbnail"> <img src="<?php echo $recommended_activity[$flag]['poster']; ?>" alt="图片显示错误" class="img-responsive">
                        <div class="caption">
                            <?php echo $recommended_activity[$flag]['name']; ?>
                            <h3><?php echo $recommended_activity[$flag]['name']; ?></h3>
                            <p><?php echo $recommended_activity[$flag]['brief']; ?></p>
                            <hr>
                            <p class="text-center"><a href="http://localhost/index.php/activity_detail/<?php echo $recommended_activity[0]['id']; ?>" class="btn btn-success" role="button">查看详情</a></p>
                        </div>
                    </div>
                    <?php $flag++;?>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
            <div class="well">
                <h3 class="text-center">我的消息</h3>

            </div>
            <hr>
            <div class="well">
                <h3 class="text-center">热门活动</h3>
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
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, consequatur neque exercitationem distinctio esse! Cupiditate doloribus a consequatur iusto illum eos facere vel iste iure maxime. Velit, rem, sunt obcaecati eveniet id nemo molestiae. In.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, consequatur neque exercitationem distinctio esse! Cupiditate doloribus a consequatur iusto illum eos facere vel iste iure maxime. Velit, rem, sunt obcaecati eveniet id nemo molestiae. In.</p>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-4 col-md-4 hidden-sm hidden-xs"> <span class="text-right"> </span>
            <h3>Latest News</h3>
            <hr>
            <div class="media-object-default">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">Heading 1</h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, quod temporibus veniam deserunt deleniti accusamus voluptatibus at illo sunt quisquam. </div>
                    <div class="media-right"> <a href="#"> <img class="media-object" src="img/75X.gif" alt="placeholder image"></a></div>
                </div>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">Heading 2</h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, iure nemo earum quae aliquid animi eligendi rerum rem porro facilis.</div>
                    <div class="media-right"> <a href="#"> <img class="media-object" src="img/75X.gif" alt="placeholder image"></a></div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-4 col-md-4"> <span class="text-right"> </span>
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
<footer class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Copyright © MyWebsite. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>