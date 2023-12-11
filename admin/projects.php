<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Was viewing their projects <strong>Activity</strong>.");
}

if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];

    if (!empty($del_id)) {
        $queryDel = mysqli_query($con, "DELETE FROM `projects` WHERE `id` = '" . $del_id . "'");
        if ($queryDel) {
            $db->redirect('projects');
        } else {
            $db->error('Your project can not be deleted, Contact Admin Support.');
        }
    }
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-building"></i> Projects</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>View Projects</strong>
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
                    <h5>Projects <small>List of all Internal Projects.</small></h5>
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
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" aria-label="Platform(s): activate to sort column ascending">Ribbon</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">TimeStamp</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($role != 'team') {
                                    $query = mysqli_query($con, "SELECT * FROM `projects` ORDER BY `id` DESC");


                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?= $row['id'] ?></td>
                                            <td><a href="project_overview?project_id=<?= $row['id'] ?>"><?= $row['title']; ?></a></td>
                                            <td><?= $row['address'] ?></td>
                                            <td><?= $row['city'] ?></td>
                                            <td class="center"><?= $row['ribbon']; ?></td>
                                            <td class="center"><?= $db->getElapsedTime($row['timestamp']) ?></td>
                                            <td class="center"><a href="edit_project?id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>&nbsp;<a href="projects?del_id=<?= $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        <!-- Modal for company -->

                                    <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel"><center><?= $db->getEachById($con, 'title', 'projects', $row['id']) ?></center></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="dl-horizontal">
                                                        <dt><img src="<?= $row['image_link'] ?>" class="img-responsive pull-right  img-thumbnail" style=""/></dt>
                                                        <dd style="padding-top: 10%"><h3><?= $row['title']; ?></h3></dd>
                                                        <dd><small>&nbsp;</small></dd>
                                                        <dt>Project ID</dt>
                                                        <dd><?= $row['id'] ?></dd>
                                                        <dt>Description</dt>
                                                        <dd><?= $row['description'] ?></dd>

                                                        <dt>TimeStamp</dt>
                                                        <dd><?= $db->getEachById($con, 'timestamp', 'projects', $row['id']) ?></dd>
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
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <!--                        <div class="col-lg-12">
                    
                                            </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>