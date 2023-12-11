<?php
include'includes/header.php';
if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Checking on web requests's on <a href='web_requests'>Web Requests's</a> ");
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>
            <i class="fa fa-bars"></i> 
            Unit Size</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Unit Size</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Unit Size</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Entry Title</th>
                        <th>Current Land Size</th>
                        <th>New Size</th>
                        <th>Select Unit</th>
                        <th>Submit Size</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($_POST['submit'])) {
                        $selected_unit = $_POST['selected-unit'];
                        $selected_size = $_POST['selected-size'];
                        $fetched_id = $_POST['id'];
                        $update_query = "UPDATE `web_posts` SET `land_area` = '$selected_size', `unit_size` = '$selected_unit' WHERE `web_posts`.`id` = $fetched_id";
                        $execution = mysqli_query($con, $update_query);
                        }
                        $select = "SELECT * FROM `web_posts` WHERE `unit_size` IS NULL";
                        $query = mysqli_query($con, $select);
                        while($fetch = mysqli_fetch_assoc($query)) {
                        ?>
                    <tr class="gradeX">
                    <form action="" method="post">
                    <td><a href="<?php echo '../listing_detail?post_id=' . $fetch['id']; ?>"><?php echo $fetch['title']; ?></a></td>
                        <td><?= $fetch['land_area']; ?></td>
                        <td><input class="form-control" name="selected-size" type="number"></td>
                        <td>
                        <select name="selected-unit" id="" class="form-control">
                            <option value="Marla">Marla</option>
                            <option value="Sqft">Sqft</option>
                            <option value="Acre">Acre</option>
                            <option value="Kanal">Kanal</option>
                        </select>
                        <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
                    </td>
                    <td><button class="btn-danger btn" type="submit" name="submit">Submit</button></td>
                    </form>
                    </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Entry Title</th>
                        <th>Current Land Size</th>
                        <th>New Size</th>
                        <th>Select Unit</th>
                        <th>Submit Size</th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>


<?php include'includes/footer.php'; ?>