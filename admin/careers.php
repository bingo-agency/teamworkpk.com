<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Was viewing their own <strong>Activity</strong>.");
}

if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $queryDel = mysqli_query($con, "DELETE FROM `job_posts` WHERE `id` = '" . $del_id . "'");
    if ($queryDel) {
        $db->redirect('careers');
        exit();
    }
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-headphones"></i> Careers</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Careers</strong>
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
                    <h5>Careers <small>List of all Jobs.</small></h5>
                </div>
                <div class="ibox-content">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline table-responsive">
                        <div class="DTTT_container">
                        </div>
                        <div class="clear"></div>
                        <table
                            class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline"
                            id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 5%;" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">#id</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Icon</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Job Title</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;"
                                        aria-label="Platform(s): activate to sort column ascending">City</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;"
                                        aria-label="Platform(s): activate to sort column ascending">Seats</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 15%;"
                                        aria-label="CSS grade: activate to sort column ascending">TimeStamp</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 15%;"
                                        aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($role != 'team') {
                                    $query = mysqli_query($con, "SELECT * FROM `job_posts` ORDER BY `id` DESC");


                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                <tr class="gradeA odd" role="row">
                                    <td class="sorting_1">
                                        <?= $row['id'] ?>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="#" data-toggle="modal" data-target="#company<?= $row['id'] ?>"
                                                style="font-size:50px;">
                                                <i class="<?= $row['image']; ?>"
                                                    style="color:#6f1c74;text-shadow:0px 0px 3px #eee;"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <?= $row['title'] ?>
                                    </td>
                                    <td>
                                        <?= $row['city'] ?>
                                    </td>
                                    <td class="center">
                                        <?= $row['available_seats']; ?>
                                    </td>
                                    <td class="center">
                                        <?= $db->getElapsedTime($row['timestamp']) ?>
                                    </td>
                                    <td class="center"><a href="edit_job?id=<?= $row['id'] ?>" title="Edit"
                                            class="btn btn-primary"><i class="fa fa-edit"></i></a> <a
                                            class="btn btn-danger" title="Remove"
                                            href="careers?del_id=<?= $row['id'] ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <!-- Modal for company -->

                                <div class="modal fade" id="company<?= $row['id'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">
                                                    <center>
                                                        <?= $db->getEachById($con, 'title', 'web_posts', $row['id']) ?>
                                                    </center>
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="dl-horizontal">
                                                    <dt style="font-size:50px;"><i class="<?= $row['image']; ?>"
                                                            style="color:#6f1c74;text-shadow:0px 0px 3px #eee;"></i>
                                                    </dt>
                                                    <dd style="padding-top: 10%">
                                                        <h3>
                                                            <?= $row['title']; ?>
                                                        </h3>
                                                    </dd>
                                                    <dd><small>&nbsp;</small></dd>
                                                    <dt>Seats</dt>
                                                    <dd>
                                                        <?= $row['available_seats'] ?>
                                                    </dd>
                                                    <dt>Description</dt>
                                                    <dd>
                                                        <?= $row['description'] ?>
                                                    </dd>
                                                    <dt>TimeStamp</dt>
                                                    <dd>
                                                        <?= $db->getEachById($con, 'timestamp', 'projects', $row['id']) ?>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <!--                        <div class="col-lg-12">
                    
                                            </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row"> -->
    <!-- <div class="container"> -->
        <table class="table table-hover" id="example">
            <thead>
                <tr style="background-color:white; color:black">
                    <th class="thead">ID</th>
                    <th class="thead">JOB_POST_ID</th>
                    <th class="thead">NAME</th>
                    <th class="thead">EMAIL</th>
                    <th class="thead">FILE</th>
                    <th class="thead">PHONE</th>
                    <th class="thead">Actions</th>
                </tr>
            </thead>
            <?php
    if (isset($_GET['d_id'])) {
        $d_id = $_GET['d_id'];
        $queryDel = mysqli_query($con, "DELETE FROM `resume` WHERE `id` = '" . $d_id . "'");
        if ($queryDel) {
            $db->redirect('careers');
            exit();
        }
    }
    // if(isset($_GET['id'])){
    //     // echo $_GET['id'];
    //     $delete=mysqli_query($con,"DELETE FROM `resume` WHERE `id` ='$id'");
    // }
    $data = mysqli_query($con,"SELECT * FROM resume");
    while($drow=mysqli_fetch_array($data,MYSQLI_ASSOC)){?>
            <tr>
                <td class="tdata">
                    <?=$drow['id'];?>
                </td>
                <td class="tdata">
                    <?=$drow['job_post_id'];?>
                </td>
                <td class="tdata">
                    <?=$drow['name'];?>
                </td>
                <td class="tdata">
                    <?=$drow['email'];?>
                </td>
                <!-- <td  class="tdata"><?=$drow['file'];?></td> -->
                <td class="tdata"><a href="../upload/<?php echo $drow['file'] ?>" target="_blank"
                        onmouseover="this.style.color='#0F0'" onmouseout="this.style.color='#00F'"
                        style="color:black; text-decoration: underline;">View</a></td>
                <td class="tdata">
                    <?=$drow['phone'];?>
                </td>
                <!-- <td class="tdata"><a href="careers.php?del_id=<?=$drow['id'];?>">delete</a></td> -->

                <td class="center"><a class="btn btn-danger" id="del" title="Remove"
                        href="careers.php?d_id=<?= $drow['id'];?>"><i class="fa fa-trash"></i></a></td>


            </tr>

            <?php }?>
        </table>
    <!-- </div> -->
<!-- </div> -->
<style>
    .overlay {
        background-color: #00000090;
        height: 100vh;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        overflow-y: hidden;
        display: none;
    }

    .lightbox {
        text-align: center;
        width: 500px;
        height: 200px;


        background-color: white;
        margin: auto;
        margin-top: 100px;
    }

    .cross {
        font-weight: 700;
        padding: 10px;
        color: black;
        cursor: pointer;
    }
</style>
<div class="overlay">
    <div class="lightbox">
        <div class="pull-right cross"><strong>X</strong></div><br />
        <h1>Are you sure you want to delete?</h1>
        <button id="delYes" class="btn btn-success">Yes</button>
        <button id="delNo" class="btn btn-danger">Cancel</button>

    </div>
</div>
<!-- </div> -->
<?php include'includes/footer.php'; ?>
<script>
    $(document).ready(function () {
        var link = "";
        $('#del').click(function (e) {
            // alert(h1);
            // console.log("ready");
            $('.overlay').fadeIn('fast', function () {
                $('.lightbox').fadeIn('fast');
                link = $('#del').attr('href');
                console.log(link);

                $('#delYes').click(function () {
                    window.location.href = link;
                });
                $('#delNo').click(function () {
                    $('.lightbox').fadeOut('fast', function () {
                        $('.overlay').fadeOut('fast');
                    });
                });

            });



            e.preventDefault();
        });

        $('.cross').click(function () {
            $('.lightbox').fadeOut('fast', function () {
                $('.overlay').fadeOut('fast');
            });
        });
        $('.overlay').click(function () {
            $('.lightbox').fadeOut('fast', function () {
                $('.overlay').fadeOut('fast');
            });
        });
    });
</script>