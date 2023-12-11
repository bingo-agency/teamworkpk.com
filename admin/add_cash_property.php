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
        <h2><i class="fa fa-dollar"></i> Cash Properties</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Cash Properties</strong>
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
                    <h5>Add Cash Properties <small>Add Cash Properties to your Dashboard.</small></h5>
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
                        $title = mysqli_real_escape_string($con, $_POST['title']);
                        $address = mysqli_real_escape_string($con, $_POST['address']);
                        $client_name = mysqli_real_escape_string($con, $_POST['client_name']);
                        $price = mysqli_real_escape_string($con, $_POST['price']);
                        $phone = mysqli_real_escape_string($con, $_POST['phone']);
                        $description = mysqli_real_escape_string($con, $_POST['description']);


                        if (empty($client_name) || empty($title) || empty($price)) {
                            $db->error('All fields are required.');
                        }


                        if (!empty($client_name) && !empty($phone) && !empty($title)) {

                            $query = mysqli_query($con, "INSERT INTO `cash_properties`  SET `title` = '" . $title . "',`address` = '" . $address . "', `client_name` = '" . $client_name . "', `phone` = '" . $phone . "',`price` = '" . $price . "', `description` ='" . $description . "'");
                            if (!$query) {
                                print($query);
                                echo "INSERT INTO `cash_properties`  SET `title` = '" . $title . "',`address` = '" . $address . "', `client_name` = '" . $client_name . "', `phone` = '" . $phone . "',`price` = '" . $price . "',`description` = '" . $description . "'";
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Added Cash Property <strong>" . $title . "</strong>");
                                $db->redirect('cash_properties?msg_add');
                            }
                        }
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal">


                        <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="title" value="<?php
                                if (isset($_POST['title'])) {
                                    echo $_POST['title'];
                                }
                                ?>" placeholder="Property Title"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Address</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="address" value="<?php
                                if (isset($_POST['address'])) {
                                    echo $_POST['address'];
                                }
                                ?>" placeholder="Complete Address"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Client's Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="client_name" value="<?php
                                if (isset($_POST['client_name'])) {
                                    echo $_POST['client_name'];
                                }
                                ?>" placeholder="Client's Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Price</label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="price" value="<?php
                                if (isset($_POST['price'])) {
                                    echo $_POST['price'];
                                }
                                ?>" placeholder="Price"></div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10"><textarea rows="10" class="form-control" name="description" placeholder="Property Description" /><?php
                                if (isset($_POST['description'])) {
                                    echo $_POST['description'];
                                }
                                ?></textarea></div>
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
                                <a href = "cash_properties" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Add Cash Property" />
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