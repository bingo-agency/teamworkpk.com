<?php
include'includes/header.php';

if (!isset($_SESSION['public_user'])) {
    $db->redirect('login');
} else {
    $id = $_SESSION['public_user']['id'];
}
if (isset($_GET['selected'])) {
    $selected = $_GET['selected'];
} else {
    $db->redirect('account?selected=profile');
}
if (isset($_GET['del_post_id'])) {
    $del_post_id = $_GET['del_post_id'];
    $query_del = mysqli_query($con, "DELETE FROM `web_posts` WHERE `id` = '" . $del_post_id . "'");
//    echo "DELETE FROM `web_posts` WHERE `id` = '" . $del_post_id . "'";
//    exit();
    if ($query_del) {
        $db->redirect('account?selected=ads');
        exit();
    }
}
?>
<style>
    .rld-main-search3 .filter-button{
        margin-top: 1px;
    }
    .rld-main-search3 .filter-button .search-btn{
        text-align: left;
        letter-spacing: 1px;
        font-size: 13px;
    }
    .btn-primary {
        color: #fff;
        background-color: #6f1c74;
        border-color: #5e1863;
    }
    .btn-primary:hover{
        background-color: #5e1863;
        border-color: #6f1c74;
    }
</style>
<div class="breadcrumb-wrap breadcrumb-wrap-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="account">Account</li>
            </ol>
        </nav>
    </div>
</div>
<section class="grid-wrap3">
    <div class="container">
        <div class="row gutters-40">
            <div class="col-lg-4 widget-break-lg sidebar-widget">
                <div class="widget widget-advanced-search">
                    <!--<h3 class="widget-subtitle">Advanced Search</h3>-->

                    <div class="banner-search-wrap banner-search-wrap-2">
                        <img style="border: 2px solid #eee;border-radius: 50%;width: 100%" src="<?= $db->getEachById($con, 'image', 'public_users', $id) ?>" />
                    </div>
                    <div class="banner-search-wrap banner-search-wrap-2">
                        <div class="rld-main-search rld-main-search3">
                            <strong><?= $db->getEachById($con, 'name', 'public_users', $id); ?></strong>
                            <div class="filter-button">
                                <a href="account?selected=profile" class="filter-btn1 search-btn"><i class="fas fa-user"></i> Edit Profile</a>
                            </div>
                            <div class="filter-button">
                                <a href="account?selected=fav" class="filter-btn1 search-btn"><i class="fas fa-heart"></i> Favourites</a>
                            </div>
                            <div class="filter-button">
                                <a href="account?selected=ads" class="filter-btn1 search-btn"><i class="fas fa-ad"></i> Manage Ads</a>
                            </div>
                            <div class="filter-button">
                                <a href="logout" class="filter-btn1 search-btn"><i class="fas fa-lock"></i> Log Out</a>
                            </div>
                        </div>
                        <!--/ End Profile Section -->
                    </div>
                </div>

                <br />
                <br />
                <br />
                <br />
            </div>
            <div class="col-lg-8">

                <div class="tab-style-1 tab-style-3">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    switch ($selected) {
                                        case 'profile':
                                            ?> 
                                                                                                                                                                                                                                    <!--<h1>Hello,<?= $db->getEachById($con, 'name', 'public_users', $id) ?></h1>-->
                                            <div class="property-box2 property-box4 wow animated fadeInUp" data-wow-delay=".6s">

                                                <?php
                                                if (isset($_POST['submit_pro'])) {
                                                    echo $phone = mysqli_real_escape_string($con, $_POST['phone']);
                                                    echo $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
                                                    echo $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
                                                    echo $savedPass = mysqli_real_escape_string($con, $db->getEachById($con, 'password', 'puclic_users', $id));

                                                    if (empty($old_password) || empty($new_password)) {
                                                        $db->error("All fields are required.");
                                                    }
                                                    if ($old_password != $db->getEachById($con, 'password', 'puclic_users', $id)) {
                                                        $db->error("Your Old Password seems incorrect");
                                                    } else {
                                                        $queryUpdatePro = mysqli_query($con, "UPDATE `public_users` SET `phone` = '$phone',`password` = '" . $new_password . "' WHERE `id`= '" . $id . "'");
                                                        if ($queryUpdatePro) {
                                                            $db->redirect('account?selected=profile');
                                                        } else {
                                                            echo "UPDATE `public_users` SET `phone` = '$phone',`password` = '$new_password' WHERE `id`= '" . $id . "'";
                                                        }
                                                    }
                                                }
                                                ?>
                                                <form action="#" method="post">
                                                    <div class="form-group">
                                                        <label for="email">Email address</label>
                                                        <input type="email" disabled="" class="form-control" id="email" value="<?= $db->getEachById($con, 'email', 'public_users', $id); ?>" placeholder="Enter email">
                                                        <small id="emailHelp" class="form-text text-muted">This is your username, Can not be changed.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="tel" class="form-control" name="phone" id="phone" value="<?= $db->getEachById($con, 'phone', 'public_users', $id); ?>" placeholder="Enter your phone">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Old Password</label>
                                                        <input type="password" class="form-control" name="old_password" id="password" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">New Password</label>
                                                        <input type="password" class="form-control" name="new_password" id="password" placeholder="Password">
                                                    </div>

                                                    <button type="submit" name="submit_pro" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                            <?php
                                            break;
                                        case 'ads':
                                            ?> 
                                            <div class="wow animated fadeInUp" data-wow-delay=".6s">

                                                <div class="tab-style-1 tab-style-3">
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                                                            <div class="row">
                                                                <?php
                                                                $query = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `public_user_id` = '" . $id . "'ORDER by `id` DESC");
                                                                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                                    ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="property-box2 property-box4 wow animated fadeInUp" data-wow-delay=".6s">


                <!--<div class="item-img" style="background-image: url('<?= $row['primary_image'] ?>');background-size:cover;background-repeat:no-repeat;height:200px;width:250px;background-position:center">-->
                                                                            <div class="item-img item-img_thumb_listing">
                                                                                <a href="listing_detail?post_id=<?= $row['id'] ?>">
                                                                                    <img src="<?= $row['primary_image'] ?>" alt="<?= $row['title'] ?>"  />
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
                                                                                <div class="location-area"><i class="flaticon-maps-and-flags"></i><?= $row['address'] ?><?= $row['city'] ?></div>
                                                                                <div class="item-categoery3">
                                                                                    <ul>
                                                                                        <li><i class="flaticon-two-overlapping-square"></i><?= $row['land_area'] ?></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <!--remove icon button-->
                                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#remove<?= $row['id']; ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>


                                                                        </div>
                                                                    </div>

                                                                <?php }
                                                                ?>

                                                            </div>
                                                            <!--                                                            <div class="pagination-style-1">
                                                                                                                                    <ul class="pagination">
                                                                                                                                        <li class="page-item">
                                                                                                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                                                                                                <span aria-hidden="true">&laquo;</span>
                                                                                                                                                <span class="sr-only">Previous</span>
                                                                                                                                            </a>
                                                                                                                                        </li>
                                                                                                                                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                                                                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                                                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                                                                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                                                                                                        <li class="page-item">
                                                                                                                                            <a class="page-link" href="#" aria-label="Next">
                                                                                                                                                <span aria-hidden="true">&raquo;</span>
                                                                                                                                                <span class="sr-only">Next</span>
                                                                                                                                            </a>
                                                                                                                                        </li>
                                                                                                                                    </ul>
                                                                                                                                </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            break;
                                        case 'fav':
                                            ?> 
                                            <div class="wow animated fadeInUp" data-wow-delay=".6s">

                                                <div class="tab-style-1 tab-style-3">
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                                                            <div class="row">
                                                                <?php
                                                                $getPostIds = "SELECT * FROM `fav` WHERE `public_user_id` = '$id'";
                                                                $getPostIdsQuery = mysqli_query($con,$getPostIds);
                                                                while($row = mysqli_fetch_assoc($getPostIdsQuery)) {
                                                                    $fav_items[] = $row['web_post_id'];
                                                                }
                                                                if (!empty($fav_items)) {
                                                                    $fav_items_str = implode(',', $fav_items);
                                                                
                                                                    $gettingPosts = "SELECT * FROM `web_posts` WHERE id IN ($fav_items_str)";
                                                                    $gettingPostsQuery = mysqli_query($con,$gettingPosts);

                                                                
                                                                    
                                                                // $query = mysqli_query($con, "SELECT * FROM `fav` WHERE `public_user_id` = '" . $id . "'ORDER by `id` DESC");
                                                                while ($row = mysqli_fetch_array($gettingPostsQuery)) {
                                                                    ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="property-box2 property-box4 wow animated fadeInUp" data-wow-delay=".6s">


                <!--<div class="item-img" style="background-image: url('<?= $row['primary_image'] ?>');background-size:cover;background-repeat:no-repeat;height:200px;width:250px;background-position:center">-->
                                                                            <div class="item-img item-img_thumb_listing">
                                                                                <a href="listing_detail?post_id=<?= $row['id'] ?>">
                                                                                    <img src="<?= $row['primary_image'] ?>" alt="<?= $row['title'] ?>"  />
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
                                                                                <div class="location-area"><i class="flaticon-maps-and-flags"></i><?= $row['address'] ?><?= $row['city'] ?></div>
                                                                                <div class="item-categoery3">
                                                                                    <ul>
                                                                                        <li><i class="flaticon-two-overlapping-square"></i><?= $row['land_area'] ?></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <!--remove icon button-->
                                                                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#remove<?= $row['id']; ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button> -->


                                                                        </div>
                                                                    </div>
                                                                <?php 
                                                                }}
                                                                else {
                                                                    echo "<h6>There is no Favourite property</h6>";
                                                                }
                                                                ?>

                                                            </div>
                                                            <!--                                                            <div class="pagination-style-1">
                                                                                                                            <ul class="pagination">
                                                                                                                                <li class="page-item">
                                                                                                                                    <a class="page-link" href="#" aria-label="Previous">
                                                                                                                                        <span aria-hidden="true">&laquo;</span>
                                                                                                                                        <span class="sr-only">Previous</span>
                                                                                                                                    </a>
                                                                                                                                </li>
                                                                                                                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                                                                                                <li class="page-item">
                                                                                                                                    <a class="page-link" href="#" aria-label="Next">
                                                                                                                                        <span aria-hidden="true">&raquo;</span>
                                                                                                                                        <span class="sr-only">Next</span>
                                                                                                                                    </a>
                                                                                                                                </li>
                                                                                                                            </ul>
                                                                                                                        </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            break;
                                        default:
                                            $db->redirect('account?selected=ads');
                                    }
                                    ?>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <br />
                <br />
                <br />
            </div>
        </div>
    </div>
</section>
<?php
$query = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `public_user_id` = '" . $id . "'ORDER by `id` DESC");
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    ?>
    <!-- delete Modal -->
    <div class="modal fade" id="remove<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $row['title'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="height:200px;width:100%;background-image: url('<?= $row['primary_image'] ?>');background-position:center;background-size:cover;border:2px solid #eee;box-shadow: 2px 2px 10px #00000069;padding:10px;" class="img-thumbnail"></div> 
                    <!--<img src="<?= $row['primary_image'] ?>" class="img-responsive img-rounded img-thumbnail" style="max-height:150px;"  /><br /><strong><?= $row['title'] ?></strong><br />-->
                    Are you sure you want to remove this property ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="account?selected=ads&del_post_id=<?= $row['id'] ?>" class="btn btn-primary">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal ends-->
<?php } ?>
<?php include'includes/footer.php'; ?>
<script>
    function remove(value) {

        alert(value);
    }
</script>