/**
 * Created by zhang on 2017/3/21.
 */

function init_rating(site_url) {
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

                    $.post(
                        //url
                        site_url + "/separated_info/comment_activity/" + activityId + "/" + (6 - index)
                    );
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

