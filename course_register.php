<?php
include'includes/header.php';
?>
<section class="contact-wrap">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-box2">
                    <div class="form-group col-lg-6">
                        <img src="https://cdn.tinybuddha.com/wp-content/uploads/2012/12/Looking-ahead.png" object-fit="cover" />
                    </div>
                    <div class="contact-content">
                        <h3 class="contact-title">Course Admission Request</h3>
                        <p>Enroll yourself in the Courses and Secure your Future with multiple Top Notch Skills</p>
                        <?php
                        if (isset($_POST['submit'])) {
                            $name = mysqli_real_escape_string($con, $_POST['name']);
                            $phone = mysqli_real_escape_string($con, $_POST['phone']);
                            $email = mysqli_real_escape_string($con, $_POST['email']);
                            $dob = mysqli_real_escape_string($con, $_POST['dob']);
                            $id_card = mysqli_real_escape_string($con, $_POST['id_card']);
                            $gender = mysqli_real_escape_string($con, $_POST['gender']);
                            $course_name = mysqli_real_escape_string($con, $_POST['course_name']);
                            $message = mysqli_real_escape_string($con, $_POST['message']);

                            if (empty($name) || empty($phone) || empty($id_card) || empty($course_name) || empty($gender)) {
                                $db->error('All Fields are required.');
                            }

                            if (!empty($name) && !empty($phone) && !empty($id_card) && !empty($course_name) && !empty($gender)) {
                                $query = mysqli_query($con, "INSERT INTO `enrollment` SET "
                                        . "`phone` = '" . $phone . "',"
                                        . "`complete_name` = '" . $name . "',"
                                        . "`email` = '" . $email . "',"
                                        . "`dob` = '" . $dob . "',"
                                        . "`id_card` = '" . $id_card . "',"
                                        . "`gender` = '" . $gender . "',"
                                        . "`course_name` = '" . $course_name . "',"
                                        . "`message` = '" . $message . "'"
                                        . "");
                                if ($query) {
                                    $db->success("Your Admission Request has been successfully sent. Please wait for someone from TeamWork to get back to you. Thank You.");
                                } else {
                                    $db->error("Your request can not be accepted at this moment, Please call 0333-5714484 for manual request entry");
                                }
                            }
                        }
                        ?>
                        <form action="#" method="POST" class="contact-box ">
                            <div class="row">

                                <div class="form-group col-lg-6">
                                    <label>Complete Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="Complete Name*" data-error="Complete Name is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Phone *</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone*" data-error="Phone is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email *</label>
                                    <input type="email" class="form-control" name="email" placeholder="Complete Name*" data-error="Email is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Date of Birth *</label>
                                    <input type="date" class="form-control" name="dob" placeholder="Date of Birth *" data-error="DOB is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>ID Card # *</label>
                                    <input type="number" class="form-control" name="id_card" placeholder="ID Card Number*" data-error="ID Card Number is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Gender *</label>
                                    <select class="form-control" name="gender"  data-error="Gender is required" required="">
                                        <option selected="">Male</option>
                                        <option>Female</option>
                                        <option>Rather not say</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Course Name *</label>
                                    <style>
                                        .contact-box2 .contact-content .contact-box .form-group .form-control{width:100%;}
                                    </style>
                                    <select class="form-control" name="course_name"  data-error="Phone is required" required="">
                                        <option>Microsoft Office</option>
                                        <option selected="">Front End Web Design</option>
                                        <option>Programming Fundamentals</option>
                                        <option>Graphic Design</option>
                                        <option>Full Stack Web Development</option>
                                        <option>Short Courses (6 Months)</option>
                                        <option>Adobe Photoshop</option>
                                        <option>E-Commerce & Ebay DropShipping</option>
                                        <option>Certification in Networking</option>
                                        <option>Social Media Marketing</option>
                                        <option>UI/UX</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Message *</label>
                                    <textarea name="message" id="message" class="form-text"  placeholder="Message" cols="30" rows="5" data-error="Message Name is required" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <button type="submit" name="submit" class="item-btn">Enroll Now</button>
                                </div>
                            </div>
                            <div class="form-response"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include'includes/footer.php';
?>