<?php
include 'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
} else {
    if (isset($_GET['project_id'])) {
        $project_id = $_GET['project_id'];
    } else {
        // $db->redirect('projects');
    }
    $db->add_user_activity($con, "Was viewing <strong>Project</strong>.");
}
?>

<style>
    .valign-top {
        vertical-align: center !important;
    }
</style>
<?php 
$last_inserted_id = isset($_GET['id']) ? $_GET['id'] : "";
$row = $db->getDataWithId($last_inserted_id,$con);
?>

<div id="myfrm">
<table class="table">
    <tr>
        <td class="text-center"><img src="../img/teamWrk.png" style="height: 150px; width: 150px; object-fit:contain;" alt=""></td>
        <td class="text-center" style="vertical-align: middle;"><h3><strong>Registration Form</strong></h3></td>
        <td rowspan="2"><img src="./img/<?= $row['thumb_print']; ?>" alt="" style="height: 180px; width: 180px; object-fit: contain;"></td>
        <td rowspan="2"><img src="./img/<?= $row['allottee_image']; ?>" alt="" style="height: 180px; width: 180px; object-fit: contain;"></td>
    </tr>
    <tr>
        <th>Floor</th>
        <th>Property Type</th>
    </tr>
    <tr>
        <td><?= $row['floor']; ?></td>
        <td><?= $row['property_selection']; ?></td>
    </tr>
    <tr>
        <th>Applicant's Name</th>
    </tr>
    <tr>
        <td><?= $row['applicant_name']; ?></td>
        <td><?= $row['applicant_of']; ?></td>
        <td><?= $row['applicant_sdw']; ?></td>
    </tr>
        <tr>
            <th>Applicant's Id Card</th>
            <th>Applicant's Passport Number</th>
            <th>Applicant's Address</th>
        </tr>
        <tr>
        <td><?= $row['id_card']; ?></td>
        <td><?= $row['passport_number']; ?></td>
        <td><?= $row['address']; ?></td>
    </tr>
    <tr>
        <th>Applicant's Permanent Address</th>
        <th>Applicant's Email Address</th>
        <th>Applicant's Office Number</th>
    </tr>
    <tr>
    <td><?= $row['permanent_address']; ?></td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['phone_office']; ?></td>
    </tr>
    <tr>
        <th>Applicant's Residence Phone Number</th>
        <th>Applicant's Mobile Number</th>
    </tr>
    <tr>
        <td><?= $row['phone_res'] ?></td>
        <td><?= $row['mobile'] ?></td>
    </tr>
    <tr>
        <th>Nominee's Name</th>
    </tr>
    <tr>
        <td><?= $row['nominee_name']; ?></td>
        <td><?= $row['nominee_of']; ?></td>
        <td><?= $row['nominee_sdw']; ?></td>
    </tr>
    <tr>
        <th>Nominee's Id Card Number</th>
        <th>Nominee's Passport Number</th>
        <th>Relation with Applicant</th>
    </tr>
    <tr>
        <td><?= $row['nominee_id']; ?></td>
        <td><?= $row['nominee_passport']; ?></td>
        <td><?= $row['rel_with_applicant']; ?></td>
    </tr>
    <tr>
        <th>Comments</th>
        <th>Initial Deposit</th>
        <th>Installment Plan</th>
    </tr>
    <tr>
    <td><?= $row['comments']; ?></td>
    <td><?= $row['initial_deposit']; ?></td>
    <td><?= $row['installmanet_plan']; ?></td>
    </tr>
</table>
</div>
<button id="form_print" onclick="printPageArea('myfrm')">Print</button>
<?php
if(isset($_GET['id'])) {
    $update_id = $_GET['id'];
}
?>

<button><a href="project_overview_edit.php?id=<?= $update_id . "&project_id=" . $project_id; ?>" style="color: #676A6C;">Back</a></button>


<script>
    //     function printFun()  
    // {  
    //     var printdata = document.getElementById("myfrm");
    //             newwin = window.open("");
    //             newwin.document.write(printdata.outerHTML);
    //             newwin.print();
    //             newwin.close();  
    // }  

    function printPageArea(areaID){
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}
</script>

<?php include 'includes/footer.php'; ?>