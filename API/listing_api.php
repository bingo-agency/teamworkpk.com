<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include'../admin/includes/connection.php';



if(isset($_GET['advance_search'])) {

$final_query = "SELECT * FROM `web_posts` WHERE 1";


if(isset($_GET['keyword'])) {
    $gotten_keyword = $_GET['keyword'];
    $final_query .= " AND (`title` LIKE '%" . $gotten_keyword . "%' OR `internal_lead_id` LIKE '%" . $gotten_keyword . "%')";
}

if(isset($_GET['property-type'])) {
    $gotten_property_type = $_GET['property-type'];
    $final_query .= " AND `property_type` = '" . $gotten_property_type . "'";
}

if(isset($_GET['city'])) {
    $gotten_city = $_GET['city'];
    $final_query .= " AND `city` = '" . $gotten_city . "'";
}

if(isset($_GET['range-min']) && isset($_GET['range-max'])) {
    $gotten_min_range = $_GET['range-min'];
    $gotten_max_range = $_GET['range-max'];
    $final_query .= " AND CAST(REPLACE(price, ',', '') AS UNSIGNED) BETWEEN {$gotten_min_range} AND {$gotten_max_range}";
}

if(isset($_GET['area-min']) && isset($_GET['area-max'])) {
    $gotten_area_min = $_GET['area-min'];
    $gotten_area_max = $_GET['area-max'];
    $final_query .= " AND CAST(REPLACE(land_area, ',', '') AS UNSIGNED) BETWEEN {$gotten_area_min} AND {$gotten_area_max}";
}

if(isset($_GET['price-sorting'])) {
    $priceSorting = $_GET['price-sorting'];

    if($priceSorting === 'low_to_high') {
        $final_query .= " AND `verification_status` = '1' ORDER BY CAST(REPLACE(price, ',', '') AS UNSIGNED) ASC";
    }
    
    if($priceSorting === 'high_to_low') {
        $final_query .= " AND `verification_status` = '1' ORDER BY CAST(REPLACE(price, ',', '') AS UNSIGNED) DESC";
    }
} else {

    $final_query .= " AND `verification_status` = '1' ORDER BY id DESC";
    
}

$final_query_results = mysqli_query($con, $final_query);

if ($final_query_results) {
    // Fetch all rows as an array of associative arrays
    $rows = array();
    while ($fetch_row = mysqli_fetch_assoc($final_query_results)) {
        $rows[] = $fetch_row;
    }

    // Encode the data as JSON
    echo json_encode($rows);
}

} else {
    
    if(isset($_GET['price-sorting'])) {
        $priceSorting = $_GET['price-sorting'];

        if($priceSorting === 'low_to_high') {
            $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY CAST(REPLACE(price, ',', '') AS UNSIGNED) ASC";
        }
        
        if($priceSorting === 'high_to_low') {
            $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY CAST(REPLACE(price, ',', '') AS UNSIGNED) DESC";
        }
    } else {

    $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC";
    
    }

    while($fetch_row = mysqli_fetch_assoc($final_query_results)) {
        $row[] = $fetch_row;
    }

    echo json_encode($row);
}

?>
