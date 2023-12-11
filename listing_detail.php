<?php
include'includes/header.php';

if (isset($_SESSION['public_user'])) {
    $public_user_id = $_SESSION['public_user']['id'];
}
?>
<div class="breadcrumb-wrap breadcrumb-wrap-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="#">Detail</li>
            </ol>
        </nav>
    </div>
</div>
<?php
if (isset($_GET['post_id'])) {
    $gotten_post_id = $_GET['post_id'];
    if (!empty($gotten_post_id)) {
        $db->add_views($con, $gotten_post_id);
    }
} else {
    $db->redirect('listing');
    exit();
}
?>

<section class="single-listing-wrap1">
    <div class="container">
        <div class="single-property">
            <div class="content-wrapper">
                <div class="property-heading">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="single-list-cate">
                                <div class="item-categoery">For <?= $db->getEachById($con, 'purpose', 'web_posts', $gotten_post_id) ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="single-list-price"><script>document.write(numberFormatter(<?php $prop_price = $db -> getEachById($con, 'price', 'web_posts', $gotten_post_id); $final_prop_price = str_replace(',', '', $prop_price); echo $final_prop_price; ?>))</script> - PKR</div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="single-verified-area">
                                <div class="item-title">
                                    <h3 style="font-size:1.5rem">
                                        <?= $db->getEachById($con, 'title', 'web_posts', $gotten_post_id); ?><?php
                                        if ($db->getEachById($con, 'verification_status', 'web_posts', $gotten_post_id) == '1') {
                                            echo '<span style="font-size:14px;color: rgb(41, 166, 137);"><i class="fa fa-check" ></i> (Approved)</span>';
                                        } else {
                                            echo '<span style="color:gray;font-size:14px;"><i class="fa fa-exclamation-triangle "></i> (pending Approval)</span>';
                                        }
                                        ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="single-item-address">
                                <ul>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <?= $db->getEachById($con, 'address', 'web_posts', $gotten_post_id); ?>
                                    </li>
                                    <li><i class="fas fa-clock"></i><?= $db->getEachById($con, 'timestamp', 'web_posts', $gotten_post_id); ?> /</li>
                                    <li><i class="fas fa-eye"></i>Views: <?= $db->getEachById($con, 'views', 'web_posts', $gotten_post_id); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">

                            <?php if(isset($_SESSION['public_user'])){ ?>


                            <div class="side-button">
                            <?php
                            $UserItself = "SELECT * FROM `web_posts` WHERE `id` = '$gotten_post_id' AND `public_user_id` = $public_user_id";
                            $UserItselfQuery = mysqli_query($con,$UserItself);
                            if(mysqli_num_rows($UserItselfQuery) == 0) {
                            $checkUser = "SELECT * FROM `fav` WHERE `web_post_id` = '$gotten_post_id' AND `public_user_id` = $public_user_id";
                            // echo $checkUser;
                            $checkUserQuery = mysqli_query($con, $checkUser);
                            if(isset($_SESSION['public_user'])) { 
                            ?>
                                <ul>
                                    <li>
                                        <?php $favresult = mysqli_num_rows($checkUserQuery); ?>
                                        <a class="side-btn" id="fav-button" style="width:100%;padding:10px"><i
                                                class="<?php if($favresult == 0) { echo " far"; } else { echo "fas" ; }
                                                ?> fa-heart"></i></a>
                                    </li>
                                </ul>
                                <input type="hidden" value="<?= $public_user_id; ?>" id="fav_user_id">
                                <input type="hidden" value="<?= $gotten_post_id; ?>" id="fav_post_id">
                            </div>
                            <?php }
                                 } else if(isset($_SESSION['public_user']) && mysqli_num_rows($UserItselfQuery) == 1) { ?>
                                <ul>
                                    <li>
                                        <a href="edit_property?web_request_id=<?= $gotten_post_id ?>" class="side-btn" style="width:100%;padding:10px"><i class="fa fa-edit"></i> &nbsp; Edit</a>
                                    </li>
                                </ul>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">

                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" style="amx-height:500px;width:100%">
                                <div class="carousel-item active" style="max-height:500px;width:100%">
                                    <!--<img src="<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id) ?>" class="d-block w-100" alt="...">-->
                                    <div style="max-height:500px;width:100%">
                                        <a target="_blank" href="<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id) ?>">
                                            <div class="mySlides"  style="width:100%;background-image: url('<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id) ?>');background-size:cover;background-repeat:no-repeat;height:500px;background-position:center;">
                                            </div>
                                        </a>    
                                    </div>

                                </div>
                                <?php
                                $queryGetImages = mysqli_query($con, "SELECT * FROM `property_images` WHERE `web_post_id` = '" . $gotten_post_id . "'");
                                while ($row = mysqli_fetch_array($queryGetImages, MYSQLI_ASSOC)) {
                                    ?>
                                    <div class="carousel-item" style="width:100%;background-image: url('<?= $row['image_link'] ?>');background-size:cover;background-repeat:no-repeat;height:500px;background-position:center;">
                                        <!--<img src="<?= $row['image_link'] ?>" class="d-block w-100" alt="...">-->
<!--                                        <div >
                                                <a target="_blank"  href="<?= $row['image_link'] ?>">
            <div class="mySlides"  style="width:100%;background-image: url('<?= $row['image_link'] ?>');background-size:cover;background-repeat:no-repeat;height:500px;background-position:center;">
            </div>
        </a>
                                        </div>-->
                                    </div>
                                <?php }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>


                        <!--slider starts here--> 

<!--                        <div class="w3-content w3-display-container">

                            <img class="mySlides" src="<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id) ?>" style="width:100%">
                            <div style="max-height:500px;width:100%">
                                <a target="_blank" href="<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id) ?>">
                                    <div class="mySlides"  style="width:100%;background-image: url('<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id) ?>');background-size:cover;background-repeat:no-repeat;height:500px;background-position:center;">
                                    </div>
                                </a>    
                            </div>

                            <?php
                            $queryGetImages = mysqli_query($con, "SELECT * FROM `property_images` WHERE `web_post_id` = '" . $gotten_post_id . "'");
                            while ($row = mysqli_fetch_array($queryGetImages, MYSQLI_ASSOC)) {
                                ?>
                                <div style="max-height:500px;width:100%">
                                    <a target="_blank"  href="<?= $row['image_link'] ?>"><div class="mySlides"  style="width:100%;background-image: url('<?= $row['image_link'] ?>');background-size:cover;background-repeat:no-repeat;height:500px;background-position:center;"></div></a>
                                </div>
                            <?php }
                            ?>


                            <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                            <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                        </div>-->

                        <script>
                            var slideIndex = 1;
                            showDivs(slideIndex);

                            function plusDivs(n) {
                                showDivs(slideIndex += n);
                            }

                            function showDivs(n) {
                                var i;
                                var x = document.getElementsByClassName("mySlides");
                                if (n > x.length) {
                                    slideIndex = 1
                                }
                                if (n < 1) {
                                    slideIndex = x.length
                                }
                                for (i = 0; i < x.length; i++) {
                                    x[i].style.display = "none";
                                }
                                x[slideIndex - 1].style.display = "block";
                            }
                        </script>

                        <!--slider ends here--> 
                        <div class="single-listing-box1">
                            <div class="overview-area"  >
                                <h3 class="item-title">Overview</h3>
                                <div class="gallery-icon-box">
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-comment"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>ID#</li>
                                            <li class="deep-clr"> &nbsp; <?= $db->getEachById($con, 'id', 'web_posts', $gotten_post_id); ?></li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-two-overlapping-square"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Type</li>
                                            <li class="deep-clr"> &nbsp; <?= $db->getEachById($con, 'type', 'web_posts', $gotten_post_id); ?></li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-check"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Status</li>
                                            <li class="deep-clr">
                                                 &nbsp; 
                                                <?php
                                                if ($db->getEachById($con, 'verification_status', 'web_posts', $gotten_post_id) == '1') {
                                                    echo 'Approved';
                                                } else {
                                                    echo 'Pending';
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-user-2"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Int ID</li>
                                            <li class="deep-clr"> &nbsp; <?= $db->getEachById($con, 'internal_lead_id', 'web_posts', $gotten_post_id); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="gallery-icon-box">
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-loupe"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Parking</li>
                                            <li class="deep-clr">Yes</li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-home"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Area</li>
                                            <li class="deep-clr"> &nbsp; <?= $db->getEachById($con, 'land_area', 'web_posts', $gotten_post_id); ?></li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-pencil"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Type</li>
                                            <li class="deep-clr"> &nbsp; <?= $db->getEachById($con, 'property_type', 'web_posts', $gotten_post_id); ?></li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-calendar"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Built in</li>
                                            <li class="deep-clr"> &nbsp; <?= $db->getEachById($con, 'year_build', 'web_posts', $gotten_post_id); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="overview-area listing-area">
                                <h3 class="item-title">About <?= $db->getEachById($con, 'title', 'web_posts', $gotten_post_id); ?></h3>
                                <p style="color:black">
                                    <?= $db->getEachById($con, 'description', 'web_posts', $gotten_post_id); ?>
                                </p>
                                <p style="color:black">
                                    <?= $db->getEachById($con, 'price', 'web_posts', $gotten_post_id); ?> - PKR
                                </p>
                                <p style="color:black">
                                    Always Remember the Internal ID while discussing this property over the phone. Thank you
                                </p>
                            </div>
                            <div class="overview-area single-details-box table-responsive">
                                <h3 class="item-title">Details</h3>
                                <table class="table-box1">
                                    <tr>
                                        <td class="item-bold">Id No</td>
                                        <td><?= $db->getEachById($con, 'id', 'web_posts', $gotten_post_id); ?></td>
                                        <td class="item-bold">Price</td>
                                        <td><?= $db->getEachById($con, 'price', 'web_posts', $gotten_post_id); ?> - PKR</td>
                                    </tr>
                                    <tr>
                                        <td class="item-bold">Type</td>
                                        <td><?= $db->getEachById($con, 'type', 'web_posts', $gotten_post_id); ?></td>
                                        <td class="item-bold">Parking</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td class="item-bold">Purpose</td>
                                        <td><?= $db->getEachById($con, 'purpose', 'web_posts', $gotten_post_id); ?></td>
                                        <td class="item-bold">Land Area</td>
                                        <td><?= $db->getEachById($con, 'land_area', 'web_posts', $gotten_post_id); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="item-bold">Property Type</td>
                                        <td><?= $db->getEachById($con, 'property_type', 'web_posts', $gotten_post_id); ?></td>
                                        <td class="item-bold">Year Build</td>
                                        <td><?= $db->getEachById($con, 'year_build', 'web_posts', $gotten_post_id); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="overview-area map-box">
                                <h3 class="item-title">Map Location</h3>
                                <div class="item-map">
                                    <div class="google-maps">
                                        <iframe style="width: 100%" height="349" style="border: 0" allowfullscreen="" loading="lazy" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCb3U_z-owpRwGS321AP0JX09crvvQj4dw&q=<?= $db->getEachById($con, 'address', 'web_posts', $gotten_post_id); ?>+<?= $db->getEachById($con, 'city', 'web_posts', $gotten_post_id); ?>"> 
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                            <?php if (strlen($db->getEachById($con, 'video_link', 'web_posts', $gotten_post_id)) > 12) { ?>
                                <div class="overview-area video-box1">
                                    <h3 class="item-title">Property Video</h3>
                                    <div class="item-img">
                                        <img src="<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id); ?>"alt="map"width="731"height="349"/>
                                        <div class="play-button">
                                            <div class="item-icon">
                                                <a
                                                    href="<?= $db->getEachById($con, 'video_link', 'web_posts', $gotten_post_id); ?>"
                                                    class="play-btn play-btn-big"
                                                    >
                                                    <span class="play-icon style-2">
                                                        <i class="fas fa-play"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>

                        </div>
                    </div>
                    <div class="col-lg-4 widget-break-lg sidebar-widget">
                        <div class="widget widget-contact-box">
                            <h3 class="widget-subtitle">Contact Agent</h3>
                            <div class="media d-flex">
                                <div class="flex-shrink-0">
                                    <div class="item-logo">
                                        <img
                                            src="<?= $db->getEachById($con, 'image', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $gotten_post_id)); ?>"
                                            alt="<?= $db->getEachById($con, 'name', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $gotten_post_id)); ?>"
                                            width="100"
                                            height="100"
                                            />
                                    </div>
                                </div>
                                <div class="media-body flex-grow-1 ms-3">
                                    <h4 class="item-title"><?= $db->getEachById($con, 'name', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $gotten_post_id)); ?></h4>
                                    <div class="item-phn">
                                        +92 3XX XXX XXXX <a href="tel:+923458514492"><span>(Call)</span></a>
                                    </div>
                                    <!--<div class="item-mail"><?= $db->getEachById($con, 'email', 'public_users', $db->getEachById($con, 'public_user_id', 'web_posts', $gotten_post_id)); ?></div>-->

                                </div>
                            </div>

                            <br />
                            
                            
                            <!-- mail send function -->
                            <?php
if(isset($_POST['send_form'])){
    
    $fname =  $_POST['fname'];
     $from =  $_POST['email'];
     $phone = $_POST['phone'];
     $comment = $_POST['comment'];
     $post_id = $_GET['post_id'];
     $complete_url = 'https://teamworkpk.com/listing_detail?post_id='.$post_id;
    //  $carrier = $_POST['carrier'];
     if(empty($fname) || empty($from) || empty($phone) || empty($comment)){
    //    echo("All fields required.");
    echo 'All fields are required!';
    //    exit();

     } 
     if(!empty($fname) && !empty($from) && !empty($phone) && !empty($comment)){
      require 'includes/class/class.phpmailer.php';
    $mail = new PHPMailer(true);
    $mail->SMTPKeepAlive = true;
    $mail->Mailer = 'smtp';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $table = '<table style="border:2px solid #000;">

        <tr style="border:2px solid #000;">
        <style>td{border:2px solid #4d4949;background-color:#eee;color:#4d4949}</style>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Message</td>
        <td>ID</td>

        
        </tr>';
        
       $table .= "<tr><td>".$fname."</td><td>".$from."</td><td>".$phone."  </td><td>".$comment."</td><td>".$complete_url."</td></tr>";
    
    $mail->IsSMTP();        //Sets Mailer to send message using SMTP
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'hassanrbaiga@gmail.com';     //Sets SMTP username
    $mail->Password = 'wantsomeone';     //Sets SMTP password
    $mail->From = 'info@teamworkpk.com';   //Sets the From email address for the message
    $mail->FromName = 'teamworkpk.com';   //Sets the From name of the message
    $mail->AddAddress('Muzamil@bingo-agency.com', 'muzzi');  //Adds a "To" address
    $mail->AddAddress('connect@bingo-agency.com', 'Hassan');  //Adds a "To" address
    $mail->AddAddress('info@teamworkpk.com', 'Asif Khan');  //Adds a "To" address
    // $mail->AddAddress('abdullah@bingo-agency.com', 'Abdullah');  //Adds a "To" address
    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);       //Sets message type to HTML				
    // $mail->AddAttachment($file_name);         //Adds an attachment from a path on the filesystem
    $mail->Subject = 'Team Work';   //Sets the Subject of the message
    $mail->Body =  $table.'</table>';    //An HTML or plain text message body
    if ($mail->Send()) {        //Send an Email. Return true on success or false on error
        $db->success('Thank you for taking interest in Team Work.<br /><strong>Team Work </strong> will get back to you after reviewing your Project details.');
    } else {
        echo $message = 'Sorry! Try Again';
    }
//    unlink($file_name);
}
}
?>
    

                            <form method="post" action="#"class="contact-box ">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="fname"
                                            placeholder="Your Full Name"
                                            data-error="First Name is required"
                                            
                                            />
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="phone"
                                            placeholder="Phone"
                                            data-error="Phone is required"
                                            />
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="email"
                                            placeholder="E-mail"
                                            data-error="Phone is required"
                                            />
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <textarea
                                            name="comment"
                                            class="form-text"
                                            placeholder="Message"
                                            cols="30"
                                            rows="4"
                                            data-error="Message Name is required"
                                            ></textarea>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="advanced-button">
                                            <button type="submit" name="send_form" class="item-btn">
                                                Send Message <i class="fas fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-response"></div> -->
                            </form>
                        </div>
                        <div class="widget widget-listing-box1 hidethislogin">
                            <h3 class="widget-subtitle">Latest Listing</h3>
                            <?php
                            $queryGetProperties = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = 1 ORDER BY `id` DESC LIMIT 3");
                            while ($row = mysqli_fetch_array($queryGetProperties, MYSQLI_ASSOC)) {
                                ?>
                                <div class="widget-listing">
                                    <a href="listing_detail?post_id=<?= $row['id'] ?>"><div class="item-img" style="width:120px;height:102px;background-image: url('<?= $row['primary_image'] ?>');background-size:cover;background-position:center;"></div></a>
                                    <div class="item-content">
                                        <h5 class="item-title">
                                            <a href="listing_detail?post_id=<?= $row['id'] ?>"><?= $row['title']; ?></a>
                                        </h5>
                                        <div class="location-area">
                                            <i class="flaticon-maps-and-flags"></i><?= $row['city'] ?>
                                        </div>
                                        <div class="item-price"><script>document.write(numberFormatter(<?php $price = str_replace(',', '', $row['price']);  echo $price; ?>));</script><span><i>-</i>PKR</span></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        $query_get_projects = mysqli_query($con, "SELECT * FROM `projects` ORDER BY `id` DESC LIMIT 1");
                        while ($row = mysqli_fetch_array($query_get_projects, MYSQLI_ASSOC)) {
                            ?>
                            <div class="widget widget-post">
                                <div class="item-img">
                                    <img src="admin/<?= $row['image_link'] ?>" alt="<?= $row['title'] ?>" />
                                    <div class="circle-shape">
                                        <span class="item-shape"></span>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h4 class="item-title">Find Your Dream House Project</h4>
                                    <div class="item-price">Lease Available</div>
                                    <div class="post-button">
                                        <a href="projects" class="item-btn">Explore Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--=====================================-->
<!--=   Property     Start              =-->
<!--=====================================-->

<section class="property-wrap1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-7 col-sm-7">
                <div class="item-heading-left">
                    <span class="section-subtitle">Our PROPERTIES</span>
                    <h2 class="section-title">Latest Properties</h2>
                    <div class="bg-title-wrap" style="display: block">
                        <span class="background-title solid">Properties</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-5">
                <div class="heading-button">
                    <a href="listing" class="heading-btn item-btn2"
                       >All Properties</a
                    >
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <?php
            $queryGetProperties = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = 1 LIMIT 3");
            while ($row = mysqli_fetch_array($queryGetProperties, MYSQLI_ASSOC)) {
                ?>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div
                        class="property-box2 wow animated fadeInUp"
                        data-wow-delay=".<?= $row['id'] ?>s"
                        >
                        <a href="listing_detail?post_id=<?= $row['id'] ?>">
                            <div class="item-img" style="    background-image: url('<?= $row['primary_image'] ?>');height: 300px;background-size: cover;">

                                                                <!--<img src="<?= $row['primary_image'] ?>"alt="<?= $row['title'] ?>"width="510"height="340"/>-->

                                <div class="item-category-box1">
                                    <div class="item-category"><?= $row['purpose'] ?></div>
                                </div>
                                <div class="rent-price">
                                    <div class="item-price">
                                    <script>document.write(numberFormatter(<?php $price = str_replace(',', '', $row['price']);  echo $price; ?>));</script><span><i>-</i>PKR</span>
                                    </div>
                                </div>
                                <div class="react-icon">

                                </div>
                            </div>
                        </a>
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

            <!--            <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="property-box2 wow animated fadeInUp" data-wow-delay=".2s">
                                <div class="item-img">
                                    <a href="single-listing1.html"><img src="<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id); ?>" alt="blog" width="510" height="340"></a>
                                    <div class="item-category-box1">
                                        <div class="item-category">For Rent</div>
                                    </div>
                                    <div class="rent-price">
                                        <div class="item-price">$12,000<span><i>/</i>mo</span></div>
                                    </div>
                                    <div class="react-icon">
                                        <ul>
                                            <li>
                                                <a href="favourite.html" data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="Favourites">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="Compare">
                                                    <i class="flaticon-left-and-right-arrows"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-category10"><a href="single-listing1.html">Villa</a></div>
                                <div class="item-content">
                                    <div class="verified-area">
                                        <h3 class="item-title"><a href="single-listing1.html">Countryside Modern Lake View</a></h3>
                                    </div>
                                    <div class="location-area"><i class="flaticon-maps-and-flags"></i>Downey, California</div>
                                    <div class="item-categoery3">
                                        <ul>
                                            <li><i class="flaticon-bed"></i>Beds: 03</li>
                                            <li><i class="flaticon-shower"></i>Baths: 02</li>
                                            <li><i class="flaticon-two-overlapping-square"></i>931 Sqft</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="property-box2 wow animated fadeInUp" data-wow-delay=".1s">
                                <div class="item-img">
                                    <a href="single-listing1.html"><img src="<?= $db->getEachById($con, 'primary_image', 'web_posts', $gotten_post_id); ?>" alt="blog" width="510" height="340"></a>
                                    <div class="item-category-box1">
                                        <div class="item-category">For Sell</div>
                                    </div>
                                    <div class="rent-price">
                                        <div class="item-price">$18,000<span><i>/</i>mo</span></div>
                                    </div>
                                    <div class="react-icon">
                                        <ul>
                                            <li>
                                                <a href="favourite.html" data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="Favourites">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="Compare">
                                                    <i class="flaticon-left-and-right-arrows"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-category10"><a href="single-listing1.html">Office</a></div>
                                <div class="item-content">
                                    <div class="verified-area">
                                        <h3 class="item-title"><a href="single-listing1.html">Gorgeous Apartment Building </a></h3>
                                    </div>
                                    <div class="location-area"><i class="flaticon-maps-and-flags"></i>Downey, California</div>
                                    <div class="item-categoery3">
                                        <ul>
                                            <li><i class="flaticon-bed"></i>Beds: 03</li>
                                            <li><i class="flaticon-shower"></i>Baths: 02</li>
                                            <li><i class="flaticon-two-overlapping-square"></i>931 Sqft</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>-->
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
</section>


<?php include'includes/footer.php'; ?>

<script>
    $(document).ready(function () {
        $('#fav-button').click(function () {

            let favUserId = $('#fav_user_id').val();
            let favPostId = $('#fav_post_id').val();

            $.ajax({
                url: 'fav.php',
                type: 'post',
                data: {
                    favUserId: favUserId,
                    favPostId: favPostId
                },
                success: function (response) {
                    if (response == "success") {
                        // alert(response + "success");
                        $('#fav-button i').removeClass("far");
                        $('#fav-button i').addClass("fas");
                    } else if (response == "Deleted") {
                        // alert(response + "Deleted");
                        $('#fav-button i').removeClass("fas");
                        $('#fav-button i').addClass("far");
                    }
                }
            });
        });
    });

</script>

<!-- <script>
    $("#myCarousel").carousel();

    </script> -->