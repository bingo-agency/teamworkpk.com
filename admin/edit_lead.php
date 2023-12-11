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


$role = $db->getEachById($con, 'role', 'users', $id);
if ($role == 'team') {

    if ($db->getEachById($con, 'by_id', 'internal_leads', $gotten_lead_id) != $id) {
        $db->redirect('view_all_leads');
    }
}
?>
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
                    if (isset($_POST['submit'])) {
                        $by_id = mysqli_real_escape_string($con, $_SESSION['user']['id']);
                        $lead_id = mysqli_real_escape_string($con, $_POST['lead_id']);
                        $client_name = mysqli_real_escape_string($con, $_POST['client_name']);
                        $property_location = mysqli_real_escape_string($con, $_POST['property_location']);
                        $details = mysqli_real_escape_string($con, $_POST['details']);
                        $property_in_demand = mysqli_real_escape_string($con, $_POST['property_in_demand']);
                        $exchange_in_demand = mysqli_real_escape_string($con, $_POST['exchange_in_demand']);
                        $visit_time = mysqli_real_escape_string($con, $_POST['visit_time']);
                        $expense_visit = mysqli_real_escape_string($con, $_POST['expense_visit']);
                        $contact_info = mysqli_real_escape_string($con, $_POST['contact_info']);
                        $remarks = mysqli_real_escape_string($con, $_POST['remarks']);
                        $progress = mysqli_real_escape_string($con, $_POST['progress']);
                        $assign = mysqli_real_escape_string($con, $_POST['assign']);


                        if (empty($lead_id) || empty($contact_info) || empty($client_name)) {
                            $db->error('Lead ID, Contact Number & Client Name is required');
                        }


                        if (!empty($client_name) && !empty($contact_info) && !empty($lead_id)) {

                            $query = mysqli_query($con, "UPDATE `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = 'active',`progress` = '" . $progress . "',`assigned_to` = '" . $assign . "' WHERE `id` = '" . $gotten_lead_id . "'");
                            if (!$query) {
                                print($query);
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Added a new lead <strong>" . $client_name . "</strong>");
                                $db->redirect('view_all_leads?msg_add');
                            }


//                            if ($status == 'in-progress') {
//
//                                $query = mysqli_query($con, "UPDATE `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = '" . $status . "',`progress` = '" . $progress . "',`assigned_to` = '" . $assign . "' WHERE `id` = '" . $gotten_lead_id . "'");
//                                echo "UPDATE `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = '" . $status . "',`assign` = '" . $assign . "' WHERE `id` = '" . $gotten_lead_id . "'";
//                            } else if ($status == 'complete') {
//                                $query = mysqli_query($con, "UPDATE `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = '" . $status . "',`progress` = '" . $progress . "',`assign` = '" . $assign . "' WHERE `id` = '" . $gotten_lead_id . "'");
//                                echo "UPDATE `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = '" . $status . "',`assign` = '" . $assign . "' WHERE `id` = '" . $gotten_lead_id . "'";
//                            } else {
//                                echo 'not in progress';
//                                $query = mysqli_query($con, "INSERT INTO `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = '" . $status . "',`assign` = '" . $assign . "' WHERE `id` = '" . $gotten_lead_id . "'");
//                            }
                        }
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal">


                        <div class="form-group"><label class="col-lg-2 control-label">Lead ID</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="lead_id" value="<?php
                                if (isset($_POST['lead_id'])) {
                                    echo $_POST['lead_id'];
                                } else {
                                    echo $db->getEachById($con, 'lead_id', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Lead ID"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Client Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="client_name" value="<?php
                                if (isset($_POST['client_name'])) {
                                    echo $_POST['client_name'];
                                } else {
                                    echo $db->getEachById($con, 'client_name', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Client Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Property Location</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="property_location" value="<?php
                                if (isset($_POST['property_location'])) {
                                    echo $_POST['property_location'];
                                } else {
                                    echo $db->getEachById($con, 'property_location', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Property Location"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-10"><textarea rows="10" class="form-control" name="details" placeholder="Details" /><?php
                                if (isset($_POST['details'])) {
                                    echo $_POST['details'];
                                } else {
                                    echo $db->getEachById($con, 'details', 'internal_leads', $gotten_lead_id);
                                }
                                ?></textarea></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="demand" class="col-sm-2 control-label">Property in Demand</label>
                            <div class="col-sm-10">
                                <input type="text" name="property_in_demand" class="form-control" id="demand" value="<?php
                                if (isset($_POST['property_in_demand'])) {
                                    echo $_POST['property_in_demand'];
                                } else {
                                    echo $db->getEachById($con, 'property_in_demand', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="property_in_demand" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="exchange_demand" class="col-sm-2 control-label">Exchange in Demand</label>
                            <div class="col-sm-10">
                                <input type="text" name="exchange_in_demand" class="form-control" value="<?php
                                if (isset($_POST['exchange_in_demand'])) {
                                    echo $_POST['exchange_in_demand'];
                                } else {
                                    echo $db->getEachById($con, 'exchange_in_demand', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Exchange in Demand" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="visit_time" class="col-sm-2 control-label">Visit Time</label>
                            <div class="col-sm-10">
                                <input type="text" name="visit_time" class="form-control" value="<?php
                                if (isset($_POST['visit_time'])) {
                                    echo $_POST['visit_time'];
                                } else {
                                    echo $db->getEachById($con, 'visit_time', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Visit Time" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="expense_visit" class="col-sm-2 control-label">Expense of Visit</label>
                            <div class="col-sm-10">
                                <input type="text" name="expense_visit" class="form-control" value="<?php
                                if (isset($_POST['expense_visit'])) {
                                    echo $_POST['expense_visit'];
                                } else {
                                    echo $db->getEachById($con, 'expense_visit', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Expense Of Visit" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="contact_info" class="col-sm-2 control-label">Contact Info</label>
                            <div class="col-sm-10">
                                <input type="text" name="contact_info" class="form-control" value="<?php
                                if (isset($_POST['contact_info'])) {
                                    echo $_POST['contact_info'];
                                } else {
                                    echo $db->getEachById($con, 'contact_info', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Contact Info" required>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="Remarks" class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                                <textarea class="form-control m-b" name="remarks" placeholder="Remarks" rows="5"><?php
                                    if (isset($_POST['remarks'])) {
                                        echo $_POST['remarks'];
                                    } else {
                                        echo $db->getEachById($con, 'remarks', 'internal_leads', $gotten_lead_id);
                                    }
                                    ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="assign" class="col-sm-2 control-label">Assign</label>
                            <div class="col-sm-10">
                                <input type="text" name="assign" class="form-control" value="<?php
                                if (isset($_POST['assign'])) {
                                    echo $_POST['assign'];
                                } else {
                                    echo $db->getEachById($con, 'assigned_to', 'internal_leads', $gotten_lead_id);
                                }
                                ?>" placeholder="Assign to someone" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
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
                        <div class = "hr-line-dashed"></div>

                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "view_all_leads" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Update" />
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php';
?>