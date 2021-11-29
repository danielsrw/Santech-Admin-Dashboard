    <?php

        include('controllers/CategoryController.php');

        $categoryObj = new Category();

        if (isset($_POST['addCategory'])) {
            $categoryObj->create($_POST);
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
                                    Category
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block">
                                    <a href="category.php">
                                        <button type="submit" class="btn-shadow btn btn-info">
                                            View Category
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
                                    Add New Category
                                </div>
                                <div class="container mb-5 mt-3">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <i class="fa fa-envelope prefix grey-text"></i>
                                            <label>Category Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary w-100" name="addCategory">Submit</button>
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
