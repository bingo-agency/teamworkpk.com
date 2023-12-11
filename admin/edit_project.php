<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Was viewing their own <strong>Activity</strong>.");
}

if (isset($_GET['id'])) {
    $gotten_project_id = $_GET['id'];
} else {
    $db->redirect('projects');
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-building"></i> Projects</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Edit Projects</strong>
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
                    <h5>Add Projects<small> Add Projects to your TeamWork Database.</small></h5>
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


                        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {

                            $title = mysqli_real_escape_string($con, $_POST['title']);
                            $ribbon = mysqli_real_escape_string($con, $_POST['ribbon']);
                            $description = mysqli_real_escape_string($con, $_POST['description']);
                            $address = mysqli_real_escape_string($con, $_POST['address']);
                            $city = mysqli_real_escape_string($con, $_POST['city']);
                            $video_link = mysqli_real_escape_string($con, $_POST['video_link']);
                            $type = mysqli_real_escape_string($con, $_POST['type']);
                            $price = mysqli_real_escape_string($con, $_POST['price']);
                            $year_build = mysqli_real_escape_string($con, $_POST['year_build']);

                            if (empty($title) || empty($description) || empty($address) || empty($city)) {
                                $db->error('Title, Description, Address and City are required !');
                            }


                            // get details of the uploaded file
                            $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
                            $fileName = $_FILES['uploadedFile']['name'];
                            $fileSize = $_FILES['uploadedFile']['size'];
                            $fileType = $_FILES['uploadedFile']['type'];
                            $fileNameCmps = explode(".", $fileName);
                            $fileExtension = strtolower(end($fileNameCmps));

                            // sanitize file-name
                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                            // check if file has one of the following extensions
                            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'svg');

                            if (in_array($fileExtension, $allowedfileExtensions)) {
                                // directory in which the uploaded file will be moved
                                $uploadFileDir = 'upload/';
                                $dest_path = $uploadFileDir . $newFileName;

                                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                    $message = 'File is successfully uploaded.';

                                    if (!empty($title) && !empty($description) && !empty($address) && !empty($city)) {

                                        $query = mysqli_query($con, "UPDATE `projects`  SET `image_link` = '" . $dest_path . "', `title` = '" . $title . "',`ribbon` = '" . $ribbon . "', `description` = '" . $description . "', `city` = '" . $city . "',`address` = '" . $address . "',`video_link`='" . $video_link . "',`type` = '" . $type . "',`price` = '" . $price . "',`year_build` = '" . $year_build . "' WHERE `id` = '" . $gotten_project_id . "'");
                                        if (!$query) {
                                            print($query);
                                            $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                                        } else {
                                            $db->add_user_activity($con, "Added Project <strong>" . $title . "</strong>");
                                            $db->redirect('projects?msg_add');
                                        }
                                    }
                                } else {
                                    $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                                }
                            } else {
                                $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
                            }
                        } else {
                            $message = 'There is some error in the file upload. Please check the following error.<br>';
                            $message .= 'Error:' . $_FILES['uploadedFile']['error'];
                        }
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">


                        <div class="form-group"><label class="col-lg-2 control-label">Primary Image</label>
                            <div class="col-sm-5">

                                <img src="<?= $db->getEachById($con, 'image_link', 'projects', $gotten_project_id) ?>" class="img-responsive" style="max-width: 300px" />

                            </div>
                            <div class="col-sm-5">

                                <div class="upload-wrapper">
                                    <span class="file-name">Choose a file...</span>
                                    <label for="file-upload">Browse<input type="file" id="file-upload" name="uploadedFile"></label>
                                </div>

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="title" value="<?php
                                if (isset($_POST['title'])) {
                                    echo $_POST['title'];
                                } else {
                                    echo $db->getEachById($con, 'title', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="Title"></div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Ribbon</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="ribbon" value="<?php
                                if (isset($_POST['ribbon'])) {
                                    echo $_POST['ribbon'];
                                } else {
                                    echo $db->getEachById($con, 'ribbon', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="Ribbon"></div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10"><textarea rows="10" class="form-control" name="description" placeholder="Job Description" /><?php
                                if (isset($_POST['description'])) {
                                    echo $_POST['description'];
                                } else {
                                    echo $db->getEachById($con, 'description', 'projects', $gotten_project_id);
                                }
                                ?></textarea></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" id="address" value="<?php
                                if (isset($_POST['address'])) {
                                    echo $_POST['address'];
                                } else {
                                    echo $db->getEachById($con, 'address', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="address" >
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
                                    echo $db->getEachById($con, 'city', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="City - Multiple Cities" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>



                        <div class="form-group">
                            <label for="video_link" class="col-sm-2 control-label">Video Link</label>
                            <div class="col-sm-10">
                                <input type="text" name="video_link" class="form-control" value="<?php
                                if (isset($_POST['video_link'])) {
                                    echo $_POST['video_link'];
                                } else {
                                    echo $db->getEachById($con, 'video_link', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="video_link" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>



                        <div class="form-group">
                            <label for="type" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" name="type" class="form-control" value="<?php
                                if (isset($_POST['type'])) {
                                    echo $_POST['type'];
                                } else {
                                    echo $db->getEachById($con, 'type', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="type" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" value="<?php
                                if (isset($_POST['price'])) {
                                    echo $_POST['price'];
                                } else {
                                    echo $db->getEachById($con, 'price', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="price" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <label for="year_build" class="col-sm-2 control-label">Year Build</label>
                            <div class="col-sm-10">
                                <input type="text" name="year_build" class="form-control" value="<?php
                                if (isset($_POST['year_build'])) {
                                    echo $_POST['year_build'];
                                } else {
                                    echo $db->getEachById($con, 'year_build', 'projects', $gotten_project_id);
                                }
                                ?>" placeholder="year_build" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>






                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "careers" class = "btn btn-white" >Cancel</a>
                                <input name="submit" class = "btn btn-primary" type="submit" value = "Update Project" />
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>