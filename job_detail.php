<?php
include'includes/header.php';

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
}
?>
<style>

    .btn-primary {
        color: #fff;
        background-color: #6f1c74;
        border-color: #5e1863;
    }
    .btn-primary:hover{
        background-color: #5e1863;
        border-color: #6f1c74;
    }

</style>
<div class="breadcrumb-wrap breadcrumb-wrap-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="careers">Careers</li>
            </ol>
        </nav>
    </div>
</div>
<section class="property-wrap1 property-wrap-10">
    <div class="container">
        <div class="item-heading-center">
            <span class="section-subtitle">Job Openings</span>
            <h2 class="section-title"><?= $db->getEachById($con, 'title', 'job_posts', $job_id) ?></h2>
            <div class="bg-title-wrap" style="display: block">
                <span class="background-title solid">Careers</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <table>
                    <tr>
                        <td></td>
                        <td>
                    <center>
                        <i class="<?= $db->getEachById($con, 'image', 'job_posts', $job_id) ?>" style="color:#6f1c74;font-size:150px;"></i>
                    </center>
                    </td>
                    </tr>
                    <tr>
                        <td><strong>Title : </strong></td>
                        <td><?= $db->getEachById($con, 'title', 'job_posts', $job_id) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Seats : </strong></td>
                        <td><?= $db->getEachById($con, 'available_seats', 'job_posts', $job_id) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Job Description: </strong></td>
                        <td><?= $db->getEachById($con, 'description', 'job_posts', $job_id) ?></td>
                    </tr>
                </table>
                <br />

            </div>
            <div class="col-md-6 col-sm-12">
                <h4>Fill out the form to apply for this job post.</h4>
                <?php
                $uploaded = false;

                if (isset($_POST['upload'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $file = $_FILES['file']['name'];
                    $newfile = time() . $file;
                    $file_location = "upload/" . time() . $file;

                    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_location)) {
                        $file_location . "File uploaded!";
                        $uploaded = true;
                    } else {
                        echo '0' . "File didn't upload!";
                    }
                    if ($uploaded == true) {
                        $query = "INSERT INTO resume(job_post_id,name,email,file,phone) VALUES(' $job_id','$name','$email','$newfile','$phone')";
                        mysqli_query($con, $query);
                        if ($query) {
                            $db->success('Job Applied Successfully.');
                        } else {
                            echo "error";
                        }
                    }
                }
                ?>
                <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-8 control-label">Name</label>
                        <div class="col-sm-8"><input type="text" class="form-control" name="name" value="<?php
                if (isset($_POST['name'])) {
                    echo $_POST['name'];
                }
                ?>" placeholder="Name"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-8 control-label">Email</label>
                        <div class="col-sm-8"><input type="email" class="form-control" name="email" value="<?php
                            if (isset($_POST['email'])) {
                                echo $_POST['email'];
                            }
                ?>" placeholder="Email"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-8 control-label">Phone Number</label>
                        <div class="col-sm-8"><input type="tel" class="form-control" name="phone" required="" placeholder="0333571xxxx"></div>
                    </div>
                    <!-- <input type="checkbox" required="" /> I accept all the <a href="terms">terms & Conditions</a>. -->

                    <div class="form-group">
                        <label class="col-lg-8 control-label">Select CV</label>
                        <div class="col-sm-8"><input type="file" class="form-control" name="file" required="" ></div>
                        <button type="submit" name="upload">upload</button>
                    </div>


                    <!-- <div class="form-group">
                        <div class="col-lg-6 col-sm-offset-2">
                    
                            <input name="submit" class="btn-block btn-lg btn btn-primary col-lg-12" type="submit" value="Register" />
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
</section>

<?php include'includes/footer.php'; ?>