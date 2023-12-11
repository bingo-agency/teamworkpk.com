<?php
include'includes/header.php';
if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Checking on web requests's on <a href='web_requests'>Web Requests's</a> ");
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>
            <i class="fa fa-bars"></i> 
            Web Requests</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Manage Web Requests</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<?php
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $queryApprove = mysqli_query($con, "UPDATE `web_posts` SET `verification_status` ='1' WHERE `id` = '" . $approve_id . "'");
    if ($queryApprove) {
        $db->redirect('web_requests');
        exit();
    } else {
        ?>
        <script>alert('error');</script>
        <?php
    }
}
if (isset($_GET['block_id'])) {
    $block_id = $_GET['block_id'];
    $queryBlock = mysqli_query($con, "UPDATE `web_posts` SET `verification_status` ='0' WHERE `id` = '" . $block_id . "'");
    if ($queryBlock) {
        $db->redirect('web_requests');
        exit();
    } else {
        ?>
        <script>alert('error');</script>
        <?php
    }
}
if (isset($_GET['remove_web_post'])) {
    $remove_id = $_GET['remove_web_post'];
    $queryRemove = mysqli_query($con, "DELETE FROM `web_posts` WHERE `id` = '" . $remove_id . "'");
    if ($queryRemove) {
        $db->redirect('web_requests?rem_success=true');
        exit();
    } else {
        ?>
        <script>alert('error');</script>
        <?php
    }
}
if (!isset($_GET['verification_status'])) {
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All Web Requests <small>List of all Web Requests.</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                            <div class="DTTT_container">
                            </div>
                            <div class="clear"></div>
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#id</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Title</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Location</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">City</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">TimeStamp</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['rem_success'])) {
                                        echo $db->success('Your record has been removed.');
                                    }
                                    ?>
                                    <?php
                                    if ($role == 'team') {
                                        $team_id = $db->getSession_id();
                                        $query = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `team_id` = '" . $team_id . "' ORDER BY `id` DESC");
                                    } else {
                                        $query = mysqli_query($con, "SELECT * FROM `web_posts` ORDER BY `id` DESC");
                                    }

                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?= $row['id'] ?></td>
                                            <td><a href="#" data-toggle="modal" data-target="#company<?= $row['id'] ?>"><?= $row['title']; ?></a></td>
                                            <td><?= $row['address'] ?></td>
                                            <td><?= $row['city'] ?></td>
                                            <td class="center">
                                                <?php if ($row['verification_status'] == 1) { ?>
                                                    <a href="web_requests?block_id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-check"></i> Approved</a>
                                                <?php } else { ?>
                                                    <a href="web_requests?approve_id=<?= $row['id'] ?>" class="btn btn-warning">Approve</a>
                                                <?php }
                                                ?>        
                                            </td>
                                            <td class="center"><?= $db->getElapsedTime($row['timestamp']) ?></td>
                                            <td class="center"><a class="btn btn-primary" href="edit_web_post?id=<?= $row['id'] ?>">Edit</a><a class="btn btn-danger" href="web_requests?remove_web_post=<?= $row['id'] ?>">Del</a></td>
                                        </tr>
                                        <!-- Modal for company -->

                                    <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel"><center><?= $db->getEachById($con, 'title', 'web_posts', $row['id']) ?></center></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="dl-horizontal">
                                                        <dt><img src="../<?= $row['primary_image'] ?>" class="img-responsive pull-right  img-thumbnail" style=""/></dt>
                                                        <dd style="padding-top: 10%"><h3><?= $db->getEachById($con, 'title', 'web_posts', $row['id']) ?></h3></dd>
                                                        <dd><small>&nbsp;</small></dd>
                                                        <dt>Internal Lead ID</dt>
                                                        <dd><?= $db->getEachById($con, 'internal_lead_id', 'web_posts', $row['id']) ?></dd>
                                                        <dt>Description</dt>
                                                        <dd><?= $db->getEachById($con, 'description', 'web_posts', $row['id']) ?></dd>
                                                        <dt>Email</dt>
                                                        <dd><?= $db->getEachById($con, 'email', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $row['id'])) ?></dd>
                                                        <dt>Phone</dt>
                                                        <dd><?= $db->getEachById($con, 'phone', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $row['id'])) ?></dd>

                                                        <dt>TimeStamp</dt>
                                                        <dd><?= $db->getEachById($con, 'timestamp', 'web_posts', $row['id']) ?></dd>
                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!--                        <div class="col-lg-12">
                        <?= $activity_request_status ?>
                                                </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { 
    $verification_status = $_GET['verification_status'];
    ?>    
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?= ($verification_status==0)?('New'):('Verified') ?> Web Requests <small>List of all <?= ($verification_status==0)?('New'):('Verified') ?> Requests.</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                            <div class="DTTT_container">
                            </div>
                            <div class="clear"></div>
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#id</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Title</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Location</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">City</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">TimeStamp</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['rem_success'])) {
                                        echo $db->success('Your record has been removed.');
                                    }
                                    ?>
                                    <?php
                                    if ($role == 'team') {
                                        $team_id = $db->getSession_id();
                                        $query = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `team_id` = '" . $team_id . "' AND `verification_status` = $verification_status ORDER BY `id` DESC");
                                    } else {
                                        $query = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = $verification_status ORDER BY `id` DESC");
                                    }

                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?= $row['id'] ?></td>
                                            <td><a href="#" data-toggle="modal" data-target="#company<?= $row['id'] ?>"><?= $row['title']; ?></a></td>
                                            <td><?= $row['address'] ?></td>
                                            <td><?= $row['city'] ?></td>
                                            <td class="center">
                                                <?php if ($row['verification_status'] == 1) { ?>
                                                    <a href="web_requests?block_id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-check"></i> Approved</a>
                                                <?php } else { ?>
                                                    <a href="web_requests?approve_id=<?= $row['id'] ?>" class="btn btn-warning">Approve</a>
                                                <?php }
                                                ?>        
                                            </td>
                                            <td class="center"><?= $db->getElapsedTime($row['timestamp']) ?></td>
                                            <td class="center"><a class="btn btn-primary" href="edit_web_post?id=<?= $row['id'] ?>">Edit</a><a class="btn btn-danger" href="web_requests?remove_web_post=<?= $row['id'] ?>">Del</a></td>
                                        </tr>
                                        <!-- Modal for company -->

                                    <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel"><center><?= $db->getEachById($con, 'title', 'web_posts', $row['id']) ?></center></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="dl-horizontal">
                                                        <dt><img src="../<?= $row['primary_image'] ?>" class="img-responsive pull-right  img-thumbnail" style=""/></dt>
                                                        <dd style="padding-top: 10%"><h3><?= $db->getEachById($con, 'title', 'web_posts', $row['id']) ?></h3></dd>
                                                        <dd><small>&nbsp;</small></dd>
                                                        <dt>Internal Lead ID</dt>
                                                        <dd><?= $db->getEachById($con, 'internal_lead_id', 'web_posts', $row['id']) ?></dd>
                                                        <dt>Description</dt>
                                                        <dd><?= $db->getEachById($con, 'description', 'web_posts', $row['id']) ?></dd>
                                                        <dt>Email</dt>
                                                        <dd><?= $db->getEachById($con, 'email', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $row['id'])) ?></dd>
                                                        <dt>Phone</dt>
                                                        <dd><?= $db->getEachById($con, 'phone', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $row['id'])) ?></dd>

                                                        <dt>TimeStamp</dt>
                                                        <dd><?= $db->getEachById($con, 'timestamp', 'web_posts', $row['id']) ?></dd>
                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!--                        <div class="col-lg-12">
                        <?= $verification_status ?>
                                                </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>

<?php include'includes/footer.php'; ?>