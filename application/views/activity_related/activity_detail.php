<div class="content_head">
    <div class="content_head_l">
        <img src="
            <?php
                echo base_url($activity['poster']);
            ?>
        " alt="海报无法显示">
    </div>

    <div class="content_head_r">
        <div class="detail_title">
            <h2>
                <?php
                    echo $activity['name'];
                ?>
            </h2>
        </div>

        <div class="detail_time">
            <div class="detail_time_start">
                <div class="title_txt">活动开始时间： </div>
                <p>
                    <?php
                        echo $activity['time_start'];
                    ?>
                </p>
            </div>
            <div class="detail_time_close">
                <div class="title_txt">截止报名时间： </div>
                <p>
                    <?php
                        echo $activity['time_expire'];
                    ?>
                </p>
            </div>
        </div>

        <div class="detail_place">
            <div class="title_txt">地点：</div>
            <p>
                <?php
                    echo $activity['place'];
                ?>
            </p>
        </div>

        <div id="detail_joinnum" class="detail_joinnum" ms-controller="detail_join_party_list_controller">
            <div class="detail_joinnum_t">
                <div class="title_txt">报名人数： </div>
                <p class="num">已有
                    <span>
                        <?php
                            echo $activity['member_number'];
                        ?>
                    </span>人报名</p>
            </div>
            <div class="detail_joinnum_b">
                <p>限<span>
                        <?php
                            echo $activity['amount_max'];
                        ?>
                    </span>人报名</p>
            </div>
        </div>

        <div class="detail_description">
            <div class="title_txt">活动详情： </div>
            <p>
            <?php
                echo $activity['brief'];
            ?>
            </p>
        </div>

        <div>
            <form action="
                <?php
                    echo '/index.php/';
                ?>
            " method="post">
                <input type="submit" id="apply" value="我要报名">
            </form>
        </div>
    </div>
</div>