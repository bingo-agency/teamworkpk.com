<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-bar-chart"></i> Installments</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Print Invoices</strong>
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
                    <h5>Installments <small>List of all Unpaid Installments.</small></h5>
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
                                    <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 5%;" ><input type="checkbox" class="i-checks icheckbox_square-green" /> </th>
                                    <th  tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;"  >Name</th>
                                    <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20%;" >Shop/Apt Number</th>
                                    <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" >Phone</th>
                                    <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" >Monthly Due</th>
                                    <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 15%;" >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysql_query("SELECT * FROM `clients` ORDER BY `id` DESC");
                                while ($row = mysql_fetch_array($query)) {
                                    ?>
                                    <tr class="gradeA odd" role="row">
                                        <td class="center"><input type="checkbox"  checked class="i-checks icheckbox_square-green" name="input[]"></td>
                                        <td><a href="#" data-toggle="modal" data-target="#company<?= $row['id'] ?>"><?= $row['client_name'] ?></a></td>
                                        <td><?= $row['shop'] ?></td>
                                        <td class="center"><?= $row['telephone'] ?></td>
                                        <td class="center"><?= $row['total_payment'] ?></td>
                                        <td class="center">
                                            <button class="btn btn-primary">View Document</button>
                                            <a href="print_document?id=<?= $row['id'];?>" target="_blank" class="btn btn-danger">Print</a>
                                        </td>
                                    </tr>
                                    <!-- Modal for company -->
                                <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><center><?= $row['client_name']; ?></center></h4>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="dl-horizontal">
                                                    <dd style="padding-top: 10px"><strong><?= $db->getEachById('client_name', 'clients', $row['id']) ?></strong></dd>
                                                    <dd><small>&nbsp;</small></dd>
                                                    <dt>Client Name</dt>
                                                    <dd><?= $db->getEachById('client_name', 'clients', $row['id']) ?></dd>
                                                    <dt>Address</dt>
                                                    <dd><?= $db->getEachById('address', 'clients', $row['id']) ?></dd>
                                                    <dt>Phone</dt>
                                                    <dd><?= $db->getEachById('telephone', 'clients', $row['id']) ?></dd>
                                                    <dt>Shop/Apt Number</dt>
                                                    <dd><?= $db->getEachById('shop', 'clients', $row['id']) ?></dd>
                                                    <dt>Total Payment</dt>
                                                    <dd><?= $db->getEachById('total_payment', 'clients', $row['id']) ?></dd>
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