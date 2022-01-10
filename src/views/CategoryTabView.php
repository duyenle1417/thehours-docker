<?php
// lấy posts từ db
$tab_most_view = $post_model->GetPostsByTopicTab($topic['id'], 10, 'views');
$tab_recent = $post_model->GetPostsByTopicTab($topic['id'], 10, 'id');
?>

<div class="tabs">
    <div class="tab-btn">
        <button class="nav-tabs active" onclick="openTab(event, 'tin-moi')">Tin mới</button>
        <button class="nav-tabs" onclick="openTab(event, 'doc-nhieu')">Đọc nhiều</button>
    </div>
    <div class="tab-content" id="tin-moi">
        <?php foreach ($tab_recent as $post) { ?>
        <div class="tab-content__item">
            <span
                class="tab-content__time"><?php echo $mysqldate = date('H:i d/m/y', strtotime($post['create_date'])); ?></span>
            <a href="<?php echo BASE_URL . "article?id=" . $post['id'] . "&slug=" . $post['slug']; ?>"
                class="tab-content__link"><?php echo $post['title'] ?></a>
        </div>
        <?php } ?>
    </div>
    <div class="tab-content" id="doc-nhieu" style="display: none;">
        <?php foreach ($tab_most_view as $post) { ?>
        <div class="tab-content__item">
            <span
                class="tab-content__time"><?php echo $mysqldate = date('H:i d/m/y', strtotime($post['create_date'])); ?></span>
            <a href="<?php echo BASE_URL . "article?id=" . $post['id'] . "&slug=" . $post['slug']; ?>"
                class="tab-content__link"><?php echo $post['title'] ?></a>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("nav-tabs");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>