<?php
require 'includes/header.php';

if (!isset($_SESSION['public_user'])) {
    $db->redirect('login');
    exit();
} else {
    $id = $_SESSION['public_user']['id'];
    $web_request_id = $_GET['web_request_id'];
}

if ($db->getEachById($con, 'public_user_id', 'web_posts', $web_request_id) != $id) {
    $db->redirect('index');
    exit();
}
?>
<style>
      .nice-select.open .list {
    height:300px !important;
    overflow-y: auto !important;
    width: 100%;
  }
  
    .btn-primary {
        color: #fff;
        background-color: #6f1c74;
        border-color: #5e1863;
    }

    .btn-primary:hover {
        background-color: #5e1863;
        border-color: #6f1c74;
    }

    .nice-select {
        height: 50px !important;
        width: 100%;
    }

    .fuzone input {
        cursor: pointer;
        height: 100%;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 100;
    }

    /*//custom owrk below*/
    .imagePreview {
        width: 100%;
        height: 200px;
        background-position: center center;
        background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
        background-color: #fff;
        background-size: cover;
        background-repeat: no-repeat;
        display: inline-block;
        background-position: center;
        background-repeat: no-repeat;
        box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        display: block;
        border-radius: 0px;
        box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
        margin-top: -5px;
    }

    .imgUp {
        margin-bottom: 15px;
    }

    .del {
        position: absolute;
        top: 0px;
        right: 15px;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        background-color: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        display: none;
    }

    .imgAdd {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #6f1c74;
        color: #fff;
        box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
        text-align: center;
        line-height: 30px;
        margin-top: 0px;
        cursor: pointer;
        font-size: 15px;
        padding-left: 9px;
    }

    .image-selected {
        border: 2px solid blue;
    }
</style>

<div class="breadcrumb-wrap breadcrumb-wrap-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="edit_property?web_request_id=<?= $web_request_id ?>">Edit Property</li>
            </ol>
        </nav>
    </div>
</div>
<section class="single-listing-wrap1 section-padding">

    <div class="container">
        <center>
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-8">
                    <div class="item-heading-left">
                        <span class="section-subtitle">Update your property Details</span>
                        <h2 class="section-title">Edit Your Property</h2>
                        <div class="bg-title-wrap" style="display: block;">
                            <span class="background-title solid">Property Details</span>
                        </div>

                    </div>
                </div>
            </div>
        </center>
        <div class="row">
            <div class="col-lg-8 col-md-8 mx-auto">
                <?php
                if (isset($_POST['submit'])) {
                    $title = mysqli_real_escape_string($con, $_POST['title']);
                    $description = mysqli_real_escape_string($con, $_POST['description']);
                    $type = mysqli_real_escape_string($con, $_POST['type']);
                    $address = mysqli_real_escape_string($con, $_POST['address']);
                    $price = mysqli_real_escape_string($con, $_POST['price']);
                    $purpose = mysqli_real_escape_string($con, $_POST['purpose']);
                    $city = mysqli_real_escape_string($con, $_POST['city']);
                    $year_build = mysqli_real_escape_string($con, $_POST['year_build']);
                    $internal_id = mysqli_real_escape_string($con, $_POST['internal_id']);
                    $video_link = mysqli_real_escape_string($con, $_POST['video_link']);
                    // $file_name = $_FILES['file']['name'];
                    $verification_status = '0';





                    // if (empty($file_name)) {
                        $queryUpdate = mysqli_query($con, "UPDATE `web_posts` SET `title` = '" . $title . "',`description` = '" . $description . "',`type` = '" . $type . "',`address` = '" . $address . "',`price` = '" . $price . "',`purpose` = '" . $purpose . "',`city` = '" . $city . "',`year_build`='" . $year_build . "',`internal_lead_id`='" . $internal_id . "',`video_link` = '" . $video_link . "',`verification_status` = '" . $verification_status . "' WHERE `id` = '" . $web_request_id . "'");
                        if (!$queryUpdate) {

                            $db->error('Please try again or contact the Admin Support');
                        } else {
                            $db->redirect('listing_detail?post_id=' . $web_request_id);
                            exit();
                        }
                    } 
                    // else {
                        // $errors = array();
                        // $file_name = $_FILES['file']['name'];
                        // $file_size = $_FILES['file']['size'];
                        // $file_tmp = $_FILES['file']['tmp_name'];
                        // $file_type = $_FILES['file']['type'];

                        // $tmp = explode('.', $file_name);
                        // $file_ext = end($tmp);
                        // $extensions = array("jpeg", "jpg", "png");






                //         if (in_array($file_ext, $extensions) === false) {
                //             $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                //         }

                //         if ($file_size > 12097152) {
                //             $errors[] = 'File size must be exactly or less then 12 MB';
                //         }

                //         if (empty($errors) == true) {
                //             move_uploaded_file($file_tmp, "upload/" . $file_name);
                //             $primary_final = "upload/" . $file_name;
                //             $queryUpdate = mysqli_query($con, "UPDATE `web_posts` SET `primary_image` = '" . $primary_final . "',`title` = '" . $title . "',`description` = '" . $description . "',`type` = '" . $type . "',`address` = '" . $address . "',`price` = '" . $price . "',`purpose` = '" . $purpose . "',`city` = '" . $city . "',`year_build`='" . $year_build . "',`internal_lead_id`='" . $internal_id . "',`video_link` = '" . $video_link . "',`verification_status` = '" . $verification_status . "' WHERE `id` = '" . $web_request_id . "'");
                //             if (!$queryUpdate) {

                //                 $db->error('Please try again or contact the Admin Support');
                //             } else {
                //                 $db->redirect('listing_detail?post_id=' . $web_request_id);
                //                 exit();
                //             }
                //         } else {
                //             print_r($errors);
                //         }
                //     }
                // }
                ?>
                <form action="#" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="web_post_id" value="<?= $web_request_id ?>" />
                    <div class="card padding-card">
                        <div class="card-body">
                            <a href="listing_detail?post_id=<?= $web_request_id ?>" style="float:right" class="pull-right right btn btn-primary">Preview</a>
                            <h5 class="card-title mb-4">Property Description</h5>
                            <div class="form-group">
                                <label>Property Title <span class="text-danger">*</span></label>
                                <input type="text" value="<?= $db->getEachById($con, 'title', 'web_posts', $web_request_id) ?>" name="title" class="form-control" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label>Property Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="4"><?= $db->getEachById($con, 'description', 'web_posts', $web_request_id) ?></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <br />
                                    <select name="type" class="form-control custom-select">

                                        <option <?php
                                                if ($db->getEachById($con, 'type', 'web_posts', $web_request_id) == 'residential') {
                                                    echo 'selected';
                                                }
                                                ?>>Residential</option>
                                        <option <?php
                                                if ($db->getEachById($con, 'type', 'web_posts', $web_request_id) == 'commercial') {
                                                    echo 'selected';
                                                }
                                                ?>>Commercial</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="<?= $db->getEachById($con, 'address', 'web_posts', $web_request_id) ?>" class="form-control" placeholder="Enter Street Address">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Price <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="price" name="price" value="<?= $db->getEachById($con, 'price', 'web_posts', $web_request_id) ?>" placeholder="Enter Price, 7 lacs">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Purpose<span class="text-danger">*</span></label><br />
                                    <select name="purpose" id="purpose" class="form-control m-b">
                                        <option value="Exchange" selected="true">Exchange</option>
                                        <option value="Sale">Sale</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 cities-selection">
                                    <label>City<span class="text-danger">*</span></label><br />
                                    <select name="city" class="form-control custom-select m-b">
                                        <option lable="<?= $db->getEachById($con, 'city', 'web_posts', $web_request_id) ?>" value="<?= $db->getEachById($con, 'city', 'web_posts', $web_request_id) ?>"><?= $db->getEachById($con, 'city', 'web_posts', $web_request_id) ?></option>
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
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Year Build<span class="text-danger">*</span></label>
                                    <input type="text" name="year_build" class="form-control" placeholder="Year Build" value="<?= $db->getEachById($con, 'year_build', 'web_posts', $web_request_id) ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Internal Property ID <span class="text-danger">*</span></label>
                                    <input type="number" name="internal_id" class="form-control" placeholder="For Internal use only - Leave Blank ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Video URL</label>
                                    <input type="text" value="<?= $db->getEachById($con, 'video_link', 'web_posts', $web_request_id) ?>" class="form-control" name="video_link" placeholder="Youtube embed code">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="card padding-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Primary Image</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="fuzone">
                                        <input type="file" name="file" id="primary_image" accept="image/*" onchange="loadFile(event)">

                                        <img id="output" src=" $db->getEachById($con, 'primary_image', 'web_posts', $web_request_id);" />
                                        <!--                                        <img src=" $db->getEachById($con, 'primary_image', 'web_posts', $web_request_id);" />-->
                                    <!-- </div>
                                </div>
                            </div>
                        </div>
                    </div> --> 
                    <div class="card padding-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Property Image Gallery</h5>
                            <h6>Please Select Feature image !!</h6>
                            <div class="row">
                                <div class="">
                                    <label class="imagePreview" id="hidethiswhen">
                                        <strong style="color:black;">Select Images</strong>
                                        <input type="file" id="files" name="files[]" multiple class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;display:none;">
                                    </label>
                                    <br />

                                    <button class="btn btn-primary" style="width:300px;margin:10px;" id="mutlimages">Upload</button>

                                </div>
                                <div id="previewI"></div>
                                <!--<div class="imgAdd"></div>-->
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM `property_images` WHERE `web_post_id` = '" . $web_request_id . "'");
                                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                ?>
                                    <div class="col-sm-4  imgUp blockid<?= $row['id'] ?>">

                                        <div class="imagePreview image-selection" style="background-image: url('<?= $row['image_link'] ?>');background-size: cover;background-position: center;background-repeat:no-repeat;"></div>

                                        <label class="btn btn-primary rem-img" id="<?= $row['id'] ?>">
                                            Remove

                                        </label>
                                    </div>
                                <?php }
                                ?>


                            </div><!-- row -->

                        </div>
                    </div>

                    <br />

                    <input type="submit" name="submit" id="submit" class="btn btn-primary" value="SUBMIT PROPERTY">
                    <input type="hidden" value="<?= $web_request_id; ?>" id="web_request">
                </form>
            </div>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />

</section>
<br />
<br />
<br />

<?php include 'includes/footer.php'; ?>
<script>
            var web_post_id = $('#web_post_id').val();

    $(".imgAdd").click(function() {
        $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-4 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;display:none;"></label><i class="fa fa-times del"></i></div>');
    });
    $(document).on("click", "i.del", function() {
        $(this).parent().remove();
    });
    $(function() {
        $('#price').keydown(function(e) {
            setTimeout(() => {
                let parts = $(this).val().split(".");
                let v = parts[0].replace(/\D/g, ""),
                    dec = parts[1]
                let calc_num = Number((dec !== undefined ? v + "." + dec : v));
                // use this for numeric calculations
                console.log('number for calculations: ', calc_num);
                let n = new Intl.NumberFormat('en-EN').format(v);
                n = dec !== undefined ? n + "." + dec : n;
                $(this).val(n);
            });
        });

        $('#remove_image_prop').click(function() {
            console.log("hello");
            alert("hello Furqan !!");
            var remove_id = this.id;
            $('.blockid' + remove_id).hide('fast');
            $.ajax({
                processData: false, // tell jQuery not to process the data
                contentType: false,
                type: 'get',
                data: '',
                url: 'remove_image.php?remove_id=' + remove_id,
                success: function(data) {
                    if (data !== '') {} else {
                        alert('can not remove image right now.');
                    }
                }
            });

        });

    });
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };


    $("#mutlimages").click(function(e) {
        var input = document.getElementById("files").files;
        console.log(input)
        
        let loadedImages = [];
        for (let i = 0; i < input.length; i++) {
            let reader = new FileReader();
            let file = input[i];
            reader.readAsDataURL(file);
            reader.onload = (event) => {
                let image_url = reader.result;
                let image = document.createElement("img");
                image.src = image_url;

                image.onload = (e) => {
                    let canvas = document.createElement("canvas");
                    canvas.width = image.width / 2;
                    canvas.height = image.height / 2;
                    let context = canvas.getContext("2d");
                    context.drawImage(image, 0, 0, canvas.width, canvas.height);

                    let new_image_url = context.canvas.toDataURL("image/png", 90);

                    let new_image = document.createElement("img");
                    new_image.src = new_image_url;

                    loadedImages.push(new_image_url);
                    urlToFile(loadedImages);
                };
            };
        }
        e.preventDefault();
    });

    let urlToFile = (url) => {

        var fd = new FormData();
        for(let len = 0; len < url.length; len++) {
        let brUrl = url[len];
        let arr = brUrl.split(",");
        let mime = arr[0].match(/:(.*?);/)[1];
        let data = arr[1];

        let dataStr = atob(data);
        let n = dataStr.length;
        let dataArr = new Uint8Array(n);

        while (n--) {
            dataArr[n] = dataStr.charCodeAt(n);
        }

        let file = new File([dataArr], 'File.jpg', {
            type: mime
        });

        fd.append('file', file);
    }
    
    console.log(fd);

        $.ajax({
            url: 'multi_uploader.php?web_post_id=' + web_post_id,
            enctype: 'multipart/form-data',
            // url: 'multi_uploader.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                // alert(response);
                var parsedResponse = JSON.parse(response);
                var image_path = parsedResponse[0];
                console.log(image_path);
                var last_insert_id = parsedResponse[1]
                console.log(last_insert_id);

                $('#previewI').before('<div class="col-sm-4 imgUp blockid' + last_insert_id + '"><div class="imagePreview image-selection" style="background-image: url(' + image_path + ');background-size: cover;background-position: center;background-repeat:no-repeat;"></div><label id="' + last_insert_id + '" class="btn btn-primary rem-img blockid' + last_insert_id + ' ">Remove</label></div>');
                $('.image-selection:first').addClass('image-selected');
                // }
                // $('.image-selection:first').addClass('image-selected');
                // $('#hidethiswhen').fadeOut('fast', function() {
                //     $('#mutlimages').fadeOut('fast', function() {
                //         // location.reload();   
                //     });
                // });
                // console.log(data);
                // alert(file.name);
                // console.log(data);
            },
            error: function(error) {
                alert(error);
                console.log(error);
            }
        })
        //   e.preventDefault();
    }

    $(document).on('click', '.rem-img', function() {
        // console.log("hello");
        // alert("hello Furqan !!");
        var remove_id = this.id;
        $('.blockid' + remove_id).hide('fast');
        $.ajax({
            processData: false, // tell jQuery not to process the data
            contentType: false,
            type: 'get',
            data: '',
            url: 'remove_image.php?remove_id=' + remove_id,
            success: function(data) {
                if (data !== '') {} else {
                    alert('can not remove image right now.');
                }
            }
        });

    });


    // Javascript code for image selection

    var fullUrl; // Declare the variable outside the event handlers

    $(document).on('click', '.image-selection', function() {
        $('.image-selection').removeClass("image-selected");
        $(this).addClass("image-selected");
    });

    $("#submit").click(function() {
        var primaryImage = $('.image-selected').siblings('label').attr('id');
        console.log(primaryImage);
        var propertyId = $("#web_request").val();
        console.log(propertyId);
        // alert(propertyId);
        // alert(primaryImage);

        $.ajax({
            type: "POST",
            url: 'primaryimage.php',
            data: {
                primaryImage: primaryImage,
                propertyId: propertyId
            }, // Pass fullUrl as data
            success: function(data) {
                // alert(data);
            },
            dataType: 'text' // Set the expected data type
        });
    });
</script>