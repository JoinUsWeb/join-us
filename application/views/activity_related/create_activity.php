<div class="container">
    <?php echo $error ?>
    <?php echo form_open_multipart('create_activity', array('id' => 'create_hd')); ?>
    <ul>
        <li>
            <label for="hd_topic" class="label_style">活动主题</label>
            <input type="text" id="hd_topic" name="name" value="<?php echo $isQuoted ? $quoted['name'] : set_value('name'); ?>" onblur="check_topic()"
                   placeholder="请输入活动主题">
            <br>
            <div id="topic_error"><?php echo form_error('name'); ?></div>
        </li>
        <li>
            <label for="hd_poster" class="label_style">活动海报</label>
            <div id="posterImg">
                <!--<img src="<?php echo base_url('/img/posterImg.png') ?>" alt="这是一张海报"> -->
            </div>
            <div id="create_button">
                <input type="file" id="hd_poster" name="poster">
            </div>
            <br>
            <div id="poster_error"><?php echo form_error('poster'); ?></div>
        </li>
        <li>
            <label for="start_date" class="label_style">活动开始时间</label>
            <input type="text" id="start_date" name="date_start" value="<?php echo $isQuoted ? substr($quoted['activity_start'],0,10) : set_value('date_start'); ?>"
                   onblur="check_start_date()"
                   placeholder="开始时间">
            <select name="time_start" id="start_hour">
                <option value="00:00:00">00:00</option>
                <option value="01:00:00">01:00</option>
                <option value="02:00:00">02:00</option>
                <option value="03:00:00">03:00</option>
                <option value="04:00:00">04:00</option>
                <option value="05:00:00">05:00</option>
                <option value="06:00:00">06:00</option>
                <option value="07:00:00">07:00</option>
                <option value="08:00:00">08:00</option>
                <option value="09:00:00">09:00</option>
                <option value="10:00:00">10:00</option>
                <option value="11:00:00">11:00</option>
                <option value="12:00:00">12:00</option>
                <option value="13:00:00">13:00</option>
                <option value="14:00:00">14:00</option>
                <option value="15:00:00">15:00</option>
                <option value="16:00:00">16:00</option>
                <option value="17:00:00">17:00</option>
                <option value="18:00:00">18:00</option>
                <option value="19:00:00">19:00</option>
                <option value="20:00:00">20:00</option>
                <option value="21:00:00">21:00</option>
                <option value="22:00:00">22:00</option>
                <option value="23:00:00">23:00</option>
                <option value="24:00:00">24:00</option>
            </select>
            <br>
            <div id="start_error"><?php echo form_error('date_start'); ?></div>
        </li>
        <li>
            <label for="end_date" class="label_style">活动结束时间</label>
            <input type="text" id="end_date" name="end_date" value="<?php echo $isQuoted ? substr($quoted['activity_expire'],0,10) : set_value('end_date'); ?>" placeholder="结束时间" onblur="check_end_date()">
            <select name="end_hour" id="end_hour">
                <option value="00:00:00">00:00</option>
                <option value="01:00:00">01:00</option>
                <option value="02:00:00">02:00</option>
                <option value="03:00:00">03:00</option>
                <option value="04:00:00">04:00</option>
                <option value="05:00:00">05:00</option>
                <option value="06:00:00">06:00</option>
                <option value="07:00:00">07:00</option>
                <option value="08:00:00">08:00</option>
                <option value="09:00:00">09:00</option>
                <option value="10:00:00">10:00</option>
                <option value="11:00:00">11:00</option>
                <option value="12:00:00">12:00</option>
                <option value="13:00:00">13:00</option>
                <option value="14:00:00">14:00</option>
                <option value="15:00:00">15:00</option>
                <option value="16:00:00">16:00</option>
                <option value="17:00:00">17:00</option>
                <option value="18:00:00">18:00</option>
                <option value="19:00:00">19:00</option>
                <option value="20:00:00">20:00</option>
                <option value="21:00:00">21:00</option>
                <option value="22:00:00">22:00</option>
                <option value="23:00:00">23:00</option>
                <option value="24:00:00">24:00</option>
            </select>
            <br>
            <div id="end_error"><?php echo form_error('end_date'); ?></div>
        </li>
        <li>
            <label for="close_date" class="label_style">截止报名时间</label>
            <input type="text" id="close_date" name="date_expire" value="<?php echo $isQuoted ? substr($quoted['apply_expire'],0,10) : set_value('date_expire'); ?>"
                   onblur="check_close_date()"
                   placeholder="截止报名时间">
            <select name="time_expire" id="close_hour">
                <option value="00:00:00">00:00</option>
                <option value="01:00:00">01:00</option>
                <option value="02:00:00">02:00</option>
                <option value="03:00:00">03:00</option>
                <option value="04:00:00">04:00</option>
                <option value="05:00:00">05:00</option>
                <option value="06:00:00">06:00</option>
                <option value="07:00:00">07:00</option>
                <option value="08:00:00">08:00</option>
                <option value="09:00:00">09:00</option>
                <option value="10:00:00">10:00</option>
                <option value="11:00:00">11:00</option>
                <option value="12:00:00">12:00</option>
                <option value="13:00:00">13:00</option>
                <option value="14:00:00">14:00</option>
                <option value="15:00:00">15:00</option>
                <option value="16:00:00">16:00</option>
                <option value="17:00:00">17:00</option>
                <option value="18:00:00">18:00</option>
                <option value="19:00:00">19:00</option>
                <option value="20:00:00">20:00</option>
                <option value="21:00:00">21:00</option>
                <option value="22:00:00">22:00</option>
                <option value="23:00:00">23:00</option>
                <option value="24:00:00">24:00</option>
            </select>
            <br>
            <div id="close_error"><?php echo form_error('date_expire'); ?></div>
        </li>
        <li>
            <label for="hd_city" class="label_style">活动地点</label>
            <select name="city" value="<?php echo $isQuoted ? $quoted['city'] : set_value('city'); ?>" id="hd_city">
                <option value="上海">上海</option>
                <option value="其他">其他</option>
            </select>
            <input type="text" id="hd_place" name="place" value="<?php echo $isQuoted ? $quoted['place'] : set_value('place'); ?>"
                   onblur="check_place()" placeholder="活动地址">
            <br>
            <div id="place_error"><?php echo form_error('city'); ?></div>
        </li>
        <li>
            <label for="hd_style_1st" class="label_style">活动类型</label>
            <select name="first_label_id" id="hd_style_1st">
                <option value="-1" selected>请选择</option>
                <?php
                foreach ($first_label as $first_label_item)
                    echo '<option value="' . $first_label_item['id'] . '">' . $first_label_item['name'] . '</option>';
                ?>
            </select>
            <select name="second_label_id" id="hd_style_2nd">
                <option id="second_label_1st" value="-1" selected>请选择</option>
            </select>
            <label for="newstyle">创建新类型</label>
            <input type="text" id="newstyle" name="new_label" value="<?php echo set_value('new_label'); ?>"
                   placeholder="">
            <br>
            <div id="style_error"></div>
        </li>
        <li>
            <label for="num_limit" class="label_style">人数上限</label>
            <input type="text" id="num_limit" name="amount_max" value="<?php echo $isQuoted ? $quoted['amount_max'] : set_value('amount_max'); ?>"
                   onblur="check_num_limit()">
            <br>
            <div id="num_error"><?php echo form_error('amount_max'); ?></div>
        </li>
        <li>
            <label for="hd_detail" class="label_style">活动详情</label>
            <textarea name="brief" id="hd_detail" cols="30" rows="10"
                      onblur="check_detail()"><?php echo $isQuoted ? $quoted['brief'] : set_value('brief'); ?></textarea>
            <br>
            <div id="detail_error"><?php echo form_error('brief'); ?></div>
        </li>
    </ul>
    <p id="publish">
        <input value="发布活动" type="submit" onclick="return check()">
    </p>
    </form>
</div>
<script type="text/javascript">
    $("#hd_style_1st").change(function () {
        if ($("#hd_style_1st").val() != -1) {
            $.post('<?php echo site_url("separated_info/json_for_second_label/")?>' + $("#hd_style_1st").val(),
                function (data) {
                    var second_labels = JSON.parse(data);
                    var new_second_labels = "";
                    var count = second_labels.length;
                    $('#hd_style_2nd').children().not('#second_label_1st').remove();
                    for (var i = 0; i < count; i++) {
                        new_second_labels += '<option value =" ' + second_labels[i].id + '">'
                            + second_labels[i].name + '</option>';
                    }
                    $("#second_label_1st").after(new_second_labels);
                });
        }
        else {
            $('#hd_style_2nd').children().not('#second_label_1st').remove();
        }
    });
</script>
<script type="text/javascript" src="https://cdn.bootcss.com/moment.js/2.17.1/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/my_bootstrap-datetimepicker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("js/form_validation/create_activity.js")?>"></script>
<script type="text/javascript">
    $(function () {
        $.fn.my_datetimepicker = function () {
            offset = this.offset();
            this.datetimepicker({
                format: 'YYYY-MM-DD',
                widgetPositioning: {
                    personal: JSON.stringify({
                        'position': 'absolute',
                        'left': offset.left,
                        'top': offset.top + this.height() + 10
                    }),
                    vertical: "bottom"
                }
            });
        };

        $('#start_date').my_datetimepicker();
        $('#close_date').my_datetimepicker();
        $('#end_date').my_datetimepicker();
        // @todo 正式提交代码是删除，仅供测试方便
        /*$.fn.my_datetimepicker = function (default_date) {
            offset = this.offset();
            this.datetimepicker({
                defaultDate: default_date.getFullYear() + '/' + (default_date.getMonth() + 1) + '/' + default_date.getDate(),
                format: 'YYYY-MM-DD',
                widgetPositioning: {
                    personal: JSON.stringify({
                        'position': 'absolute',
                        'left': offset.left,
                        'top': offset.top + this.height() + 10
                    }),
                    vertical: "bottom"
                }
            });
        };

        var a = Math.floor(Math.random() * 10) + 10,
            b = Math.floor(Math.random() * 10) + 15,
            c = Math.floor(Math.random() * 10) + 20;

        var today = new Date();
        var change = today;
        change.setDate(change.getDate() + a);
        $('#close_date').my_datetimepicker(change);
        change = today;
        change.setDate(change.getDate() + b);
        $('#start_date').my_datetimepicker(change);
        change = today;
        change.setDate(change.getDate() + c);
        $('#end_date').my_datetimepicker(change);*/
    })
</script>