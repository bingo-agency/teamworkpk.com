<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    $db->add_user_activity($con, "Was viewing <strong>Cash Clients</strong>.");
}

if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $queryDel = mysqli_query($con, "DELETE FROM `cash_clients` WHERE `id` = '" . $del_id . "'");
    if ($queryDel) {
        $db->redirect('cash_clients');
        exit();
    }
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-dollar"></i> Cash Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>Cash Clients</strong>
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
                    <h5>Cash Clients <small>List of all Cash Clients/Investors.</small> </h5> 
                    <a href="add_cash_clients" class="btn btn-primary pull-right btn-sm small">Add Cash Client</a>
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
                                        aria-label="Rendering engine: activate to sort column descending">Client's Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;"
                                        aria-label="Platform(s): activate to sort column ascending">Interested In</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;"
                                        aria-label="Platform(s): activate to sort column ascending">Cash Amount</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;"
                                        aria-label="Platform(s): activate to sort column ascending">Till Time</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 20%;"
                                        aria-label="Platform(s): activate to sort column ascending">Phone</th>
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
                                    $query = mysqli_query($con, "SELECT * FROM `cash_clients` ORDER BY `id` DESC");


                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1">
                                                <?= $row['id'] ?>
                                            </td>
                                            <td>
                                    <center>
                                        <a href="#" data-toggle="modal" data-target="#company<?= $row['id'] ?>">
                                               <?= $row['client_name']; ?>
                                        </a>
                                    </center>
                                    </td>
                                    <td>
                                        <?= $row['interested_in'] ?>
                                    </td>
                                    <td>
                                        <?= $row['cash_amount'] ?>
                                    </td>
                                    <td>
                                        <?= $row['till_time'] ?>
                                    </td>
                                    <td class="center">
                                        <?= $row['phone']; ?>
                                    </td>
                                    <td class="center">
                                        <?= $db->getElapsedTime($row['timestamp']) ?>
                                    </td>
                                    <td class="center"><a href="edit_cash_client?id=<?= $row['id'] ?>" title="Edit"
                                                          class="btn btn-primary"><i class="fa fa-edit"></i></a> <a
                                            class="btn btn-danger" title="Remove"
                                            href="cash_clients?del_id=<?= $row['id'] ?>"><i class="fa fa-trash"></i></a></td>
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
                                                            <?= $db->getEachById($con, 'client_name', 'cash_clients', $row['id']) ?>
                                                        </center>
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="dl-horizontal">
                                                       
                                                        <dd style="padding-top: 10%">
                                                            <h3>
                                                                <?= $row['client_name']; ?>
                                                            </h3>
                                                        </dd>
                                                        <dd><small>&nbsp;</small></dd>
                                                        <dt>Interested In</dt>
                                                        <dd>
                                                            <?= $row['interested_in'] ?>
                                                        </dd>
                                                        <dt>Cash Amount</dt>
                                                        <dd>
                                                            <?= $row['cash_amount'] ?>
                                                        </dd>
                                                        <dt>Till time</dt>
                                                        <dd>
                                                            <?= $row['till_time'] ?>
                                                        </dd>
                                                        <dt>Phone</dt>
                                                        <dd>
                                                            <?= $row['phone'] ?>
                                                        </dd>
                                                        <dt>TimeStamp</dt>
                                                        <dd>
                                                            <?= $db->getEachById($con, 'timestamp', 'cash_clients', $row['id']) ?>
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