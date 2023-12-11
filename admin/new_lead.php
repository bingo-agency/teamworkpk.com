<?php
include'includes/header.php';
if (!$_SESSION['user']) {
    $db->redirect('login');
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>
            New Lead</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>New Lead</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-plus-circle"></i> New Lead</h5>
                </div>
                <div class="ibox-content" style="min-height:100vh;">
                    <div class="clear clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <?php 
                                        $activity_request_status = '';
                                        ?>
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
                                                    $query = mysqli_query($con, "SELECT * FROM `users` WHERE role='clients' ORDER BY `id` DESC");
                                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                        ?>
                                                        <tr class="gradeA odd" role="row">
                                                            <td class="sorting_1"><?= $row['id'] ?></td>
                                                            <td><a href="request_detail?request_id=<?= $row['id'] ?>"><?= $row['name'] ?></a></td>
                                                            <td><a href="edit_user?id=<?= $row['by_id'] ?>"><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></a></td>
                                                            <td><?= $row['request_category'] ?></td>
                                                            <td class="center"><?= $row['status'] ?></td>
                                                            <td class="center"><?= $row['progress'] ?></td>
                                                            <td class="center"><?= $db->getElapsedTime($row['timestamp']) ?></td>
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
                                        <?= 'activity_request_status' ?>
                                                                </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>