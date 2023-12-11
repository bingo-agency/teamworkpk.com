<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Adding leads on <a href='add_leads'>Add Leads</a> ");
}
?>
<?php
//if ($role != 'admin') {
//    $db->redirect('dashboard');
//}
?>
<link href="https://fonts.cdnfonts.com/css/gotham" rel="stylesheet">
<style>

    .tw-roundedCircle{
        min-height: 300px;
        position: absolute;
        /*        background: #C04848;   fallback for old browsers 
                background: -webkit-linear-gradient(to right, #480048, #C04848);   Chrome 10-25, Safari 5.1-6 
                background: linear-gradient(to right, #480048, #C04848);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        min-width: 300px;
        /*border-radius: 50%;*/
        /*border: 5px solid #5e1863;*/
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    @media only screen and (max-width: 1200px) {
        .tw-roundedCircle {
            z-index:-1;
        }
    }


</style>
<div class="tw-roundedCircle" style="z-index: 1;top:3.5%;
     opacity: 0.7;right: -12%;background-image: url(../img/banner/banner6.png)">

</div>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-building"></i> Internal Leads</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Add Lead</strong>
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
                <!--                <div class="ibox-title">
                                    <h5>Add Leads <small>Add Leads to your Internal Listing.</small></h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>-->
                <div class="ibox-content" style="
                     border-radius:15px 0px 15px 0px;
                     box-shadow: 2px 2px 12px #00000069;background-color: #ffffff;
                     color: inherit;
                     padding: 0px 20px 0px 15px;
                     border-color: #808080ed;
                     border-image: none;
                     border-style: solid;
                     border-width: 5px;
                     /*                     background: #6f1c74;   fallback for old browsers 
                                          background: -webkit-linear-gradient(to right, #480048, #fff);   Chrome 10-25, Safari 5.1-6 
                                          background: linear-gradient(to right, #480048, #fff);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                     background-size: cover;">
                    <div class="row">
                        <div class="col-lg-5" style="
                             min-height: 120vh;

                             z-index: 2;
                             border-radius: 10px 0px 0px 10px;



                             background: #C04848;  /* fallback for old browsers */
                             /*background: -webkit-linear-gradient(to bottom, #480048, #C04848);   Chrome 10-25, Safari 5.1-6 */
                             /*background: linear-gradient(to right, #480048, #C04848);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                             background: linear-gradient(to bottom, #480048, #c0484866);



                             /*background: #1ab394b3;*/  
                             /* fallback for old browsers */
                             /*background: -webkit-linear-gradient(to right, #480048, #C04848);   Chrome 10-25, Safari 5.1-6 */
                             /*background: linear-gradient(to right, #480048, #C04848);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

                             ">
                            <div class="" style='padding:10px'>

                                <center><img src="../img/logoGreen.png" /></center>
                                <div class="" style='padding-top:100px;'>
                                    <h1 style="font-family: Gotham;color:#fff;font-weight: 500">Welcome Back,<br /> <?= $db->getEachById($con, 'contact_name', 'users', $id) ?></h1>
                                    <p style="font-family: Gotham;color:#fff;font-weight: 500">Add more entries to your system</p>
                                </div>
                                <div class="" style='padding-top:10px;'>
                                    <a href="view_all_leads" class="btn btn-lg btn-primary btn-outline">View All Leads</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-7">
                            <div class="center-block">
                                <h1 style="font-weight: 600;
                                    padding-top: 25px;
                                    padding-bottom: 25px;
                                    font-family: Gotham;
                                    color: #1ab394;">Fill out the Internal Lead form</h1>
                            </div>
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
                                $status = 'New';
                                $progress = '0';
                                $assign = mysqli_real_escape_string($con, $_POST['assign']);

                                if (empty($lead_id) || empty($contact_info) || empty($client_name)) {
                                    $db->error('Lead ID, Contact Number & Client Name is required');
                                }
                                $dup = mysqli_query($con, "SELECT `lead_id` FROM `internal_leads` WHERE `lead_id` = '" . $lead_id . "'");
                                if (mysqli_num_rows($dup) > 0) {
                                    $db->error("This Lead ID <strong>" . $lead_id . "</strong> already exists, Try to Searching and editing it instead from all <a href='view_all_leads'>Leads</a>.");
                                } else {
                                    if (!empty($client_name) && !empty($contact_info) && !empty($lead_id)) {
                                        $query = mysqli_query($con, "INSERT INTO `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = '" . $status . "',`progress` = '" . $progress . "',`assigned_to` = '" . $assign . "' ");
                                        if (!$query) {
//                                            print("INSERT INTO `internal_leads`  SET `lead_id` = '" . $lead_id . "',`by_id` = '" . $by_id . "', `client_name` = '" . $client_name . "', `property_location` = '" . $property_location . "',`details` = '" . $details . "', `property_in_demand` = '" . $property_in_demand . "', `exchange_in_demand` = '" . $exchange_in_demand . "',`visit_time`='" . $visit_time . "',`expense_visit` = '" . $expense_visit . "',`contact_info` = '" . $contact_info . "',`remarks` = '" . $remarks . "' ,`status` = '" . $status . "',`progress` = '" . $progress . "',`assigned_to` = '" . $assign . "' ");
//                                            exit();
                                            $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                                        } else {
                                            $db->add_user_activity($con, "Added a new lead <strong>" . $client_name . "</strong>");
                                            $db->redirect('view_all_leads?msg_add');
                                        }
                                    }
                                }
                            }
                            if (isset($_GET['msg'])) {
                                $db->success('<strong>Thank you</strong> Your record has been updated!');
                            }
                            ?>
                            <form action="#" method="POST" class="form-horizontal">


                                <!--<div class="hr-line-dashed"></div>-->
                                <div class="form-group">

                                    <div class="col-sm-6"><input type="text" class="form-control" name="lead_id" value="<?php
                                        if (isset($_POST['lead_id'])) {
                                            echo $_POST['lead_id'];
                                        }else{
                                            echo $db->getMaxLeadId($con);
                                        }
                                        ?>" placeholder="Lead_id" required=""></div>
                                    <div class="col-sm-6"><input type="text" class="form-control" name="client_name" value="<?php
                                        if (isset($_POST['client_name'])) {
                                            echo $_POST['client_name'];
                                        }
                                        ?>" placeholder="Client Name"></div>
                                </div>
                                <!--<div class="hr-line-dashed"></div>-->
                                <div class="form-group">
                                    <!--<label class="col-lg-2 control-label">Property Location</label>-->
                                    <div class="col-sm-12"><input type="text" class="form-control" name="property_location" value="<?php
                                        if (isset($_POST['property_location'])) {
                                            echo $_POST['property_location'];
                                        }
                                        ?>" placeholder="Property Location"></div>
                                </div>
                                <!--<div class="hr-line-dashed"></div>-->

                                <div class="form-group">
                                    <!--<label class="col-sm-2 control-label">Details</label>-->
                                    <div class="col-sm-12"><textarea rows="5" class="form-control" name="details" placeholder="Details" /><?php
                                        if (isset($_POST['details'])) {
                                            echo $_POST['details'];
                                        }
                                        ?></textarea></div>
                                </div>
                                <!--<div class="hr-line-dashed"></div>-->


                                <!--<div class="hr-line-dashed"></div>-->

                                <div class="form-group">
                                    <!--<label for="exchange_demand" class="col-sm-2 control-label">Exchange in Demand</label>-->
                                    <div class="col-sm-12">
                                        <input type="text" name="exchange_in_demand" class="form-control" value="<?php
                                        if (isset($_POST['exchange_in_demand'])) {
                                            echo $_POST['exchange_in_demand'];
                                        }
                                        ?>" placeholder="Exchange in Demand" >
                                    </div>

                                </div>
                                <div class="form-group">
                                    <!--<label for="exchange_demand" class="col-sm-2 control-label">Exchange in Demand</label>-->
                                    <div class="col-sm-12">
                                        <input type="text" name="property_in_demand" class="form-control" id="demand" value="<?php
                                        if (isset($_POST['property_in_demand'])) {
                                            echo $_POST['property_in_demand'];
                                        }
                                        ?>" placeholder="Property In Demand" >
                                    </div>

                                </div>
                                <!--<div class="hr-line-dashed"></div>-->

                                <div class="form-group">
                                    <!--<label for="visit_time" class="col-sm-2 control-label">Visit Time</label>-->
                                    <div class="col-sm-6">
                                        <input type="text" name="visit_time" class="form-control" value="<?php
                                        if (isset($_POST['visit_time'])) {
                                            echo $_POST['visit_time'];
                                        }
                                        ?>" placeholder="Visit Time" >
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="expense_visit" class="form-control" value="<?php
                                        if (isset($_POST['expense_visit'])) {
                                            echo $_POST['expense_visit'];
                                        }
                                        ?>" placeholder="Expense Of Visit" >
                                    </div>
                                </div>
                                <!--<div class="hr-line-dashed"></div>-->

                                <!--<div class="hr-line-dashed"></div>-->
                                <div class="form-group">
                                    <!--<label for="contact_info" class="col-sm-2 control-label">Contact Info</label>-->
                                    <div class="col-sm-12">
                                        <input type="text" name="contact_info" class="form-control" value="<?php
                                        if (isset($_POST['contact_info'])) {
                                            echo $_POST['contact_info'];
                                        }
                                        ?>" placeholder="Contact Info" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!--<label for="assign" class="col-sm-2 control-label">Assign</label>-->
                                    <div class="col-sm-12">
                                        <input type="text" name="assign" class="form-control" value="<?php
                                        if (isset($_POST['assign'])) {
                                            echo $_POST['assign'];
                                        }
                                        ?>" placeholder="Assign" required>
                                    </div>
                                </div>
                                <!--<div class="hr-line-dashed"></div>-->
                                <div class="form-group">
                                    <!--<label for="Remarks" class="col-sm-2 control-label">Remarks</label>-->
                                    <div class="col-sm-12">
                                        <textarea class="form-control m-b" name="remarks" placeholder="Remarks" rows="5"><?php
                                            if (isset($_POST['remarks'])) {
                                                echo $_POST['remarks'];
                                            }
                                            ?></textarea>
                                    </div>
                                    <p class="small" style="margin-left:15px;">This is a solid entry. Once a lead is added, it can not be deleted or modified without Admin.</p>
                                </div>

                                <!--<div class="hr-line-dashed"></div>-->

                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <a href="view_all_leads" class="btn btn-white" >Cancel</a>
                                        <input name="submit" class="btn btn-primary" type="submit" value="Add Lead" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-roundedCircle" style="left: -10%;bottom:15%;min-height:250px;min-width:300px;background-image: url(../img/banner/banner4.png)">

        </div>
    </div>
</div>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="clearfix"></div>
<?php include'includes/footer.php'; ?>