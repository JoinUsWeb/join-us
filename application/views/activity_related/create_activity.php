<div class="container">
    <?php echo $error ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('create_activity'); ?>
    <ul>
        <li>
            <label for="hd_topic">活动主题</label>
            <input type="text" id="hd_topic" name="name" value="<?php echo set_value('name'); ?>" placeholder="请输入活动主题">
        </li>
        <li>
            <label for="hd_poster">活动海报</label>
            <div id="posterImg">
                <img src="<?php echo base_url('/img/posterImg.png')?>" alt="这是一张海报">
            </div>
            <div id="create_button">
                <input type="file" id="hd_poster" name="hd_poster">
            </div>
        </li>
        <li>
            <label for="start_date" class="label_style">活动开始时间</label>
            <input type="date" id="start_date" name="date_start" value="<?php echo set_value('date_start'); ?>"
                   placeholder="开始时间">
            <select name="time_start" value="<?php echo set_value('time_start'); ?>" id="start_hour">
                <option value="00:00:00">0:00</option>
                <option value="01:00:00">1:00</option>
                <option value="02:00:00">2:00</option>
                <option value="03:00:00">3:00</option>
                <option value="04:00:00">4:00</option>
            </select>
        </li>
        <li>
            <label for="close_date" class="label_style">截止报名时间</label>
            <input type="date" id="close_date" name="date_expire" value="<?php echo set_value('date_expire'); ?>"
                   placeholder="截止报名时间">
            <select name="time_expire" value="<?php echo set_value('time_expire'); ?>" id="close_hour">
                <option value="00:00:00">0:00</option>
                <option value="01:00:00">1:00</option>
                <option value="02:00:00">2:00</option>
                <option value="03:00:00">3:00</option>
                <option value="04:00:00">4:00</option>
            </select>
        </li>
        <li>
            <label for="hd_city" class="label_style">活动地点</label>
            <select name="city" value="<?php echo set_value('city'); ?>" id="hd_city">
                <option value="上海">上海</option>
                <option value="其他">其他</option>
            </select>
            <input type="text" id="hd_place" name="place" value="<?php echo set_value('place'); ?>" placeholder="活动地址">
        </li>
        <li>
            <label for="hd_style_1st" class="label_style">活动类型</label>
            <select name="first_label_id" value="<?php echo set_value('first_label'); ?>" id="hd_style_1st">
                <?php
                foreach ($first_label as $first_label_item)
                    echo '<option value="' . $first_label_item['id'] . '">' . $first_label_item['name'] . '</option>';
                ?>
            </select>
            <select name="second_label_id" value="<?php echo set_value('second_label'); ?>" id="hd_style_2nd">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <label for="newstyle">创建新类型</label>
            <input type="text" id="newstyle" name="new_label" value="<?php echo set_value('new_label'); ?>"
                   placeholder="">
        </li>
        <li>
            <label for="num_limit" class="label_style">人数上限</label>
            <input type="text" id="num_limit" name="amount_max" value="<?php echo set_value('amount_max'); ?>">
        </li>
        <li>
            <label for="hd_detail" class="label_style">活动详情</label>
            <textarea name="brief" id="hd_detail" cols="30" rows="10"><?php echo set_value('brief'); ?></textarea>
        </li>
        <li>
            <input type="submit" id="publish" value="发布活动">
        </li>
    </ul>
    </form>
</div>
<script type="text/javascript">
    $("#hd_style_1st").change(function () {
        $.post('localhost/join-us/index.php/separated_info/json_for_second_label/' + $("#hd_style_1st").val(),
            function (data, status) {
                alert(data);
            });
    });
</script>