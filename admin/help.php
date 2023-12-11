<?php
include'includes/header.php';

if (!$_SESSION['user']) {
    $db->redirect('login');
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-question-circle"></i> Help</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li class="active">
                <strong>FAQ's</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<?php include'includes/footer.php'; ?>