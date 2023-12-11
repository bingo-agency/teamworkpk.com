<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con,"Was viewing their own <strong>Activity</strong>.");
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-user"></i> Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Activity</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>


<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">

        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Your Complete Activity feed</h5>
                                <div class="ibox-tools">
                                    <?php
                                    if (!isset($_GET['all'])) {
                                        echo '<span class="label label-warning-light">Last 10 Activities</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <div>
                                    <div class="feed-activity-list">
                                        <?php
                                        if (isset($_GET['all'])) {
                                            $query = mysqli_query($con,"SELECT * FROM `user_activity` WHERE `user_id` = '" . $id . "' ORDER BY `id` DESC");
                                        } else {
                                            $query = mysqli_query($con,"SELECT * FROM `user_activity` WHERE `user_id` = '" . $id . "' ORDER BY `id` DESC LIMIT 10");
                                        }
                                        while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                            ?>
                                            <div class="feed-element">
                                                <span class="pull-left">
                                                    <img alt="image" class="img-circle" src="img/<?= $db->getEachById($con,'image', 'users', $id); ?>">
                                                </span>
                                                <div class="media-body ">
                                                    <small class="pull-right"><?= $row['timestamp'] ?></small>
                                                    <strong><?= $db->getEachById($con,'contact_name', 'users', $id); ?></strong> <?= $row['activity'] ?> <br>
                                                    <!--<small class="" class="timeago"></small>-->
                                                    <time class="timeago" datetime="<?= $row['timestamp'] ?>"><?= $row['timestamp'] ?></time>

                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                    <?php
                                    if (!isset($_GET['all'])) {
                                        echo'<a href="view_all_activity.php?all=sub" class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</a>';
                                    }
                                    ?>


                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</div>

<?php
include'includes/footer.php';
?>