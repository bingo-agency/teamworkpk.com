<?php
ob_start();
session_start();
include 'admin/includes/dataBase.php';


if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
if (isset($_SESSION['public_user'])) {
    $public_user_id = $_SESSION['public_user']['id'];
}

function active($currect_page) {
    $url_array = explode('/', $_SERVER['REQUEST_URI']);
    $url = end($url_array);
    if ($currect_page == $url) {
        echo 'active'; //class name in css 
    }
}
?>

<!--<style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
        </style>-->

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <title>TeamWork Est</title>
        <meta name="description" content="TeamWork is an asset management company that provides the best value of secure future investment returns in exchange for property" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#5F1964" />
        <!-- Favicon Start Here -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="css/jquery-ui.css" />
        <!-- Bootstrap Css Start Here -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <!-- Animate Css Start Here -->
        <link rel="stylesheet" href="css/animate.min.css" />
        <!-- Owl Carousel Start Here -->
        <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css" />
        <link
            rel="stylesheet"
            href="vendor/owlcarousel/owl.theme.default.min.css"
            />
        <!-- Swiper Css Start Here -->
        <link rel="stylesheet" href="css/swiper-bundle.min.css" />
        <!-- Flaticon Css Start Here -->
        <link rel="stylesheet" href="css/flaticon/font/flaticon.css" />
        <!-- Select Css Start Here -->
        <link rel="stylesheet" href="css/nice-select.css" />
        <!-- Animate Css Start Here -->
        <link rel="stylesheet" href="css/animate.min.css" />
        <!-- Pop Up Css Start Here -->
        <link rel="stylesheet" href="css/magnific-popup.css" />
        <!-- All min Css Start Here -->
        <link rel="stylesheet" href="css/all.min.css" />
        <!-- Pannellum -->
        <link rel="stylesheet" href="css/pannellum.css" />
        <!-- noUIrangle slider -->
        <link rel="stylesheet" href="vendor/noUiSlider/nouislider.min.css" />
        <!-- Style Css Start Here -->
        <link rel="stylesheet" href="style.css" />
        <!-- Google Font Start Here -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Ubuntu:wght@400;500;700&display=swap"
            rel="stylesheet"
            />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap"
            rel="stylesheet"
            />
    </head>
    <script>
            function numberFormatter(num) {
        if (num >= 1000000000000) {
    return (num / 1000000000000).toFixed(1).replace(/\.0$/, '') + ' Arab';
    }
    if (num >= 10000000) {
        return (num / 10000000).toFixed(1).replace(/\.0$/, '') + ' Crore';
    }
    if (num >= 100000) {
        return (num / 100000).toFixed(1).replace(/\.0$/, '') + ' Lakh';
    }
    if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + ' Thousand';
    }
    return num;

}
    </script>

    <body class="sticky-header">
        <!--[if IE]>
          <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
          </p>
        <![endif]-->
        <!--=====================================-->
        <!--=   Preloader     Start             =-->
        <!--=====================================-->

        <div id="preloader"></div>
        <!--=====================================-->
        <!--=   Preloader     End               =-->
        <!--=====================================-->
        <div class="wrapper" id="wrapper">
        
            <!--=====================================-->
            <!--=   App Install Banner Start        =-->
            <!--=====================================-->

            

            <!--=====================================-->
            <!--=   Header     Start             =-->
            <!--=====================================-->

            <header class="rt-header sticky-on">
                <div id="sticky-placeholder"></div>
                <div id="navbar-wrap" class="header-menu menu-layout1 header-menu menu-layout2">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo-area">
                                    <a href="index" class="temp-logo">
                                        <!--<img src="img/logo.svg" width="157" height="40" alt="logo" class="img-fluid">-->
                                        <img src="img/teamWrk.png" width="157" height="40" alt="logo" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 d-flex justify-content-end position-static">
                                <nav id="dropdown" class="template-main-menu template-main-menu-3" style="float: right">
                                    <ul>
                                        <li>
                                            <a href="index">Home</a>
                                        </li>
                                        <li>
                                            <a href="listing">Listings</a>
                                        </li>
                                        <li>
                                            <a href="projects">Projects</a>
                                        </li>
                                        <li>
                                            <a href="careers">Careers</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-flex justify-content-end">
                                <div class="header-action-layout1">
                                    <ul class="action-list">



                                        <li class="action-item-style my-account">
                                            <a href="account">
                                                <i class="flaticon-user-1 icon-round"></i>
                                            </a>
                                        </li>


                                        <li class="listing-button">
                                            <a href="add_property" class="listing-btn">
                                                <span>
                                                    <i class="fas fa-plus-circle"></i>
                                                </span>
                                                <span class="item-text">Add Property</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </header>
            <div
                class="rt-header-menu mean-container position-relative"
                id="meanmenu">
                <div class="mean-bar">
                    <a href="./">
                        <img src='img/teamWrk.png' style="max-width:200px" alt='logo' class='img-fluid'/>
                    </a>
                    <div class="mean-bar--right">
                        <!--                        <div class="actions search">
                                                    <a href="#" class="item-icon" title="Search">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                </div>-->
                        <div class="actions user">
                            <a href="account"><i class="flaticon-user-1 icon-round" style="color:#6f1c74;"></i></a>
                        </div>
                        <div class="actions user">
                            <a href="add_property"><i class="fa fa-plus-circle" title="Add Property" style="color:#6f1c74;"></i></a>
                        </div>
                        <span class="sidebarBtn">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </span>
                    </div>
                </div>
                <div class="rt-slide-nav">
                    <div class="offscreen-navigation">
                        <nav class="menu-main-primary-container">
                            <ul class="menu">
                                <li class="list menu-item-parent">
                                    <a class="animation" href="listing">Listing</a>
                                </li>

                                <li class="list menu-item-parent">
                                    <a class="animation" href="projects">Projects</a>
                                </li>
                                <li class="list menu-item-parent">
                                    <a class="animation" href="careers">Careers</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="app_install_banner d-sm-none" style="border-bottom: 2px solid #eee;box-shadow: 2px 12px 12px #00000069;">
                <div class="row align-items-center">
                    <div class="col-1"><img src="img/close_icon.png" class="banner_close"></div>
                    <div class="col-2"><img src="img/anotherLogo.png" class="" style="padding:10px;"></div>
                    <div class="col-5 col-sm-6" style="padding-top: 21px;">
                        <!-- <h6 class="">Teamwork</h6> -->
                    <p>Teamwork - in Google Play</p></div>
                    <div class="col-4 col-sm-3 d-flex justify-content-center"><button class="btn btn-primary app-install-btn"><a href="https://play.google.com/store/apps/details?id=com.teamworkpk.teamwork&hl=en&gl=US" class="app-install-btn-link">Get App</a></button></div>
                </div>
            </div>
            <!--=====================================-->
            <!--=   Main Banner     Start           =-->
            <!--=====================================-->
