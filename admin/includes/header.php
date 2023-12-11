<?php
ob_start();
include 'dataBase.php';
session_start();
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Internal Portal - TeamWork</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
        <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/editable.css" rel="stylesheet">
        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/plugins/dropzone/basic.css" rel="stylesheet">
        <link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery-2.1.1.js"></script>
    </head>
    <body>
        <?php
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user']['id'];

            $currency_sign = 'USD';


            $role = $db->getEachById($con, 'role', 'users', $id);
        }
        ?>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                                    <img alt="image" class="img-circle" src="img/<?= $db->getEachById($con, 'image', 'users', $id); ?>" style="max-width: 48px;" />
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $db->getEachById($con, 'contact_name', 'users', $id); ?></strong>
                                        </span> <span class="text-muted text-xs block">Options<b class="caret"></b></span> </span> </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="settings">Update profile photo</a></li>
                                    <!--<li><a href="view_all_clients">Clients</a></li>-->
                                    <li class="divider"></li>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element" title="Bingo.">
                                <div style="padding: 5px;"><img src="https://teamworkpk.com/admin/img/thumb_1652958830teamwrk%20logo_2643658965.png" class="img-responsive"/></div>
                            </div>
                        </li>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
                        </li>
                        <?php if ($role == 'client') { ?>
                            <li <?php
                            if (basename($_SERVER['PHP_SELF']) == 'new_request.php') {
                                echo 'class="active"';
                            }
                            ?>>
                                <a href="new_request"><i class="fa fa-plus-circle "></i> <span class="nav-label">New Request</span> </a>
                            </li>
                        <?php } ?>
                        <?php if ($role == 'admin') { ?> 
                            <!--                        <li <?php
                            if (basename($_SERVER['PHP_SELF']) == 'categories.php') {
                                echo 'class="active"';
                            }
                            ?>
                                                        <a href="categories"><i class="fa fa-list"></i> <span class="nav-label">Categories</span></a>
                                                    </li>-->
                        <?php } ?>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'view_all_leads.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="view_all_leads"><i class="fa fa-bars"></i> <span class="nav-label">Leads</span><span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                                <li <?php
                                if (basename($_SERVER['PHP_SELF']) == 'view_all_leads.php') {
                                    echo 'class="active"';
                                }
                                ?>><a href="view_all_leads">View All Leads</a></li>
                                <li <?php
                                if (basename($_SERVER['PHP_SELF']) == 'add_leads.php') {
                                    echo 'class="active"';
                                }
                                ?>><a href="add_leads">Add Leads</a></li>
                            </ul>
                        </li>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'web_requests.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="web_requests"><i class="fa fa-weibo"></i> <span class="nav-label">Web Requests</span><span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                                <li <?php
                                if (basename($_SERVER['PHP_SELF']) == 'web_requests.php') {
                                    echo 'class="active"';
                                }
                                ?>><a href="web_requests">View Web Requests</a></li>
                                    <?php if ($role == 'admin') { ?>

                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'add_requests.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="../add_property">Add Requests</a></li>

                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'web_requests.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="web_requests?verification_status=0">New Requests <span class="label label-warning float-right"><?= $db->count_rows_new_web($con, 'web_posts'); ?> New</span> </a></li>

                                <?php } ?>
                            </ul>
                        </li>

                        <?php if ($role == 'admin') { ?>
                            <li <?php
                            if (basename($_SERVER['PHP_SELF']) == 'view_all_users.php') {
                                echo 'class="active"';
                            }
                            if (basename($_SERVER['PHP_SELF']) == 'add_users.php') {
                                echo 'class="active"';
                            }
                            ?> >
                                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'view_all_users.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="view_all_users">View All Users</a></li>
                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'add_users.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="add_users">Add Users</a></li>

                                </ul>
                            </li>
                        <?php } ?>

                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'projects.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="projects"><i class="fa fa-building"></i> <span class="nav-label">Projects</span><span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                                <li <?php
                                if (basename($_SERVER['PHP_SELF']) == 'projects.php') {
                                    echo 'class="active"';
                                }
                                ?>><a href="projects">View Projects</a></li>
                                    <?php if ($role == 'admin') { ?>

                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'add_projects.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="add_projects">Add Projects</a></li>
                                    <?php } ?>
                            </ul>
                        </li>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'careers.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="careers"><i class="fa fa-headphones"></i> <span class="nav-label">Careers</span><span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                                <li <?php
                                if (basename($_SERVER['PHP_SELF']) == 'careers.php') {
                                    echo 'class="active"';
                                }
                                ?>><a href="careers">Careers</a></li>
                                    <?php if ($role == 'admin') { ?>

                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'add_careers.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="add_careers">Add Jobs</a></li>
                                    <?php } ?>
                            </ul>
                        </li>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'cash_clients.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="cash_clients"><i class="fa fa-dollar"></i> <span class="nav-label">Cash Clients</span><span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                                <li <?php
                                if (basename($_SERVER['PHP_SELF']) == 'cash_clients.php') {
                                    echo 'class="active"';
                                }
                                ?>><a href="cash_clients">Cash Clients</a></li>
                                    <?php if ($role == 'admin') { ?>

<!--                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'add_cash_clients.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="add_cash_clients">Add Cash Clients</a></li>-->
                                    <li <?php
                                    if (basename($_SERVER['PHP_SELF']) == 'cash_properties.php') {
                                        echo 'class="active"';
                                    }
                                    ?>><a href="cash_properties">Cash Properties</a></li>
                                    <?php } ?>
                            </ul>
                        </li>

                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'courses.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="courses"><i class="fa fa-stumbleupon"></i> <span class="nav-label">Courses</span> </a>
                        </li>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'help.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="help"><i class="fa fa-question-circle"></i> <span class="nav-label">Help</span> </a>
                        </li>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'unit.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="unit" class="btn-danger"><i class="fa fa-question-circle"></i> <span class="nav-label">Unit Size</span> </a>
                        </li>
                        <li <?php
                        if (basename($_SERVER['PHP_SELF']) == 'logout.php') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span> </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary hidden-lg" href="#"><i class="fa fa-bars"></i> </a>
                            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                                <div class="form-group">
                                    <!--<input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">-->
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span class="m-r-sm text-muted welcome-message">Welcome to <strong>TeamWork's</strong> Portal.</span>
                            </li>
                            <li>
                                <a href="lock?id=<?= $id ?>">
                                    <i class="fa fa-lock"></i>Lock
                                </a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                    <i class="fa fa-bell"></i>  <span class="label label-primary"><?= $db->count_rows_new_web($con, 'web_posts') + $db->count_rows_new($con, 'internal_leads'); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-alerts">
                                    <li>
                                        <a href="web_requests?verification_status=0" class="dropdown-item">
                                            <div>
                                                <i class="fa fa-weibo fa-fw"></i> You have <?= $db->count_rows_new_web($con, 'web_posts') ?> Web Request
                                                <span class="float-right text-muted small"><?= $db->getElapsedTime($db->getLatestTimeStamp($con, 'web_posts')); ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a href="view_all_leads?status=new" class="dropdown-item">
                                            <div>
                                                <i class="fa fa-bars fa-fw"></i> <?= $db->count_rows_new($con, 'internal_leads'); ?> New Leads
                                                <span class="float-right text-muted small"><?= $db->getElapsedTime($db->getLatestTimeStamp($con, 'internal_leads')); ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a href="courses" class="dropdown-item">
                                            <div>
                                                <i class="fa fa-stumbleupon fa-fw"></i>Total <strong><?= $db->count_rows($con, 'enrollment'); ?></strong> Enrollments
                                                <span class="float-right text-muted small"><?= $db->getElapsedTime($db->getLatestTimeStamp($con, 'enrollment')); ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <div class="text-center link-block">
                                            <a href="#" class="dropdown-item">
                                                <strong>See All Notifications</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="logout">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>