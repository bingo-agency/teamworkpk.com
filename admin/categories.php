<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {

    $db->add_user_activity($con, "Checking all categories on <a href='categories'>Categories</a> ");
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-list"></i> Categories</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Manage Categories</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Categories <small>List of all Categories.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php
                    if (isset($_GET['msg'])) {
                        $db->success('<strong>Awesome !</strong> Your record has been updated!');
                    }
                    if (isset($_GET['msg_add'])) {
                        $db->success('<strong>Perfect !</strong> Your category has been added!');
                    }
                    if (isset($_GET['msg_del'])) {
                        $db->error('<strong>Okay !</strong> Your category has been removed!');
                    }

                    if (isset($_GET['del_id'])) {
                        $del_id = $_GET['del_id'];
                        $query_delete = mysqli_query($con, "DELETE FROM `categories` WHERE `id` = '" . $del_id . "'");
                        if ($query_delete) {
                            $db->redirect('categories?msg_del');
                        } else {
                            $db->error('<strong>Error ! </strong>Your category can not be deleted.');
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if (isset($_POST['addCategory'])) {
                                $categoryName = $_POST['categoryName'];
                                $mainCategory = $_POST['mainCategory'];

                                $queryAddCategory = mysqli_query($con, "INSERT INTO `categories` SET `name` = '" . $categoryName . "',`main_category` = '" . $mainCategory . "'");
                                if ($queryAddCategory) {
                                    $db->redirect('categories?msg_add');
                                } else {
                                    $db->error("<strong>Error !</strong> Your category can not be added at this time, contact Admin support.");
                                }
                            }
                            ?>
                            <form role="form" class="form-inline" action="##" method="post">
                                <div class="form-group">
                                    <label for="categoryname" class="sr-only">Category Name</label>
                                    <input type="text" placeholder="Category Name" name="categoryName" id="categoryname" class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <label for="mainCategory" class="sr-only">Main Category</label>
                                    <select class="form-control" name="mainCategory" id="mainCategory">
                                        <option value="design">design</option>
                                        <option value="marketing">marketing</option>
                                        <option value="web">web</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" name="addCategory" type="submit">Add Category</button>
                            </form>
                        </div>
                        <hr />
                        <div class="">
                            <br /><hr />
                            <div class="col-lg-12"><h3>All Categories.</h3></div>
                            <br>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <h3>Design</h3>
                                    <div class="taskList">
                                        <?php
                                        $queryGetAllDesign = mysqli_query($con, "SELECT * FROM `categories` WHERE `main_category` = 'design'");
                                        while ($row = mysqli_fetch_array($queryGetAllDesign, MYSQLI_ASSOC)) {
                                            ?>
                                            <div class="widget style1 navy-bg">
                                                <h3><a href="category_detail_list?cat_id=<?=$row['id']?>" style="color:white;"><?= $row['name'] ?></a></h3>
                                                <span><?= $row['main_category'] ?></span>
                                                <a title="Remove" href="categories?del_id=<?= $row['id'] ?>" style="color:white"><span class="pull-right"><i class="fa fa-remove"></i></span></a>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h3>Marketing</h3>
                                    <div class="taskList">
                                        <?php
                                        $queryGetAllmarketing = mysqli_query($con, "SELECT * FROM `categories` WHERE `main_category` = 'marketing'");
                                        while ($row = mysqli_fetch_array($queryGetAllmarketing, MYSQLI_ASSOC)) {
                                            ?>
                                            <div class="widget style1 navy-bg">
                                                <h3><?= $row['name'] ?></h3>
                                                <span><?= $row['main_category'] ?></span>
                                                <a title="Remove" href="categories?del_id=<?= $row['id'] ?>" style="color:white"><span class="pull-right"><i class="fa fa-remove"></i></span></a>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h3>Web</h3>
                                    <div class="taskList">
                                        <?php
                                        $queryGetAllweb = mysqli_query($con, "SELECT * FROM `categories` WHERE `main_category` = 'web'");
                                        while ($row = mysqli_fetch_array($queryGetAllweb, MYSQLI_ASSOC)) {
                                            ?>
                                            <div class="widget style1 navy-bg">
                                                <h3><?= $row['name'] ?></h3>
                                                <span><?= $row['main_category'] ?></span>
                                                <a title="Remove" href="categories?del_id=<?= $row['id'] ?>" style="color:white"><span class="pull-right"><i class="fa fa-remove"></i></span></a>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>