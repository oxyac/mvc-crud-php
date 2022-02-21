<?php include_once 'header.php'; ?>
    <div class="col-md-6 align-content-center" style="margin: auto">
        <div class="thin-panel">
            <div class="d-flex justify-content-between">
                <div>
                    <h3>NEW DEPARTMENT</h3>
                </div>
                <div>

                    <a href="index.php" class="btn btn-info">Return to Home Page</a>

                </div>
            </div>
            <hr/>

            <form action="index.php?controller=department&action=create" method="post">

                <input type="hidden" name="id" value="<?php echo $receivedData["department"]->id ?>"/>

                <div class="form-group">
                    <label for="project_name">Project</label>
                    <input type="text" name="project_name" class="form-control" id="project_name">
                </div>

                <div class="form-group">
                    <label for="language">Language</label>
                    <input type="text" name="language" class="form-control" id="language">
                </div>

                <button type="submit" class="btn btn-primary">Create Department</button>

            </form>

        </div>
    </div>


<?php include_once 'footer.php'; ?>