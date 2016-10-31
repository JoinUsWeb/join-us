<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>我的消息</title>
	<link rel="stylesheet" href="../../css/bootstrap.css">
	<link rel="stylesheet" href="../../css/personal.css">
	<link rel="stylesheet" href="../../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/default.css">
	<link rel="stylesheet" type="text/css" href="../../css/component.css">
	<script src="../../js/modernizr.custom.js"></script>
</head>

<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid"> 
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myInverseNavbar2"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="../index.html">Join Us</a> </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="myInverseNavbar2">
					<ul class="nav navbar-nav navbar-right">
						<li></li>
						<li><a href="searching.html">查找活动</a></li>
						<li><a href="create.html">创建活动</a></li>
						<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">地区 <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="details_page.html">上海</a></li>
							</ul>
						</li> 
						<li>
							<a id="login_p" href="login.html">登录</a>
						</li>
						<li><p>|</p></li>
						<li>    
						<a id="register_p" href="register.html">注册</a>
						</li>
					</ul>

          <!--
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">个人中心 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="html/personal_applied.html">我报名的</a></li>
            <li><a href="html/personal_joined.html">我参加的</a></li>
            <li><a href="html/personal_favorites.html">收藏</a></li>
            <li><a href="html/personal_comments.html">评论</a></li>
            <li class="divider"></li>
            <li><a href="#">关于我们</a></li>
          </ul>
        </li>
    -->

</div>
<!-- /.navbar-collapse --> 
</div>
<!-- /.container-fluid --> 
</nav>
<div style="height: 72px;"></div>
<!--个人中心导航栏-->
<div class="container">	
	<!-- <script src="../../js/adsense.js" type="text/javascript"></script> -->
	<div class="main">
		<div class="side">
			<nav class="dr-menu">
				<div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">我的主页</a></div>
				<ul>
					<li><a class="dr-icon dr-icon-user" href="../html/personal_data.html">个人信息</a></li>
					<li><a class="dr-icon dr-icon-camera" href="../html/personal_joined.html">已参加活动</a></li>
					<li><a class="dr-icon dr-icon-heart" href="../html/personal_applied.html">已报名活动</a></li>
					<li><a class="dr-icon dr-icon-bullhorn" href="../html/personal_comments.html">评价活动</a></li>
					<li><a class="dr-icon dr-icon-download" href="../html/personal_mymessages.html">我的消息</a></li>
					<li><a class="dr-icon dr-icon-settings" href="../html/personal_group.html">我的小组</a></li>
					<li><a class="dr-icon dr-icon-switch" href="#">退出登录</a></li>
				</ul>
			</nav>

		</div>
		<!--个人中心导航栏-->
		<!--个人中心主页-->

		<div class="per_message">

			<div class="per_message_block">
				<div class="per_message_title">
					<h5><i class="icon-calendar"></i>活动提醒</h5>
				</div>
				<div class="message_bar">
					<ul>
					<?php foreach ($activity_in_three_days as $row):?> 
						<li>您报名参加的 <?= $row['name']?> 将于 <?= $row['date_start'].' '.$row['time_start']?> 开始活动</li>
					<? endforeach;?>
					<?php foreach ($activity_in_a_week as $row):?> 
						<li>您组织的 <?= $row['name']?> 将于 <?= $row['date_start'].' '.$row['time_start']?> 开始活动</li>
					<? endforeach;?>
						<!-- <li>
							您报名参加的华东师范大学第二届创新创业大赛将于2016-11-23开始活动
						</li>
						<li>
							您报名参加的沉迷php研讨会已经结束，请前往评论！
						</li>
						<li>
							您报名参加的 新生汇演 有新公告啦！
						</li> -->
					</ul>
				</div>
			</div>

			<div class="per_message_block">
				<div class="per_message_title">
					<h5><i class="icon-comments"></i>小组动态</h5>
				</div>
				<div class="message_bar">
					<ul>
						<li>
							您所在的 吃瓜群众 小组更新了公告！
						</li>
						<li>
							
						</li>
						<li>
							您报名参加的华东师范大学第二届创新创业大赛将于2016-11-23开始活动
						</li>
					</ul>
				</div>
			</div>

			<div class="per_message_block">
				<div class="per_message_title">
					<h5><i class="icon-user"></i>我的邀请</h5>
				</div>
				<div class="message_bar">
					<ul>
						<?php foreach ($invitation as $row):?> 
							<li>您收到了一条来自 <?= $row['nick_name']?> 的活动邀请-<?= $row['name']?></li>
						<? endforeach;?>
					</ul>
				</div>
			</div>

			<div class="per_message_block">
				<div class="per_message_title">
					<h5><i class="icon-ok-sign"></i>审核通过</h5>
				</div>
				<div class="message_bar">
					<ul>
						<li>
							您创建的活动 华东师范大学第二届创新创业大赛 已通过审核！
						</li>
						<li>
							您创建的活动 夏雨艺苑万圣节party 已通过审核！
						</li>
						<li>
							
						</li>
					</ul>
				</div>
			</div>

		</div>




		<div style="clear:both"></div>
	</div>
	<!--个人中心主页-->
	<!-- /container -->
	<script src="../../js/ytmenu.js"></script>






	<div class="Clear"><!-- 清除浮动 --></div>
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
					<div class="media-right"> <a href="#"> <img class="media-object" src="../../img/75X.gif" alt="placeholder image"></a></div>
				</div>
				<div class="media">
					<div class="media-body">
						<h4 class="media-heading">Heading 2</h4>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, iure nemo earum quae aliquid animi eligendi rerum rem porro facilis.</div>
						<div class="media-right"> <a href="#"> <img class="media-object" src="../../img/75X.gif" alt="placeholder image"></a></div>
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
	<script src="../../js/jquery-1.11.2.min.js"></script> 
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="../../js/bootstrap.min.js"></script>
</body>    
</html>

