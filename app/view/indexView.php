<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">IT Departments</h2>
                    <button onclick="location.href = 'index.php?controller=department&action=showNew'" class="btn btn-success pull-right"><i
                                class="fa fa-plus"></i> Add New Department</button>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Project</th>
                        <th>Limbaj</th>
                        <th>Head Name</th>
                        <th>Amount of sotrudnici</th>
                    </tr>
                    </thead>


                    <?php
                    $i = 1;

                    echo "\n\n";
                    //var_dump($receivedData["departments"]);
                    foreach ($receivedData["departments"] as $dept) {
//                                $depId = $dept->department_id;
//                                $lang = function($depId){
//                                    return 0;
//                                };
//                                $project = $department->getDepProjectById($departmentId);

                        ?>

                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo ucwords(...explode(" ", $dept["project_name"])) ?></td>
                            <td><?php echo $dept['language']; ?></td>
                            <td><?php echo $dept['head_name'] ?></td>
                            <td><?php echo $dept['progs_count'] ?></td>
                            <td><?php echo $dept["level"] ?></td>
                            <td>
                                <button class="btn btn-outline-primary" onclick="location.href =
                                'index.php?controller=department&action=details&id=<?php echo $dept['id']; ?>'">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Info</button>
                                <button class="btn btn-outline-danger" onclick="location.href =
                                'index.php?controller=department&action=delete&id=<?php echo $dept['id']; ?>'">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Delete</button></td>
                            </td>
                        </tr>


                        <?php $i = $i + 1;
                    }

                    ?>

                    </tbody>
                </table>

            </div>

            <div class="col-md-6">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Progers</h2>
                    <button onclick="location.href = 'index.php?controller=programmer&action=showNew'" class="btn btn-success pull-right"><i
                                class="fa fa-plus"></i> Add New Coder</button>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nume</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Nivelul</th>
                        <th>Member of</th>

                    </tr>
                    </thead>


                    <?php
                    $i = 1;

                    echo "\n\n";
                    foreach ($receivedData["progers"] as $proger) {
//                        var_dump($proger);
                        //var_dump($receivedData['departments'][$proger['department_id']]);
                        ?>


                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo ucwords($proger['first_name'] . " " . $proger['last_name']) ?></td>
                            <td><?php echo $proger['phone'] ?></td>
                            <td><?php echo $proger['email'] ?></td>
                            <td><?php echo $proger['level'] ?></td>
                            <td><?php echo $proger['on_project'] ?></td>
                            <td>
                                <button class="btn btn-outline-primary" onclick="location.href =
                                        'index.php?controller=programmer&action=details&id=<?php echo $proger['id']; ?>&department=<?php echo $proger["department_id"] ?>'">
                                    <i class="fa fa-info" aria-hidden="true"></i>Info</button>

                                <button class="btn btn-outline-danger" onclick="location.href = 'index.php?controller=programmer&action=delete&id=<?php echo $proger['id']; ?>'">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>


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
</div>

<?php include_once 'footer.php'; ?>