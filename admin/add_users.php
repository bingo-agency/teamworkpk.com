<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
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
                <strong>Add Users</strong>
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
                    <h5>Add Users <small>Add new users to your software.</small></h5>
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
                        $contact_name = $_POST['contact_name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $role = $_POST['role'];
                        $image = "images/avatardefault.png";
                        $telephone = $_POST['telephone'];

                        $dup = mysqli_query($con, "SELECT `email` FROM `users` WHERE `email` = '" . $email . "'");
                        if (mysqli_num_rows($dup) > 0) {
                            $db->error("This email address already exists, Try to <a href='view_all_users'>Manage</a> users.");
                        } else {

                            if (empty($contact_name) || empty($email) || empty($password) || empty($role) || empty($telephone)) {
                                $db->error('All fields are required !');
                            }
                            if (!empty($contact_name) && !empty($email) && !empty($password) && !empty($role) && !empty($telephone)) {
                                $query = mysqli_query($con, "INSERT INTO `users` SET `contact_name` = '" . $contact_name . "', `email` = '" . $email . "',`password` = '" . $password . "', `role` = '" . $role . "', `telephone` = '" . $telephone . "',`image`='" . $image . "',`status` = 'Active'");
                                if (!$query) {
                                    print($query);
                                    $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                                } else {
                                    $db->add_user_activity($con, "Added a new user <strong>" . $contact_name . "</strong>");
                                    $db->redirect('view_all_users?msg_add');
                                }
                            }
                        }
                    }
                    if (isset($_GET['msg'])) {
                        $db->success('<strong>Thank you</strong> Your record has been updated!');
                    }
                    ?>
                    <form action="#" method="POST" class="form-horizontal">

                        <div class="form-group"><label class="col-lg-2 control-label">Contact Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="contact_name" value="<?php
                                if (isset($_POST['contact_name'])) {
                                    echo $_POST['contact_name'];
                                }
                                ?>" placeholder="Contact Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="email" value="<?php
                                if (isset($_POST['email'])) {
                                    echo $_POST['email'];
                                }
                                ?>" placeholder="Email"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="telephone" class="col-sm-2 control-label">Telephone</label>
                            <div class="col-sm-10">
                                <input type="tel" name="telephone" class="form-control" id="telephone" value="<?php
                                if (isset($_POST['telephone'])) {
                                    echo $_POST['telephone'];
                                }
                                ?>" placeholder="+1 705 678 1122" required>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" value="<?php
                                if (isset($_POST['password'])) {
                                    echo $_POST['password'];
                                }
                                ?>" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-lg-2 control-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="sub-admin">Sub-Admin</option>
                                    <option value="team">Team</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="view_all_users" class="btn btn-white" >Cancel</a>
                                <input name="submit" class="btn btn-primary" type="submit" value="Add User" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>