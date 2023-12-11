<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}

if (isset($_GET['id'])) {
    $gotten_lead_id = $_GET['id'];
} else {
    $db->redirect('view_all_leads');
}
?>
<link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<style>

    .dataTables_length,.dataTables_filter,.dataTables_info,.dataTables_paginate,.paging_simple_numbers{
        display:none;
    }
    .dt-buttons{
        float:right;
    }

</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-users"></i> Users</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Edit Lead</strong>
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
                    <h5>Edit Lead <small>Edit Internal leads in your software.</small></h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-tw" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><?= $db->getEachById($con, 'lead_id', 'internal_leads', $gotten_lead_id); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td>Client's Name</td>
                                    <td><?= $db->getEachById($con, 'client_name', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Assigned To</td>
                                    <td><?= $db->getEachById($con, 'assigned_to', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Property Location</td>
                                    <td><?= $db->getEachById($con, 'property_location', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Details</td>
                                    <td><?= $db->getEachById($con, 'details', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Property in Demand</td>
                                    <td><?= $db->getEachById($con, 'property_in_demand', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Exchange in Demand</td>
                                    <td><?= $db->getEachById($con, 'exchange_in_demand', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Visit Time</td>
                                    <td><?= $db->getEachById($con, 'visit_time', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Expense of Visit</td>
                                    <td><?= $db->getEachById($con, 'expense_visit', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Contact Info</td>
                                    <td><?= $db->getEachById($con, 'contact_info', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Remarks</td>
                                    <td><?= $db->getEachById($con, 'remarks', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>
                                <tr class="gradeX">
                                    <td>TimeStamp</td>
                                    <td><?= $db->getEachById($con, 'timestamp', 'internal_leads', $gotten_lead_id); ?></td>
                                </tr>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Progress</th>
                                    <th>
                                        <?php if ($db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) == '0') { ?>
                                            <span>New</span>
                                        <?php } else if ($db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) == '100') { ?>
                                            <div class="progress" style="margin-bottom: 0px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animate" role="progressbar" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) . '%' ?>">

                                                    <?= $db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) . '%' ?>
                                                </div>
                                            </div> 
                                        <?php } else { ?>
                                            <div class="progress" style="margin-bottom: 0px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animate" role="progressbar" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) . '%' ?>">

                                                    <?= $db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) . '%' ?>
                                                </div>
                                            </div> 
                                        <?php } ?>    

                                    </th>

                                </tr>
                                <tr>
                                    <th>Generated by</th>
                                    <th><?= $db->getEachById($con, 'contact_name', 'users', $db->getEachById($con, 'by_id', 'internal_leads', $gotten_lead_id)); ?></th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
                <?php
                $queryFrontEnd = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `internal_lead_id` = '" . $db->getEachById($con, 'lead_id', 'internal_leads', $gotten_lead_id) . "' LIMIT 1");
                while ($row = mysqli_fetch_array($queryFrontEnd, MYSQLI_ASSOC)) {
                    ?>
                    <div class="">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Property Detail</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" style="width:100%" class="img-responsive" src="../<?= $row['primary_image'] ?>">
                                </div>
                                <div class="ibox-content profile-content">
                                    <h4><strong><?= $row['title'] ?></strong></h4>
                                    <p><i class="fa fa-map-marker"></i> <?= $row['address'] ?>,<?= $row['city'] ?></p>
                                    <h5>
                                        Property Description
                                    </h5>
                                    <p>
                                        <?= $row['description']; ?>
                                    </p>
                                    <h5>
                                        Property Price
                                    </h5>
                                    <p>
                                        <?= $row['price']; ?>
                                    </p>
                                    <h5>
                                        Posted By
                                    </h5>
                                    <p>
                                        <?= $db->getEachById($con, 'name', 'public_users', $row['public_user_id']); ?>
                                    </p>
                                    

                                </div>
                            </div>
                        </div>
                    </div>


                <?php }
                ?>
                <div class="ibox-content">
                    <div class="">
                        <h5>Additional Remarks <small>Add new remarks to your lead with progress update.</small></h5>
                        <div class="feed-activity-list" style="padding:20px">

                            <?php
                            $getRemarks = mysqli_query($con, "SELECT * FROM `additional_remarks` WHERE `lead_id` = '" . $gotten_lead_id . "' ");
                            while ($row = mysqli_fetch_array($getRemarks, MYSQLI_ASSOC)) {
                                ?>
                                <div class="feed-element">
                                    <a class="float-left" href="#">
                                        <img alt="<?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?>" class="rounded-circle img-responsive" src="img/<?= $db->getEachById($con, 'image', 'users', $row['by_id']); ?>">
                                    </a>
                                    <div class="media-body ">
                                        <small class="float-right"><?= $row['timestamp']; ?></small>
                                        <strong><?= $db->getEachById($con, 'contact_name', 'users', $row['by_id']); ?></strong> <?= $row['remarks'] ?> <br>
                                        <small class="text-muted"><?= $row['timestamp'] ?></small>

                                    </div>
                                </div>
                            <?php }
                            ?>

                        </div>
                        <div style="margin:10px"></div>
                        <div class="somethingnew">
                            <?php
                            if (isset($_POST['submit'])) {

                                $progress = mysqli_real_escape_string($con, $_POST['progress']);
                                $remarks = mysqli_real_escape_string($con, $_POST['remarks']);


                                $queryUpdate = mysqli_query($con, "UPDATE `internal_leads` SET `progress` = '" . $progress . "' WHERE `id` = '" . $gotten_lead_id . "'");
                                if ($queryUpdate) {
                                    $queryAddRemarks = mysqli_query($con, "INSERT INTO `additional_remarks` SET `lead_id` = '" . $gotten_lead_id . "',`by_id` = '" . $id . "',`remarks` = '" . $remarks . "'");

                                    if ($queryAddRemarks) {
                                        $db->redirect('lead_detail?id=' . $gotten_lead_id);
                                    } else {
                                        $db->error('Contact Admin Support.');
                                    }
                                }
                            }
                            ?>

                            <form action="#" method="POST" class="form-horizontal">


                                <!--<div class="hr-line-dashed"></div>-->
                                <div class="form-group">

                                    <div class="form-group">
                                        <label for="Progress" class="col-sm-2 control-label">Progress</label>
                                        <div class="col-sm-10">
                                            <select name="progress" class="form-control m-b">
                                                <?php if (isset($_POST['progress'])) { ?>
                                                    <option selected="true" style="text-transform: capitalize" value="<?= $_POST['progress']; ?>"><?= $_POST['progress']; ?></option>    
                                                <?php } else { ?>
                                                    <option selected="true" style="text-transform: capitalize" value="<?= $db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) ?>"><?= $db->getEachById($con, 'progress', 'internal_leads', $gotten_lead_id) ?></option>
                                                <?php }
                                                ?>
                                                <option value = "0">New</option>
                                                <option value = "10">10%</option>
                                                <option value = "20">20%</option>
                                                <option value = "30">30%</option>
                                                <option value = "40">40%</option>
                                                <option value = "50">50%</option>
                                                <option value = "60">60%</option>
                                                <option value = "70">70%</option>
                                                <option value = "80">80%</option>
                                                <option value = "90">90%</option>
                                                <option value = "95">95%</option>
                                                <option value = "100">100%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label for="Remarks" class="col-sm-2 control-label">Remarks</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control m-b" name="remarks" placeholder="Remarks" rows="5"><?php
                                                if (isset($_POST['remarks'])) {
                                                    echo $_POST['remarks'];
                                                }
                                                ?></textarea>
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <div class = "col-sm-4 col-sm-offset-2">
                                            <input name="submit" class = "btn btn-primary" type = "submit" value = "Add Remarks" />
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>
<script src="js/plugins/dataTables/datatables.min.js"></script>

<script>

    // Upgrade button class name
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

    $(document).ready(function () {
        $('.dataTables-tw').DataTable({
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'TeamWorkEst'},
                {extend: 'pdf', title: 'TeamWorkEst'},

                {extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        $('.buttons-print').removeClass('btn-white');
                        $('.buttons-print').addClass('btn-primary');

                    }
                }
            ]

        });

    });

</script>