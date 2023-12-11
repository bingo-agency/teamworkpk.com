<?php
include'includes/header.php';

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    if (!empty($project_id)) {
        $db->add_views_project($con, $project_id);
    }
} else {
    $db->redirect('index');
    exit();
}
?>
<section class="single-slider-wrap1">
    <div class="container-fluid px-0">
        <div class="swiper-container single-slider-layout1">
            <div class="swiper-wrapper">
                <div class="swiper-slide">

                    <div class="item-img">
                        <img src="admin/<?= $db->getEachById($con, 'image_link', 'projects', $project_id); ?>" alt="slider" width="1920" height="569">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item-img">
                        <img src="admin/<?= $db->getEachById($con, 'image_link', 'projects', $project_id); ?>" alt="slider" width="1920" height="569">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item-img">
                        <img src="admin/<?= $db->getEachById($con, 'image_link', 'projects', $project_id); ?>" alt="slider" width="1920" height="569">
                    </div>
                </div>
            </div>
            <div class="rt-slider-pagniation-wrap-1">
                <div class="rt-swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="single-slider-content"> 
            <div class="single-list-cate">
                <div class="item-categoery"><?= $db->getEachById($con, 'ribbon', 'projects', $project_id); ?></div>
            </div>  
            <div class="single-verified-area">
                <div class="item-title">
                    <h3><a style="cursor: none;"><?= $db->getEachById($con, 'title', 'projects', $project_id); ?></a></h3>
                </div>
            </div>
            <div class="single-item-address">
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i><?= $db->getEachById($con, 'address', 'projects', $project_id); ?>,<?= $db->getEachById($con, 'city', 'projects', $project_id); ?> /</li>
                    <li><i class="fas fa-clock"></i><?= $db->getEachById($con, 'timestamp', 'projects', $project_id); ?>  / </li>
                    <li><i class="fas fa-eye"></i>Views: <?= $db->getEachById($con, 'views', 'projects', $project_id); ?> </li>
                </ul>
            </div>
            <div class="property-heading-2">
                <div class="single-list-price-2"><?= $db->getEachById($con, 'price', 'projects', $project_id); ?> - PKR</div> 
                <div class="side-button">
                    <ul>
    <!--<li><a href="with-sidebar2.html" class="side-btn"><i class="flaticon-share"></i></a></li>-->
<!--                        <li><a href="with-sidebar2.html" class="side-btn"><i class="flaticon-heart"></i></a></li>
    <li><a href="with-sidebar2.html" class="side-btn"><i class="flaticon-left-and-right-arrows"></i></a></li>
    <li><a href="with-sidebar2.html" class="side-btn"><i class="flaticon-printer"></i></a></li>-->
                    </ul>
                </div>
            </div>   
        </div>
    </div>
</section>
<section class="single-listing-wrap1 single-listing-wrap3">
    <div class="container">
        <div class="single-property">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="single-listing-box1">
                            <div class="overview-area listing-area">
                                <h3 class="item-title">About <?= $db->getEachById($con, 'title', 'projects', $project_id); ?></h3>
                                <p>
                                    <?= $db->getEachById($con, 'description', 'projects', $project_id); ?>
                                </p>
                                <p>
                                    <?= $db->getEachById($con, 'price', 'projects', $project_id); ?> - PKR
                                </p>
                                <p>
                                    Always Remember the Internal ID while discussing this property over the phone. Thank you
                                </p>
                            </div>
                            <div class="overview-area overview-area-2">

                                <h3 class="item-title">Overview</h3>
                                <div class="gallery-icon-box">
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-comment"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>ID No :</li>
                                            <li class="deep-clr"><?= $db->getEachById($con, 'id', 'projects', $project_id); ?></li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-home"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Type :</li>
                                            <li class="deep-clr"><?= $db->getEachById($con, 'type', 'projects', $project_id); ?></li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-check"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Site Status :</li>
                                            <li class="deep-clr">Approved</li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="gallery-icon-box">
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-home"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Parking :</li>
                                            <li class="deep-clr">Yes</li>
                                        </ul>
                                    </div>

                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-pencil"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Land Size :</li>
                                            <li class="deep-clr">15,000 sqft</li>
                                        </ul>
                                    </div>
                                    <div class="item-icon-box">
                                        <div class="item-icon">
                                            <i class="flaticon-two-overlapping-square"></i>
                                        </div>
                                        <ul class="item-number">
                                            <li>Year Build :</li>
                                            <li class="deep-clr"><?= $db->getEachById($con, 'year_build', 'projects', $project_id); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="overview-area single-details-box table-responsive">
                                <h3 class="item-title">Details</h3>
                                <table class="table-box1">
                                    <tr>
                                        <td class="item-bold">Id No</td>
                                        <td><?= $db->getEachById($con, 'id', 'projects', $project_id); ?></td>
                                        <td class="item-bold">Price</td>
                                        <td><?= $db->getEachById($con, 'price', 'projects', $project_id); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="item-bold">Property Type</td>
                                        <td><?= $db->getEachById($con, 'type', 'projects', $project_id); ?></td>
                                        <td class="item-bold">Parking</td>
                                        <td>Yes</td>
                                    </tr>

                                    <tr>
                                        <td class="item-bold">Size</td>
                                        <td>1050 sqft</td>
                                        <td class="item-bold">Year Build</td>
                                        <td><?= $db->getEachById($con, 'year_build', 'projects', $project_id); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="overview-area map-box">
                                <h3 class="item-title">Map Location</h3>
                                <div class="item-map">
                                    <div class="google-maps">
                                        <iframe style="width: 100%" height="349" style="border: 0" allowfullscreen="" loading="lazy" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCb3U_z-owpRwGS321AP0JX09crvvQj4dw&q=<?= $db->getEachById($con, 'address', 'projects', $project_id); ?>+<?= $db->getEachById($con, 'city', 'projects', $project_id); ?>"> 
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                            <?php if (!$db->getEachById($con, 'video_link', 'projects', $project_id) == '') { ?>
                                <div class="overview-area video-box1">
                                    <h3 class="item-title">Property Video</h3>
                                    <div class="item-img">
                                        <img src="admin/<?= $db->getEachById($con, 'image_link', 'projects', $project_id) ?>" alt="<?= $db->getEachById($con, 'title', 'projects', $project_id) ?>" width="731" height="349">
                                        <div class="play-button">
                                            <div class="item-icon">
                                                <a href='<?= $db->getEachById($con, 'video_link', 'projects', $project_id) ?>' class="play-btn play-btn-big">
                                                    <!--<a href='https://www.youtube.com/watch?v=-4n1hfZdClY' class="play-btn play-btn-big">-->
                                                    <span class="play-icon style-2">
                                                        <i class="fas fa-play"></i>
                                                    </span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                    <div class="col-lg-4 widget-break-lg sidebar-widget">
                        <div class="widget widget-contact-box">
                            <h3 class="widget-subtitle">Inquire</h3>

                            <form class="contact-box rt-contact-form">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <input type="text" class="form-control" name="fname"
                                               placeholder="Your Full Name" data-error="First Name is required" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="text" class="form-control" name="phone" placeholder="Phone"
                                               data-error="Phone is required" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="text" class="form-control" name="phone" placeholder="E-mail"
                                               data-error="Phone is required" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <textarea name="comment" id="message" class="form-text" placeholder="Message"
                                                  cols="30" rows="4" data-error="Message Name is required"
                                                  required></textarea>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="advanced-button">
                                            <button type="submit" class="item-btn">Send Message <i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-response"></div>
                            </form>
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
</section>
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
            $queryGetProperties = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = 1 ORDER BY `id` DESC LIMIT 3");
            while ($row = mysqli_fetch_array($queryGetProperties, MYSQLI_ASSOC)) {
                ?>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div
                        class="property-box2 wow animated fadeInUp"
                        data-wow-delay=".<?= $row['id'] ?>s"
                        >
                        <a href="listing_detail?post_id=<?= $row['id'] ?>">
                            <div class="item-img" style="    background-image: url('<?= $row['primary_image'] ?>');height: 250px;background-size: cover;background-position:center;background-repeat:no-repeat;">

                <!--<img src="<?= $row['primary_image'] ?>"alt="<?= $row['title'] ?>"width="510"height="340"/>-->

                                <div class="item-category-box1">
                                    <div class="item-category"><?= $row['purpose'] ?></div>
                                </div>
                                <div class="rent-price">
                                    <div class="item-price">
                                        <?= $row['price'] ?><span><i>-</i>PKR</span>
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
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
</section>
<?php include'includes/footer.php'; ?>