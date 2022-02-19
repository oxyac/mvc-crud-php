<?php include_once 'header.php';?>

    <div class="thin-panel">
        <div class="d-flex justify-content-between">
            <div>
                <h3>NEW DEPARTMENT</h3>
            </div>
            <div>
                <a href="index.php" class="btn btn-info">BRING ME BACK</a>
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

            <div class="form-group">
                <label for="head_id">Team Lead</label>
                <select name="head_id" id="head_id" type="head_id">

                    <?php  foreach($receivedData['progers'] as $proger) {?>
                        <option value=<?php echo $proger['id'] ?> >
                            <?php echo $proger['first_name'] . " " . $proger['last_name'] ?></option>
                    <?php  } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Department</button>
        </form>
    </div>





<?php include_once 'footer.php';?>