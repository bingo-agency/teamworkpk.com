<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}

if (isset($_GET['id'])) {
    $gotten_cash_client_id = $_GET['id'];
} else {
    $db->redirect('cash_clients');
}


$role = $db->getEachById($con, 'role', 'users', $id);
if ($role == 'team') {

//    if ($db->getEachById($con, 'by_id', 'web_posts', $gotten_lead_id) != $id) {
//        $db->redirect('careers');
//    }
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-dollar"></i> Cash Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Edit Cash Client</strong>
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
                    <h5>Edit Cash Client<small> Update your cash client in your Dashboard system.</small></h5>
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
                        $client_name = mysqli_real_escape_string($con, $_POST['client_name']);
                        $interested_in = mysqli_real_escape_string($con, $_POST['interested_in']);
                        $cash_amount = mysqli_real_escape_string($con, $_POST['cash_amount']);
                        $till_time = mysqli_real_escape_string($con, $_POST['till_time']);
                        $phone = mysqli_real_escape_string($con, $_POST['phone']);


                        if (empty($client_name) || empty($interested_in) || empty($cash_amount) || empty($phone)) {
                            $db->error(' All fields are required.');
                        }


                        if (!empty($client_name) && !empty($phone) && !empty($interested_in) && !empty($cash_amount)) {

                            $query = mysqli_query($con, "UPDATE `cash_clients`  SET `client_name` = '" . $client_name. "',`interested_in` = '" . $interested_in . "', `cash_amount` = '" . $cash_amount. "', `till_time` = '" . $till_time. "',`phone` = '" . $phone . "' WHERE `id` = '" . $gotten_cash_client_id . "'");
                            if (!$query) {
//                                print($query);
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Updated Cash Client <strong>" . $client_name . "</strong>");
                                $db->redirect('cash_clients?msg_add');
                            }
                        }
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal">


                        <div class="form-group"><label class="col-lg-2 control-label">Client's Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="client_name" value="<?php
                                if (isset($_POST['client_name'])) {
                                    echo $_POST['client_name'];
                                } else {
                                    echo $db->getEachById($con, 'client_name', 'cash_clients', $gotten_cash_client_id);
                                }
                                ?>" placeholder="Client's Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Interested In</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="interested_in" value="<?php
                                if (isset($_POST['interested_in'])) {
                                    echo $_POST['interested_in'];
                                } else {
                                    echo $db->getEachById($con, 'interested_in', 'cash_clients', $gotten_cash_client_id);
                                }
                                ?>" placeholder="Interested In"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group"><label class="col-lg-2 control-label">Cash Amount</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="cash_amount" value="<?php
                                if (isset($_POST['cash_amount'])) {
                                    echo $_POST['cash_amount'];
                                } else {
                                    echo $db->getEachById($con, 'cash_amount', 'cash_clients', $gotten_cash_client_id);
                                }
                                ?>" placeholder="Cash Amount"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group"><label class="col-lg-2 control-label">Till Time</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="till_time" value="<?php
                                if (isset($_POST['till_time'])) {
                                    echo $_POST['till_time'];
                                } else {
                                    echo $db->getEachById($con, 'till_time', 'cash_clients', $gotten_cash_client_id);
                                }
                                ?>" placeholder="Till Time"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" id="demand" value="<?php
                                if (isset($_POST['phone'])) {
                                    echo $_POST['phone'];
                                } else {
                                    echo $db->getEachById($con, 'phone', 'cash_clients', $gotten_cash_client_id);
                                }
                                ?>" placeholder="Phone Number (Digits only)" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "cash_clients" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Update Cash Client" />
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