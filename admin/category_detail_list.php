<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    if (isset($_GET['cat_id'])) {
        $cat_id = $_GET['cat_id'];
    } else {
        $db->redirect('login');
    }
    $db->add_user_activity($con, "Checking all users on <a href='view_all_users'>Users</a> ");
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
                <h2><!-- <i class="fa fa-users"></i> --><strong>Category </strong> <?= $db->getEachById($con, 'name', 'categories', $cat_id); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Users in "<?= $db->getEachById($con, 'name', 'categories', $cat_id); ?>"</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Request Categories <small>List of all Users with Requests in <?= $db->getEachById($con, 'name', 'categories', $cat_id); ?>.</small></h5>
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
                    <?php
                    if (isset($_GET['msg'])) {
                        $db->success('<strong>Thank you</strong> Your record has been updated!');
                    }
                    if (isset($_GET['msg_add'])) {
                        $db->success('<strong>Thank you</strong> Your client has been added!');
                    }
                    ?>
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                        <div class="DTTT_container">
                        </div>
                        <div class="clear"></div>
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#id</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Contact Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="Engine version: activate to sort column ascending">Phone</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Role</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM `requests` WHERE `request_category` = '" . $db->getEachById($con, 'name', 'categories', $cat_id) . "' ORDER BY `id` DESC");
                                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                    ?>
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1"><?= $row['id'] ?></td>
                                        <td><a href="#" data-toggle="modal" data-target="#company<?= $row['id'] ?>"><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></a></td>
                                        <td><?= $db->getEachById($con, 'email', 'users', $row['by_id']); ?></td>
                                        <td class="center"><?= $db->getEachById($con, 'telephone', 'users', $row['by_id']); ?></td>
                                        <td class="center"><?= $db->getEachById($con, 'role', 'users', $row['by_id']); ?></td>
                                        <td class="center"><a href="edit_user?id=<?= $row['by_id'] ?>" class="btn btn-primary">Edit</a> &nbsp; <button class="btn btn-danger">Block</button></td>
                                    </tr>
                                    <!-- Modal for company -->
                                <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><center><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></center></h4>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="dl-horizontal">
                                                    <dt><img src="img/<?= $db->getEachById($con, 'image', 'users', $row['by_id']); ?>" class="img-responsive pull-right img-circle img-thumbnail" style="max-width:100px;"/></dt>
                                                    <dd style="padding-top: 10%"><h3><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></h3></dd>
                                                    <!--<dd><small>&nbsp;</small></dd>-->
                                                    <dt>Contact Name</dt>
                                                    <dd><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></dd>
                                                    <dt>Email</dt>
                                                    <dd><?= $db->getEachById($con, 'email', 'users', $row['by_id']); ?></dd>
                                                    <dt>Phone</dt>
                                                    <dd><?= $db->getEachById($con, 'telephone', 'users', $row['by_id']); ?></dd>
                                                    <dt>Role</dt>
                                                    <dd><?= $db->getEachById($con, 'role', 'users', $row['by_id']); ?></dd>
                                                    <dt>TimeStamp</dt>
                                                    <dd><?= $db->getEachById($con, 'timestamp', 'users', $row['by_id']); ?></dd>
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Access Categories <small>List of all Users who have access to <?= $db->getEachById($con, 'name', 'categories', $cat_id); ?>.</small></h5>
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
                    <?php
                    if (isset($_GET['msg'])) {
                        $db->success('<strong>Thank you</strong> Your record has been updated!');
                    }
                    if (isset($_GET['msg_add'])) {
                        $db->success('<strong>Thank you</strong> Your client has been added!');
                    }
                    ?>
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                        <div class="DTTT_container">
                        </div>
                        <div class="clear"></div>
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#id</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Contact Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="Engine version: activate to sort column ascending">Phone</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Role</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryAccess = mysqli_query($con, "SELECT * FROM `category_access` WHERE `category_id` = '" . $cat_id . "' ORDER BY `id` DESC");
                                while ($row = mysqli_fetch_array($queryAccess, MYSQLI_ASSOC)) {
                                    ?>
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1"><?= $row['id'] ?></td>
                                        <td><a href="#" data-toggle="modal" data-target="#company<?= $row['id'] ?>"><?= $db->getEachById($con, 'contact_name', 'users', $row['user_id']); ?></a></td>
                                        <td><?= $db->getEachById($con, 'email', 'users', $row['user_id']); ?></td>
                                        <td class="center"><?= $db->getEachById($con, 'telephone', 'users', $row['user_id']); ?></td>
                                        <td class="center"><?= $db->getEachById($con, 'role', 'users', $row['user_id']); ?></td>
                                        <td class="center"><a href="edit_user?id=<?= $row['user_id'] ?>" class="btn btn-primary">Edit</a> &nbsp; <button class="btn btn-danger">Block</button></td>
                                    </tr>
                                    <!-- Modal for company -->
                                <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><center><?= $db->getEachById($con, 'contact_name', 'users', $row['user_id']); ?></center></h4>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="dl-horizontal">
                                                    <dt><img src="img/<?= $db->getEachById($con, 'image', 'users', $row['user_id']); ?>" class="img-responsive pull-right img-circle img-thumbnail" style="max-width:100px;"/></dt>
                                                    <dd style="padding-top: 10%"><h3><?= $db->getEachById($con, 'contact_name', 'users', $row['user_id']); ?></h3></dd>
                                                    <!--<dd><small>&nbsp;</small></dd>-->
                                                    <dt>Contact Name</dt>
                                                    <dd><?= $db->getEachById($con, 'contact_name', 'users', $row['user_id']); ?></dd>
                                                    <dt>Email</dt>
                                                    <dd><?= $db->getEachById($con, 'email', 'users', $row['user_id']); ?></dd>
                                                    <dt>Phone</dt>
                                                    <dd><?= $db->getEachById($con, 'telephone', 'users', $row['user_id']); ?></dd>
                                                    <dt>Role</dt>
                                                    <dd><?= $db->getEachById($con, 'role', 'users', $row['user_id']); ?></dd>
                                                    <dt>TimeStamp</dt>
                                                    <dd><?= $db->getEachById($con, 'timestamp', 'users', $row['user_id']); ?></dd>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>