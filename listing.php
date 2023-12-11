<?php
include'includes/header.php';

//if (isset($_GET['city'])) {
//    $gotten_city = $_GET['city'];
//}
//if (isset($_GET['area'])) {
//    $gotten_area = $_GET['area'];
//}
//if (isset($_GET['property_type'])) {
//    $gotten_property_type = $_GET['property_type'];
//}

// $results_per_page = 20;
// $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page }";


// if (isset($_GET['feature'])) {
//     $gotten_featured = $_GET['feature'];
//     if ($gotten_featured == 'yes') {
//         $final_query = "SELECT * FROM `web_posts` WHERE `featured` = '1' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
//     }
// }
// if (isset($_GET['property_type'])) {
//     $gotten_property_type = $_GET['property_type'];
//     if ($gotten_property_type != '') {
//         $final_query = "SELECT * FROM `web_posts` WHERE `property_type` = '" . $gotten_property_type . "' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
//     } else {
//         $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
//     }
// }
// if (isset($_GET['type'])) {
//     $gotten_type = $_GET['type'];
//     if ($gotten_type != '') {
//         $final_query = "SELECT * FROM `web_posts` WHERE `type` = '" . $gotten_type . "' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
//     } else {
//         $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
//     }
// }

// if (isset($_GET['city_search'])) {
//     $gotten_city_search = $_GET['city_search'];
//     if (empty($gotten_city_search)) {
//         $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
//     } else {
//         $final_query = "SELECT * FROM `web_posts` WHERE `city` = '" . $gotten_city_search . "' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
//     }
// }

// if (isset($_GET['keyword'])) {
//     $gotten_keyword = $_GET['keyword'];
//     $final_query = "SELECT * FROM `web_posts` WHERE (`title` LIKE '%" . $gotten_keyword . "%') OR (`internal_lead_id` LIKE '%" . $gotten_keyword . "%')";
// }

// if (isset($_GET['min-range'])) {
//     $minimum_range = $_GET['min-range'];
//     $maximum_range = $_GET['max-range'];
//     $final_query = "SELECT * FROM web_posts WHERE CAST(REPLACE(price, ',', '') AS UNSIGNED) BETWEEN {$minimum_range} AND {$maximum_range} AND verification_status = '1' ORDER BY id DESC LIMIT {$results_per_page}";
// }

// if (isset($_GET['advance_search'])) {
//     $gotten_city = $_GET['city'];
//     $gotten_keyword = $_GET['keyword'];
//     $gotten_type = $_GET['type'];
//     $minimum_range = $_GET['range-min'];
//     $maximum_range = $_GET['range-max'];

//     if (empty($gotten_keyword) || empty($gotten_city) || empty($gotten_type) || empty($minimum_range) || empty($maximum_range)) {
//         $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
//     }
//     if (empty($gotten_city) && empty($gotten_type) && empty($minimum_range) && empty($maximum_range)) {
//         $db->redirect('listing?keyword=' . $gotten_keyword);
//     }
//     if (empty($gotten_keyword) && empty($gotten_type) && empty($minimum_range) && empty($maximum_range)) {
//         $db->redirect('listing?city_search=' . $gotten_city);
//         exit();
//     }
//     if (empty($gotten_keyword) && empty($gotten_city) && empty($minimum_range) && empty($maximum_range)) {
//         $db->redirect('listing?type=' . $gotten_type);
//         exit();
//     }
//     if(empty($gotten_keyword) && empty($gotten_city) && empty($gotten_type)) {
//         $db->redirect('listing?min-range='. $minimum_range . '&max-range=' . $maximum_range);
//     }
//         if (!empty($gotten_keyword) && !empty($gotten_city) && !empty($gotten_type) && !empty($maximum_range) && !empty($minimum_range)) {
//         $final_query = "SELECT * FROM `web_posts` WHERE (`title` LIKE '%" . $gotten_keyword . "%') AND (`internal_lead_id` LIKE '%" . $gotten_keyword . "%')  AND CAST(REPLACE(price, ',', '') AS UNSIGNED) BETWEEN {$minimum_range} AND {$maximum_range} `type` = '" . $gotten_type . "' AND `city` = '" . $gotten_city . "' ORDER BY `id` DESC LIMIT {$results_per_page}";
        
//     }
// }



// chatgpt seach engine

// Start with a base query and condition that will always be true to avoid SQL syntax errors
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



// Add the common verification status condition to all queries

// Get the current URL with all its parameters
$currentURL = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL to get its parameters as an associative array
$urlParts = parse_url($currentURL);
parse_str($urlParts['query'], $urlParams);

// Create an array to store the valid parameters
$validParams = array();

// Loop through the parameters and keep only the non-empty ones
foreach ($urlParams as $key => $value) {
    if (!empty($value)) {
        $validParams[$key] = $value;
    }
}

// Check if there are any empty parameters
if (count($validParams) < count($urlParams)) {
    // Build the filtered URL
    $filteredURL = $urlParts['path'] . '?' . http_build_query($validParams);

    // Redirect the user to the filtered URL
    header("Location: $filteredURL");
    exit;
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
}


// echo $final_query;
$Count_query = mysqli_query($con, $final_query);
$recordsNow = mysqli_num_rows($Count_query);
// echo $recordsNow;
?>

<section class="grid-wrap3">
    <div class="container">
        <div class="row gutters-40">
            <div class="col-lg-4 widget-break-lg sidebar-widget">
                <div class="widget widget-advanced-search">
                    <h3 class="widget-subtitle">Advanced Search</h3>
                    <div action="#" class="map-forms map-form-style-2">
                        <input type="text" id="asearch_keyword" class="form-control" placeholder="Enter Keyword Here">
                        <div class="row">
                            <div class="col-lg-12 pl-15 mb-0">
                                <div class="rld-single-select">
                                    <select id="asearch_type" class="select single-select mr-0">
                                    <option value="">Property Type</option>
                                    <option value="studio">Studio House</option>
                                    <option value="Office">Office</option>
                                    <option value="apartments">Apartment</option>
                                    <option value="plot">Plot</option>
                                    <option value="shop">Shop</option>
                                    <option value="restaurant">Restaurant</option>
                                    <option value="building">Building</option>
                                    <option value="shop">Shop</option>
                                    <option value="house">House</option>
                                    <option value="land">Land</option>
                                    <option value="vehicle">Vehicle</option>
                                    <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 pl-15">
                                
                            <div class="" style="padding-top:10px">
                                        <!-- <label for="exampleDataList" class="form-label">Enter City</label> -->
                                        <input class="form-control" name="city" id="asearch_city" list="datalistOptions" placeholder="Type to search...">
                                        <datalist id="datalistOptions" >
                                            <option value="">Select</option>
                                            <option label="Islamabad" value="Islamabad">Islamabad</option>
                                            <option label="Lahore" value="Lahore">Lahore</option>
                                            <option label="Karachi" value="Karachi">Karachi</option>
                                            <option label="Abbotabad" value="Abbotabad">Abbotabad</option>
                                            <option label="Abdul Hakeem" value="Abdul Hakeem">Abdul Hakeem</option>
                                            <option label="Agra" value="Agra">Agra</option>
                                            <option label="Ahmed Nagar" value="Ahmed Nagar">Ahmed Nagar</option>
                                            <option label="Ahmed Pur East" value="Ahmed Pur East">Ahmed Pur East</option>
                                            <option label="Ahmed Pur Sial" value="Ahmed Pur Sial">Ahmed Pur Sial</option>
                                            <option label="Akora Khattak" value="Akora Khattak">Akora Khattak</option>
                                            <option label="Ali Pur" value="Ali Pur">Ali Pur</option>
                                            <option label="Ali Pur Chatta" value="Ali Pur Chatta">Ali Pur Chatta</option>
                                            <option label="Ali Zai" value="Ali Zai">Ali Zai</option>
                                            <option label="Arif Wala" value="Arif Wala">Arif Wala</option>
                                            <option label="Attock" value="Attock">Attock</option>
                                            <option label="Badah" value="Badah">Badah</option>
                                            <option label="Badin" value="Badin">Badin</option>
                                            <option label="Badomali" value="Badomali">Badomali</option>
                                            <option label="Bagh A.J.K." value="Bagh A.J.K.">Bagh A.J.K.</option>
                                            <option label="Bahawalnagar" value="Bahawalnagar">Bahawalnagar</option>
                                            <option label="Bahawalpur" value="Bahawalpur">Bahawalpur</option>
                                            <option label="Bahrain" value="Bahrain">Bahrain</option>
                                            <option label="Bajur Agency" value="Bajur Agency">Bajur Agency</option>
                                            <option label="Balakot" value="Balakot">Balakot</option>
                                            <option label="Ban Saeed Abad" value="Ban Saeed Abad">Ban Saeed Abad</option>
                                            <option label="Bannu" value="Bannu">Bannu</option>
                                            <option label="Bara" value="Bara">Bara</option>
                                            <option label="Barian" value="Barian">Barian</option>
                                            <option label="Basirpur" value="Basirpur">Basirpur</option>
                                            <option label="Batkhela" value="Batkhela">Batkhela</option>
                                            <option label="Bela" value="Bela">Bela</option>
                                            <option label="Bewal" value="Bewal">Bewal</option>
                                            <option label="Bhai Phero" value="Bhai Phero">Bhai Phero</option>
                                            <option label="Bhakkar" value="Bhakkar">Bhakkar</option>
                                            <option label="Bhalwal" value="Bhalwal">Bhalwal</option>
                                            <option label="Bhaun" value="Bhaun">Bhaun</option>
                                            <option label="Bhawana" value="Bhawana">Bhawana</option>
                                            <option label="Bhera" value="Bhera">Bhera</option>
                                            <option label="Bheriya Road" value="Bheriya Road">Bheriya Road</option>
                                            <option label="Bhirya City" value="Bhirya City">Bhirya City</option>
                                            <option label="Bhit Shah" value="Bhit Shah">Bhit Shah</option>
                                            <option label="Bonga Sleh" value="Bonga Sleh">Bonga Sleh</option>
                                            <option label="Bucheki" value="Bucheki">Bucheki</option>
                                            <option label="Buffa" value="Buffa">Buffa</option>
                                            <option label="Bulida" value="Bulida">Bulida</option>
                                            <option label="Bunair" value="Bunair">Bunair</option>
                                            <option label="Bungla Dero" value="Bungla Dero">Bungla Dero</option>
                                            <option label="Burewala" value="Burewala">Burewala</option>
                                            <option label="Chack 15.Sb" value="Chack 15.Sb">Chack 15.Sb</option>
                                            <option label="Chak 273" value="Chak 273">Chak 273</option>
                                            <option label="Chak 330" value="Chak 330">Chak 330</option>
                                            <option label="Chak Jhumra" value="Chak Jhumra">Chak Jhumra</option>
                                            <option label="Chakwal" value="Chakwal">Chakwal</option>
                                            <option label="Chaman" value="Chaman">Chaman</option>
                                            <option label="Charsadda" value="Charsadda">Charsadda</option>
                                            <option label="Chawinda" value="Chawinda">Chawinda</option>
                                            <option label="Chichawatni" value="Chichawatni">Chichawatni</option>
                                            <option label="Chichoki Malian" value="Chichoki Malian">Chichoki Malian</option>
                                            <option label="Chichtian" value="Chichtian">Chichtian</option>
                                            <option label="Chiniot" value="Chiniot">Chiniot</option>
                                            <option label="Chitral" value="Chitral">Chitral</option>
                                            <option label="Choa Khalisa" value="Choa Khalisa">Choa Khalisa</option>
                                            <option label="Chota Lahore" value="Chota Lahore">Chota Lahore</option>
                                            <option label="Choti (D.G.K.)" value="Choti (D.G.K.)">Choti (D.G.K.)</option>
                                            <option label="Chowk Azam" value="Chowk Azam">Chowk Azam</option>
                                            <option label="Chowk Munda" value="Chowk Munda">Chowk Munda</option>
                                            <option label="Chuhar Kana" value="Chuhar Kana">Chuhar Kana</option>
                                            <option label="Chunian" value="Chunian">Chunian</option>
                                            <option label="D. I. Khan" value="D. I. Khan">D. I. Khan</option>
                                            <option label="D.G. Khan" value="D.G. Khan">D.G. Khan</option>
                                            <option label="Dabbanp" value="Dabbanp">Dabbanp</option>
                                            <option label="Dadu" value="Dadu">Dadu</option>
                                            <option label="Daggar" value="Daggar">Daggar</option>
                                            <option label="Dahran Wala" value="Dahran Wala">Dahran Wala</option>
                                            <option label="Dalbandin" value="Dalbandin">Dalbandin</option>
                                            <option label="Damba" value="Damba">Damba</option>
                                            <option label="Dara Adam Khel" value="Dara Adam Khel">Dara Adam Khel</option>
                                            <option label="Dargai" value="Dargai">Dargai</option>
                                            <option label="Darya Khan" value="Darya Khan">Darya Khan</option>
                                            <option label="Daska" value="Daska">Daska</option>
                                            <option label="Daur" value="Daur">Daur</option>
                                            <option label="Depalpur" value="Depalpur">Depalpur</option>
                                            <option label="Dera Allah Khan" value="Dera Allah Khan">Dera Allah Khan</option>
                                            <option label="Dera Bugti" value="Dera Bugti">Dera Bugti</option>
                                            <option label="Dera Murad Jamali" value="Dera Murad Jamali">Dera Murad Jamali</option>
                                            <option label="Dewal Sharif" value="Dewal Sharif">Dewal Sharif</option>
                                            <option label="Dhabe Jee" value="Dhabe Jee">Dhabe Jee</option>
                                            <option label="Dhadhar" value="Dhadhar">Dhadhar</option>
                                            <option label="Dherki" value="Dherki">Dherki</option>
                                            <option label="Digkot" value="Digkot">Digkot</option>
                                            <option label="Digree" value="Digree">Digree</option>
                                            <option label="Dina" value="Dina">Dina</option>
                                            <option label="Dina Jlm" value="Dina Jlm">Dina Jlm</option>
                                            <option label="Dinga" value="Dinga">Dinga</option>
                                            <option label="Diplo" value="Diplo">Diplo</option>
                                            <option label="Dir" value="Dir">Dir</option>
                                            <option label="Dokri" value="Dokri">Dokri</option>
                                            <option label="Dolat Pur" value="Dolat Pur">Dolat Pur</option>
                                            <option label="Domaili" value="Domaili">Domaili</option>
                                            <option label="Drosh" value="Drosh">Drosh</option>
                                            <option label="Duggar" value="Duggar">Duggar</option>
                                            <option label="Dukki" value="Dukki">Dukki</option>
                                            <option label="Dunya Pur" value="Dunya Pur">Dunya Pur</option>
                                            <option label="Esa Khel" value="Esa Khel">Esa Khel</option>
                                            <option label="Faisalabad" value="Faisalabad">Faisalabad</option>
                                            <option label="Fateh Jang" value="Fateh Jang">Fateh Jang</option>
                                            <option label="Fateh Pur" value="Fateh Pur">Fateh Pur</option>
                                            <option label="Fort Abbas" value="Fort Abbas">Fort Abbas</option>
                                            <option label="Gaddani" value="Gaddani">Gaddani</option>
                                            <option label="Gadoon" value="Gadoon">Gadoon</option>
                                            <option label="Galana" value="Galana">Galana</option>
                                            <option label="Gambat" value="Gambat">Gambat</option>
                                            <option label="Garhi Habib Ullah" value="Garhi Habib Ullah">Garhi Habib Ullah</option>
                                            <option label="Garhi Kapura" value="Garhi Kapura">Garhi Kapura</option>
                                            <option label="Garhi Mori" value="Garhi Mori">Garhi Mori</option>
                                            <option label="Garhi Nori" value="Garhi Nori">Garhi Nori</option>
                                            <option label="Garhi Yasin" value="Garhi Yasin">Garhi Yasin</option>
                                            <option label="Gawadar" value="Gawadar">Gawadar</option>
                                            <option label="Gharmaraja" value="Gharmaraja">Gharmaraja</option>
                                            <option label="Ghaus Gashti" value="Ghaus Gashti">Ghaus Gashti</option>
                                            <option label="Ghazni Khel" value="Ghazni Khel">Ghazni Khel</option>
                                            <option label="Ghotki" value="Ghotki">Ghotki</option>
                                            <option label="Gilgit" value="Gilgit">Gilgit</option>
                                            <option label="Godap" value="Godap">Godap</option>
                                            <option label="Gojra" value="Gojra">Gojra</option>
                                            <option label="Gomal University" value="Gomal University">Gomal University</option>
                                            <option label="Gujar Khan" value="Gujar Khan">Gujar Khan</option>
                                            <option label="Gujranwala" value="Gujranwala">Gujranwala</option>
                                            <option label="Gujrat" value="Gujrat">Gujrat</option>
                                            <option label="Gulshan-E-Hadeed" value="Gulshan-E-Hadeed">Gulshan-E-Hadeed</option>
                                            <option label="Hafizabad" value="Hafizabad">Hafizabad</option>
                                            <option label="Hala" value="Hala">Hala</option>
                                            <option label="Hangu" value="Hangu">Hangu</option>
                                            <option label="Haripur" value="Haripur">Haripur</option>
                                            <option label="Haripur Tamewali" value="Haripur Tamewali">Haripur Tamewali</option>
                                            <option label="Harnai" value="Harnai">Harnai</option>
                                            <option label="Haroon Abad" value="Haroon Abad">Haroon Abad</option>
                                            <option label="Hasan Abdal" value="Hasan Abdal">Hasan Abdal</option>
                                            <option label="Hasil Pur" value="Hasil Pur">Hasil Pur</option>
                                            <option label="Hattar" value="Hattar">Hattar</option>
                                            <option label="Havalian" value="Havalian">Havalian</option>
                                            <option label="Haveli Lkakhan" value="Haveli Lkakhan">Haveli Lkakhan</option>
                                            <option label="Hazro" value="Hazro">Hazro</option>
                                            <option label="Hub" value="Hub">Hub</option>
                                            <option label="Hurumzai" value="Hurumzai">Hurumzai</option>
                                            <option label="Hyderabad" value="Hyderabad">Hyderabad</option>

                                            <option label="Jaccobabad" value="Jaccobabad">Jaccobabad</option>
                                            <option label="Jahangira" value="Jahangira">Jahangira</option>
                                            <option label="Jahanina" value="Jahanina">Jahanina</option>
                                            <option label="Jalal Pur Jatta" value="Jalal Pur Jatta">Jalal Pur Jatta</option>
                                            <option label="Jalalpur Bhattian" value="Jalalpur Bhattian">Jalalpur Bhattian</option>
                                            <option label="Jalalpur Pirwala" value="Jalalpur Pirwala">Jalalpur Pirwala</option>
                                            <option label="Jam Nawaz Ali" value="Jam Nawaz Ali">Jam Nawaz Ali</option>
                                            <option label="Jamke Cheema" value="Jam Nawaz Ali">Jamke Cheema</option>
                                            <option label="Jampur" value="Jampur">Jampur</option>
                                            <option label="Jamrud" value="Jamrud">Jamrud</option>
                                            <option label="Jaranwala" value="Jaranwala">Jaranwala</option>
                                            <option label="Jatoi" value="Jatoi">Jatoi</option>
                                            <option label="Jauhar Abad" value="Jauhar Abad">Jauhar Abad</option>
                                            <option label="Jhang" value="Jhang">Jhang</option>
                                            <option label="Jhawarian" value="Jhawarian">Jhawarian</option>
                                            <option label="Jhelum" value="Jhelum">Jhelum</option>
                                            <option label="Jhudo" value="Jhudo">Jhudo</option>
                                            <option label="Kabir Wala" value="Kabir Wala">Kabir Wala</option>
                                            <option label="Kabul S. Sharif" value="Kabul S. Sharif">Kabul S. Sharif</option>
                                            <option label="Kahuta" value="Kahuta">Kahuta</option>
                                            <option label="Kakul" value="Kakul">Kakul</option>
                                            <option label="Kalabagh" value="Kalabagh">Kalabagh</option>
                                            <option label="Kalat" value="Kalat">Kalat</option>
                                            <option label="Kalur Kot" value="Kalur Kot">Kalur Kot</option>
                                            <option label="Kamalia" value="Kamalia">Kamalia</option>
                                            <option label="Kambar Ali Khan" value="Kambar Ali Khan">Kambar Ali Khan</option>
                                            <option label="Kamoke" value="Kamoke">Kamoke</option>
                                            <option label="Kamra" value="Kamra">Kamra</option>
                                            <option label="Kan Kacha" value="Kan Kacha">Kan Kacha</option>
                                            <option label="Kand Kot" value="Kand Kot">Kand Kot</option>
                                            <option label="Kandiaro" value="Kandiaro">Kandiaro</option>
                                            <option label="Karak" value="Karak">Karak</option>
                                            <option label="Karam Pur" value="Karam Pur">Karam Pur</option>
                                            <option label="Karoor Lalisen" value="Karoor Lalisen">Karoor Lalisen</option>
                                            <option label="Karoor Pacca" value="Karoor Pacca">Karoor Pacca</option>
                                            <option label="Kasur" value="Kasur">Kasur</option>
                                            <option label="Khair Pur" value="Khair Pur">Khair Pur</option>
                                            <option label="Khair Pur (Ns)" value="Khair Pur (Ns)">Khair Pur (Ns)</option>
                                            <option label="Khalabat Town" value="Khalabat Town">Khalabat Town</option>
                                            <option label="Khan Pur" value="Khan Pur">Khan Pur</option>
                                            <option label="Khan Pur Dogra" value="Khan Pur Dogra">Khan Pur Dogra</option>
                                            <option label="Khanewal" value="Khanewal">Khanewal</option>
                                            <option label="Kharan" value="Kharan">Kharan</option>
                                            <option label="Kharian" value="Kharian">Kharian</option>
                                            <option label="Khawaza Khela" value="Khawaza Khela">Khawaza Khela</option>
                                            <option label="Khipro" value="Khipro">Khipro</option>
                                            <option label="Khurrian Wala" value="Khurrian Wala">Khurrian Wala</option>
                                            <option label="Khurshab" value="Khurshab">Khurshab</option>
                                            <option label="Khuzdar" value="Khuzdar">Khuzdar</option>
                                            <option label="Kilikar Balia" value="Kilikar Balia">Kilikar Balia</option>
                                            <option label="Kohat" value="Kohat">Kohat</option>
                                            <option label="Kohat Town Ship" value="Kohat Town Ship">Kohat Town Ship</option>
                                            <option label="Kohlu" value="Kohlu">Kohlu</option>
                                            <option label="Kot Adu" value="Kot Adu">Kot Adu</option>
                                            <option label="Kot Digi" value="Kot Digi">Kot Digi</option>
                                            <option label="Kot Gh. Muhammad" value="Kot Gh. Muhammad">Kot Gh. Muhammad</option>
                                            <option label="Kot Momen" value="Kot Momen">Kot Momen</option>
                                            <option label="Kot Najeeb Ullah" value="Kot Najeeb Ullah">Kot Najeeb Ullah</option>
                                            <option label="Kot Radha Kishan" value="Kot Radha Kishan">Kot Radha Kishan</option>
                                            <option label="Kotli (A.J.K.)" value="Kotli (A.J.K.)">Kotli (A.J.K.)</option>
                                            <option label="Kotli Loharan" value="Kotli Loharan">Kotli Loharan</option>
                                            <option label="Kuchlak" value="Kuchlak">Kuchlak</option>
                                            <option label="Kundian" value="Kundian">Kundian</option>
                                            <option label="Kunjah" value="Kunjah">Kunjah</option>
                                            <option label="Kunri" value="Kunri">Kunri</option>
                                            <option label="Lachi" value="Lachi">Lachi</option>

                                            <option label="Laki Ghulams Hah" value="Laki Ghulams Hah">Laki Ghulams Hah</option>
                                            <option label="Laki Marwat" value="Laki Marwat">Laki Marwat</option>
                                            <option label="Lala Musa" value="Lala Musa">Lala Musa</option>
                                            <option label="Lalian" value="Lalian">Lalian</option>
                                            <option label="Landi Kotal" value="Landi Kotal">Landi Kotal</option>
                                            <option label="Larkana" value="Larkana">Larkana</option>
                                            <option label="Latamber (Bmu)" value="Latamber (Bmu)">Latamber (Bmu)</option>
                                            <option label="Leyyah" value="Leyyah">Leyyah</option>
                                            <option label="Liaqat Abad" value="Liaqat Abad">Liaqat Abad</option>
                                            <option label="Liaqat Pur" value="Liaqat Pur">Liaqat Pur</option>
                                            <option label="Lillah Town" value="Lillah Town">Lillah Town</option>
                                            <option label="Lodhran" value="Lodhran">Lodhran</option>
                                            <option label="Lora Lai" value="Lora Lai">Lora Lai</option>
                                            <option label="Mailsi" value="Mailsi">Mailsi</option>
                                            <option label="Malikwal" value="Malikwal">Malikwal</option>
                                            <option label="Mandi Baha Ud Din" value="Mandi Baha Ud Din">Mandi Baha Ud Din</option>
                                            <option label="Mandi Faiz Abad" value="Mandi Faiz Abad">Mandi Faiz Abad</option>
                                            <option label="Mangora" value="Mangora">Mangora</option>
                                            <option label="Mankera" value="Mankera">Mankera</option>
                                            <option label="Mansehra" value="Mansehra">Mansehra</option>
                                            <option label="Mardan" value="Mardan">Mardan</option>
                                            <option label="Mardan (Ind)" value="Mardan (Ind)">Mardan (Ind)</option>
                                            <option label="Mastung" value="Mastung">Mastung</option>
                                            <option label="Matli" value="Matli">Matli</option>
                                            <option label="Matta" value="Matta">Matta</option>
                                            <option label="Mehar" value="Mehar">Mehar</option>
                                            <option label="Mehrab Pur" value="Mehrab Pur">Mehrab Pur</option>
                                            <option label="Mian Channu" value="Mian Channu">Mian Channu</option>
                                            <option label="Mian Wali" value="Mian Wali">Mian Wali</option>
                                            <option label="Mian Wali Bangla" value="Mian Wali Bangla">Mian Wali Bangla</option>
                                            <option label="Minchan Abad" value="Minchan Abad">Minchan Abad</option>
                                            <option label="Mir Ali" value="Mir Ali">Mir Ali</option>
                                            <option label="Mir Ali (Bnu)" value="Mir Ali (Bnu)">Mir Ali (Bnu)</option>
                                            <option label="Mir Pur Khas" value="Mir Pur Khas">Mir Pur Khas</option>
                                            <option label="Miran Shah" value="Miran Shah">Miran Shah</option>
                                            <option label="Miro Khan" value="Miro Khan">Miro Khan</option>
                                            <option label="Mirpur (A.J.K)" value="Mirpur (A.J.K)">Mirpur (A.J.K)</option>
                                            <option label="Mirpur Mathelo" value="Mirpur Mathelo">Mirpur Mathelo</option>
                                            <option label="Mitari" value="Mitari">Mitari</option>
                                            <option label="Mithan Kot" value="Mithan Kot">Mithan Kot</option>
                                            <option label="Mithi" value="Mithi">Mithi</option>
                                            <option label="More Khunda" value="More Khunda">More Khunda</option>
                                            <option label="Moro" value="Moro">Moro</option>
                                            <option label="Much" value="Much">Much</option>
                                            <option label="Multan" value="Multan">Multan</option>
                                            <option label="Murid Wala" value="Murid Wala">Murid Wala</option>
                                            <option label="Murree" value="Murree">Murree</option>
                                            <option label="Muslim Bagh" value="Muslim Bagh">Muslim Bagh</option>
                                            <option label="Mustafa Abad" value="Mustafa Abad">Mustafa Abad</option>
                                            <option label="Muzaffar Abad" value="Muzaffar Abad">Muzaffar Abad</option>
                                            <option label="Muzaffar Garh" value="Muzaffar Garh">Muzaffar Garh</option>
                                            <option label="Nankan Sahib" value="Nankan Sahib">Nankan Sahib</option>
                                            <option label="Narang Mandi" value="Narang Mandi">Narang Mandi</option>
                                            <option label="Narowal" value="Narowal">Narowal</option>
                                            <option label="Nasir Abad" value="Nasir Abad">Nasir Abad</option>
                                            <option label="Nathia Gali" value="Nathia Gali">Nathia Gali</option>
                                            <option label="Naudero" value="Naudero">Naudero</option>
                                            <option label="Naukot" value="Naukot">Naukot</option>
                                            <option label="Naukundi" value="Naukundi">Naukundi</option>
                                            <option label="Naushehra Virkan" value="Naushehra Virkan">Naushehra Virkan</option>
                                            <option label="Naushera Khushab" value="Naushera Khushab">Naushera Khushab</option>
                                            <option label="Naushero Feroz" value="Naushero Feroz">Naushero Feroz</option>
                                            <option label="Nawab Shah" value="Nawab Shah">Nawab Shah</option>
                                            <option label="Nawagaikhar" value="Nawagaikhar">Nawagaikhar</option>
                                            <option label="Nawakali" value="Nawakali">Nawakali</option>
                                            <option label="Neka Jang" value="Neka Jang">Neka Jang</option>
                                            <option label="New Jatoi" value="New Jatoi">New Jatoi</option>
                                            <option label="New Saeed Abad" value="New Saeed Abad">New Saeed Abad</option>
                                            <option label="Nodero" value="Nodero">Nodero</option>
                                            <option label="Noor Pur Thal" value="Noor Pur Thal">Noor Pur Thal</option>
                                            <option label="Noori Abad" value="Noori Abad">Noori Abad</option>
                                            <option label="Noshki" value="Noshki">Noshki</option>
                                            <option label="Nowshera" value="Nowshera">Nowshera</option>
                                            <option label="Ogoki" value="Ogoki">Ogoki</option>
                                            <option label="Okara" value="Okara">Okara</option>
                                            <option label="Ormarah" value="Ormarah">Ormarah</option>
                                            <option label="Padedan" value="Padedan">Padedan</option>
                                            <option label="Pak Pattan" value="Pak Pattan">Pak Pattan</option>
                                            <option label="Panjgar" value="Panjgar">Panjgar</option>
                                            <option label="Pano Aqil" value="Pano Aqil">Pano Aqil</option>
                                            <option label="Pansera" value="Pansera">Pansera</option>
                                            <option label="Panwan" value="Panwan">Panwan</option>
                                            <option label="Para Chinar" value="Para Chinar">Para Chinar</option>
                                            <option label="Pashin" value="Pashin">Pashin</option>
                                            <option label="Pasni" value="Pasni">Pasni</option>
                                            <option label="Pasroor" value="Pasroor">Pasroor</option>
                                            <option label="Pattoki" value="Pattoki">Pattoki</option>
                                            <option label="Penyala" value="Penyala">Penyala</option>
                                            <option label="Peshawar" value="Peshawar">Peshawar</option>
                                            <option label="Pezo" value="Pezo">Pezo</option>
                                            <option label="Phalia" value="Phalia">Phalia</option>
                                            <option label="Pinan Wali" value="Pinan Wali">Pinan Wali</option>
                                            <option label="Pind Dadan Khan" value="Pind Dadan Khan">Pind Dadan Khan</option>
                                            <option label="Pindi Bhattian" value="Pindi Bhattian">Pindi Bhattian</option>
                                            <option label="Pindi Gheb" value="Pindi Gheb">Pindi Gheb</option>
                                            <option label="Pir Jogoth" value="Pir Jogoth">Pir Jogoth</option>
                                            <option label="Pir Mahal" value="Pir Mahal">Pir Mahal</option>
                                            <option label="Pir Pai" value="Pir Pai">Pir Pai</option>
                                            <option label="Piryalio" value="Piryalio">Piryalio</option>
                                            <option label="Pishin" value="Pishin">Pishin</option>
                                            <option label="Punjgoor" value="Punjgoor">Punjgoor</option>
                                            <option label="Punoo Aqil" value="Punoo Aqil">Punoo Aqil</option>
                                            <option label="Qabula" value="Qabula">Qabula</option>
                                            <option label="Qazi Abad" value="Qazi Abad">Qazi Abad</option>
                                            <option label="Qazi Ahmad" value="Qazi Ahmad">Qazi Ahmad</option>
                                            <option label="Qila Didar Singh" value="Qila Didar Singh">Qila Didar Singh</option>
                                            <option label="Qila Sheikhupura" value="Qila Sheikhupura">Qila Sheikhupura</option>
                                            <option label="Qilla Saif Ullah" value="Qilla Saif Ullah">Qilla Saif Ullah</option>
                                            <option label="Quaid Abad" value="Quaid Abad">Quaid Abad</option>
                                            <option label="Quetta" value="Quetta">Quetta</option>
                                            <option label="Quetta Army" value="Quetta Army">Quetta Army</option>
                                            <option label="Quetta Paf" value="Quetta Paf">Quetta Paf</option>
                                            <option label="Quetta Staff College" value="Quetta Staff College">Quetta Staff College</option>
                                            <option label="Radhan" value="Radhan">Radhan</option>
                                            <option label="Raheem Abad" value="Raheem Abad">Raheem Abad</option>
                                            <option label="Rahim Yar Khan" value="Rahim Yar Khan">Rahim Yar Khan</option>
                                            <option label="Rahwali" value="Rahwali">Rahwali</option>
                                            <option label="Raiwind" value="Raiwind">Raiwind</option>
                                            <option label="Rajan Pur" value="Rajan Pur">Rajan Pur</option>
                                            <option label="Rani Pur" value="Rani Pur">Rani Pur</option>
                                            <option label="Rashkai (Mdn)" value="Rashkai (Mdn)">Rashkai (Mdn)</option>
                                            <option label="Rattu Dero" value="Rattu Dero">Rattu Dero</option>
                                            <option label="Rawalpindi" value="Rawalpindi">Rawalpindi</option>
                                            <option label="Rawat" value="Rawat">Rawat</option>
                                            <option label="Rawla Kot" value="Rawla Kot">Rawla Kot</option>
                                            <option label="Renal Khurd" value="Renal Khurd">Renal Khurd</option>
                                            <option label="Risalpur" value="Risalpur">Risalpur</option>
                                            <option label="Rizmak" value="Rizmak">Rizmak</option>
                                            <option label="Rodalia Road" value="Rodalia Road">Rodalia Road</option>
                                            <option label="Rojhan Jamali" value="Rojhan Jamali">Rojhan Jamali</option>
                                            <option label="Sabir Abad" value="Sabir Abad">Sabir Abad</option>
                                            <option label="Saddah" value="Saddah">Saddah</option>
                                            <option label="Sadhoki" value="Sadhoki">Sadhoki</option>
                                            <option label="Sadiq Abad" value="Sadiq Abad">Sadiq Abad</option>
                                            <option label="Sahiwal" value="Sahiwal">Sahiwal</option>
                                            <option label="Sajwal" value="Sajwal">Sajwal</option>
                                            <option label="Sakrand" value="Sakrand">Sakrand</option>
                                            <option label="Sambrial" value="Sambrial">Sambrial</option>
                                            <option label="Samundri" value="Samundri">Samundri</option>
                                            <option label="Sanghar" value="Sanghar">Sanghar</option>
                                            <option label="Sangla Hill" value="Sangla Hill">Sangla Hill</option>
                                            <option label="Sanjwai" value="Sanjwai">Sanjwai</option>
                                            <option label="Sarai Naurang" value="Sarai Naurang">Sarai Naurang</option>
                                            <option label="Sargodha" value="Sargodha">Sargodha</option>
                                            <option label="Sattiana" value="Sattiana">Sattiana</option>
                                            <option label="Sehwan Sharif" value="Sehwan Sharif">Sehwan Sharif</option>
                                            <option label="Shabqadar" value="Shabqadar">Shabqadar</option>
                                            <option label="Shadi Khan" value="Shadi Khan">Shadi Khan</option>
                                            <option label="Shadiwal" value="Shadiwal">Shadiwal</option>
                                            <option label="Shah Jiwana" value="Shah Jiwana">Shah Jiwana</option>
                                            <option label="Shah Jiwana Mandi" value="Shah Jiwana Mandi">Shah Jiwana Mandi</option>
                                            <option label="Shah Kot" value="Shah Kot">Shah Kot</option>
                                            <option label="Shah Pur" value="Shah Pur">Shah Pur</option>
                                            <option label="Shah Pur Chakkar" value="Shah Pur Chakkar">Shah Pur Chakkar</option>
                                            <option label="Shahdad Kot" value="Shahdad Kot">Shahdad Kot</option>
                                            <option label="Shahdad Pur" value="Shahdad Pur">Shahdad Pur</option>
                                            <option label="Shakkar Garh" value="Shakkar Garh">Shakkar Garh</option>
                                            <option label="Sharaq Pur" value="Sharaq Pur">Sharaq Pur</option>
                                            <option label="Sheikh Manda" value="Sheikh Manda">Sheikh Manda</option>
                                            <option label="Sheikhupura" value="Sheikhupura">Sheikhupura</option>
                                            <option label="Sherpao" value="Sherpao">Sherpao</option>
                                            <option label="Shikar Pur" value="Shikar Pur">Shikar Pur</option>
                                            <option label="Shinkiari" value="Shinkiari">Shinkiari</option>
                                            <option label="Shor Kot City" value="Shor Kot City">Shor Kot City</option>
                                            <option label="Shorkot" value="Shorkot">Shorkot</option>
                                            <option label="Shuja Abad" value="Shuja Abad">Shuja Abad</option>
                                            <option label="Sialkot" value="Sialkot">Sialkot</option>
                                            <option label="Sibi" value="Sibi">Sibi</option>
                                            <option label="Sidha" value="Sidha">Sidha</option>
                                            <option label="Sillan Wali" value="Sillan Wali">Sillan Wali</option>
                                            <option label="Sita Road" value="Sita Road">Sita Road</option>
                                            <option label="Skardu" value="Skardu">Skardu</option>
                                            <option label="Sohawa" value="Sohawa">Sohawa</option>
                                            <option label="Sukheki" value="Sukheki">Sukheki</option>
                                            <option label="Sukkur" value="Sukkur">Sukkur</option>
                                            <option label="Sumbrial" value="Sumbrial">Sumbrial</option>
                                            <option label="Swabi" value="Swabi">Swabi</option>
                                            <option label="Swat" value="Swat">Swat</option>
                                            <option label="Taftan" value="Taftan">Taftan</option>
                                            <option label="Takhat Bai" value="Takhat Bai">Takhat Bai</option>
                                            <option label="Takhat Nusrati" value="Takhat Nusrati">Takhat Nusrati</option>
                                            <option label="Talagang" value="Talagang">Talagang</option>
                                            <option label="Talhar" value="Talhar">Talhar</option>
                                            <option label="Tall" value="Tall">Tall</option>
                                            <option label="Tandlianwala" value="Tandlianwala">Tandlianwala</option>
                                            <option label="Tando Adam Khan" value="Tando Adam Khan">Tando Adam Khan</option>
                                            <option label="Tando Allah Yar" value="Tando Allah Yar">Tando Allah Yar</option>
                                            <option label="Tando Jam" value="Tando Jam">Tando Jam</option>
                                            <option label="Tando Jan M." value="Tando Jan M.">Tando Jan M.</option>
                                            <option label="Tank" value="Tank">Tank</option>
                                            <option label="Tarbela" value="Tarbela">Tarbela</option>
                                            <option label="Tasp" value="Tasp">Tasp</option>
                                            <option label="Taunsa" value="Taunsa">Taunsa</option>
                                            <option label="Taxila" value="Taxila">Taxila</option>
                                            <option label="Thana" value="Thana">Thana</option>
                                            <option label="Thana Bula Khan" value="Thana Bula Khan">Thana Bula Khan</option>
                                            <option label="Tharu (Su)" value="Tharu (Su)">Tharu (Su)</option>
                                            <option label="Thatta" value="Thatta">Thatta</option>
                                            <option label="Thul" value="Thul">Thul</option>
                                            <option label="Timar Gara" value="Timar Gara">Timar Gara</option>
                                            <option label="Toba Tek Singh" value="Toba Tek Singh">Toba Tek Singh</option>
                                            <option label="Toorkhum" value="Toorkhum">Toorkhum</option>
                                            <option label="Topi" value="Topi">Topi</option>
                                            <option label="Toru" value="Toru">Toru</option>
                                            <option label="Trand M Pinah" value="Trand M Pinah">Trand M Pinah</option>
                                            <option label="Turbat" value="Turbat">Turbat</option>
                                            <option label="Ubaro" value="Ubaro">Ubaro</option>
                                            <option label="Uch Sharif" value="Uch Sharif">Uch Sharif</option>
                                            <option label="Umar Kot" value="Umar Kot">Umar Kot</option>
                                            <option label="Usta Muhammad" value="Usta Muhammad">Usta Muhammad</option>
                                            <option label="Uthal" value="Uthal">Uthal</option>
                                            <option label="Vehari" value="Vehari">Vehari</option>
                                            <option label="Vehoa" value="Vehoa">Vehoa</option>
                                            <option label="Wadh" value="Wadh">Wadh</option>
                                            <option label="Wah" value="Wah">Wah</option>
                                            <option label="Wana" value="Wana">Wana</option>
                                            <option label="Warah" value="Warah">Warah</option>
                                            <option label="Wazir Abad" value="Wazir Abad">Wazir Abad</option>
                                            <option label="Yazman" value="Yazman">Yazman</option>
                                            <option label="Zhobe" value="Zhobe">Zhobe</option>
                                            <option label="Ziarat" value="Ziarat">Ziarat</option>
                                            <option label="Jamshoro" value="Jamshoro">Jamshoro</option>
                                        </datalist>

                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- price input slider -->
                    <br>
                    <h6>Select Price</h6>
                    <div class="price-input">
                    <div class="field">
                    <span>Min</span>
                    <?php 
                        $max_select = "SELECT MAX(CAST(REPLACE(price, ',', '') AS INT)) AS highest_price FROM `web_posts` WHERE `verification_status` = 1";
                        $result = mysqli_query($con, $max_select); // Assuming you have a valid mysqli connection stored in $connection
                        
                        if ($result) {
                          $max_query = mysqli_fetch_assoc($result);
                          $highest_price = $max_query['highest_price'];
                    }

                    ?>
                    <input type="number" class="input-min" value="<?php if(isset($_GET['range-min']))  echo $_GET['range-min']; else { echo 1; } ?>">
                    </div>
                    <div class="separator" style="margin-top: 30px;">-</div>
                    <div class="field">
                    <span>Max</span>
                    <input type="number" class="input-max" value="<?php if(isset($_GET['range-max']))  echo $_GET['range-max']; else { echo $highest_price; } ?>">
                    </div>
                    </div>
                    <div class="slider">
                    <div class="progress"></div>
                    </div>
                    <div class="range-input">
                    <input type="range" class="range-min" min="1" max="<?= $highest_price; ?>" value="<?php if(isset($_GET['range-min']))  echo $_GET['range-min']; else { echo 1; } ?>" step="100000">
                    <input type="range" class="range-max" min="1" max="<?= $highest_price; ?>" value="<?php if(isset($_GET['range-max']))  echo $_GET['range-max']; else { echo $highest_price; } ?>" step="100000">
                    </div>

                    <!-- price input slider ends here  -->

                    <!-- area input slider -->
                    
                    <br>
                    <h6>Select Area</h6>

                    <div class="area-input">
                    <div class="area-field">
                    <span>Min</span>
                    <?php 
                        $max_select = "SELECT MAX(CAST(REPLACE(land_area, ',', '') AS INT)) AS highest_area FROM `web_posts` WHERE `verification_status` = 1";
                        $result = mysqli_query($con, $max_select); // Assuming you have a valid mysqli connection stored in $connection
                        
                        if ($result) {
                          $max_query = mysqli_fetch_assoc($result);
                          $highest_area = $max_query['highest_area'];
                    }

                    ?>
                    <input type="number" class="area-input-min" value="<?php if(isset($_GET['area-min']))  echo $_GET['area-min']; else { echo 1; } ?>">
                    </div>
                    <div class="area-separator" style="margin-top: 30px;">-</div>
                    <div class="area-field">
                    <span>Max</span>
                    <input type="number" class="area-input-max" value="<?php if(isset($_GET['area-max']))  echo $_GET['area-max']; else { echo $highest_area; } ?>">
                    </div>
                    </div>
                    <div class="area-slider">
                    <div class="area-progress"></div>
                    </div>
                    <div class="area-range-input">
                    <input type="range" class="area-min" min="1" max="<?= $highest_area; ?>" value="<?php if(isset($_GET['area-min']))  echo $_GET['area-min']; else { echo 1; } ?>" step="1">
                    <input type="range" class="area-max" min="1" max="<?= $highest_area; ?>" value="<?php if(isset($_GET['area-max']))  echo $_GET['area-max']; else { echo $highest_area; } ?>" step="1">
                    </div>

                    <!-- area input slider ends here -->

                    <div class="banner-search-wrap banner-search-wrap-2">
                        <div class="rld-main-search rld-main-search3">
                            <div class="filter-button">
                                <button id="asearch" class="filter-btn1 search-btn">Search<i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                </div>
                <div class="widget widget-listing-box1 hidethislogin">
                    <h3 class="widget-subtitle">Latest Listing</h3>



                    <?php
                    $query = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER by `id` DESC LIMIT 3");
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        ?>
                        <div class="widget-listing no-brd">

                        <!--<div class="item-img" style="width:120px;height:102px;background-image: url('<?= $row['primary_image'] ?>');background-size:cover;background-position:center;">-->
                            <div class="item-img item-img_thumb_tiny">
                                <a href="listing_detail?post_id=<?= $row['id'] ?>">
                                    <img src="<?= $row['primary_image'] ?>" alt="<?= $row['title'] ?>">
                                </a>
                            </div>

                            <div class="item-content">
                                <h5 class="item-title"><a href="listing_detail?post_id=<?= $row['id'] ?>"><?= $row['title'] ?></a></h5>
                                <div class="location-area"><i class="flaticon-maps-and-flags"></i><?= $row['city'] ?></div>
                                <div class="item-price"><script>document.write(numberFormatter(<?php $price = str_replace(',', '', $row['price']);  echo $price; ?>));</script><span><i>-</i>PKR</span></div>
                            </div>
                        </div>

                    <?php }
                    ?>

                </div>
                <div class="widget widget-post">
                    <div class="item-img">
                        <img src="admin/<?= $db->getEachById($con, 'image_link', 'projects', '1') ?>" alt="widget" width="690" height="850">
                        <div class="circle-shape">
                            <span class="item-shape"></span>
                        </div>
                    </div>
                    <div class="item-content">
                        <h4 class="item-title">Find Your  Dream House</h4>
                        <div class="item-price">2,999 Lacs</div>
                        <div class="post-button"><a href="contact" class="item-btn">Contact Now</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="item-shorting-box">
                            <div class="shorting-title">
                                <?php
                                $records_query = "SELECT COUNT(*) FROM web_posts";
                                $executing_query = mysqli_query($con, $records_query);
                                $fetch_records = mysqli_fetch_assoc($executing_query);
                                ?>
                                <h4 class="item-title"><?= $recordsNow;    
                                ?> results</h4>
                            </div>
                            <div class="item-shorting-box-2">
                                <div class="by-shorting">
                                    <div class="shorting">Sort by:</div>
                                    <select class="select single-select mr-0 price-low-high">
                                        <option value="">Default</option>
                                        <option <?php if(isset($_GET['price-sorting'])) {if($_GET['price-sorting'] === "high_to_low") { echo 'selected';} else {"";}} ?> value="high_to_low">High Price</option>
                                        <option <?php if(isset($_GET['price-sorting'])) {if($_GET['price-sorting'] === "low_to_high") { echo 'selected';} else {"";}} ?> value="low_to_high">Low Price</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-style-1 tab-style-3">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                            <div class="row" id="output">
                                <?php
                                $query = mysqli_query($con, $final_query);
                                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                    $last_fetched_id = '';
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="property-box2 property-box4 wow animated fadeInUp" data-wow-delay=".6s">

                                                <!--<div class="item-img" style="    background-image: url('<?= $row['primary_image'] ?>');width:250px;height: 200px;background-size: cover;background-repeat: no-repeat;">-->
                                            <div class="item-img item-img_thumb_listing">
                                                <a href="listing_detail?post_id=<?= $row['id'] ?>">
                                                    <img src="<?= $row['primary_image'] ?>" alt="<?= $row['title'] ?>" />
                                                </a>

                                                <div class="item-category-box1">
                                                    <div class="item-category"><?= $row['purpose'] ?></div>
                                                </div>
                                            </div>

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
                                                <div class="item-price"><script>document.write(numberFormatter(<?php $price = str_replace(',', '', $row['price']);  echo $price; ?>));</script><span><i>-</i>PKR</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    /*
                                    $last_fetched_id = $row['id'];
                                }
                                if ($fetch_records > 20) {
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
                                <?php } else {
                                    echo "";
                                } 
                                */
                            }
                                ?>

                            </div>


                            <br />
                            <br />
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5 my-md-0">
            <div class="item-heading-center">
                <span class="section-subtitle">OUR PROPERTIES</span>
                <h2 class="section-title">Our Featured Properties</h2>
                <div class="bg-title-wrap" style="display: block">
                    <span class="background-title solid">Properties</span>
                </div>
            </div>
            <div class="row">
                <?php
                $queryGetProperties = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = 1 AND `featured` = 1 ORDER BY `id` DESC LIMIT 3");
                while ($row = mysqli_fetch_array($queryGetProperties, MYSQLI_ASSOC)) {
                    ?>
                    <div class="col-xl-4 col-lg-6 col-md-6">
    
                        <div
                            class="property-box2 wow animated fadeInUp"
                            data-wow-delay=".<?= $row['id'] ?>s"
                            >
    
                            <!--<div class="item-img" style="background-image: url('<?= $row['primary_image'] ?>');height: 300px;background-size: cover;background-position: center;background-repeat: no-repeat;">-->
                            <div class="item-img item-img_thumb">
                                <a href="listing_detail?post_id=<?= $row['id'] ?>">
                                    <img src="<?= $row['primary_image'] ?>"alt="<?= $row['title'] ?>" />
                                </a>
                                <?php if ($row['featured'] == '1') { ?>
                                    <div class="item-category-box1">
                                        <div class="item-category">Featured</div>
                                    </div>
                                <?php } ?>
    
    
                                <div class="rent-price">
                                    <div class="item-price">
                                    <script>document.write(numberFormatter(<?php $price = str_replace(',', '', $row['price']);  echo $price; ?>));</script><span><i>-</i>PKR</span>
                                    </div>
                                </div>
                                <div class="react-icon">
    
                                </div>
                            </div>
    
                            <div class="item-category10">
                                <a href="listing_detail?post_id=<?= $row['id'] ?>"><?= $row['city'] ?></a>
                            </div>
                            <div class="item-content">
                                <div class="verified-area">
                                    <h3 class="item-title">
                                        <a href="listing_detail?post_id=<?= $row['id'] ?>"><?= $row['title'] ?></a>
                                    </h3>
                                </div>
                                <div class="location-area">
                                    <i class="flaticon-maps-and-flags"></i><?= $row['address'] ?>, <?= $row['city'] ?>
                                </div>
                                <div class="item-categoery3">
    
                                </div>
                            </div>
                        </div>
    
                    </div>
                <?php }
                ?>
            </div>
            <div class="property-button">
                <a href="listing?feature=yes" class="item-btn">View All Featured Properties</a>
            </div>
            </div>
    </div>
</section>
<?php include'includes/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#load_more', function (event) {
            event.preventDefault();
            var id = $('#load_more').data('id');
            var pathname = $(location).attr('search');
        //    alert(pathname);
//            alert(id);
            $('#load_more').remove();

            $.ajax({
                url: "load_more.php" + pathname,
                type: "post",
                data: {
                    id: id
                },
                success: function (response) {
                //    alert('response' + response);
                    $('#output').append(response);
                //     function priceFormatting() {
                //         var loopValue = $('.loop-value').value()
                //         var loadedPrice = $('.load-more-price').text();
                //         // var loadedPrice1 = $('.load-more-price'+ 1).text();
                //         console.log(loadedPrice);
                //         // console.log(loadedPrice1);
                //         var finalLoadedPrice = numberFormatter(loadedPrice);
                //         // var finalLoadedPrice2 = numberFormatter(loadedPrice2);
                //         $('.load-more-price').text(finalLoadedPrice);
                //         // $('.load-more-price'+ 2).text(finalLoadedPrice2);
                //     }
                //     priceFormatting();
                }
            });

        });


        $('#asearch').click(function(e){
        e.preventDefault();

        var keyword = $('#asearch_keyword').val();
        var type = $('#asearch_type').val();
        var city = $('#asearch_city').val();
        var rangeMin = $('.range-min').val();
        console.log(rangeMin);
        var rangeMax = $('.range-max').val();
        var areaMin = $('.area-min').val();
        var areaMax = $('.area-max').val();
        // var finalUrl = "listing?advance_search=true&keyword=" + keyword + "&type=" + type + "&city=" + city + "&range-min=" + rangeMin + "&range-max=" + rangeMax;
        window.location = "listing?advance_search=true&keyword=" + keyword + "&property-type=" + type + "&city=" + city + "&range-min=" + rangeMin + "&range-max=" + rangeMax + "&area-min=" + areaMin + "&area-max=" + areaMax;
        // console.log(finalUrl);

        });

        /// price filter starts from here

        $(".price-low-high").change(function() {
        let priceFilter = $(".price-low-high").val();
        let url = new URL(window.location.href);
        let params = url.searchParams;

        // Check if the price-sorting parameter exists in the URL
        if (params.has("price-sorting")) {
            params.set("price-sorting", priceFilter);
        } else {
            params.append("price-sorting", priceFilter);
        }

        // Remove the existing price-sorting parameter from the URL
        url.searchParams.delete("price-sorting");

        // Add the updated price-sorting parameter to the URL
        url.searchParams.append("price-sorting", priceFilter);

        // Navigate to the updated URL
        window.location.href = url.toString();
        });

        /// price filter ends here

    });
</script>
