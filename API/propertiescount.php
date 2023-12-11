<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
include'../admin/includes/connection.php';


// $query = "SELECT DISTINCT * FROM web_posts";



// // Execute the query
// $result = mysqli_query($con, $query);

// while($row = mysqli_fetch_assoc($result)) {
// if ($result) {   
//     echo $row['city'] . "<br>";
// }
// }
//     // Display the count
//     echo "Islamabad: " . $count . "<br>";
// }



// $query = "SELECT * FROM web_posts";

// Execute the query
// $result = mysqli_query($con, $query);

// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $cities[] = $row['city'];
//     }
// } 

// $a = array_count_values($cities);

// print json_encode($a);

$query = "SELECT * FROM web_posts";

// Execute the query
$result = mysqli_query($con, $query);

$cities = array(); // Initialize the array

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cities[] = $row['city'];
    }
} 

$cityCounts[] = array_count_values($cities);

$arr['citites'] = $cityCounts;
print json_encode($arr);


?>