    <?php
        include('controllers/CategoryController.php');
        $categoryObj = new Category();

        if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
            $deleteId = $_GET['deleteId'];
            $categoryObj->delete($deleteId);
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
                                    <a href="categoryAdd.php">
                                        <button type="submit" class="btn-shadow btn btn-info">
                                            Add Category
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    All stories
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $categories = $categoryObj->show();
                                                foreach ($categories as $category) {
                                            ?>
                                                <tr class="text-center">
                                                    <td class="text-center text-muted">#<?php echo $category['id'] ?></td>
                                                    <td>
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left flex2">
                                                                    <div class="widget-heading"><?php echo $category['name'] ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="categoryEdit.php?categoryId=<?php echo $category['id']; ?>">
                                                            <div class="badge badge-primary">Edit</div>
                                                        </a>
                                                        <a href="category.php?deleteId=<?php echo $category['id']; ?>">
                                                            <span class="badge badge-danger" onclick="return confirm('Are you sure want to delete this record')">Delete</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
