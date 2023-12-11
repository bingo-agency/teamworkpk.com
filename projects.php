<?php include'includes/header.php'; ?>
<div class="breadcrumb-wrap breadcrumb-wrap-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="projects">Projects</li>
            </ol>
        </nav>
    </div>
</div>
<section class="blog-wrap1 blog-wrap3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-8">
                <div class="item-heading-left">
                    <span class="section-subtitle">What’s New at TeamWork</span>
                    <h2 class="section-title">Latest Projects</h2>
                    <div class="bg-title-wrap" style="display: block;">
                        <span class="background-title solid">Projects</span>
                    </div>

                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <?php
            $queryGetProjects = mysqli_query($con, "SELECT * FROM `projects` ORDER BY `id` DESC");
            while ($row = mysqli_fetch_array($queryGetProjects, MYSQLI_ASSOC)) {
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-box1 wow fadeInUp" data-wow-delay=".4s">
                        <a href="project_detail?id=<?= $row['id'] ?>">
                            <div class="item-img" style="background-image: url('admin/<?= $row["image_link"] ?>');background-size: cover;background-repeat: no-repeat;background-position: center;height:250px;width:100%;">

                            <!--<img src="img/photo_21955058.jpeg" alt="blog" width="520" height="350">-->

                            </div>
                        </a>
                        <div class="thumbnail-date">
                            <div class="popup-date">

                                <span class="month"><?= $row['ribbon'] ?></span>                                    
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="entry-meta">
                                <ul>
                                    <li>Residential</li>
                                </ul>
                            </div>
                            <div class="heading-title">
                                <h3><a href="project_detail?id=<?= $row['id'] ?>"><?=$row['title'] ?></a></h3>
                            </div>
                            <div class="blog-button">
                                <a href="project_detail?id=<?= $row['id'] ?>" class="item-btn">View Details<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>

<?php include'includes/footer.php'; ?>