<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
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
                <strong>Add Jobs</strong>
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
                    <h5>Add Job<small>Add Jobs to your front Site.</small></h5>
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
                            $db->error('Internal Lead ID , Title & Verificaiton status and Featured is required');
                        }


                        if (!empty($title) && !empty($description) && !empty($seats) && !empty($city)) {

                            $query = mysqli_query($con, "INSERT INTO `job_posts`  SET `title` = '" . $title . "',`image` = '" . $image . "', `description` = '" . $description . "', `city` = '" . $city . "',`available_seats` = '" . $seats . "'");
                            if (!$query) {
                                print($query);
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Added Job <strong>" . $title . "</strong>");
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
                                }
                                ?>" placeholder="Icon - Use only font-awesome (font-family: Font Awesome 5 Free)"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="title" value="<?php
                                if (isset($_POST['title'])) {
                                    echo $_POST['title'];
                                }
                                ?>" placeholder="Title"></div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10"><textarea rows="10" class="form-control" name="description" placeholder="Job Description" /><?php
                                if (isset($_POST['description'])) {
                                    echo $_POST['description'];
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
                                }
                                ?>" placeholder="Available Seats (Numbers Only)" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <label for="city" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" name="city" class="form-control" value="<?php
                                if (isset($_POST['city'])) {
                                    echo $_POST['city'];
                                }
                                ?>" placeholder="City - Multiple Cities" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>






                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "careers" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Add Job" />
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