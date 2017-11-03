<div class="personal_cover">
    <img src="<?php echo base_url('img/back03.jpg');?>" alt="">
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-9 hidden-xs">
            <div class="personal_nav">
                <div class="personal_portrait">
                    <img alt="头像" src="<?php echo base_url($avatar); ?>">
                    <div class="p_show">
                        <ul>
                            <li><i class=" icon-user-md"></i>账号:
                                <ul class="p_present"><li><?php echo $email; ?></li></ul></li>
                            <li><i class="icon-info-sign"></i>昵称:
                                <ul class="p_present"><li><?php echo $nick_name; ?></li></ul></li>
                        </ul>
                    </div>

                </div>
                <div class="p_shows">
                    <nav class="p_rate_choice">
                        <ul>
                            <li class="special"><a class="special" href="#personal_xinyong">用户信用<span class="pipe">|</span></a></li>
                            <li><a class="special" href="#personal_pingfen">组织评分</a></li>
                        </ul>
                    </nav>
                    <div>
                        <section id="personal_xinyong" class="personal_credit">
                            <div class="p_rating">
                                <div class="p_score"><?php echo $leadership; ?></div>
                                <div class="p_star">
                                    <?php
                                    $star_string = '';
                                    for ($i = 0; $i < 5; $i++):
                                        if ($i < $leadership):
                                             $star_string .= '<span class="rate_show">☆</span>';
                                        else:
                                            $star_string .= '<span>☆</span>';
                                        endif;
                                    endfor;
                                    echo $star_string; ?>
                                </div>
                            </div>
                        </section>
                        <section id="personal_pingfen" class="personal_credit">
                            <div class="p_rating">
                                <div class="p_score"><?php echo $brownie_point;?></div>
                                <div class="p_star">
                                    <?php
                                    $star_string = '';
                                    for ($i = 0; $i < 5; $i++):
                                        if ($i < $leadership):
                                            $star_string .= '<span class="rate_show">☆</span>';
                                        else:
                                            $star_string .= '<span>☆</span>';
                                        endif;
                                    endfor;
                                    echo $star_string; ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="p_nav">
                    <ul>
                        <?php
                            $tags=array('个人信息','我的活动','我的小组','我的消息');
                            $tag_index=0;
                            switch ($tag){
                                case 'info':
                                    $tag_index=0;break;
                                case 'activities':
                                    $tag_index=1;break;
                                case 'group':
                                case 'group_detail':
                                    $tag_index=2;break;
                                case 'message':
                                    $tag_index=3;break;
                            }
                            $tags[$tag_index]='<p>'.$tags[$tag_index].'</p>';
                        ?>
                        <li><a class="thisover" href="<?php echo site_url('user/info'); ?>"><?php echo $tags[0];?></a></li>
                        <li><a class="thisover" href="<?php echo site_url('user/activities'); ?>"><?php echo $tags[1];?></a></li>
                        <li><a class="thisover" href="<?php echo site_url('user/group'); ?>"><?php echo $tags[2];?></a></li>
                        <li><a class="thisover" href="<?php echo site_url('message/personal_mymessages'); ?>"><?php echo $tags[3];?></a></li>
                        <li><a></a></li>
                    </ul>
                    <h2 class="page_title"></h2>
                </div>
            </div>
            <script>
                /*把相应section的id和用户点击的导航栏href值比较，改变各个section的display属性*/
                function showSection(id) {
                    var sections = document.getElementsByTagName("section");
                    for(var i=0;i<sections.length;i++) {
                        if(sections[i].getAttribute("id") != id) {
                            sections[i].style.display = "none";
                        }else {
                            sections[i].style.display = "block";
                        }
                    }
                }
                /*把导航栏href和用户点击href比较，改变相应元素的父元素的className*/
                function changeColor(id) {
                    var navs = document.getElementsByTagName("nav");
                    var links = navs[1].getElementsByTagName("a");
                    for (var i = 0; i <links.length; i++) {
                        var sectionId = links[i].getAttribute("href").split("#")[1];
                        if(sectionId == id){
                            links[i].parentNode.className = "special";
                        }else {
                            links[i].parentNode.className = "";
                        }
                    }
                }
                function getId() {
                    var navs = document.getElementsByTagName("nav");
                    var links = navs[1].getElementsByTagName("a");
                    for (var i = 0; i <links.length; i++) {
                        //获取导航栏的href值
                        var secId = links[i].getAttribute("href").split("#")[1];
                        if (!document.getElementById(secId)) continue;
                        //设置最初的演示
                        document.getElementById(secId).style.display = "none";
                        document.getElementById("personal_xinyong").style.display = "block";
                        /*这里存在作用域问题，secId是个局部变量，它在getId函数执行期间存在，
                        到时间处理函数执行的时候就不存在了，故在这里为每个链接创建了一个自定义的属性destination*/
                        links[i].destination = secId;
                        links[i].onclick = function() {
                            showSection(this.destination);
                            changeColor(this.destination);
                            return false;
                        }

                    };
                }

                window.onload = function(){
                    getId();
                }
            </script>