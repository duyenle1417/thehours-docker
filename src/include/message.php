<!-- thông báo lỗi -->
<?php if (count($errors) > 0) { ?>
    <ul class="msg error">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php foreach ($errors as $error) { ?>
            <li><?php echo $error; ?></li>
            <?php }; ?>
        </ul>
<?php };
    ?>

    