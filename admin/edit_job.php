<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}

if (isset($_GET['id'])) {
    $gotten_job_id = $_GET['id'];
} else {
    $db->redirect('careers');
}


$role = $db->getEachById($con, 'role', 'users', $id);
if ($role == 'team') {

    if ($db->getEachById($con, 'by_id', 'web_posts', $gotten_lead_id) != $id) {
        $db->redirect('careers');
    }
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-headphones"></i> Careers</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Edit Job Post</strong>
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
                    <h5>Edit Job Post<small>Edit job Post.</small></h5>
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
                        $description = mysqli_real_escape_string($con, $_POST['description']);
                        $seats = mysqli_real_escape_string($con, $_POST['seats']);
                        $city = mysqli_real_escape_string($con, $_POST['city']);
                        $image = mysqli_real_escape_string($con, $_POST['icon']);


                        if (empty($title) || empty($description) || empty($seats) || empty($city)) {
                            $db->error(' Title & Description and city is required');
                        }


                        if (!empty($title) && !empty($description) && !empty($seats) && !empty($city)) {

                            $query = mysqli_query($con, "UPDATE `job_posts`  SET `title` = '" . $title . "',`image` = '" . $image . "', `description` = '" . $description . "', `city` = '" . $city . "',`available_seats` = '" . $seats . "' WHERE `id` = '" . $gotten_job_id . "'");
                            if (!$query) {
                                print($query);
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Updated Job <strong>" . $title . "</strong>");
                                $db->redirect('careers?msg_add');
                            }
                        }
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal">


                        <div class="form-group"><label class="col-lg-2 control-label">Icon</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="icon" value="<?php
                                if (isset($_POST['icon'])) {
                                    echo $_POST['icon'];
                                } else {
                                    echo $db->getEachById($con, 'image', 'job_posts', $gotten_job_id);
                                }
                                ?>" placeholder="Icon - Use only font-awesome (font-family: Font Awesome 5 Free)"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="title" value="<?php
                                if (isset($_POST['title'])) {
                                    echo $_POST['title'];
                                } else {
                                    echo $db->getEachById($con, 'title', 'job_posts', $gotten_job_id);
                                }
                                ?>" placeholder="Title"></div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10"><textarea rows="10" class="form-control" name="description" placeholder="Description" /><?php
                                if (isset($_POST['description'])) {
                                    echo $_POST['description'];
                                } else {
                                    echo $db->getEachById($con, 'description', 'job_posts', $gotten_job_id);
                                }
                                ?></textarea></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="seats" class="col-sm-2 control-label">Seats</label>
                            <div class="col-sm-10">
                                <input type="text" name="seats" class="form-control" id="demand" value="<?php
                                if (isset($_POST['seats'])) {
                                    echo $_POST['seats'];
                                } else {
                                    echo $db->getEachById($con, 'available_seats', 'job_posts', $gotten_job_id);
                                }
                                ?>" placeholder="Available Seats" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <label for="city" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" name="city" class="form-control" value="<?php
                                if (isset($_POST['city'])) {
                                    echo $_POST['city'];
                                } else {
                                    echo $db->getEachById($con, 'city', 'job_posts', $gotten_job_id);
                                }
                                ?>" placeholder="City - Multiple Cities" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>






                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "careers" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Update Job" />
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