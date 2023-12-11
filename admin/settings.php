<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}else{
    $db->add_user_activity($con,"Checking Settings of personal profile ");
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
                <strong>Profile</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<style>

    #upload-wrapper {
        width: 80%;
        margin-right: auto;
        margin-left: auto;
        margin-top: 50px;
        background: #F5F5F5;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 1px 1px 3px #AAA;
    }
    #upload-wrapper h3 {
        padding: 0px 0px 10px 0px;
        margin: 0px 0px 20px 0px;
        margin-top: -30px;
        border-bottom: 1px dotted #DDD;
    }
    #upload-wrapper input[type=file] {
        border: 1px solid #DDD;
        padding: 6px;
        background: #FFF;
        border-radius: 5px;
    }
    #upload-wrapper #submit-btn {
        border: none;
        /*padding: 10px;*/
        background: #61BAE4;
        border-radius: 5px;
        color: #FFF;
    }
    #output{
        padding: 5px;
        font-size: 12px;
    }
    #output img {
        border: 1px solid #DDD;
        padding: 5px;
    }
</style>

<?php
if (isset($_GET['msg'])) {
    echo '<br />';
    $db->success('<strong>Success </strong>Your profile has been updated.');
}
?>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <br />

                        <center><img alt="image" class="img-responsive img-thumbnail" src="img/<?= $db->getEachById($con,'image', 'users', $id); ?>"><br /><br /><a href="#" data-toggle="modal" data-target="#avatar"><span class="label label-primary">update avatar +</span></a></center>
                        <!-- Modal -->
                        <div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Upload your image</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div id="upload-wrapper">
                                            <div align="center">
                                                <form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
                                                    <input name="image_file" id="imageInput" type="file" style="width: 100%"/>
                                                    <br />
                                                    <input type="submit"  id="submit-btn" value="Upload" class="btn btn-info" />

                                                    <img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait" class="img-responsive"/>
                                                </form>
                                                <div id="output"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!--<button type="button" class="btn btn-danger" data-dismiss="modal" href="profile">Close</button>-->
                                        <a href="settings" class="btn btn-danger" >Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?= $db->getEachById($con,'contact_name', 'users', $id); ?></strong></h4>
                        <h4>
                            Email
                        </h4>
                        <p>
                            <?= $db->getEachById($con,'email', 'users', $id); ?>
                        </p>
                        
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="edit_profile" type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="lock?id=<?= $id ?>" type="button" class="btn btn-danger btn-sm btn-block"><i class="fa fa-lock"></i> Lock </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Recent Activites</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="feed-activity-list">
                            <?php
                            $query = mysqli_query($con,"SELECT * FROM `user_activity` WHERE `user_id` = '" . $id . "' ORDER BY `id` DESC LIMIT 6");
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
                                        <time class="timeago" datetime="<?= $row['timestamp'] ?>">August 25, 1988</time>

                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <a href="view_all_activity.php" class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>