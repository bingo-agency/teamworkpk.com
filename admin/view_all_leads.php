<?php
include'includes/header.php';
if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Checking all leads on <a href='view_all_leads'>Leads</a> ");
}
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>
            <i class="fa fa-bars"></i> 
            Internal Leads</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Manage Leads</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<?php
if (isset($_GET['block_id'])) {
    $block_id = $_GET['block_id'];

    if ($role == 'admin') {
        $queryBlock = mysqli_query($con, "UPDATE `leads` SET `status` = 'block' WHERE `id` = '" . $block_id . "'");
        if ($queryBlock) {
            $db->add_user_activity($con, 'Admin has blocked the lead with db id = ' . $block_id);
        }
    }
}


if (isset($_GET['status'])) {
    echo $gotten_status = $_GET['status'];
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="pull-right" style="text-transform: capitalize"><h3><?= $gotten_status ?> Leads</h3></span>
                        <h5 style="text-transform: capitalize;"><?= $gotten_status ?> Leads <small>List of all <?= $gotten_status ?> requests.</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                            <div class="DTTT_container">
                            </div>
                            <div class="clear"></div>
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#System id</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#id</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Client Name</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Location</th>
                                        <?php if ($role == 'admin') { ?>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Assigned to</th>
                                        <?php } else { ?>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Generated By</th>
                                        <?php } ?>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Progress</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 10%;" aria-label="CSS grade: activate to sort column ascending">TimeStamp</th>
                                        <?php // if ($role == 'admin') { ?>
                                        <th class="" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;">Actions</th>
                                        <?php // } ?>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($role == 'admin' || $role == 'sub-admin') {
                                        if ($gotten_status == 'new') {
                                            $query = mysqli_query($con, "SELECT * FROM `internal_leads` WHERE `progress` = '0'");
                                        } else if ($gotten_status == 'complete') {
                                            $query = mysqli_query($con, "SELECT * FROM `internal_leads` WHERE `progress` = '100'");
                                        } else {
                                            $query = mysqli_query($con, "SELECT * FROM `internal_leads` WHERE  NOT  `progress`= '0' AND NOT `progress` = '100' ORDER BY `id` DESC ");
                                        }
                                    }
                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr class="gradeA odd" role="row">

                                            <td class="sorting_1"><?= $row['id'] ?></td>
                                            <td ><?= $row['lead_id'] ?></td>

                                            <td><a href="lead_detail?id=<?= $row['id'] ?>"><?= $row['client_name'] ?></a></td>

                                            <td><?= $row['property_location'] ?></td>

                                            <?php if ($role != "admin") { ?>
                                                <td><a href="#" data-toggle="modal" data-target="#user<?= $row['by_id'] ?>"><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></a></td>    
                                            <?php } else { ?>
                                                <?php if ($row['assigned_to'] == '') { ?>
                                                    <td><center>Not Assigned Yet</center></td>    
                                        <?php } else { ?>
                                            <td><center><?= $row['assigned_to'] ?></center></td>    
                                        <?php } ?>

                                    <?php }
                                    ?>

                                    <td>

                                        <?php if ($row['progress'] == '0') { ?>
                                        <center>New</center>
                                    <?php } else if ($row['progress'] == '100') { ?>
                                        <div class="progress" style="margin-bottom: 0px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animate" role="progressbar" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $row['progress'] . '%' ?>">

                                                <?= $row['progress'] . '%' ?>
                                            </div>
                                        </div> 
                                    <?php } else { ?>
                                        <div class="progress" style="margin-bottom: 0px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animate" role="progressbar" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $row['progress'] . '%' ?>">

                                                <?= $row['progress'] . '%' ?>
                                            </div>
                                        </div> 
                                    <?php } ?>
                                    </td>


                                    <td class="center"><span title="<?= $row['timestamp'] ?>"><?= $db->getElapsedTime($row['timestamp']) ?></span></td>

                                    <td class="center"><a href="edit_lead?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a></td>
                                    </tr>
                                    <!-- Modal for TW user -->

                                    <div class="modal fade" id="user<?= $row['by_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel"><center><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']) ?></center></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="dl-horizontal">
                                                        <dt><img src="img/<?= $db->getEachById($con, 'image', 'users', $row['by_id']) ?>" class="img-responsive pull-right img-circle img-thumbnail" style="max-width:100px;"/></dt>
                                                        <dd style="padding-top: 10%"><h3><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']) ?></h3></dd>
                                                        <dd><small>&nbsp;</small></dd>
                                                        <dt>Contact Name</dt>
                                                        <dd><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']) ?></dd>
                                                        <dt>Email</dt>
                                                        <dd><?= $db->getEachById($con, 'email', 'users', $row['by_id']) ?></dd>
                                                        <dt>Phone</dt>
                                                        <dd><?= $db->getEachById($con, 'telephone', 'users', $row['by_id']) ?></dd>
                                                        <dt>Role</dt>
                                                        <dd><?= $db->getEachById($con, 'role', 'users', $row['by_id']) ?></dd>
                                                        <dt>TimeStamp</dt>
                                                        <dd><?= $db->getEachById($con, 'timestamp', 'users', $row['by_id']) ?></dd>
                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <!--                                                <div class="col-lg-12">
                                                //<?= $activity_request_status ?>
                                                                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

if (!isset($_GET['status'])) {
//    $activity_request_status = $_GET['status'];
    $activity_request_status = "";
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?= $activity_request_status ?> Leads <small>List of all <?= $activity_request_status ?> requests.</small></h5>
                    </div>

                    <div class="ibox-content">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                            <div class="DTTT_container">
                            </div>
                            <div class="clear"></div>
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#System id</th>
                                        <th class="" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#id</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Client Name</th>
                                        <th class="" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Location</th>
                                        <?php if ($role == 'admin') { ?>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Assigned to</th>
                                        <?php } else { ?>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Generated By</th>
                                        <?php } ?>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Progress</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">TimeStamp</th>
                                        <?php //if ($role == 'admin') {       ?>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                        <?php //}      ?>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo $role;
                                    if ($role != 'team') {
                                        $query = mysqli_query($con, "SELECT * FROM `internal_leads` ORDER BY `id` DESC");
                                    } else {
                                        $query = mysqli_query($con, "SELECT * FROM `internal_leads` WHERE `by_id` = '" . $db->getSession_id() . "' ORDER BY `id` DESC");
                                    }
                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?= $row['id'] ?></td>
                                            <td class=""><?= $row['lead_id'] ?></td>
                                            <td><a href="lead_detail?id=<?= $row['id'] ?>"><?= $row['client_name'] ?></a></td>
                                            <td><?= $row['property_location'] ?></td>
                                            <!--<td><a href="#" data-toggle="modal" data-target="#user<?= $row['by_id'] ?>"><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></a></td>-->
                                            <?php if ($role != "admin") { ?>
                                                <td><a href="#" data-toggle="modal" data-target="#user<?= $row['by_id'] ?>"><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></a></td>    
                                            <?php } else { ?>
                                                <?php if ($row['assigned_to'] == '') { ?>
                                                    <td><center>Not Assigned</center></td>    
                                        <?php } else { ?>
                                            <td><center><?= $row['assigned_to'] ?></center></td>    
                                        <?php } ?>

                                    <?php }
                                    ?>

                                    <td>

                                        <?php if ($row['progress'] == '0') { ?>
                                        <center>New</center>
                                    <?php } else if ($row['progress'] == '100') { ?>
                                        <div class="progress" style="margin-bottom: 0px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animate" role="progressbar" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $row['progress'] . '%' ?>">

                                                <?= $row['progress'] . '%' ?>
                                            </div>
                                        </div> 
                                    <?php } else { ?>
                                        <div class="progress" style="margin-bottom: 0px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animate" role="progressbar" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $row['progress'] . '%' ?>">

                                                <?= $row['progress'] . '%' ?>
                                            </div>
                                        </div> 
                                    <?php } ?>
                                    </td>

                                    <td class="center"><span title="<?= $row['timestamp'] ?>"><?= $db->getElapsedTime($row['timestamp']) ?></span></td>

                                    <td class="center">
                                        <a href="edit_lead?id=<?= $row['id'] ?>" class="btn btn-primary" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    </tr>
                                    <!-- Modal for TW user -->

                                    <div class="modal fade" id="user<?= $row['by_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel"><center><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']) ?></center></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="dl-horizontal">
                                                        <dt><img src="img/<?= $db->getEachById($con, 'image', 'users', $row['by_id']) ?>" class="img-responsive pull-right img-circle img-thumbnail" style="max-width:100px;"/></dt>
                                                        <dd style="padding-top: 10%"><h3><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']) ?></h3></dd>
                                                        <dd><small>&nbsp;</small></dd>
                                                        <dt>Contact Name</dt>
                                                        <dd><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']) ?></dd>
                                                        <dt>Email</dt>
                                                        <dd><?= $db->getEachById($con, 'email', 'users', $row['by_id']) ?></dd>
                                                        <dt>Phone</dt>
                                                        <dd><?= $db->getEachById($con, 'telephone', 'users', $row['by_id']) ?></dd>
                                                        <dt>Role</dt>
                                                        <dd><?= $db->getEachById($con, 'role', 'users', $row['by_id']) ?></dd>
                                                        <dt>TimeStamp</dt>
                                                        <dd><?= $db->getEachById($con, 'timestamp', 'users', $row['by_id']) ?></dd>
                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>
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
<?php }
?>

<?php include'includes/footer.php'; ?>