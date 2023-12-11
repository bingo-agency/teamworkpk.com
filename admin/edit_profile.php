<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-user"></i> Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Edit Profile</strong>
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
                    <h5>Edit Profile <small>Update your profile with following form.</small></h5>
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
                        $new_email = $_POST['email'];
                        $new_contact_name = $_POST['contact_name'];
                        $new_telephone = $_POST['telephone'];

                        if (empty($new_contact_name) || empty($new_telephone) || empty($new_email)) {
                            $db->error('All fields are required !');
                        }
                        if (!empty($new_contact_name) && !empty($new_telephone) && !empty($new_email)) {
                            $query = mysqli_query($con,"UPDATE `users` SET `contact_name` = '" . $new_contact_name . "',`telephone` = '" . $new_telephone . "', `email` = '" . $new_email . "' WHERE `id` = '" . $id . "'");
                            if (!$query) {
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->redirect('settings?msg');
                            }
                        }
                    }
                    if (isset($_GET['msg'])) {
                        $db->success('<strong>Thank you</strong> Your record has been updated!');
                    }
                    ?>
                    <form action="#" method="POST" class="form-horizontal">

                        <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                            <div class="col-sm-10"><input type="email" class="form-control" name="email" value="<?= $db->getEachById($con,'email', 'users', $id); ?>" placeholder="Email"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group"><label class="col-sm-2 control-label">Contact Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="contact_name" value="<?= $db->getEachById($con,'contact_name', 'users', $id); ?>" placeholder="Contact Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="telephone" class="col-sm-2 control-label">Telephone</label>
                            <div class="col-sm-10">
                                <input type="tel" name="telephone" class="form-control" id="telephone" value="<?= $db->getEachById($con,'telephone', 'users', $id); ?>" placeholder="+92" required>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="settings" class="btn btn-white" >Cancel</a>
                                <input name="submit" class="btn btn-primary" type="submit" value="Save changes" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>