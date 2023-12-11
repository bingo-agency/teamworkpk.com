<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><i class="fa fa-th-large"></i> Dashboard</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">

        <div class="title-action">
            <a href="add_leads" class="btn btn-primary btn-lg" style="background-color: #2F404F;border: 2px solid white">+ Add Leads</a>    
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div>
                        <span class="pull-right text-right">
                            <small>Average project(s) delivered in the past month: <strong>TeamWork</strong></small>
                        </span>
                        <br>
                        <span class="allActiveRequests">All Valid Leads: <strong><?= $db->count_rows($con, 'internal_leads'); ?></strong></span>
                        <!--<h1 class="m-b-xs">$ 50,992</h1>-->
                        <h3 class="font-bold no-margins">
                            Welcome to the Dashboard.
                        </h3>
                        <small>A unique and powerful tool for TeamWork's Internal Management</small>
                    </div>

                    <div class="row">
                        <br />

                        <div class="col-lg-12">
                            <div class=" ">

                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="flot-chart">
                                                <div class="flot-chart-content" id="flot-dashboard-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" width="720" height="200" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 720px; height: 200px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 69px; text-align: center;">Jan 03</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 135px; text-align: center;">Jan 06</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 200px; text-align: center;">Jan 09</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 265px; text-align: center;">Jan 12</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 331px; text-align: center;">Jan 15</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 396px; text-align: center;">Jan 18</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 462px; text-align: center;">Jan 21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 527px; text-align: center;">Jan 24</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 592px; text-align: center;">Jan 27</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 184px; left: 658px; text-align: center;">Jan 30</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 170px; left: 19px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 130px; left: 6px; text-align: right;">250</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 91px; left: 6px; text-align: right;">500</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 51px; left: 6px; text-align: right;">750</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 12px; left: 0px; text-align: right;">1000</div></div><div class="flot-y-axis flot-y2-axis yAxis y2Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 170px; left: 708px;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 142px; left: 708px;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 114px; left: 708px;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 85px; left: 708px;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 57px; left: 708px;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 29px; left: 708px;">25</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 708px;">30</div></div></div><canvas class="flot-overlay" width="720" height="200" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 720px; height: 200px;"></canvas><div class="legend"><div style="position: absolute; width: 112.984px; height: 36.4688px; top: 14px; left: 35px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:14px;left:35px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #000000;padding:1px"><div style="width:4px;height:0;border:5px solid #1ab394;overflow:hidden"></div></div></td><td class="legendLabel">Number of orders</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #000000;padding:1px"><div style="width:4px;height:0;border:5px solid #1C84C6;overflow:hidden"></div></div></td><td class="legendLabel">Payments</td></tr></tbody></table></div></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <ul class="stat-list">
                                                <li>
                                                    <h2 class="no-margins"><?= $db->count_rows($con, 'internal_leads'); ?></h2>
                                                    <small>Total Leads</small>
                                                    <div class="stat-percent">100% <i class="fa fa-level-up text-navy"></i></div>
                                                    <!--                                                    <div class="progress progress-mini">
                                                                                                            <div style="width: 100%;" class="progress-bar"></div>
                                                                                                        </div>-->
                                                </li>
                                                <li>
                                                    <h2 class="no-margins "><?= $db->count_rows_active($con, 'internal_leads'); ?></h2>
                                                    <small>Leads in Progress</small>
                                                    <div class="stat-percent"><?php
                                                        if ($inprogress_rows_info = $db->count_rows_active($con, 'internal_leads') / $db->count_rows($con, 'internal_leads') < 0) {
                                                            echo '0';
                                                        } else {
                                                            echo $inprogress_rows_info;
                                                        }
                                                        ?>% <i class="fa fa-level-down text-navy"></i></div>
                                                    <div class="progress progress-mini">
                                                        <div style="width: <?= $inprogress_rows_info ?>%;" class="progress-bar"></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h2 class="no-margins "><?= $db->count_rows_complete($con, 'internal_leads'); ?></h2>
                                                    <small>Completed Leads</small>
                                                    <div class="stat-percent"><?php
                                                        if ($completed_rows_info = $db->count_rows_complete($con, 'internal_leads') / $db->count_rows($con, 'internal_leads') < 0) {
                                                            echo '0';
                                                        } else {
                                                            echo $completed_rows_info;
                                                        }
                                                        ?>
                                                        % <i class="fa fa-bolt text-navy"></i></div>
                                                    <div class="progress progress-mini">
                                                        <div style="width: <?= $completed_rows_info ?>%;" class="progress-bar"></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        



                    </div>

                    <div>
                        <span class="pull-right text-right">
                            <small>Average project(s) delivered in the past month: <strong>TeamWork</strong></small>


                        </span>
                        <br>
                        <span class="allActiveRequests">All Valid Leads: <strong><?= $db->count_rows($con, 'internal_leads'); ?></strong></span>
                        <br />
                    </div>

                    <div class="row">
                        <br />

                        <div class="col-lg-12">


                            <div class="col-lg-4">
                                <?php if ($role == 'admin') { ?><a href="view_all_leads?status=new"><?php } ?>
                                    <div class="kwidget red-bg p-lg text-center" style="background-color: #E20D00;border-radius:5px;" >
                                        <div style="color: white;">
                                            <div class="m-b-md" style="padding-top: 20px;padding-bottom: 20px;">
                                                <i class="fa fa fa-4x"></i>
                                                <h1 class="m-xs"><?php
                                                    echo $db->count_rows_new($con, 'internal_leads');
                                                    ?></h1>
                                                <h3 class="font-bold no-margins">
                                                    New <br />Leads
                                                </h3>
                                                <small>Inactive</small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($role == 'admin') { ?></a><?php } ?>
                            </div>
                            <div class="col-lg-4">
                                <?php if ($role == 'admin') { ?><a href="view_all_leads?status=in-progress"><?php } ?>
                                    <div class="kwidget  p-lg text-center" style="background-color:#f25c05;border-radius:5px;" >
                                        <div style="color: white;">
                                            <div class="m-b-md"style="padding-top: 20px;padding-bottom: 20px;">
                                                <i class="fa fa fa-4x"></i>
                                                <h1 class="m-xs"><?php
                                                    echo $db->count_rows_active($con, 'internal_leads');
                                                    ?></h1>
                                                <h3 class="font-bold no-margins">
                                                    Leads in <br />progress
                                                </h3>
                                                <small>Active</small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($role == 'admin') { ?></a><?php } ?>
                            </div>
                            <div class="col-lg-4">
                                <?php if ($role == 'admin') { ?><a href="view_all_leads?status=complete"><?php } ?>
                                    <div class="kwidget navy-bg p-lg text-center" style="background-color: #275d3b;border-radius:5px;">
                                        <div style="color: white;"> 
                                            <div class="m-b-md"style="padding-top: 20px;padding-bottom: 20px;">
                                                <i class="fa fa fa-4x"></i>
                                                <h1 class="m-xs"><?php
                                                    echo $db->count_rows_complete($con, 'internal_leads');
                                                    ?></h1>
                                                <h3 class="font-bold no-margins">
                                                    Mature <br />Sales
                                                </h3>
                                                <small>All Completed Sales</small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($role == 'admin') { ?></a><?php } ?>
                            </div>
                            <div class="col-lg-4">
                                <div class="widget-head-color-box navy-bg p-lg text-center">
                                    <div class="m-b-md">
                                        <h2 class="font-bold no-margins">
                                            <?= $db->getEachById($con, 'contact_name', 'users', $id); ?>
                                        </h2>
                                        <small><?= $db->getEachById($con, 'email', 'users', $id); ?></small>
                                    </div>
                                    <img src="img/<?= $db->getEachById($con, 'image', 'users', $id); ?>" class="img-circle circle-border m-b-md" alt="profile" width="128px">
                                    <div>
                                    </div>
                                </div>
                                <div class="widget-text-box">
                                    <p><h4 class="media-heading"><strong>Name </strong><br /> <?= $db->getEachById($con, 'contact_name', 'users', $id); ?></h4></p>
                                    <p><strong>Email </strong><br /> <?= $db->getEachById($con, 'email', 'users', $id); ?></p>
                                    <p style="text-transform: capitalize;"><strong>Role </strong><br /> <?= $db->getEachById($con, 'role', 'users', $id); ?></p>
                                    <div class="text-right">
                                        <br />
                                        <a class="btn btn-primary btn-block" href="view_all_leads" >My Leads</a>
                                        <a class="btn btn-primary btn-block" href="settings">My Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="m-t-md">
                        <?php // if ($role == "admin") {    ?>
                        <small class="pull-right">
                            <i class="fa fa-clock-o"> </i>
                            <a href="view_all_leads">Leads</a> updated about
                            <?php
                            $query = mysqli_query($con, "SELECT * FROM `internal_leads` ORDER BY `id` DESC LIMIT 1");
                            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                ?>
                                <time datetime="<?= $row['timestamp']; ?>" class="timeago" title="<?= $row['timestamp']; ?>"><?= $row['timestamp']; ?></time>
                            <?php }
                            ?>
                        </small>
                        <?php // }    ?>
                        <small>
                            <strong>Analysis of Leads:</strong> The value has been changed over time, and last month reached a level over 0% progress.
                            &nbsp;
                        </small>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <?php if ($role == "admin") { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Report</h5>

                            </div>
                            <div class="ibox-content no-padding">
                                <div class="container">
                                    A place where team's progress would be calculated !
                                    <span class="pie">50,50</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>






</div>
<?php include'includes/footer.php'; ?>

<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.spline.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>


<!-- EayPIE -->
<script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="js/demo/sparkline-demo.js"></script>
<!-- Peity -->
<script src="js/plugins/peity/jquery.peity.min.js"></script>

<!-- Peity -->
<script src="js/demo/peity-demo.js"></script>

<script>
    $(document).ready(function () {

        var data2 = [
            [gd(2022, 4, 1), 7],
            [gd(2022, 4, 2), 6],
            [gd(2022, 4, 3), 4],
            [gd(2022, 4, 4), 8],
            [gd(2022, 4, 5), 9],
            [gd(2022, 4, 6), 7],
            [gd(2022, 4, 7), 5],
            [gd(2022, 4, 8), 4],
            [gd(2022, 4, 9), 7],
            [gd(2022, 4, 10), 8],
            [gd(2022, 4, 11), 9],
            [gd(2022, 4, 12), 6],
            [gd(2022, 4, 13), 4],
            [gd(2022, 4, 14), 5],
            [gd(2022, 4, 15), 11],
            [gd(2022, 4, 16), 8],
            [gd(2022, 4, 17), 8],
            [gd(2022, 4, 18), 11],
            [gd(2022, 4, 19), 11],
            [gd(2022, 4, 20), 6],
            [gd(2022, 4, 21), 6],
            [gd(2022, 4, 22), 8],
            [gd(2022, 4, 23), 11],
            [gd(2022, 4, 24), 13],
            [gd(2022, 4, 25), 7],
            [gd(2022, 4, 26), 9],
            [gd(2022, 4, 27), 9],
            [gd(2022, 4, 28), 8],
            [gd(2022, 4, 29), 5],
            [gd(2022, 4, 30), 8],
            [gd(2022, 4, 31), 25]
        ];

        var data3 = [
            [gd(2022, 4, 1), 800],
            [gd(2022, 4, 2), 500],
            [gd(2022, 4, 3), 600],
            [gd(2022, 4, 4), 700],
            [gd(2022, 4, 5), 500],
            [gd(2022, 4, 6), 456],
            [gd(2022, 4, 7), 800],
            [gd(2022, 4, 8), 589],
            [gd(2022, 4, 9), 467],
            [gd(2022, 4, 10), 876],
            [gd(2022, 4, 11), 689],
            [gd(2022, 4, 12), 700],
            [gd(2022, 4, 13), 500],
            [gd(2022, 4, 14), 600],
            [gd(2022, 4, 15), 700],
            [gd(2022, 4, 16), 786],
            [gd(2022, 4, 17), 345],
            [gd(2022, 4, 18), 888],
            [gd(2022, 4, 19), 888],
            [gd(2022, 4, 20), 888],
            [gd(2022, 4, 21), 987],
            [gd(2022, 4, 22), 444],
            [gd(2022, 4, 23), 999],
            [gd(2022, 4, 24), 567],
            [gd(2022, 4, 25), 786],
            [gd(2022, 4, 26), 666],
            [gd(2022, 4, 27), 888],
            [gd(2022, 4, 28), 900],
            [gd(2022, 4, 29), 178],
            [gd(2022, 4, 30), 555],
            [gd(2022, 4, 31), 993]
        ];


        var dataset = [
            {
                label: "Total Leads",
                data: data3,
                color: "#1ab394",
                bars: {
                    show: true,
                    align: "center",
                    barWidth: 24 * 60 * 60 * 600,
                    lineWidth: 0
                }

            }, {
                label: "Team Progress",
                data: data2,
                yaxis: 2,
                color: "#1C84C6",
                lines: {
                    lineWidth: 1,
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                    }
                },
                splines: {
                    show: false,
                    tension: 0.6,
                    lineWidth: 1,
                    fill: 0.1
                },
            }
        ];


        var options = {
            xaxis: {
                mode: "time",
                tickSize: [3, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var previousPoint = null, previousLabel = null;

        $.plot($("#flot-dashboard-chart"), dataset, options);




    });
</script>