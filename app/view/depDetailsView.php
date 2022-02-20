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
                        }</script>
                    <a href="index.php" class="btn btn-outline-primary"><i class="fa fa-arrow-left"
                                                                           aria-hidden="true"></i>&nbsp;Go
                        Back</a>
                    <a href="index.php?controller=department&action=delete&id=<?php echo $receivedData['department']->id ?>"
                       class="btn btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;DELETE</a>
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

                    <div class="form-group">
                        <label for="head_id">Team Lead</label>
                        <select name="head_id" id="head_id" type="head_id">

                            <?php foreach ($receivedData['team'] as $proger) { ?>
                                <option value=<?php echo $proger['id'] ?> <?php echo $proger['id'] === $receivedData['head_id'] ? "selected='selected'" : "" ?>>
                                    <?php echo $proger['first_name'] . " " . $proger['last_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary hide">SAVE</button>
                </form>
            </div>


            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>TEAM</h3>
                    </div>
                    <div>
                        <form action="index.php?controller=programmer&action=assign" method="post">

                            <label for="head_id">Add Artist</label>

                            <select name="id_depId" id="id_depId" type="id_depId">


                                <?php foreach ($receivedData['progers'] as $proger) {
//                                    var_dump($proger['id'] . '&' . $receivedData['department']->id);
                                    ?>

                                    <option name="id_depId" value=<?php echo $proger['id'] . '&' . $receivedData['department']->id ?>>
                                        <?php echo $proger['first_name'] . " " . $proger['last_name'] ?>
                                    </option>



                                <?php } ?>

                            </select>



                            <button type="submit" class="btn btn-primary hide">Add Selected</button>
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
                    <!---->
                    <!--        array(7) {-->
                    <!--        ["id"]=>-->
                    <!--        int(12)-->
                    <!--        ["first_name"]=>-->
                    <!--        string(7) "adsfdsa"-->
                    <!--        ["last_name"]=>-->
                    <!--        string(8) "asdgasdg"-->
                    <!--        ["level"]=>-->
                    <!--        int(1)-->
                    <!--        ["department_id"]=>-->
                    <!--        int(1)-->
                    <!--        ["phone"]=>-->
                    <!--        int(252151)-->
                    <!--        ["email"]=>-->
                    <!--        string(7) "5324532"-->
                    <!--        }-->
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

                                <a href="index.php?controller=programmer&action=details&id=<?php echo $proger['id']; ?>&department=<?php echo $receivedData["department"]->id ?>
                        class=" btn btn-outline-info">Info</a>
                                <!--                    <a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record"-->
                                <!--                       data-toggle="tooltip">-->
                                <!--                        <span class="fa fa-phone"></span></a>-->
                                <!--                    <a href="edit.php?id=-->
                                <?php //echo $proger->id ?><!--" class=mr-3 title='Update Record' data-toggle=tooltip>-->
                                <!--                        <span class='fa fa-pencil'></span></a>-->
                                <!--                    <a onclick="idClass.id=-->
                                <?php //echo $proger->id ?><!--" title="Delete Record" data-toggle='modal'-->
                                <!--                       data-target='#deleteModal'>-->
                                <!--                        <span class="fa fa-trash"></span></a>-->

                            </td>
                        </tr>


                        <?php $i = $i + 1;
                    }

                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include_once 'footer.php'; ?>