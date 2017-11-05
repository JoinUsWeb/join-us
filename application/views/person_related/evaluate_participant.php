        <?php if (!empty($members_info)):?>
        <table class="pd_rating" border="1">
            <tr>
                <th>用户昵称</th>
                <th>为其打分</th>
            </tr>
            <?php foreach ($members_info as $member_info):?>
            <tr>
                <td><?= $member_info['nick_name']?></td>
                <td>
                    <div class="rate_show">
                        <div class="rating comment"  style="vertical-align:middle"
                             data-member-id="<?=$member_info['id']?>" data-rank-selected="3">
                            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        <div class="comment_submit">
            <input type="button" value="提交评价" class="submit_button" onclick="commit()">
        </div>
        <?php endif;?>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('js/star_rate.js'); ?>"></script>
<script type="text/javascript">
    //initiating jQuery
    jQuery(function ($) {
        init_rating();
    });

    function init_rating() {
        // 找到所有 rating
        var rating = Array.prototype.slice.call(document.getElementsByClassName('rating'));
        rating.forEach(function (element) {
            // 遍历每个 rating ，选择每个 rating 下的 span
            var activityId = element.dataset.activityId;
            var spans = Array.prototype.slice.call(element.childNodes);
            spans.forEach(function (star, index) {
                // text 的 nodeType 是 3，去掉这些子节点
                if (star.nodeType != 3) {
                    star.setAttribute('rank', (6 - index).toString());
                    // 为每个星星添加 onclick
                    star.onclick = function () {
                        var temp = this;
                        // 将这个星星后的所有兄弟节点
                        while (temp) {
                            temp.classList.add('selected');
                            temp = temp.nextElementSibling;
                        }
                        // 这里也许需要满足一定条件才可以删除，以便用户修改
                        // 改变当前星星所对应的 rating 的 class，去掉变化效果
                        this.parentNode.classList.remove('rating');
                        this.parentNode.classList.add('rated');

                        // 删除当前星星所对应的 rating 的 onclick
                        delete_onclick(this);
                        this.parentNode.setAttribute('data-rank-selected',(6 - index).toString())
                    }
                }
            })
        });
    }

    function delete_onclick(element) {
        var children = Array.prototype.slice.call(element.parentNode.childNodes);
        children.forEach(function (element) {
            if (element.prototype != 3) {
                element.onclick = null;
            }
        })
    }


    function commit() {
        evaluate_list = [];
        comments = document.getElementsByClassName('comment');
        for( index = 0;index<comments.length;index++){
            evaluate_item = [];
            evaluate_item[0] = comments[index].getAttribute('data-member-id');
            evaluate_item[1] = comments[index].getAttribute('data-rank-selected');
            evaluate_list.push(evaluate_item);
        }
        data = [];
        data[0] = <?=$activity_id?>;
        data[1] = evaluate_list;
        data = JSON.stringify(data);
        $.post(
            "<?php echo site_url();?>" + "/activity_detail/evaluate_participant",
            {data:data}
        );
        window.location.href = "<?php echo site_url();?>" + "/user/activities/2";
    }
</script>