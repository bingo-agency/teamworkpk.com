<?php include'includes/header.php'; ?>
<section class="main-banner-wrap1 main-banner-wrap6 motion-effects-wrap">
    <div class="shape-element">
        <ul>
            <li><img class="wow fadeInLeft" data-wow-delay=".3s" src="img/figure/shape33.svg" height="296" width="408" alt="shape"></li>
            <li><img src="img/figure/shape34.svg" height="426" width="319" alt="shape"></li>
            <li><img class="motion-effects12" src="img/figure/shape35.svg" width="150" height="150" alt="shape"></li>
            <li><img src="img/figure/shape36.svg" width="70" height="27" alt="shape"></li>
            <li><img class="motion-effects13" src="img/figure/shape37.svg" width="191" height="178" alt="shape"></li>
            <li><img src="img/figure/shape38.svg" width="719" height="196" alt="shape"></li>
        </ul>
        <div class="item-banner-thumb wow fadeInRight" data-wow-delay=".4s"><img src="img/banner/banner7.png" width="1204" height="1156" alt="banner"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="main-banner-box1 main-banner-box6">
                    <h1 class="item-title wow fadeInUp" data-wow-delay=".4s">
                        Find the perfect value of your Property Exchange
                    </h1>
                    <div class="bg-title-wrap" style="display: block">
                        <span class="background-title solid">Property Exchange</span>
                    </div>
                    <div class="banner-search-wrap">
                        <div class="rld-main-search">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="box">
                                        <div class="box-top">
                                            <div class="rld-single-input item">
                                                <input type="text" id="asearch_keyword" placeholder="Enter Keyword here..."/>
                                            </div>
                                            <div class="rld-single-select ml-22">
                                                <select id="asearch_type" class="select single-select">
                                                <option value="Property Type">Property Type</option>
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
                                            <div class="rld-single-select item">
                                                <select id="asearch_city" class="select single-select mr-0">
                                                    <option value="">All Cities</option>
                                                    <option value="Islamabad">Islamabad</option>
                                                    <option value="Lahore">Lahore</option>
                                                    <option value="Karachi">Karachi</option>
                                                    <option value="Abbotabad">Abbotabad</option>
                                                    <option value="Peshawar">Peshawar</option>
                                                </select>

                                            </div>
                                            <div class="item rt-filter-btn">
                                                <div class="filter-button-area">
                                                    <a class="filter-btn" id="asearch" href="#"><span>Search</span><i class="fas fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="item-para wow fadeInUp" data-wow-delay=".4s">
                            We’ve more than
                            <span class="banner-p">54,000</span> properties for <span style="text-shadow: 1px 1px 2px #eee;color:#4d4949">Exchange.</span>
                            <span class="item-shape"><img src="img/figure/shape39.svg" width="79" height="16" alt="shape"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=   Property     Start              =-->
<!--=====================================-->

<section class="property-wrap1 property-wrap-10">
    <div class="container">
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
                                <!-- <img src="https://teamworkpk.com/upload/image_picker2146810955202900047.jpg"alt="<?= $row['title'] ?>" /> -->
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
        <br />
        <br />
        <div class="item-heading-center">
            <span class="section-subtitle">OUR PROPERTIES</span>
            <h2 class="section-title">All Listed Properties</h2>
            <div class="bg-title-wrap" style="display: block">
                <span class="background-title solid">Properties</span>
            </div>
        </div>
        <div class="row">
            <?php
            $queryGetProperties = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = 1 ORDER BY `id` DESC LIMIT 9");
            while ($row = mysqli_fetch_array($queryGetProperties, MYSQLI_ASSOC)) {
                ?>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="property-box2 wow animated fadeInUp"data-wow-delay=".<?= $row['id'] ?>s">

                                    <!--<div class="item-img" style="background-image: url('<?= $row['primary_image'] ?>');height: 300px;background-size: cover;background-position: center;background-repeat: no-repeat;">-->
                        <div class="item-img item-img_thumb">
                            <a href="listing_detail?post_id=<?= $row['id'] ?>">
                                <img src="<?= $row['primary_image'] ?>"alt="<?= $row['title'] ?>"width="510"height="340"/>
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
            <a href="listing" class="item-btn">View All Properties</a>
        </div>
    </div>
</section>
<!--
<section class="property-wrap-7">
    <div class="" style="padding-left:50px;padding-right:25px;">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-7">
                <div class="item-heading-left">
                    <span class="section-subtitle">Our PROPERTIES</span>
                    <h2 class="section-title">Properties up for Exchange</h2>
                    <div class="bg-title-wrap" style="display: block;">
                        <span class="background-title solid">Properties</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-5">
                <div class="heading-button">
                    <a href="listing" class="heading-btn">See All Properties</a>
                </div>
            </div>
        </div>
        <div class="slider-wrapper">
            <div class="swiper-container property-layout1">
                <div class="swiper-wrapper">
<?php
$queryGetProperties = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `verification_status` = 1");
while ($row = mysqli_fetch_array($queryGetProperties, MYSQLI_ASSOC)) {
    ?>
                                                                                        <div class="swiper-slide">
                                                                                            <div class="property-box6 wow animated fadeInUp" data-wow-delay=".<?= $row['id'] ?>s">
                                                                                                <a href="listing_detail?post_id=<?= $row['id'] ?>">
                                                                                                    <div class="item-img" style="background-image: url('<?= $row['primary_image'] ?>');height: 350px;background-size: cover;background-position:center;background-repeat:no-repeat;">


                                                                                                        <div class="categoery-style-3">

    <?php if ($row['featured'] == '1') { ?>
                                                                                                                                                                                <div class="item-category-box1">
                                                                                                                                                                                    <div class="item-category">Featured</div>
                                                                                                                                                                                </div>
    <?php } ?>
                                                                                                        </div>
                                                                                                                                                <div class="author-img">
                                                                                                                                                    <img src="img/blog/property17.jpg" alt="blog" width="40" height="40">
                                                                                                                                                </div>
                                                                                                    </div>
                                                                                                </a>
                                                                                                <div class="item-content" style="padding:30px 20px 4px 30px">
                                                                                                    <div class="verified-area">
                                                                                                        <h3 class="item-title">
                                                                                                            <a href="listing_detail?post_id=<?= $row['id'] ?>">
    <?= $db->limit_chars_by($row['title'], 30); ?>
                                                                                                            </a>
                                                                                                        </h3>
                                                                                                    </div>
                                                                                                    <div class="location-area"><i class="flaticon-maps-and-flags"></i><?= $db->limit_chars_by($row['address'], 30) ?>, <?= $row['city'] ?></div>
                                                                                                    <div class="item-price"><?= $row['price'] ?>-<span>PKR</span></div>
                                                                                                                                        <div class="item-categoery3">
                                                                                                                                            <ul>
                                                                                                                                                <li><span><a href="listing_detail?post_id=<?= $row['id'] ?>" class="btn item-btn">View Add</a></span></li>
                                                                                                                                                <li><span><a href="listing_detail?post_id=<?= $row['id'] ?>" class="btn btn-success">Contact</a></span></li>
                                                                                                    
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
<?php } ?>  
                </div>
            </div>
        </div>
    </div>
</section>-->

<!--=====================================-->
<!--=   Who is team work ?     Start    =-->
<!--=====================================-->

<section class="about-wrap-5 counter-appear motion-effects-wrap">
    <div class="container">
        <div class="item-element-shape">
            <ul>
                <li><img class="wow animated fadeInRight" data-wow-delay=".4s" src="img/figure/shape30.svg" width="312" height="295" alt="shape"></li>
                <li><img class="motion-effects12" src="img/figure/shape31.svg" width="155" height="92" alt="shape"></li>
                <li><img src="img/figure/shape32.svg" width="575" height="162" alt="shape"></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="about-box-9 wow animated fadeInLeft" data-wow-delay=".5s">
                    <div class="item-img">
                        <img src="img/blog/about2.png" alt="shape" width="567" height="572">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-box-10 wow animated fadeInRight" data-wow-delay=".3s">
                    <div class="item-heading-left mb-bottom">
                        <span class="section-subtitle">WHO WE ARE</span>
                        <h2 class="section-title">We are Offering The Best
                            Property Swap For All</h2>
                        <div class="bg-title-wrap" style="display: block;">
                            <span class="background-title solid">About</span>
                        </div>
                        <p>The more information you have about your property, the better. We know that it's not always easy to find out what condition a property is in, whether there are any problems with the electrical system or if mould has started to grow in a damp area of your house.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="about-svg-shape">
                                <img src="img/figure/shape28.svg" alt="svg">
                                <div class="item-content">
                                    <div class="item-content">
                                        <div class="item-content__text">
                                            <div class="item-k"><span class="counterUp" data-counter="55">55</span>K</div>
                                        </div>
                                        <p>Satisfied People</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="about-svg-shape">
                                <img src="img/figure/shape29.svg" alt="svg">
                                <div class="item-content">
                                    <div class="item-content__text">
                                        <div class="item-k"><span class="counterUp" data-counter="11">11</span>K</div>
                                    </div>
                                    <p>Verified Property</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>This is why we offer a Property Exchange service where we can get an independent surveyor to go into your home and give us all the important details for free. Our experts can also help you find out how much you might be able to make against your property and whether renting out rooms will make sense for you financially.
                    </p>
                    <div class="banner-button about-button-2">
                        <a href="contact" class="banner-btn">Contact With Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=   Category Feature    Start                =-->
<!--=====================================-->
<section class="feature-wrap2 rt-feature-slide-wrap">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="item-heading-left">
                    <span class="section-subtitle">PROPERTY TYPE</span>
                    <h2 class="section-title">Let’s Explore by Property Type</h2>
                    <div class="bg-title-wrap" style="display: block">
                        <span class="background-title solid">Categories</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-layout-nav-button-wrap">
                    <span class="feature-btn-prev">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="feature-btn-next">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="feature-layout-style-1 swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=apartments'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="item-img">
                            <img src="img/figure/shape22.svg" alt="svg" height="78" width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                Apartments
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'apartments'); ?> Listings</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=office'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".5s">
                        <div class="item-img">
                            <img src="img/figure/shape24.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                office
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'office'); ?> Listing</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=restaurant'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".6s">
                        <div class="item-img">
                            <img src="img/figure/shape25.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                Restaurant
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'restaurant'); ?> Listings</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=studio'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".7s">
                        <div class="item-img">
                            <img src="img/figure/shape26.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                Studio Home
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'studio'); ?> Listing</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=land'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="item-img">
                            <img src="img/figure/land_forest_teamWork.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                Land
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'land'); ?> Listings</div>
                        </div>
                    </div>
                    </a>    
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=plot'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="item-img">
                            <img src="img/figure/land-parcels.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                Plot
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'plot'); ?> Listings</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=vehicle'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="item-img">
                            <img src="img/figure/rda-car-ijarah.png"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                vehicle
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'vehicle'); ?> Listings</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=office'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".5s">
                        <div class="item-img">
                            <img src="img/figure/shape24.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                office
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'office'); ?> Listing</div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=restaurant'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".6s">
                        <div class="item-img">
                            <img src="img/figure/shape25.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                Restaurant
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'restaurant'); ?> Listings</div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="swiper-slide">
                    <a href='listing?advance_search=true&property-type=studio'>
                    <div class="feature-box4 wow fadeInUp" data-wow-delay=".7s">
                        <div class="item-img">
                            <img src="img/figure/shape26.svg"alt="svg"height="78"width="70"/>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" style="font-size: 18px; font-weight: 500;">
                                Studio Home
                            </h3>
                            <div class="item-categoery"><?= $db->property_type_count($con, 'web_posts', 'studio'); ?> Listing</div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=   Location     Start              =-->
<!--=====================================-->

<section class="location-wrap1">
    <div class="container">
        <div class="item-heading-center">
            <span class="section-subtitle">Top Cities</span>
            <h2 class="section-title">Find in Your Neighborhood</h2>
            <div class="bg-title-wrap" style="display: block">
                <span class="background-title solid">Locations</span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <a href="listing?city_search=islamabad">
                    <div class="location-box3 location-box4 wow zoomIn" data-wow-delay=".3s">
                        <div class="item-img">
                            <img src="img/blog/islamabad.jpeg"alt="Islamabad"width="424"height="280" />
                        </div>
                        <div class="item-content">
                            <div class="content-body">
                                <div class="item-title">
                                    <h3><a href="listing?advance_search=true&city=islamabad">Islamabad</a></h3>
                                </div>
                                <div class="item-category"><span><?= $db->property_city_count($con, 'web_posts', 'Islamabad'); ?> properties</span></div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-md-6">
                <a href="listing?city_search=lahore">
                    <div class="location-box3 location-box4 wow zoomIn" data-wow-delay=".4s">
                        <div class="item-img">
                            <img src="img/blog/lahore.jpeg"alt="Lahore"width="424"height="280"/>
                        </div>
                        <div class="item-content">
                            <div class="content-body">
                                <div class="item-title">
                                    <h3><a href="listing?advance_search=true&city=lahore">Lahore</a></h3>
                                </div>
                                <div class="item-category"><span><?= $db->property_city_count($con, 'web_posts', 'Lahore'); ?> properties</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="listing?city_search=peshawar">
                    <div class="location-box3 location-box4 wow zoomIn" data-wow-delay=".5s">
                        <div class="item-img">
                            <img
                                src="img/blog/peshawar.jpeg"
                                alt="peshawar"
                                width="424"
                                height="280"
                                />
                        </div>
                        <div class="item-content">
                            <div class="content-body">
                                <div class="item-title">
                                    <h3><a href="listing?advance_search=true&city=peshawar">Peshawar</a></h3>
                                </div>
                                <div class="item-category"><span><?= $db->property_city_count($con, 'web_posts', 'Peshawar'); ?> properties</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <a href="listing?city_search=abbotabad">
                    <div class="location-box3 location-box4 wow zoomIn" data-wow-delay=".6s">
                        <div class="item-img">
                            <img
                                src="img/blog/abbotabad.jpeg"
                                alt="Abbotabad"
                                width="424"
                                height="280"
                                />
                        </div>
                        <div class="item-content">
                            <div class="content-body">
                                <div class="item-title">
                                    <h3><a href="listing?advance_search=true&city=abbotabad">Abbotabad</a></h3>
                                </div>
                                <div class="item-category"><span><?= $db->property_city_count($con, 'web_posts', 'Abbotabad'); ?> properties</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-8 col-md-8">
                <a href="listing?city_search=karachi">
                    <div class="location-box3 location-box4 wow zoomIn" data-wow-delay=".7s">
                        <div class="item-img">
                            <img
                                src="img/blog/karachi.jpeg"
                                alt="Karachi"
                                width="846"
                                height="280"
                                />
                        </div>
                        <div class="item-content">
                            <div class="content-body">
                                <div class="item-title">
                                    <h3><a href="listing?advance_search=true&city=karachi">Karachi</a></h3>
                                </div>
                                <div class="item-category"><span><?= $db->property_city_count($con, 'web_posts', 'Karachi'); ?> properties</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=   Property Banner     Start       =-->
<!--=====================================-->

<section
    class="property-banner-wrap1 parallaxie"
    data-bg-image="img/alone-innerpage-mahira-khan-736.png"
    >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12">
                <div class="property-box1 wow slideInUp" data-wow-delay="100">
                    <div class="item-subtitle">Let’s Take a Tour</div>
                    <h3 class="item-title">
                        Search Property Smarter, Quicker & Anywhere
                    </h3>
                    <div class="play-button">
                        <div class="item-icon">
                            <a
                                href="https://www.youtube.com/watch?v=aFFDZDoWFA0"
                                class="play-btn"
                                >
                                <span class="play-icon style-1">
                                    <i class="fas fa-play"></i>
                                </span>
                                <span class="play-text">Watch Video</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="property-img wow fadeInUp" data-wow-delay="100">
                    <div class="bg-title-wrap" style="display: block">
                        <span class="background-title solid">Swap Smarter</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=   Progress     Start              =-->
<!--=====================================-->

<section class="banner-collection4 motion-effects-wrap">
    <div class="item-element">
        <ul>
            <li><img class="wow fadeInLeft" data-wow-delay=".4s" src="img/figure/shape19.svg" width="388" height="417" alt="shape" /></li>
            <li>
                <img
                    class="motion-effects12"
                    src="img/figure/shape20.svg"
                    width="191" height="178" alt="shape"
                    />
            </li>
            <li><img src="img/figure/shape21.svg" width="570" height="243" alt="shape" /></li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="banner-box-2 wow fadeInLeft" data-wow-delay=".5s">
                    <div class="item-img">
                        <img src="img/icon_marker.png" width="309" height="523" alt="banner" />
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner-content-2 wow fadeInUp" data-wow-delay=".7s">
                    <div class="item-heading-left">
                        <h2 class="section-title">
                            We’re Providing the Best Real Estate Services
                        </h2>
                        <p class="item-para">
                            Make a type specimen book. It has survived not only
                        </p>
                        <p>five centuries, but also the leap into.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="service-box-1">
                                <div class="service-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="service-content">
                                    <h3 class="info-title">Our Hot Line:</h3>
                                    <p><a href="tel:(+92) 345 8514492">(+92) 345 8514492</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="service-box-1 service-box-2">
                                <div class="service-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="service-content">
                                    <h3 class="info-title">Mail Us:</h3>
                                    <p><a href="mailto:info@teamworkpk.com">info@teamworkpk.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-button">
                        <a href="contact" class="banner-btn">Contact With Us</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="banner-img-style-2 wow fadeInRight" data-wow-delay=".6s">
                    <img src="img/banner/banner4.png" width="569" height="480" alt="banner" />
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=   Testimonial     Start           =-->
<!--=====================================-->

<section class="testimonial-wrap3">
    <div class="container">
        <div class="testimonial-layout3 swiper-container">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="item-img">
                        <img src="img/slider/hamza.jpg" width="74" height="74" alt="Hamza" />
                    </div>
                    <div class="testimonial-content">
                        <h3 class="item-title">Hamza Abbas</h3>
                        <div class="item-subtitle">Head of Technologies Corp</div>
                        <div class="rtin-content">
                            <span
                                >“I was looking to sell my house. I found a buyer and the transaction went smoothly with no complications. I'm happy and so is the new owner." "It's been less than a month since my property exchange, but it's already sold! Thank you for all your help!”
                            </span>
                            <div class="item-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="item-img">
                        <img src="img/slider/sarim.jpg" width="74" height="74" alt="Sarim" />
                    </div>
                    <div class="testimonial-content">
                        <h3 class="item-title">Sarim Hassan</h3>
                        <div class="item-subtitle">Software Engineer</div>
                        <div class="rtin-content">
                            <span
                                >“ I was having problem selling out this property but the people at teamWork helped me to organize another place which i was interested in getting against my current property. Thank you guys.”
                            </span>
                            <div class="item-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item-img">
                        <img src="img/slider/huzaifa.jpg" width="74" height="74" alt="Abrar" />
                    </div>
                    <div class="testimonial-content">
                        <h3 class="item-title">Huzaifa Naqvi</h3>
                        <div class="item-subtitle">Architect</div>
                        <div class="rtin-content">
                            <span
                                >“ I have chosen the team of TeamWork Est. over many times, They have resolved many of my property related issues, For many things as we politicians do not have time, these guys are there for us to take care of all the work required. ”
                            </span>
                            <div class="item-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- navigation buttons -->
            <div class="swiper-button-prev testimonial-btn"></div>
            <div class="swiper-button-next testimonial-btn"></div>
        </div>
    </div>
    <!-- Slider main container -->
</section>
<!--=====================================-->
<!--=   Blog     Start                  =-->
<!--=====================================-->

<section class="blog-wrap1 blog-wrap3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-8">
                <div class="item-heading-left">
                    <span class="section-subtitle">What’s New at TeamWork</span>
                    <h2 class="section-title">Latest Projects</h2>
                    <div class="bg-title-wrap" style="display: block;">
                        <span class="background-title solid">Projects</span>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4">
                <div class="heading-button">
                    <a href="projects" class="heading-btn">See All Projects</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $queryGetProjects = mysqli_query($con, "SELECT * FROM `projects` ORDER BY `id` DESC LIMIT 3");
            while ($row = mysqli_fetch_array($queryGetProjects, MYSQLI_ASSOC)) {
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-box1 wow fadeInUp" data-wow-delay=".4s">

            <!--<div class="item-img" style="background-image: url('admin/<?= $row["image_link"] ?>');background-size: cover;background-repeat: no-repeat;background-position: center;height:250px;width:100%;">-->
                        <div class="item-img item-img_thumb">
                            <a href="project_detail?id=<?= $row['id'] ?>">
                                <img src="admin/<?= $row["image_link"] ?>" />
                            </a>
                        </div>

                        <div class="thumbnail-date">
                            <div class="popup-date">

                                <span class="month"><?= $row['ribbon'] ?></span>                                    
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="entry-meta">
                                <ul>
                                    <li><?= $row['type'] ?></li>
                                </ul>
                            </div>
                            <div class="heading-title">
                                <h3><a href="project_detail?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></h3>
                            </div>
                            <div class="blog-button">
                                <a href="project_detail?id=<?= $row['id'] ?>" class="item-btn">View Details<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>

<?php include'includes/footer.php'; ?>
<script>

    $(document).ready(function () {


        $('#asearch').click(function (e) {
            var keyword = $('#asearch_keyword').val();
            var type = $('#asearch_type').val();
            var city = $('#asearch_city').val();

            window.location = "listing?advance_search=true&keyword=" + keyword + "&property-type=" + type + "&city=" + city;
//        e.prevantDefault();
        });
    });
</script>