<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}

if (isset($_GET['id'])) {
    $gotten_cash_property_id = $_GET['id'];
} else {
    $db->redirect('cash_properties');
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
        <h2><i class="fa fa-dollar"></i> Cash Properties</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Edit Cash Property</strong>
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
                    <h5>Edit Cash Property<small> Update your cash client in your Dashboard system.</small></h5>
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


                        if (empty($client_name) || empty($title) || empty($price) || empty($phone)) {
                            $db->error(' All fields are required.');
                        }


                        if (!empty($client_name) && !empty($phone) && !empty($title) && !empty($price)) {

                            $query = mysqli_query($con, "UPDATE `cash_properties`  SET `client_name` = '" . $client_name . "',`title` = '" . $title . "', `address` = '" . $address . "', `price` = '" . $price . "',`phone` = '" . $phone . "',`description` = '" . $description . "' WHERE `id` = '" . $gotten_cash_property_id . "'");
                            if (!$query) {
//                                print($query);
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Updated Cash Property <strong>" . $title . "</strong>");
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
                                } else {
                                    echo $db->getEachById($con, 'title', 'cash_properties', $gotten_cash_property_id);
                                }
                                ?>" placeholder="Title of the Property"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Address</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="address" value="<?php
                                if (isset($_POST['address'])) {
                                    echo $_POST['address'];
                                } else {
                                    echo $db->getEachById($con, 'address', 'cash_properties', $gotten_cash_property_id);
                                }
                                ?>" placeholder="Complete Property Address"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Client's Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="client_name" value="<?php
                                if (isset($_POST['client_name'])) {
                                    echo $_POST['client_name'];
                                } else {
                                    echo $db->getEachById($con, 'client_name', 'cash_properties', $gotten_cash_property_id);
                                }
                                ?>" placeholder="Client's Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-lg-2 control-label">Price</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="price" value="<?php
                                if (isset($_POST['price'])) {
                                    echo $_POST['price'];
                                } else {
                                    echo $db->getEachById($con, 'price', 'cash_properties', $gotten_cash_property_id);
                                }
                                ?>" placeholder="Price of this property"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10"><textarea rows="10" class="form-control" name="description" placeholder="Property Description" /><?php
                                if (isset($_POST['description'])) {
                                    echo $_POST['description'];
                                } else {
                                    echo $db->getEachById($con, 'description', 'cash_properties', $gotten_cash_property_id);
                                }
                                ?></textarea></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" id="demand" value="<?php
                                if (isset($_POST['phone'])) {
                                    echo $_POST['phone'];
                                } else {
                                    echo $db->getEachById($con, 'phone', 'cash_properties', $gotten_cash_property_id);
                                }
                                ?>" placeholder="Phone Number (Digits only)" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "cash_properties" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Update Cash Property" />
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