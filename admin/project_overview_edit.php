<?php
include 'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    if (isset($_GET['project_id'])) {
        $project_id = $_GET['project_id'];
    } else {
        // $db->redirect('projects');
    }
    $db->add_user_activity($con, "Was viewing <strong>Project</strong>.");
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script>
    window.alert = function(e){ console.warn( "Alerted: " + e ); }
</script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />-->
<style type="text/css">
    #results {
        padding: 20px;
        border: 1px solid;
        background: #ccc;
        transform: rotateY(180deg);
        -webkit-transform: rotateY(180deg);
        /* Safari and Chrome */
        -moz-transform: rotateY(180deg);
        /* Firefox */
    }

    #my_camera {
        transform: rotateY(180deg);
        -webkit-transform: rotateY(180deg);
        Safari and Chrome -moz-transform: rotateY(180deg);
        Firefox
    }
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
                    $update_id = $_GET['id'];
                    if (isset($_POST['submit'])) {
                        $allotteeimage = $_POST['image']; // Your base64-encoded image string
                        $thumbprint = $_FILES['thumbprint']['name'];
                        $thubmprint_tmp = $_FILES['thumbprint']['tmp_name'];
                        $floor = $_POST['a'];
                        $property_selection = $_POST['b'];
                        $applicant_name = $_POST['name'];
                        $applicant_of = $_POST['applicant-of'];
                        $applicant_sdw = $_POST['applicant-sdw'];
                        $id_card = $_POST['cnic'];
                        $passport_number = $_POST['passport'];
                        $address = $_POST['address'];
                        $permanent_address = $_POST['permanent_address'];
                        $email = $_POST['email'];
                        $phone_office = $_POST['phone_office'];
                        $phone_res = $_POST['phone_res'];
                        $mobile = $_POST['mobile'];
                        $nominee_name = $_POST['nominee_name'];
                        $nominee_of = $_POST['nominee_of'];
                        $nominee_sdw = $_POST['nominee-sdw'];
                        $nominee_id = $_POST['nominee_id'];
                        $nominee_passport = $_POST['nominee_passport'];
                        $rel_with_applicant = $_POST['rel_with_applicant'];
                        $comments = $_POST['comments'];
                        $initial_deposit = $_POST['initial_deposit'];
                        $installmanet_plan = $_POST['installmanet_plan'];

                        $thumbprint_destination = "img/" . $thumbprint;

                        move_uploaded_file($thubmprint_tmp, $thumbprint_destination);

                        // Remove the data URI scheme prefix (e.g., "data:image/png;base64,")
                        $imageData = substr($allotteeimage, strpos($allotteeimage, ',') + 1);

                        // Decode the base64-encoded image data
                        $decodedImage = base64_decode($imageData);

                        // Specify the destination folder and file name
                        $uploadFolder = 'img/';
                        $fileName = 'allottee_image' . time() . rand(1, 1000) . '.png'; // Provide a file name with the appropriate extension

                        // Construct the full destination path
                        $destinationPath = $uploadFolder . $fileName;

                        // Save the decoded image to the destination folder
                        if (file_put_contents($destinationPath, $decodedImage)) {
                            echo 'Image transferred to upload folder successfully.';
                        } else {
                            echo 'Error transferring image.';
                        }

                        if($allotteeimage == "" && !$thumbprint == "") {

                        $investor_update_query = "UPDATE project_investors
                        SET thumb_print = '$thumbprint', floor = '$floor', property_selection = '$property_selection', applicant_name = '$applicant_name', applicant_of = '$applicant_of', applicant_sdw = '$applicant_sdw', id_card = '$id_card', passport_number = '$passport_number', address = '$address', permanent_address = '$permanent_address', email = '$email', phone_office = '$phone_office', phone_res = '$phone_res', mobile = '$mobile', nominee_name = '$nominee_name', nominee_of = '$nominee_of', nominee_sdw = '$nominee_sdw', nominee_id = '$nominee_id', nominee_passport = '$nominee_passport', rel_with_applicant = '$rel_with_applicant', comments = '$comments', initial_deposit = '$initial_deposit', installmanet_plan = '$installmanet_plan'
                        WHERE id = $update_id";    

                        } else if ($thumbprint == "" && !$allotteeimage == "") {

                        $investor_update_query = "UPDATE project_investors
                        SET allottee_image = '$fileName', floor = '$floor', property_selection = '$property_selection', applicant_name = '$applicant_name', applicant_of = '$applicant_of', applicant_sdw = '$applicant_sdw', id_card = '$id_card', passport_number = '$passport_number', address = '$address', permanent_address = '$permanent_address', email = '$email', phone_office = '$phone_office', phone_res = '$phone_res', mobile = '$mobile', nominee_name = '$nominee_name', nominee_of = '$nominee_of', nominee_sdw = '$nominee_sdw', nominee_id = '$nominee_id', nominee_passport = '$nominee_passport', rel_with_applicant = '$rel_with_applicant', comments = '$comments', initial_deposit = '$initial_deposit', installmanet_plan = '$installmanet_plan'
                        WHERE id = $update_id";        
                        
                        } else if ($thumbprint == "" && $allotteeimage == "") {
                        $investor_update_query = "UPDATE project_investors
                        SET floor = '$floor', property_selection = '$property_selection', applicant_name = '$applicant_name', applicant_of = '$applicant_of', applicant_sdw = '$applicant_sdw', id_card = '$id_card', passport_number = '$passport_number', address = '$address', permanent_address = '$permanent_address', email = '$email', phone_office = '$phone_office', phone_res = '$phone_res', mobile = '$mobile', nominee_name = '$nominee_name', nominee_of = '$nominee_of', nominee_sdw = '$nominee_sdw', nominee_id = '$nominee_id', nominee_passport = '$nominee_passport', rel_with_applicant = '$rel_with_applicant', comments = '$comments', initial_deposit = '$initial_deposit', installmanet_plan = '$installmanet_plan'
                        WHERE id = $update_id";                            
                        }
    
                        else {

                        $investor_update_query = "UPDATE project_investors
                        SET allottee_image = '$fileName', thumb_print = '$thumbprint', floor = '$floor', property_selection = '$property_selection', applicant_name = '$applicant_name', applicant_of = '$applicant_of', applicant_sdw = '$applicant_sdw', id_card = '$id_card', passport_number = '$passport_number', address = '$address', permanent_address = '$permanent_address', email = '$email', phone_office = '$phone_office', phone_res = '$phone_res', mobile = '$mobile', nominee_name = '$nominee_name', nominee_of = '$nominee_of', nominee_sdw = '$nominee_sdw', nominee_id = '$nominee_id', nominee_passport = '$nominee_passport', rel_with_applicant = '$rel_with_applicant', comments = '$comments', initial_deposit = '$initial_deposit', installmanet_plan = '$installmanet_plan'
                        WHERE id = $update_id";

                        }
                        
                        // echo $investor_update_query;

                        $investor_query_run = mysqli_query($con, $investor_update_query);
                        

                        // $last_inserted_id = $db->lastID($con);

                        $db->redirect("project_overview_preview.php?id=" . $update_id . "&project_id=" . $project_id);
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <?php
                        $row = $db->getDataWithId($update_id,$con);
                        ?>
                        <div class="form-group" id="allottee-webcam-div" style="display: none;"><label class="col-lg-2 control-label">Allottee Image</label>
                        <div class="col-sm-10">
                            <!--<img src="<?= $db->getEachById($con, 'image_link', 'projects', $project_id) ?>" class="img-responsive" style="max-width:300px;" />-->
                                <div id="results" class="pull-right"><i class="fa fa-user"></i></div>
                                <div id="my_camera" style="display: none;"></div>
                                <br />
                                <input type=button value="Take Snapshot" onClick="take_snapshot()" class="pull-right">
                                <input type="hidden" name="image" class="image-tag" class="pull-right">
                            </div>
                        </div>
                        <div class="form-group" id="allottee-image-div">
                            <img id="allottee_image" src="./img/<?= $row['allottee_image']; ?>" alt="">
                            <button id="allottee-image-hide-btn">Take Another</button>
                            </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Thumbprint</label>
                            <div class="col-sm-10">
                                <input type="file" id="thumbprint" name="thumbprint">
                                <img id="thumbPreview" src="./img/<?= $row['thumb_print']; ?>" alt="" style="padding: 10px 0; width: 400px; height: 400px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Floor</label>
                            <div class="col-sm-10"> 
                                <div class="checkbox-inline i-checks"><label> <input type="radio" <?php echo ($row['floor'] == "First Floor") ? 'checked=""' : ""; ?> value="First Floor" name="a"> <i></i> First Floor</label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['floor'] == "Second Floor") ? 'checked=""' : ""; ?> value="Second Floor" name="a"> <i></i> Second Floor </label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['floor'] == "Third Floor") ? 'checked=""' : ""; ?> value="Third Floor" name="a"> <i></i> Third Floor </label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['floor'] == "Fourth Floor") ? 'checked=""' : ""; ?> value="Fourth Floor" name="a"> <i></i> Fourth Floor </label></div>
                                <div class="hr-line-dashed"></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['floor'] == "Lower Ground") ? 'checked=""' : ""; ?> value="Lower Ground" name="a"> <i></i> Lower Ground</label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['floor'] == "Ground Floor") ? 'checked=""' : ""; ?> value="Ground Floor" name="a"> <i></i> Ground Floor</label></div>

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
                                <div class="checkbox-inline i-checks"><label> <input type="radio" <?php echo ($row['property_selection'] == "Apartment") ? 'checked=""' : ""; ?> value="Apartment" name="b"> <i></i> Apartment</label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['property_selection'] == "1 Bed") ? 'checked=""' : ""; ?> value="1 Bed" name="b"> <i></i> 1 Bed <small>(Approx 450 Sq Ft.)</small></label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['property_selection'] == "2 Bed") ? 'checked=""' : ""; ?> value="2 Bed" name="b"> <i></i> 2 Bed <small>(Approx 850 Sq Ft.)</small></label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['property_selection'] == "Shop") ? 'checked=""' : ""; ?> value="Shop" name="b"> <i></i> Shop </label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['property_selection'] == "307 sqft") ? 'checked=""' : ""; ?> value="307 sqft" name="b"> <i></i> 307 Sq Ft. </label></div>
                                <div class="i-checks"><label> <input type="radio" <?php echo ($row['property_selection'] == "318 sqft") ? 'checked=""' : ""; ?> value="318 sqft" name="b"> <i></i> 318 Sq Ft. </label></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Personal Information</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="<?= $row['applicant_name']; ?>" placeholder="Name of Applicant - Copy Scaned">
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" name="applicant-of">
                                        <option <?php echo ($row['applicant_of'] == "S/O") ? 'selected' : ''; ?>>S/O</option>
                                        <option <?php echo ($row['applicant_of'] == "D/O") ? 'selected' : ''; ?>>D/O</option>
                                        <option <?php echo ($row['applicant_of'] == "W/O") ? 'selected' : ''; ?>>W/O</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="applicant-sdw" value="<?= $row['applicant_sdw']; ?>" placeholder="S/O,D/O,W/O">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Identity Information</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic hyphenIdCard" value="<?= (!$row['id_card'] == "") ? $row['id_card'] : "XXXXX-XXXXXXX-X"; ?>" data-mask="00000-0000000-0" placeholder="XXXXX-XXXXXXX-X" name="cnic" required="">
                                <span class="form-text">ID Card # : 61101-1234567-8</span>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic" value="<?= (!$row['passport_number'] == "") ? $row['passport_number'] : "xxx-xxxx-xx"; ?>" data-mask="000-0000-00" placeholder="xxx-xxxx-xx (Optional)" name="passport">
                                <span class="form-text">Passport Number</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" id="address" value="<?= (!$row['address'] == "") ? $row['address'] : "Address"; ?>" placeholder="address">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="permanent_address" class="col-sm-2 control-label">Permanent Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="permanent_address" class="form-control" id="permanent_address" value="<?= (!$row['permanent_address'] == "") ? $row['permanent_address'] : "Permanent Address"; ?>" placeholder="Permanent Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" id="email" value="<?= (!$row['email'] == "") ? $row['email'] : "Email Address"; ?>" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_office" class="col-sm-2 control-label">Phone Office</label>
                            <div class="col-sm-2">
                                <input type="tel" data-mask="000-0000000" value="<?= (!$row['phone_office'] == "") ? $row['phone_office'] : "051-1234567"; ?>" placeholder="051-1234567" name="phone_office" id="phone_off" class="form-control threeDigits" id="phone_office" value="<?php
                                                                                                                                                                                        if (isset($_POST['phone_office'])) {
                                                                                                                                                                                            echo $_POST['phone_office'];
                                                                                                                                                                                        }
                                                                                                                                                                                        ?>" placeholder="Phone Office" />
                                <span class="form-text">Office # : 051-1234567</span>
                            </div>
                            <label for="phone_res" class="col-sm-1 control-label">Phone Res</label>
                            <div class="col-sm-3">
                                <input type="tel" name="phone_res" data-mask="000-0000000" value="<?= (!$row['phone_res'] == "") ? $row['phone_res'] : "051-1234567"; ?>" placeholder="051-1234567" class="form-control threeDigits" id="phone_res" value="<?php
                                                                                                                                                                if (isset($_POST['phone_res'])) {
                                                                                                                                                                    echo $_POST['phone_res'];
                                                                                                                                                                }
                                                                                                                                                                ?>" placeholder="Phone Res" />
                                <span class="form-text">Residence # : 051-1234567</span>
                            </div>
                            <label for="mobile" class="col-sm-1 control-label">Mobile</label>
                            <div class="col-sm-3">
                                <input type="tel" name="mobile" data-mask="0000-000-0000" value="<?= (!$row['mobile'] == "") ? $row['mobile'] : "0333-571-4484"; ?>" placeholder="0333-571-4484" class="form-control fourDigits" id="mobile" value="<?php
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
                                <input type="text" class="form-control" name="nominee_name" value="<?= (!$row['nominee_name'] == "") ? $row['nominee_name'] : "Name of Applicant - Copy Scaned"; ?>" placeholder="Name of Applicant - Copy Scaned">
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" name="nominee_of">
                                    <option <?php echo ($row['nominee_of'] == "S/O") ? 'selected' : ''; ?>>S/O</option>
                                        <option <?php echo ($row['nominee_of'] == "D/O") ? 'selected' : ''; ?>>D/O</option>
                                        <option <?php echo ($row['nominee_of'] == "W/O") ? 'selected' : ''; ?>>W/O</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nominee-sdw" value="<?= (!$row['nominee_sdw'] == "") ? $row['nominee_sdw'] : "S/O,D/O,W/O"; ?>" placeholder="S/O,D/O,W/O">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nominee Identity Information</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic hyphenIdCard" data-mask="00000-0000000-0" value="<?= (!$row['nominee_id'] == "") ? $row['nominee_id'] : "XXXXX-XXXXXXX-X"; ?>" placeholder="XXXXX-XXXXXXX-X" name="nominee_id" required="">
                                <span class="form-text">ID Card # : 61101-1234567-8</span>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control cnic" data-mask="000-0000-00" value="<?= (!$row['nominee_passport'] == "") ? $row['nominee_passport'] : "xxx-xxxx-xx (Optional)"; ?>" placeholder="xxx-xxxx-xx (Optional)" name="nominee_passport">
                                <span class="form-text">Passport Number</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Relation with Applicant</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $row['rel_with_applicant']; ?>" name="rel_with_applicant" required="">
                                <span class="form-text">Relation with Applicant</span>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Comments <br /><small>(Office use only)</small></label>
                            <div class="col-sm-10">
                                <textarea rows="10" class="form-control" name="comments" placeholder="Comments"><?= (!$row['comments'] == "") ? $row['comments'] : "Comments"; ?></textarea>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="deposit" class="col-sm-2 control-label">Initial Deposit</label>
                            <div class="col-sm-10">
                                <input type="text" name="initial_deposit" value="<?= (!$row['initial_deposit'] == "") ? $row['initial_deposit'] : ""; ?>" data-mask="PKR 000,000,000.00" autocomplete="off" maxlength="16" class="form-control" value="<?php
                                                                                                                                                                        if (isset($_POST['deposit'])) {
                                                                                                                                                                            echo $_POST['deposit'];
                                                                                                                                                                        }
                                                                                                                                                                        ?>" placeholder="Initial Deposit">
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
                                <select name="installmanet_plan" class="form-control">
                                    <option <?php echo ($row['installmanet_plan'] == "3 - months") ? 'selected' : ''; ?>>3 - months</option>
                                    <option <?php echo ($row['installmanet_plan'] == "6 - months") ? 'selected' : ''; ?>>6 - months</option>
                                    <option <?php echo ($row['installmanet_plan'] == "12 - months") ? 'selected' : ''; ?>>12 - months</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>






                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="projects" class="btn btn-white">Cancel</a>
                                <input name="submit" class="btn btn-primary" type="submit" value="Confirm Slot" />
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
<script language="JavaScript">



    // function take_snapshot() {

    //     Webcam.set({
    //     width: 490,
    //     height: 390,
    //     image_format: 'png',
    //     jpeg_quality: 90,

    // });
    
    // Webcam.attach('#my_camera');
    
    //     $("#my_camera").show();
    //     $("#allottee_image").hide();
    //     Webcam.snap(function(data_uri) {
    //         $(".image-tag").val(data_uri);
    //         document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
    //         $('#my_camera').hide();
    //     });

    // }

    
    
    

    
    
    function take_snapshot() {

        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            $('#my_camera').hide();
        });

    }

    $("#allottee-image-hide-btn").click(function(event){
        $("#allottee-webcam-div").show();
        $("#allottee-image-div").hide();
        $("#my_camera").show();
        
        Webcam.set({
            width: 490,
            height: 390,
            image_format: 'png',
            jpeg_quality: 90,
            
        });
        
        Webcam.attach('#my_camera');
        event.preventDefault();
    })

    $('#thumbprint').change(function() {
        $('#thumbPreview').show("fast");
        const file = this.files[0];
        console.log(file);
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                console.log(event.target.result);
                $('#thumbPreview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $('.hyphenIdCard').on('input', function() {
        var input = $(this).val();
        var formattedInput = idFormatInput(input);
        $(this).val(formattedInput);
    });

    function idFormatInput(input) {
        // Remove existing hyphens and non-numeric characters
        var cleanInput = input.replace(/[^0-9]/g, '');

        // Split the clean input into groups
        var firstGroup = cleanInput.slice(0, 6);
        var secondGroup = cleanInput.slice(6, 12);
        var thirdGroup = cleanInput.slice(12);

        // Join the groups with hyphens
        var formattedInput = [firstGroup, secondGroup, thirdGroup].filter(Boolean).join('-');

        return formattedInput;
    }

    $('.threeDigits').on('input', function() {
        var input = $(this).val();
        var formattedInput = threeDigitsHyphen(input);
        $(this).val(formattedInput);
    });

    function threeDigitsHyphen(input) {
        // Remove existing hyphens and non-numeric characters
        var cleanInput = input.replace(/[^0-9]/g, '');

        // Split the clean input into groups
        var firstGroup = cleanInput.slice(0, 3);
        var remainingDigits = cleanInput.slice(3);

        // Join the groups with hyphen
        var formattedInput = firstGroup + (remainingDigits.length > 0 ? '-' + remainingDigits : '');

        return formattedInput;
    }

    $('.fourDigits').on('input', function() {
        var input = $(this).val();
        var formattedInput = formatInput(input);
        $(this).val(formattedInput);
    });

    function formatInput(input) {
    // Remove existing hyphens and non-numeric characters
    var cleanInput = input.replace(/[^0-9]/g, '');

    // Split the clean input into groups
    var firstGroup = cleanInput.slice(0, 4);
    var remainingDigits = cleanInput.slice(4);

    // Join the groups with hyphen
    var formattedInput = firstGroup + (remainingDigits.length > 0 ? '-' + remainingDigits : '');

    return formattedInput;
    }

</script>