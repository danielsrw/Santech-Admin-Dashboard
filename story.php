    <?php
        include('controllers/StoryController.php');
        $storyObj = new Story();

        if (isset($_POST['enable'])) {
            $storyObj->enable($_POST);
        }

        if (isset($_POST['disable'])) {
            $storyObj->disable($_POST);
        }

        if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
            $deleteId = $_GET['deleteId'];
            $storyObj->delete($deleteId);
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
                                    Story
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block">
                                    <a href="storyAdd.php">
                                        <button type="submit" class="btn-shadow btn btn-info">
                                            Add Story
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
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $stories = $storyObj->show();
                                                foreach ($stories as $story) {
                                            ?>
                                                <tr>
                                                    <td class="text-center text-muted">#<?php echo $story['id'] ?></td>
                                                    <td class="text-center">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left flex2">
                                                                    <div class="widget-heading">
                                                                        <?php echo $story['title'] ?>
                                                                    </div>
                                                                    <div class="widget-subheading opacity-7">
                                                                        <?php echo $story['category'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <img src="assets/stories/<?php echo $story['image'] ?>" style='width: 100px;'>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $story['description'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <form method="POST">
                                                            <input type="hidden" name="id" value="<?php echo $story['id']; ?>">
                                                            <input type="hidden" name="status" value="<?php echo $story['status']; ?>">
                                                            <?php if ($story['status'] == 1) {
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
                                                        <a href="storyEdit.php?storyId=<?php echo $story['id']; ?>">
                                                            <div class="badge badge-primary">Edit</div>
                                                        </a>
                                                        <a href="story.php?deleteId=<?php echo $story['id']; ?>">
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
