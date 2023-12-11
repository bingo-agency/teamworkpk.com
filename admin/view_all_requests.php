<?php
include'includes/header.php';
if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Checking all requests on <a href='view_all_requests'>Requests</a> ");
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>
            <!--<i class="fa fa-bars"></i>--> 
            Your request activity</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Manage Requests</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<?php
if (isset($_GET['status'])) {
    $activity_request_status = $_GET['status'];
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?= $activity_request_status ?> Requests <small>List of all <?= $activity_request_status ?> requests.</small></h5>
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
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Request Name</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Client</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Category</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="Engine version: activate to sort column ascending">Status</th>
                                        <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Progress</th>-->
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM `requests` WHERE status='" . $activity_request_status . "' ORDER BY `id` DESC");
                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?= $row['id'] ?></td>
                                            <td><a href="request_detail?request_id=<?= $row['id'] ?>"><?= $row['name'] ?></a></td>
                                            <td><a href="edit_user?id=<?= $row['by_id'] ?>"><?= $db->getEachById($con,'contact_name','users',$row['by_id']); ?></a></td>
                                            <td><?= $row['request_category'] ?></td>
                                            <td class="center"><?= $row['status'] ?></td>
                                            <td class="center"><?= $row['progress'] ?></td>
                                            <td class="center"><?= $db->getElapsedTime($row['timestamp'])?></td>
                                        </tr>
                                        <!-- Modal for company -->
                                        <!--                                    
                                                                        <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                            <h4 class="modal-title" id="myModalLabel"><center><?= $row['contact_name']; ?></center></h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <dl class="dl-horizontal">
                                                                                                <dt><img src="img/<?= $row['image'] ?>" class="img-responsive pull-right img-circle img-thumbnail" style="max-width:100px;"/></dt>
                                                                                                <dd style="padding-top: 10%"><h3><?= $db->getEachById($con, 'contact_name', 'users', $row['id']) ?></h3></dd>
                                                                                                <dd><small>&nbsp;</small></dd>
                                                                                                <dt>Contact Name</dt>
                                                                                                <dd><?= $db->getEachById($con, 'contact_name', 'users', $row['id']) ?></dd>
                                                                                                <dt>Email</dt>
                                                                                                <dd><?= $db->getEachById($con, 'email', 'users', $row['id']) ?></dd>
                                                                                                <dt>Phone</dt>
                                                                                                <dd><?= $db->getEachById($con, 'telephone', 'users', $row['id']) ?></dd>
                                                                                                <dt>Role</dt>
                                                                                                <dd><?= $db->getEachById($con, 'role', 'users', $row['id']) ?></dd>
                                                                                                <dt>TimeStamp</dt>
                                                                                                <dd><?= $db->getEachById($con, 'timestamp', 'users', $row['id']) ?></dd>
                                                                                            </dl>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                        -->
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
<?php }
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Requests <small>List of all requests.</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <div class="i-checks" id="stepradio1"style="display:none;">
                                <label> 
                                    <input type="radio" id="radio1" disabled="">
                                    <i class="hassanafterline" style="color:green"></i> 
                                </label>
                            </div>
                            <div class="i-checks" id="stepradio_1" >
                                <label> 
                                    <input type="radio" id="radio1" checked="">
                                    <i class="hassanafterline"style="color:green"></i> 
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="i-checks" id="stepradio2">
                                <label> 
                                    <input type="radio" id="radio2" disabled="">
                                    <i class="hassanafterline"></i> 
                                </label>
                            </div>
                            <div class="i-checks" id="stepradio_2" style="display:none;">
                                <label> 
                                    <input type="radio" id="radio2" checked="">
                                    <i class="hassanafterline"></i> 
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="i-checks" id="stepradio3">
                                <label> 
                                    <input type="radio" id="radio3" disabled="">
                                    <i class="hassanafterline"></i> 
                                </label>
                            </div>
                            <div class="i-checks" id="stepradio_3" style="display:none;">
                                <label> 
                                    <input type="radio" id="radio3" checked="">
                                    <i class="hassanafterline"></i> 
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="i-checks" id="stepradio4">
                                <label> 
                                    <input type="radio" id="radio4" disabled="">
                                    <i class="hassanafterline"></i> 
                                </label>
                            </div>
                            <div class="i-checks" id="stepradio_4" style="display:none;">
                                <label> 
                                    <input type="radio" id="radio4" checked="">
                                    <i class="hassanafterline"></i> 
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="clear clearfix"></div>
                    <div class="row">
                        <div class="step1ar">
                            <div class="col-lg-12"><h3>All Requests.</h3></div>

                            <br />
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <h3>New</h3>
                                    <div class="taskList">
                                        <?php
                                        if ($role == 'client') {
                                            $query = mysqli_query($con, "SELECT * FROM `requests` WHERE `by_id` = '" . $id . "' AND `status` = 'inactive' ORDER BY `id` DESC");
                                        } else if ($role == 'admin') {
                                            $query = mysqli_query($con, "SELECT * FROM `requests` WHERE `status` = 'inactive' ORDER BY `id` DESC ");
                                        }
                                        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                            ?>
                                            <a href="request_detail?request_id=<?= $row['id'] ?>" >
                                                <div class="widget style1 lazur-bg">
                                                    <h3><?= $row['request_category'] ?></h3>
                                                    <span><?= $row['name'] ?></span>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h3>Working</h3>
                                    <div class="taskList">
                                        <?php
                                        if ($role == 'client') {
                                            $query = mysqli_query($con, "SELECT * FROM `requests` WHERE `by_id` = '" . $id . "' AND `status` = 'active' ORDER BY `id` DESC");
                                        } else if ($role == 'admin') {
                                            $query = mysqli_query($con, "SELECT * FROM `requests` WHERE `status` = 'active' ORDER BY `id` DESC");
                                        }
                                        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                            ?>
                                            <a href="request_detail?request_id=<?= $row['id'] ?>" >
                                                <div class="widget style1 navy-bg">
                                                    <h3><?= $row['request_category'] ?></h3>
                                                    <span><?= $row['name'] ?></span>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h3>Completed</h3>
                                    <div class="taskList">
                                        <?php
                                        if ($role == 'client') {
                                            $query = mysqli_query($con, "SELECT * FROM `requests` WHERE `by_id` = '" . $id . "' AND `status` = 'complete' ORDER BY `id` DESC");
                                        } else if ($role == 'admin') {
                                            $query = mysqli_query($con, "SELECT * FROM `requests` WHERE `status` = 'complete' ORDER BY `id` DESC");
                                        }
                                        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                            ?>
                                            <a href="request_detail?request_id=<?= $row['id'] ?>" >
                                                <div class="widget style1 red-bg">
                                                    <h3><?= $row['request_category'] ?></h3>
                                                    <span><?= $row['name'] ?></span>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <?php
//                    if (isset($_GET['msg'])) {
//                        $db->success('<strong>Thank you</strong> Your record has been updated!');
//                    }
//                    if (isset($_GET['msg_add'])) {
//                        $db->success('<strong>Thank you</strong> Your client has been added!');
//                    }
//                    if (isset($_GET['msg_request_add'])) {
//                        $db->success('<strong>Thank you</strong> Your request has been added!');
//                    }
                    ?>
                    <!--                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                                            <div class="DTTT_container">
                                            </div>
                                            <div class="clear"></div>
                                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="descending" aria-label="Rendering engine: activate to sort column descending">#id</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="descending" aria-label="Rendering engine: activate to sort column descending">Project Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Subject</th>
                                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column descending">Request Category</th>
                                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column descending">Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column descending">Progress</th>
                                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column descending">Timestamp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                    
                                                            <tr class="gradeA odd" role="row">
                                                                <td class="sorting_1"><?//= $row['id'] ?></td>
                                                                <td><a href="request_detail?request_id=<?//= $row['id'] ?>"><?//= $row['name'] ?></a></td>
                                                                <td><a href="#" data-toggle="modal" data-target="#company<?//= $row['id'] ?>"><?//= $row['name'] ?></a></td>
                                                                <td><?//= $row['subject'] ?></td>
                                                                <td class="center"><?//= $row['request_category'] ?></td>
                                                                <td class="center"><?php //if ($row['status'] == 'active') {             ?><span class="label label-primary">Active</span><?php // } else if ($row['status'] == 'inactive') {            ?><span class="label label-default">Inactive</span><?php //}            ?></td>
                                                                <td class="center"><small>Completion with: <?//= $row['progress'] ?>%</small>
                                                                        <div class="progress progress-mini">
                                                                            <div style="width: <?//= $row['progress'] ?>%;" class="progress-bar"></div>
                                                                        </div>
                        </td>
                                                                <td class="center"><time datetime="<?//= $row['timestamp']; ?>" class="timeago" title="<?//= $row['timestamp']; ?>"><?//= $row['timestamp']; ?></time></td>
                                                            </tr>
                                                             Modal for company 
                                                        <div class="modal fade" id="company<?//= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel"><center><?//= $row['name']; ?></center></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <dl class="dl-horizontal">
                                                                            <dd style="padding-top: 10px"><strong><?//= $db->getEachById($con, 'contact_name', 'users', $row['by_id']) ?></strong></dd>
                                                                            <dd><small>&nbsp;</small></dd>
                                                                            <dt>Project Name</dt>
                                                                            <dd><?//= $row['name'] ?></dd>
                                                                            <dt>Subject</dt>
                                                                            <dd><?//= $row['subject'] ?></dd>
                                                                            <dt>Request Category</dt>
                                                                            <dd><?//= $row['request_category'] ?></dd>
                                                                            <br />
                                                                            <dt>Message</dt>
                                                                            <dd><?//= $row['message'] ?></dd>
                                                                            <br />
                                                                            <dt>Timestamp</dt>
                                                                            <dd><?//= $row['timestamp'] ?></dd>
                                                                        </dl>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                    <?php //}   ?>
                                                </tbody>
                                            </table>
                                        </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>