<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}

if (isset($_GET['id'])) {
    $gotten_lead_id = $_GET['id'];
} else {
    $db->redirect('web_requests');
}


$role = $db->getEachById($con, 'role', 'users', $id);
if ($role == 'team') {

    if ($db->getEachById($con, 'by_id', 'web_posts', $gotten_lead_id) != $id) {
        $db->redirect('web_requests');
    }
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-weibo"></i> Web Requests</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Edit Web Request</strong>
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
                    <h5>Edit Web Request <small>Edit Web Requests.</small></h5>
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
                        $internal_lead_id = mysqli_real_escape_string($con, $_POST['internal_lead_id']);
                        $title = mysqli_real_escape_string($con, $_POST['title']);
                        $featured = mysqli_real_escape_string($con, $_POST['featured']);
                        $description = mysqli_real_escape_string($con, $_POST['description']);
                        $price = mysqli_real_escape_string($con, $_POST['price']);
                        $address = mysqli_real_escape_string($con, $_POST['address']);
                        $city = mysqli_real_escape_string($con, $_POST['city']);
                        $type = mysqli_real_escape_string($con, $_POST['type']);
                        $property_type = mysqli_real_escape_string($con, $_POST['property_type']);
                        $purpose = mysqli_real_escape_string($con, $_POST['purpose']);
                        $land_area = mysqli_real_escape_string($con, $_POST['land_area']);
                        $year_build = mysqli_real_escape_string($con, $_POST['year_build']);
                        $video_link = mysqli_real_escape_string($con, $_POST['video_link']);
                        $verification_status = mysqli_real_escape_string($con, $_POST['verification_status']);

                        if (empty($featured) || $featured == "") {
                            $featured = '0';
                        }


                        if (empty($internal_lead_id) || empty($title) || empty($verification_status)) {
                            $db->error('Internal Lead ID , Title & Verificaiton status and Featured is required');
                        }


                        if (!empty($internal_lead_id) && !empty($title) && !empty($verification_status)) {

                            $query = mysqli_query($con, "UPDATE `web_posts`  SET `internal_lead_id` = '" . $internal_lead_id . "',`title` = '" . $title . "', `featured` = '" . $featured . "', `description` = '" . $description . "',`price` = '" . $price . "', `address` = '" . $address . "', `city` = '" . $city . "',`type`='" . $type . "',`property_type` = '" . $property_type . "',`purpose` = '" . $purpose . "',`land_area` = '" . $land_area . "' ,`year_build` = '" . $year_build . "',`video_link` = '" . $video_link . "',`verification_status` = '" . $verification_status . "' WHERE `id` = '" . $gotten_lead_id . "'");
                            if (!$query) {
                                print($query);
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                                echo "UPDATE `web_posts`  SET `internal_lead_id` = '" . $internal_lead_id . "',`title` = '" . $title . "', `featured` = '" . $featured . "', `description` = '" . $description . "',`price` = '" . $price . "', `address` = '" . $address . "', `city` = '" . $city . "',`type`='" . $type . "',`property_type` = '" . $property_type . "',`purpose` = '" . $purpose . "',`land_area` = '" . $land_area . "' ,`year_build` = '" . $year_build . "',`video_link` = '" . $video_link . "',`verification_status` = '" . $verification_status . "' WHERE `id` = '" . $gotten_lead_id . "'";
                            } else {
                                $db->add_user_activity($con, "Added a new lead <strong>" . $client_name . "</strong>");
                                $db->redirect('web_requests?msg_add');
                            }
                        }
                    }
                    ?>

                    <form action="#" method="POST" class="form-horizontal">


                        <div class="form-group"><label class="col-lg-2 control-label">Internal Lead ID</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="internal_lead_id" value="<?php
                                if (isset($_POST['internal_lead_id'])) {
                                    echo $_POST['internal_lead_id'];
                                } else {
                                    echo $db->getEachById($con, 'internal_lead_id', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Internal Lead ID"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="title" value="<?php
                                if (isset($_POST['title'])) {
                                    echo $_POST['title'];
                                } else {
                                    echo $db->getEachById($con, 'title', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Title"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Featured</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="featured" value="<?php
                                if (isset($_POST['featured'])) {
                                    echo $_POST['featured'];
                                } else {
                                    echo $db->getEachById($con, 'featured', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Put numbers like 1 for featured and 0 for non feature."></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10"><textarea rows="10" class="form-control" name="description" placeholder="Description" /><?php
                                if (isset($_POST['description'])) {
                                    echo $_POST['description'];
                                } else {
                                    echo $db->getEachById($con, 'description', 'web_posts', $gotten_lead_id);
                                }
                                ?></textarea></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" id="demand" value="<?php
                                if (isset($_POST['price'])) {
                                    echo $_POST['price'];
                                } else {
                                    echo $db->getEachById($con, 'price', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Price" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" value="<?php
                                if (isset($_POST['address'])) {
                                    echo $_POST['address'];
                                } else {
                                    echo $db->getEachById($con, 'address', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Address" >
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
                                    echo $db->getEachById($con, 'city', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="City" >
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
                                    echo $db->getEachById($con, 'type', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Type" required>
                            </div>
                        </div>
                        <!--                        <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <label for="property_type" class="col-sm-2 control-label">Remarks</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control m-b" name="remarks" placeholder="Remarks" rows="5"><?php
                        if (isset($_POST['remarks'])) {
                            echo $_POST['remarks'];
                        } else {
                            echo $db->getEachById($con, 'remarks', 'web_posts', $gotten_lead_id);
                        }
                        ?></textarea>
                                                    </div>
                                                </div>-->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="property_type" class="col-sm-2 control-label">Property Type</label>
                            <div class="col-sm-10">
                                <input type="text" name="property_type" class="form-control" value="<?php
                                if (isset($_POST['property_type'])) {
                                    echo $_POST['property_type'];
                                } else {
                                    echo $db->getEachById($con, 'property_type', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Property Type" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="purpose" class="col-sm-2 control-label">Purpose</label>
                            <div class="col-sm-10">
                                <input type="text" name="purpose" class="form-control" value="<?php
                                if (isset($_POST['purpose'])) {
                                    echo $_POST['purpose'];
                                } else {
                                    echo $db->getEachById($con, 'purpose', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Purpose" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="land_area" class="col-sm-2 control-label">Land Area</label>
                            <div class="col-sm-10">
                                <input type="text" name="land_area" class="form-control" value="<?php
                                if (isset($_POST['land_area'])) {
                                    echo $_POST['land_area'];
                                } else {
                                    echo $db->getEachById($con, 'land_area', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Land Area" />
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
                                    echo $db->getEachById($con, 'year_build', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Year Build" />
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
                                    echo $db->getEachById($con, 'video_link', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Video Link" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="verification_status" class="col-sm-2 control-label">Verification Status</label>
                            <div class="col-sm-10">
                                <input type="text" name="verification_status" class="form-control" value="<?php
                                if (isset($_POST['verification_status'])) {
                                    echo $_POST['verification_status'];
                                } else {
                                    echo $db->getEachById($con, 'verification_status', 'web_posts', $gotten_lead_id);
                                }
                                ?>" placeholder="Verification Status" />
                            </div>
                        </div>

                        <!--<div class="hr-line-dashed"></div>-->
                        <!--                        <div class="form-group">
                                                    <label for="year_build" class="col-sm-2 control-label">Primary Image</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="year_build" class="form-control" value="<?php
                        if (isset($_POST['year_build'])) {
                            echo $_POST['year_build'];
                        } else {
                            echo $db->getEachById($con, 'year_build', 'web_posts', $gotten_lead_id);
                        }
                        ?>" placeholder="Year Build" />
                                                    </div>
                                                </div>-->

                        <div class = "form-group">
                            <div class = "col-sm-4 col-sm-offset-2">
                                <a href = "web_requests" class = "btn btn-white" >Cancel</a>
                                <input name = "submit" class = "btn btn-primary" type = "submit" value = "Update" />
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