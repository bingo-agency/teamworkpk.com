<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    if (isset($_GET['project_id'])) {
        $project_id = $_GET['project_id'];
    } else {
        $db->redirect('projects');
    }
    $db->add_user_activity($con, "Was viewing <strong>Project</strong>.");
}
?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />-->
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; transform: rotateY(180deg);
    -webkit-transform:rotateY(180deg); /* Safari and Chrome */
    -moz-transform:rotateY(180deg); /* Firefox */ }
        #my_camera{transform: rotateY(180deg);
    -webkit-transform:rotateY(180deg);  Safari and Chrome 
    -moz-transform:rotateY(180deg);  Firefox  }
    </style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-building"></i> Projects</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Project Overview</strong>
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
                    <h5><?= $db->getEachById($con, 'title', 'projects', $project_id) ?><small> Project OverView.</small></h5>
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

                        echo 'COol';
//                        
//
//
//                        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
//
//                            $title = mysqli_real_escape_string($con, $_POST['title']);
//                            $ribbon = mysqli_real_escape_string($con, $_POST['ribbon']);
//                            $description = mysqli_real_escape_string($con, $_POST['description']);
//                            $address = mysqli_real_escape_string($con, $_POST['address']);
//                            $city = mysqli_real_escape_string($con, $_POST['city']);
//                            $video_link = mysqli_real_escape_string($con, $_POST['video_link']);
//                            $type = mysqli_real_escape_string($con, $_POST['type']);
//                            $price = mysqli_real_escape_string($con, $_POST['price']);
//                            $year_build = mysqli_real_escape_string($con, $_POST['year_build']);
//
//                            if (empty($title) || empty($description) || empty($address) || empty($city)) {
//                                $db->error('Title, Description, Address and City are required !');
//                            }
//
//
//                            // get details of the uploaded file
//                            $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
//                            $fileName = $_FILES['uploadedFile']['name'];
//                            $fileSize = $_FILES['uploadedFile']['size'];
//                            $fileType = $_FILES['uploadedFile']['type'];
//                            $fileNameCmps = explode(".", $fileName);
//                            $fileExtension = strtolower(end($fileNameCmps));
//
//                            // sanitize file-name
//                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
//
//                            // check if file has one of the following extensions
//                            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'svg');
//
//                            if (in_array($fileExtension, $allowedfileExtensions)) {
//                                // directory in which the uploaded file will be moved
//                                $uploadFileDir = 'upload/';
//                                $dest_path = $uploadFileDir . $newFileName;
//
//                                if (move_uploaded_file($fileTmpPath, $dest_path)) {
//                                    $message = 'File is successfully uploaded.';
//
//                                    if (!empty($title) && !empty($description) && !empty($address) && !empty($city)) {
//
//                                        $query = mysqli_query($con, "INSERT INTO `projects`  SET `image_link` = '" . $dest_path . "', `title` = '" . $title . "',`ribbon` = '" . $ribbon . "', `description` = '" . $description . "', `city` = '" . $city . "',`address` = '" . $address . "',`video_link`='" . $video_link . "',`type` = '" . $type . "',`price` = '" . $price . "',`year_build` = '" . $year_build . "'");
//                                        if (!$query) {
//                                            print($query);
//                                            $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
//                                        } else {
//                                            $db->add_user_activity($con, "Added Project <strong>" . $title . "</strong>");
//                                            $db->redirect('projects?msg_add');
//                                        }
//                                    }
//                                } else {
//                                    $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
//                                }
//                            } else {
//                                $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
//                            }
//                        } else {
//                            $message = 'There is some error in the file upload. Please check the following error.<br>';
//                            $message .= 'Error:' . $_FILES['uploadedFile']['error'];
//                        }
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">


                        <div class="form-group"><label class="col-lg-2 control-label">Allottee Image</label>
                            <div class="col-sm-10">
                                <!--<img src="<?= $db->getEachById($con, 'image_link', 'projects', $project_id) ?>" class="img-responsive" style="max-width:300px;" />-->
                                <div id="results" class="pull-right"><i class="fa fa-user"></i></div>

                                <div id="my_camera"></div>
                                <br/>
                                <input type=button value="Take Snapshot" onClick="take_snapshot()" class="pull-right">
                                <input type="hidden" name="image" class="image-tag" class="pull-right">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Floor</label>
                            <div class="col-sm-10">
                                <div class="checkbox-inline i-checks"><label > <input type="radio" value="first_floor" name="a"> <i></i> First Floor</label></div>
                                <div class="i-checks"><label> <input type="radio" value="second_floor" name="a"> <i></i> Second Floor </label></div>
                                <div class="i-checks"><label> <input type="radio" value="third_floor" name="a"> <i></i> Third Floor </label></div>
                                <div class="i-checks"><label> <input type="radio" checked="" value="fourth_floor" name="a"> <i></i> Fourth Floor </label></div>
                                <div class="hr-line-dashed"></div>        
                                <div class="i-checks"><label> <input type="radio" value="lower_ground" name="a"> <i></i> Lower Ground</label></div>
                                <div class="i-checks"><label> <input type="radio" checked="" value="ground_floor" name="a"> <i></i> Ground Floor</label></div>

<!--                                <input type="text" class="form-control" name="title" value="<?php
                                if (isset($_POST['title'])) {
                                    echo $_POST['title'];
                                }
                                ?>" placeholder="Title">-->
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Property Selection</label>
                            <div class="col-sm-10">
                                <div class="checkbox-inline i-checks"><label > <input type="radio" value="Apartment" name="b"> <i></i> Apartment</label></div>
                                <div class="i-checks"><label> <input type="radio" value="1_bed" name="b"> <i></i> 1 Bed <small>(Approx 450 Sq Ft.)</small></label></div>
                                <div class="i-checks"><label> <input type="radio" value="2_bed" name="b"> <i></i> 2 Bed <small>(Approx 850 Sq Ft.)</small></label></div>
                                <div class="i-checks"><label> <input type="radio" value="shop" name="b"> <i></i> Shop </label></div>
                                <div class="i-checks"><label> <input type="radio" value="307_sqft" name="b"> <i></i> 307 Sq Ft. </label></div>
                                <div class="i-checks"><label> <input type="radio" checked="" value="318_sqft" name="b"> <i></i> 318 Sq Ft. </label></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Personal Information</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="<?php
                                if (isset($_POST['name'])) {
                                    echo $_POST['name'];
                                }
                                ?>" placeholder="Name of Applicant - Copy Scaned">
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" >
                                        <option>S/O</option>
                                        <option>D/O</option>
                                        <option>W/O</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="of" value="<?php
                                if (isset($_POST['of'])) {
                                    echo $_POST['of'];
                                }
                                ?>" placeholder="S/O,D/O,W/O">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Identity Information</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic" data-mask="00000-0000000-0" placeholder="XXXXX-XXXXXXX-X"  name="cnic" required="">
                                <span class="form-text">ID Card # : 61101-1234567-8</span>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic" data-mask="000-0000-00" placeholder="xxx-xxxx-xx (Optional)"  name="passport">
                                <span class="form-text">Passport Number</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" id="address" value="<?php
                                if (isset($_POST['address'])) {
                                    echo $_POST['address'];
                                }
                                ?>" placeholder="address" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="permanent_address" class="col-sm-2 control-label">Permanent Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="permanent_address" class="form-control" id="permanent_address" value="<?php
                                if (isset($_POST['permanent_address'])) {
                                    echo $_POST['permanent_address'];
                                }
                                ?>" placeholder="Permanent Address" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" id="email" value="<?php
                                if (isset($_POST['email'])) {
                                    echo $_POST['email'];
                                }
                                ?>" placeholder="Email Address" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_office" class="col-sm-2 control-label">Phone Office</label>
                            <div class="col-sm-2">
                                <input type="tel" data-mask="000-0000000" placeholder="051-1234567"  name="phone_office" class="form-control" id="phone_office" value="<?php
                                if (isset($_POST['phone_office'])) {
                                    echo $_POST['phone_office'];
                                }
                                ?>" placeholder="Phone Office" />
                                <span class="form-text">Office # : 051-1234567</span>
                            </div>
                            <label for="phone_res" class="col-sm-1 control-label">Phone Res</label>
                            <div class="col-sm-3">
                                <input type="tel" name="phone_res" data-mask="000-0000000" placeholder="051-1234567" class="form-control" id="phone_res" value="<?php
                                if (isset($_POST['phone_res'])) {
                                    echo $_POST['phone_res'];
                                }
                                ?>" placeholder="Phone Res" />
                                <span class="form-text">Residence # : 051-1234567</span>
                            </div>
                            <label for="mobile" class="col-sm-1 control-label">Mobile</label>
                            <div class="col-sm-3">
                                <input type="tel" name="mobile" data-mask="0000-000-0000" placeholder="0333-571-4484" class="form-control" id="mobile" value="<?php
                                if (isset($_POST['mobile'])) {
                                    echo $_POST['mobile'];
                                }
                                ?>" placeholder="Mobile" />
                                <span class="form-text">Mobile # : 0333-123-1234</span>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nominee Information</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="<?php
                                if (isset($_POST['name'])) {
                                    echo $_POST['name'];
                                }
                                ?>" placeholder="Name of Applicant - Copy Scaned">
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" >
                                        <option>S/O</option>
                                        <option>D/O</option>
                                        <option>W/O</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="of" value="<?php
                                if (isset($_POST['of'])) {
                                    echo $_POST['of'];
                                }
                                ?>" placeholder="S/O,D/O,W/O">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nominee Identity Information</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic" data-mask="00000-0000000-0" placeholder="XXXXX-XXXXXXX-X"  name="cnic" required="">
                                <span class="form-text">ID Card # : 61101-1234567-8</span>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic" data-mask="000-0000-00" placeholder="xxx-xxxx-xx (Optional)"  name="passport">
                                <span class="form-text">Passport Number</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Relation with Applicant</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="relation_with_applicant" required="">
                                <span class="form-text">Relation with Applicant</span>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Comments <br /><small>(Office use only)</small></label>
                            <div class="col-sm-10">
                                <textarea rows="10" class="form-control" name="comments" placeholder="Comments" /><?php
                                if (isset($_POST['comments'])) {
                                    echo $_POST['comments'];
                                }
                                ?></textarea>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="deposit" class="col-sm-2 control-label">Initial Deposit</label>
                            <div class="col-sm-10">
                                <input type="text" name="deposit"  data-mask="PKR 000,000,000.00" autocomplete="off" maxlength="16" class="form-control" value="<?php
                                if (isset($_POST['deposit'])) {
                                    echo $_POST['deposit'];
                                }
                                ?>" placeholder="Initial Deposit" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <label for="installmanet_plan" class="col-sm-2 control-label">Installmanet Plan</label>
                            <div class="col-sm-10">
<!--                                <input type="text" name="installmanet_plan" class="form-control" value="<?php
                                if (isset($_POST['installmanet_plan'])) {
                                    echo $_POST['installmanet_plan'];
                                }
                                ?>" placeholder="installmanet_plan" >-->
                                <select name="installmanet_plan" class="form-control" >
                                    <option>3 - months</option>
                                    <option>6 - months</option>
                                    <option>12 - months</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>






                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href="projects" class = "btn btn-white" >Cancel</a>
                                <input name="submit" class = "btn btn-primary" type = "submit" value = "Confirm Slot" />
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'png',
        jpeg_quality: 90,
        
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        $('#my_camera').hide();    
        });
        
    }
</script>