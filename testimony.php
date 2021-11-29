    <?php
        include('controllers/TestimonialController.php');
        $testimonyObj = new Testimony();

        if (isset($_POST['enable'])) {
            $testimonyObj->enableTestimony($_POST);
        }

        if (isset($_POST['disable'])) {
            $testimonyObj->disableTestimony($_POST);
        }

        if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
            $deleteId = $_GET['deleteId'];
            $testimonyObj->deleteTestimony($deleteId);
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
                                    <a href="testimonyAdd.php">
                                        <button type="submit" class="btn-shadow btn btn-info">
                                            Add Testimony
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
                                    All testimonials
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Title</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $testimonials = $testimonyObj->show();
                                                foreach ($testimonials as $testimony) {
                                            ?>
                                                <tr>
                                                    <td class="text-center text-muted">#<?php echo $testimony['id'] ?></td>
                                                    <td>
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left flex2">
                                                                    <div class="widget-heading"><?php echo $testimony['title'] ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <img src="assets/testimonials/<?php echo $testimony['image'] ?>" style='width: 100px;'>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $testimony['description'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <form method="POST">
                                                            <input type="hidden" name="id" value="<?php echo $testimony['id']; ?>">
                                                            <input type="hidden" name="status" value="<?php echo $testimony['status']; ?>">
                                                            <?php if ($testimony['status'] == 1) {
                                                                echo "<button class='badge badge-success' name='enable' style='border: none;'>";
                                                                    echo "On";
                                                                echo "</button>";
                                                            } else {
                                                                echo "<button class='badge badge-danger' name='disable' style='border: none;'>";
                                                                    echo "Off";
                                                                echo "</button>";
                                                            } ?>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="testimonyEdit.php?testimonyId=<?php echo $testimony['id']; ?>">
                                                            <div class="badge badge-primary">Edit</div>
                                                        </a>
                                                        <a href="testimony.php?deleteId=<?php echo $testimony['id']; ?>">
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
