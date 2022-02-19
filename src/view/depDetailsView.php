<?php include_once 'header.php'; ?>
    <div>
        <h3>Department Details</h3>
    </div>
    <div>
        <button onclick="enable()" id="disable" href="#" id="editBtn" class="btn btn-outline-warning">
            <i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit</button>
        <script>
            function enable(){
            document.getElementById('project_name').disabled = false;
            document.getElementById('language').disabled = false;
            }</script>
        <a href="index.php" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Go Back</a>
        <a href="index.php?controller=department&action=delete&id=<?php echo $receivedData['departmentId']->id ?>"
           class="btn btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;DELETE</a>
    </div>
    </div>
    <hr/>
    <form action="index.php?controller=department&action=update" method="post">
        <input type="hidden" name="id" value="<?php echo $receivedData['departmentId']->id ?>"/>
        <div class="form-group">
            <label for="nombre">Project</label>
            <input disabled type="text" name="project_name" class="form-control" id="project_name"
                   value="<?php echo $receivedData["departmentId"]->project_name ?>">
        </div>

        <div class="form-group">
            <label for="language">Language</label>
            <input disabled type="text" name="language" class="form-control" id="language"
                   value="<?php echo $receivedData['departmentId']->language ?>">
        </div>

        <div class="form-group">
            <label for="email">Team Lead</label>
            <select name="head_id" id="head_id" type="head_id">
                <?php  foreach($receivedData['progers'] as $proger) {?>
                <option value=1 <?php echo $proger->id === $receivedData['department']->head_id ? "selected='selected'" : "" ?> >
                    <?php echo $proger->first_name . " " . $proger->last_name ?></option>
    <?php  } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary hide">SAVE</button>
    </form>

    <div class="col-6">
    <div class="d-flex justify-content-between">
        <div>
            <h3>TEAM</h3>
        </div>
        <div>
            <a href="index.php?controller=programmer&action=nuevo&bodega=<?php echo $datos['bodega']->id ?>"
               class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add Artist</a>
        </div>
    </div>
    <hr/>
    <table class="table table-bordered table-striped">
        <tbody>
        <thead>
        <tr>
            <th>#</th>
            <th>Nume</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Nivelul</th>
        </tr>
        </thead>

        <?php
        $i = 1;
        foreach ($receivedData['progers'] as $proger) {

                switch ($proger) {
                    case 1:
                        return 'Junior';
                        break;
                    case 2:
                        return 'Middle';
                        break;
                    case 3:
                        return 'Senior';
                        break;
                }

            ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo ucwords($proger->first_name . " " . $proger->last_name) ?></td>
                <td><?php echo "project" ?></td>
                <td><?php echo "lang" ?></td>
                <td><?php echo "lang" ?></td>
                <td><?php echo $level($proger->level) ?></td>
                <td>
                    <a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record"
                       data-toggle="tooltip">
                        <span class="fa fa-phone"></span></a>
                    <a href="edit.php?id=<?php echo $proger->id ?>" class=mr-3 title='Update Record' data-toggle=tooltip>
                        <span class='fa fa-pencil'></span></a>
                    <a onclick="idClass.id=<?php echo $proger->id ?>" title="Delete Record" data-toggle='modal'
                       data-target='#deleteModal'>
                        <span class="fa fa-trash"></span></a>

                </td>
            </tr>


            <?php $i = $i + 1;
        }

        ?>

        </tbody>
    </table>



<?php include_once 'footer.php'; ?>