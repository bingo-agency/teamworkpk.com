<?php
include 'admin/includes/dataBase.php';

$results_per_page = 2;
// print_r($_POST);
// exit();
$gotten_id = $_POST['id'];
$final_query = "SELECT * FROM web_posts WHERE id > '$gotten_id' AND `verification_status` = '1' ORDER BY id LIMIT {$results_per_page}";

if (isset($_GET['feature'])) {
    $gotten_featured = $_GET['feature'];
    if ($gotten_featured == 'yes') {
        $final_query = "SELECT * FROM `web_posts` WHERE `featured` = '1' AND `verification_status` = '1' AND `id` > '" . $_POST['id'] . "' ORDER BY `id` DESC LIMIT {$results_per_page}";
    }
}
if (isset($_GET['property_type'])) {
    $gotten_property_type = $_GET['property_type'];
    if ($gotten_property_type != '') {
        $final_query = "SELECT * FROM `web_posts` WHERE `property_type` = '" . $gotten_property_type . "' AND `verification_status` = '1' AND `id` < '" . $_POST['id'] . "'  ORDER BY `id` DESC LIMIT {$results_per_page}";
    } else {
        $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
    }
}
if (isset($_GET['type'])) {
    $gotten_type = $_GET['type'];
    if ($gotten_type != '') {
        $final_query = "SELECT * FROM `web_posts` WHERE `type` = '" . $gotten_type . "' AND `verification_status` = '1' AND `id` > '" . $_POST['id'] . "'  ORDER BY `id` DESC LIMIT {$results_per_page}";
    } else {
        $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
    }
}

if (isset($_GET['city_search'])) {
    $gotten_city_search = $_GET['city_search'];
    if (empty($gotten_city_search)) {
        $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' AND `id` > '" . $_POST['id'] . "'  ORDER BY `id` DESC LIMIT {$results_per_page}";
    } else {
        $final_query = "SELECT * FROM `web_posts` WHERE `city` = '" . $gotten_city_search . "' AND `verification_status` = '1' AND `id` > '" . $_POST['id'] . "'  ORDER BY `id` DESC LIMIT {$results_per_page} ";
    }
}
if (isset($_GET['keyword'])) {
    $gotten_keyword = $_GET['keyword'];
    $final_query = "SELECT * FROM `web_posts` WHERE (`title` LIKE '%" . $gotten_keyword . "%') OR (`internal_lead_id` LIKE '%" . $gotten_keyword . "%')  AND `id` > '" . $_POST['id'] . "' ORDER BY `id` DESC";
}


if (isset($_GET['advance_search'])) {
    $gotten_city = $_GET['city'];
    $gotten_keyword = $_GET['keyword'];
    $gotten_type = $_GET['type'];

    if (empty($gotten_keyword) || empty($gotten_city) || empty($gotten_type)) {
        $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1'  AND `id` > '" . $_POST['id'] . "' ORDER BY `id` DESC LIMIT {$results_per_page}";
    }
    if (empty($gotten_city) && empty($gotten_type)) {
        $db->redirect('listing?keyword');
    }
    if (empty($gotten_keyword) && empty($gotten_type)) {
        $db->redirect('listing?city_search=' . $gotten_city);
        exit();
    }
    if (empty($gotten_keyword) && empty($gotten_city)) {
        $db->redirect('listing?type=' . $gotten_type);
        exit();
    }
    if (!empty($gotten_keyword) && !empty($gotten_city) && !empty($gotten_type)) {
        $final_query = "SELECT * FROM `web_posts` WHERE (`title` LIKE '%" . $gotten_keyword . "%') OR (`internal_lead_id` LIKE '%" . $gotten_keyword . "%') AND `city` = '" . $gotten_city . "' AND `type` = '" . $gotten_type . "'  AND `id` > '" . $_POST['id'] . "' ORDER BY `id` DESC LIMIT {$results_per_page}";
    }
}


$output = "";


$query = mysqli_query($con, $final_query);
$recordsNow = mysqli_num_rows($query);
if($recordsNow > 0) {
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $last_fetched_id = '';
    ?>

    <div class="col-lg-12">
        <div class="property-box2 property-box4 wow animated fadeInUp" data-wow-delay=".6s">
            <a href="listing_detail?post_id=<?= $row['id'] ?>">
                <div class="item-img" style="    background-image: url('<?= $row['primary_image'] ?>');width:250px;height: 200px;background-size: cover;background-repeat: no-repeat;">

                                                                                                                                                                                                                                                                                            <!--<img src="<?= $row['primary_image'] ?>" alt="<?= $row['title'] ?>" width="250" height="200">-->

                    <div class="item-category-box1">
                        <div class="item-category"><?= $row['purpose'] ?></div>
                    </div>
                </div>
            </a>
            <div class="item-content item-content-property">
                <div class="item-category10" style="text-transform: capitalize"><?= $row['type'] ?></div>
                <div class="react-icon react-icon-2">
                </div>
                <div class="verified-area">
                    <h3 class="item-title"><a href="listing_detail?post_id=<?= $row['id'] ?>"><?= $row['title'] ?></a></h3>
                </div>
                <div class="location-area"><i class="flaticon-maps-and-flags"></i><?= $row['city'] ?></div>
                <div class="item-categoery3">
                    <ul>
                        <li><i class="flaticon-two-overlapping-square"></i><?= $row['land_area'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php
    $last_fetched_id = $row['id'];
}
}
if ($recordsNow > 0) {
    ?>
    <div class="pagination-style-1">
        <div class="property-button" >
            <button id="load_more" data-id="<?php
            if ($last_fetched_id != '') {
                echo $last_fetched_id;
            }
            ?>" class="item-btn">Load More Records</button>
        </div>
    </div>

    <?php
}



