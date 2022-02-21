<?php include_once 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ">

                <div>
                    <h3>Department Details</h3>
                </div>
                <div>
                    <button onclick="enable()" id="disable" href="#" id="editBtn" class="btn btn-outline-warning">
                        <i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit
                    </button>
                    <script>

                        function enable() {
                            document.getElementById('project_name').disabled = false;
                            document.getElementById('language').disabled = false;
                        }

                    </script>

                    <button onclick="location.href='index.php'" class="btn btn-outline-primary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Go Back
                    </button>

                    <button onclick="location.href='index.php?controller=department&action=delete&id=<?php echo $receivedData['department']->id ?>'"
                            class="btn btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;DELETE
                    </button>

                </div>
                <hr/>

                <form action="index.php?controller=department&action=update" method="post">
                    <input type="hidden" name="id" value="<?php echo $receivedData['department']->id ?>"/>

                    <div class="form-group">
                        <label for="project_name">Project</label>
                        <input disabled type="text" name="project_name" class="form-control" id="project_name"
                               value="<?php echo $receivedData["department"]->project_name ?>">
                    </div>

                    <div class="form-group">
                        <label for="language">Language</label>
                        <input disabled type="text" name="language" class="form-control" id="language"
                               value="<?php echo $receivedData['department']->language ?>">
                    </div>

                    <button type="submit" class="btn btn-primary hide">SAVE</button>

                </form>
            </div>


            <div class="col-md-6">
                <div>
                    <div>
                        <h3>TEAM</h3>
                    </div>
                    <div>

                        <form action="index.php?controller=programmer&action=assign" method="post">

                            <label for="id_depId">Assign Coder To Project</label>

                            <select name="id_depId" id="id_depId" type="id_depId">


                                <?php foreach ($receivedData['progers'] as $proger) { ?>

                                    <option name="id_depId"
                                            value=<?php echo $proger['id'] . '&' . $receivedData['department']->id ?>>
                                        <?php echo $proger['first_name'] . " " . $proger['last_name'] ?>
                                    </option>

                                <?php } ?>

                            </select>

                            <button type="submit" class="btn btn-primary hide">Add Selected</button>

                        </form>
                    </div>
                </div>

                <table class="table table-bordered table-striped">
                    <tbody>
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Nume</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Nivelul</th>
                    </tr>
                    </thead>

                    <?php
                    $i = 1;
                    foreach ($receivedData['team'] as $proger) { ?>

                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo ucwords($proger['first_name'] . " " . $proger['last_name']) ?></td>
                            <td><?php echo $proger['phone'] ?></td>
                            <td><?php echo $proger['email'] ?></td>
                            <td><?php echo $proger['level'] ?></td>
                            <td>


                                <button
                                    <?php echo $receivedData['department']->head_id == $proger['id'] ? "disabled" : "" ?>
                                        onclick="location.href = 'index.php?controller=department&action=setHead&id=<?php echo $proger['id'] . '&depId=' . $receivedData['department']->id ?>'"
                                        class=" btn btn-outline-info">Set Head
                                </button>

                                <button

                                        onclick="location.href = 'index.php?controller=programmer&action=unassign&id=<?php echo $proger['id'] . '&depId=' . $receivedData['department']->id; ?>'"
                                        class=" btn btn-outline-info">Unassign

                                </button>

                            </td>
                        </tr>

                        <?php $i = $i + 1;
                    } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include_once 'footer.php'; ?>