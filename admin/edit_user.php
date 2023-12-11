<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}

if (isset($_GET['id'])) {
    $gotten_user_id = $_GET['id'];
     $gotten_role = $db->getEachById($con, 'role', 'users', $gotten_user_id);

    if ($db->getEachById($con, 'role', 'users', $id) == 'team' || $db->getEachById($con, 'role', 'users', $id) == 'sub-admin') {
        exit();
        $db->redirect('dashboard');
    }
} else {
    $db->redirect('users');
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
                <strong>Edit User</strong>
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
                    <h5>Edit User <small>Edit users in your software.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>

                <?php if ($gotten_role == 'client') { ?>
                    <div class="ibox-content">
                        <?php
                        if (isset($_POST['submit'])) {
                            $contact_name = $_POST['contact_name'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $role = $_POST['role'];
                            $image = $_POST['image'];
                            $telephone = $_POST['telephone'];

                            if (empty($contact_name) || empty($email) || empty($password) || empty($role) || empty($telephone)) {
                                $db->error('All fields are required !');
                            }
                            if (!empty($contact_name) && !empty($email) && !empty($password) && !empty($role) && !empty($telephone)) {
                                $query = mysqli_query($con, "UPDATE `users` SET `contact_name` = '" . $contact_name . "', `email` = '" . $email . "',`password` = '" . $password . "', `role` = '" . $role . "', `telephone` = '" . $telephone . "' WHERE `id` = '" . $gotten_user_id . "'");
                                if (!$query) {
                                    $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                                } else {
                                    $db->redirect('view_all_users?msg_add');
                                }
                            }
                        }
                        if (isset($_GET['msg'])) {
                            $db->success('<strong>Thank you</strong> Your record has been updated!');
                        }
                        ?>
                        <form action="#" method="POST" class="form-horizontal">

                            <div class="form-group"><label class="col-lg-2 control-label">Contact Name</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="contact_name" value="<?= $db->getEachById($con, 'contact_name', 'users', $gotten_user_id) ?>" placeholder="Contact Name"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="email" value="<?= $db->getEachById($con, 'email', 'users', $gotten_user_id) ?>" placeholder="Email"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label for="telephone" class="col-sm-2 control-label">Telephone</label>
                                <div class="col-sm-10">
                                    <input type="tel" name="telephone" class="form-control" id="telephone" value="<?= $db->getEachById($con, 'telephone', 'users', $gotten_user_id) ?>" placeholder="+1 705 678 1122" required>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" value="<?php
                                    if (isset($_POST['password'])) {
                                        echo $_POST['password'];
                                    } else {
                                        echo $db->getEachById($con, 'password', 'users', $gotten_user_id);
                                    }
                                    ?>" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label for="access" class="col-sm-2 control-label">Access</label>
                                <div class="col-sm-10">
                                    Add Category Access<br />
                                    <?php
                                    if (isset($_POST['addCategoryAccess'])) {
                                        $catName = $_POST['catName'];
                                        $queryAddCatName = mysqli_query($con, "INSERT INTO `category_access` SET `user_id` = '" . $gotten_user_id . "',`category_id` = '" . $catName . "'");
                                        if ($queryAddCatName) {
                                            $db->success("Cool");
                                        } else {
                                            $db->error("<strong>Oops! </strong>Gotta figure something else out.");
                                        }
                                    }
                                    if (isset($_GET['del_cat_id'])) {
                                        $remove_access_id = $_POST['del_cat_id'];
                                        $queryRemoveCatName = mysqli_query($con, "DELETE FROM `category_access` WHERE `id` = '" . $remove_access_id . "'");
                                        if ($queryRemoveCatName) {
                                            $db->success("Cool, Your record has been removed.");
                                        } else {
                                            $db->error("<strong>Oops! </strong>Gotta figure something else out.");
                                        }
                                    }
                                    ?>
                                    <form action="##" method="post">
                                        <select class="form-control m-b" name="catName">
                                            <?php
                                            $getAllCategories = mysqli_query($con, "SELECT * FROM `categories`");
                                            while ($row = mysqli_fetch_array($getAllCategories, MYSQLI_ASSOC)) {
                                                ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>    
                                            <?php }
                                            ?>
                                        </select>
                                        <input type="submit" name="addCategoryAccess" class="btn btn-primary" value="Add Category Access" />
                                    </form>
                                    <br />
                                    <?php
                                    $queryGetAccessList = mysqli_query($con, "SELECT * FROM `category_access` WHERE `user_id` = '" . $gotten_user_id . "'");
                                    while ($row = mysqli_fetch_array($queryGetAccessList, MYSQLI_ASSOC)) {
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="taskList">
                                                <div class="widget navy-bg">
                                                    <?= $db->getEachById($con, 'name', 'categories', $row['category_id']) ?>
                                                    <a href="edit_user?id=<?= $gotten_user_id ?>&del_cat_id=<?= $row['id'] ?>" style="color: white;"><span class="pull-right"><i class="fa fa-remove"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>

                                </div>

                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-lg-2 control-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="role">
                                        <option value="admin" <?php
                                        if ($db->getEachById($con, 'role', 'users', $gotten_user_id) == 'admin') {
                                            echo 'selected="true"';
                                        }
                                        ?>>Admin</option>
                                        <option value="sub-admin" <?php
                                        if ($db->getEachById($con, 'role', 'users', $gotten_user_id) == 'sub-admin') {
                                            echo 'selected="true"';
                                        }
                                        ?>>Sub-Admin</option>
                                        <option value="team" <?php
                                        if ($db->getEachById($con, 'role', 'users', $gotten_user_id) == 'team') {
                                            echo 'selected="true"';
                                        }
                                        ?>>Team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>


                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a href="view_all_users" class="btn btn-white" >Cancel</a>
                                    <input name="submit" class="btn btn-primary" type="submit" value="Update" />
                                </div>
                            </div>
                        </form>
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                    </div>
                <?php } else {
                    ?>

                    <div class="ibox-content">
                        <?php
                        if (isset($_POST['submit'])) {
                            $contact_name = $_POST['contact_name'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $role = $_POST['role'];
                            $image = $_POST['image'];
                            $telephone = $_POST['telephone'];

                            if (empty($contact_name) || empty($email) || empty($password) || empty($role) || empty($telephone)) {
                                $db->error('All fields are required !');
                            }
                            if (!empty($contact_name) && !empty($email) && !empty($password) && !empty($role) && !empty($telephone)) {
                                $query = mysqli_query($con, "UPDATE `users` SET `contact_name` = '" . $contact_name . "', `email` = '" . $email . "',`password` = '" . $password . "', `role` = '" . $role . "', `telephone` = '" . $telephone . "' WHERE `id` = '" . $gotten_user_id . "'");
                                if (!$query) {
                                    $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                                } else {
                                    $db->redirect('view_all_users?msg_updated');
                                }
                            }
                        }
                        if (isset($_GET['msg'])) {
                            $db->success('<strong>Thank you</strong> Your record has been updated!');
                        }
                        ?>
                        <form action="#" method="POST" class="form-horizontal">

                            <div class="form-group"><label class="col-lg-2 control-label">Contact Name</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="contact_name" value="<?= $db->getEachById($con, 'contact_name', 'users', $gotten_user_id) ?>" placeholder="Contact Name"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="email" value="<?= $db->getEachById($con, 'email', 'users', $gotten_user_id) ?>" placeholder="Email"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label for="telephone" class="col-sm-2 control-label">Telephone</label>
                                <div class="col-sm-10">
                                    <input type="tel" name="telephone" class="form-control" id="telephone" value="<?= $db->getEachById($con, 'telephone', 'users', $gotten_user_id) ?>" placeholder="+1 705 678 1122" required>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" value="<?php
                                    if (isset($_POST['password'])) {
                                        echo $_POST['password'];
                                    } else {
                                        echo $db->getEachById($con, 'password', 'users', $gotten_user_id);
                                    }
                                    ?>" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>



                            <div class="form-group"><label class="col-lg-2 control-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="role">
                                        <option value="admin" <?php
                                        if ($db->getEachById($con, 'role', 'users', $gotten_user_id) == 'admin') {
                                            echo 'selected="true"';
                                        }
                                        ?>>Admin</option>
                                        <option value="sub-admin" <?php
                                        if ($db->getEachById($con, 'role', 'users', $gotten_user_id) == 'sub-admin') {
                                            echo 'selected="true"';
                                        }
                                        ?>>Sub-Admin</option>
                                        <option value="team" <?php
                                        if ($db->getEachById($con, 'role', 'users', $gotten_user_id) == 'team') {
                                            echo 'selected="true"';
                                        }
                                        ?>>Team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>


                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a href="view_all_users" class="btn btn-white" >Cancel</a>
                                    <input name="submit" class="btn btn-primary" type="submit" value="Update" />
                                </div>
                            </div>
                        </form>
                    </div>

                <?php }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>