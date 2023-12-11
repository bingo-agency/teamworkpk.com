<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}



$role = $db->getEachById($con, 'role', 'users', $id);
if ($role == 'team') {

//    if ($db->getEachById($con, 'by_id', 'web_posts', $gotten_lead_id) != $id) {
//        $db->redirect('cash_clients');
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
                <strong>Cash Clients</strong>
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
                    <h5>Add Cash Clients <small>Add Cash Clients to your Dashboard.</small></h5>
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


                        if (empty($client_name) || empty($interested_in) || empty($cash_amount) || empty($till_name)) {
                            $db->error('All fields are required.');
                        }


                        if (!empty($client_name) && !empty($phone) && !empty($interested_in)) {

                            $query = mysqli_query($con, "INSERT INTO `cash_clients`  SET `client_name` = '" . $client_name . "',`interested_in` = '" . $interested_in . "', `cash_amount` = '" . $cash_amount . "', `till_time` = '" . $till_time . "',`phone` = '" . $phone . "'");
                            if (!$query) {
                                print($query);
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Added Cash Client <strong>" . $client_name . "</strong>");
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
                                }
                                ?>" placeholder="Client's Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Interested In</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="interested_in" value="<?php
                                if (isset($_POST['interested_in'])) {
                                    echo $_POST['interested_in'];
                                }
                                ?>" placeholder="Interested In"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Cash Amount</label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="cash_amount" value="<?php
                                if (isset($_POST['cash_amount'])) {
                                    echo $_POST['cash_amount'];
                                }
                                ?>" placeholder="Cash Amount"></div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <!--                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                                    <div class="col-sm-10"><textarea rows="10" class="form-control" name="description" placeholder="Job Description" /><?php
                        if (isset($_POST['description'])) {
                            echo $_POST['description'];
                        }
                        ?></textarea></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>-->

                        <div class="form-group">
                            <label for="till_time" class="col-sm-2 control-label">till_time</label>
                            <div class="col-sm-10">
                                <input type="text" name="till_time" class="form-control" id="till_time" value="<?php
                                if (isset($_POST['till_time'])) {
                                    echo $_POST['till_time'];
                                }
                                ?>" placeholder="Till Time" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <label for="Phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="number" name="phone" class="form-control" value="<?php
                                if (isset($_POST['phone'])) {
                                    echo $_POST['phone'];
                                }
                                ?>" placeholder="Phone Number (Digits only)" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>






                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "cash_clients" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Add Cash Client" />
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