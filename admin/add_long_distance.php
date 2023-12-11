<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Adding LD on <a href='add_long_distance'>Add LD Data</a> ");
}
?>
<?php
if ($role != 'admin') {
    $db->redirect('dashboard');
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-phone"></i> Long Distance</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Add LD Data</strong>
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
                    <h5>Add LD Data <small>Add new Data to your partner center LD.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <!--                        <a class="close-link">
                                                    <i class="fa fa-times"></i>
                                                </a>-->
                    </div>
                </div>
                <div class="ibox-content">
                    <?php
                    if (isset($_POST['submit'])) {
                        $team_id = $_POST['team_id'];
                        $date_made = mysqli_real_escape_string($con,$_POST['date_made']);
                        $ld_cost = mysqli_real_escape_string($con,$_POST['ld_cost']);

                        if (empty($team_id) || empty($date_made) || empty($ld_cost)) {
                            $db->error('All fields are required !');
                        }
                        if (!empty($team_id) && !empty($date_made) && !empty($ld_cost)) {
                            $query = mysqli_query($con, "INSERT INTO `long_distance` SET `team_id`='" . $team_id . "',`date_made` = '" . $date_made . "', `ld_cost` = '" . $ld_cost . "'");
                            if (!$query) {
//                                    print($query);
//                                    echo $query;
                                $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
                            } else {
                                $db->add_user_activity($con, "Added a new data to LD for <strong>" . $team_id . "</strong>");
                                $db->redirect('long_distance?msg_add');
                            }
                        }
                    }
                    if (isset($_GET['msg'])) {
                        $db->success('<strong>Thank you</strong> Your Lead has been added!');
                    }
                    ?>
                    <form action="#" method="POST" class="form-horizontal">

                        <div class="form-group"><label class="col-lg-2 control-label">Team Name</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="team_id">
                                    <?php
                                    $getAllTeams = mysqli_query($con, "SELECT * FROM `users` WHERE `role` = 'team'");
                                    while ($eachTeam = mysqli_fetch_assoc($getAllTeams)) {
                                        ?>
                                        <option value="<?= $eachTeam['id'] ?>"><?= $eachTeam['contact_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-lg-2 control-label">Date Made</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="date_made" value="<?php
                                if (isset($_POST['date_made'])) {
                                    echo $_POST['date_made'];
                                }
                                ?>" placeholder="Date Made"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">LD Cost</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="ld_cost" value="<?php
                                if (isset($_POST['ld_cost'])) {
                                    echo $_POST['ld_cost'];
                                }
                                ?>" placeholder="Long Distance Cost"></div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="long_distance" class="btn btn-white" >Cancel</a>
                                <input name="submit" class="btn btn-primary" type="submit" value="Add LD" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'includes/footer.php'; ?>