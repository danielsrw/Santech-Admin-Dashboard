    <?php

        include('controllers/TestimonialController.php');

        $testimonialObj = new Testimony();

        if(isset($_GET['testimonyId']) && !empty($_GET['testimonyId'])) {
            $testimonyId = $_GET['testimonyId'];
            $testimony = $testimonialObj->editTestimony($testimonyId);
        }

        if (isset($_POST['updateTest'])) {
            $testimonialObj->updateTestimony($_POST);
        }

        include('inc/css.php');

    ?>

    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php include('inc/header.php'); ?>
        <div class="app-main">
            <?php include('inc/sidebar.php') ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div>
                                    Testimonial
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block">
                                    <a href="testimony.php">
                                        <button type="submit" class="btn-shadow btn btn-info">
                                            View Testimonials
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    Edit Testimony
                                </div>
                                <div class="container mb-5 mt-3">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <i class="fa fa-envelope prefix grey-text"></i>
                                            <label>Your Title</label>
                                            <input type="text" name="title" value="<?php echo $testimony['title'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <i class="fa fa-image prefix grey-text"></i>
                                            <label>Your Image <span class="badge badge-warning">Optional</span></label>
                                            <input type="file" name="image" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <i class="fa fa-comment prefix grey-text"></i>
                                            <label>Your Description</label>
                                            <textarea class="form-control" name="description" rows="7" placeholder="Enter your description"><?php echo $testimony['description'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="<?php echo $testimony['id'] ?>">
                                            <button class="btn btn-primary w-100" name="updateTest">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
</body>
</html>
