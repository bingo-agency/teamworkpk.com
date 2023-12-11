<!--<script src="../js/jquery-2.1.1.js"></script>
<script src="../js/jquery.timeago.js"></script>
<script>
    $(document).ready(function () {
        jQuery("time.timeago").timeago();
    });
</script>-->
<?php
ob_start();
include '../includes/dataBase.php';

session_start();

$query = mysql_query("SELECT * FROM `messages_replies` WHERE `messages_id` = '" . $_GET['messages_id'] . "'");
while ($row = mysql_fetch_array($query)) {

    if ($row['user_id'] != $_SESSION['user']['id']) {
        $align = 'right';
    } elseif ($row['user_id'] == $_SESSION['user']['id']) {
        $align = 'left';
    }
    ?>
    <li class="<?= $align ?> message"><span class="chat-img pull-<?= $align ?>">
            <img src="img/<?= $db->getEachById('image', 'users', $row['user_id']); ?>" alt="User Avatar" class="chat-avatar img-circle">
        </span>
        <div class="clearfix">
            <div class="header">
                <?php if ($align == 'right') { ?>
                    <small class="text-muted"><span class="glyphicon glyphicon-time"></span><time datetime="<?= $row['timestamp'] ?>" class="timeago" title="<?= $row['timestamp'] ?>"><?= $row['timestamp'] ?></time></small>    
                    <strong class="primary-font pull-right">&nbsp;<?= $db->getEachById('contact_name', 'users', $row['user_id']); ?>&nbsp;</strong> 
                <?php } ?>

                <?php if ($align == 'left') { ?>
                    <strong class="primary-font"><?= $db->getEachById('contact_name', 'users', $row['user_id']); ?></strong> 
                    <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>
                        <time datetime="<?= $row['timestamp'] ?>" class="timeago" title="<?= $row['timestamp'] ?>"><?= $row['timestamp'] ?></time>
                    </small>    
                <?php } ?>

            </div>
            <p>
                <?= $row['message'] ?>
            </p>
        </div>
    </li>
<?php }
?>


