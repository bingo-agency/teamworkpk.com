<?php include'includes/header.php'; ?>
<style>
    .icon-career{
        color: #6f1c74;
        margin-left: 37%;
        margin-top: 96px;
        font-size: 4.0rem;
        text-shadow:2px 2px 2px 2px black;
    }
    .career-box{
        height: 300px;
    }
</style>
<div class="breadcrumb-wrap breadcrumb-wrap-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="careers">Careers</li>
            </ol>
        </nav>
    </div>
</div>
<section class="property-wrap1 property-wrap-10">
    <div class="container">
        <div class="item-heading-center">
            <span class="section-subtitle">Job Openings</span>
            <h2 class="section-title">Recent Job Openings</h2>
            <div class="bg-title-wrap" style="display: block">
                <span class="background-title solid">Careers</span>
            </div>
        </div>
        <div class="row">
            <div class="feature-layout-style-1 swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM `job_posts` ORDER BY `id` DESC");
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        ?>
                        <a href="job_detail?job_id=<?= $row['id'] ?>">
                        <div class="" style="margin:5px;width:400px;box-shadow: 0px 1px 5px 0px #00000019">
                            <div class="feature-box4 wow fadeInUp" data-wow-delay=".2s">
                                <div class="item-img" style="font-size:50px;color:#6f1c74;">
                                    <i class="<?= $row['image'] ?>" style="text-shadow:0px 0px 3px #eee;"></i>
                                    <!--<img src="<?= $row['image'] ?>"alt="<?= $row['title'] ?>"height="78"width="70"/>-->

                                </div>
                                
                                <div class="item-content">
                                    <h6 class="item-title">
                                        <?= $row['title']; ?>
                                    </h6>
                                    <div class="item-categoery"><?= $row['available_seats'] ?> Seats</div>
                                </div>

                            </div>
                        </div>
                        </a>
                    <?php }
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>
<div>

</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?php include'includes/footer.php'; ?>