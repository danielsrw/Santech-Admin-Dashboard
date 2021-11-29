    <?php

        include('controllers/StoryController.php');

        $storyObj = new Story();

        if(isset($_GET['storyId']) && !empty($_GET['storyId'])) {
            $storyId = $_GET['storyId'];
            $story = $storyObj->edit($storyId);
        }

        if (isset($_POST['updateStory'])) {
            $storyObj->update($_POST);
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
                                    <a href="story.php">
                                        <button type="submit" class="btn-shadow btn btn-info">
                                            View Story
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
                                    Edit Story
                                </div>
                                <div class="container mb-5 mt-3">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <i class="fa fa-envelope prefix grey-text"></i>
                                            <label>Your Title</label>
                                            <input type="text" name="title" value="<?php echo $story['title'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Story Category</label>
                                            <select class="form-control" name="category" required>
                                                <option disabled>Choose Category</option>
                                                <?php
                                                    $stories = $storyObj->showCategories();
                                                    foreach ($stories as $story) {
                                                ?>
                                                    <option value="<?php echo $story['name'] ?>">
                                                        <?php echo $story['name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <i class="fa fa-image prefix grey-text"></i>
                                            <label>Your Image <span class="badge badge-warning">Optional</span></label>
                                            <input type="file" name="image" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <i class="fa fa-comment prefix grey-text"></i>
                                            <label>Your Description</label>
                                            <textarea class="form-control" name="description" rows="7" placeholder="Enter your description"><?php echo $story['description'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="<?php echo $story['id'] ?>">
                                            <input type="hidden" name="image" value="<?php echo $story['image'] ?>">
                                            <button class="btn btn-primary w-100" name="updateStory">Submit</button>
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
