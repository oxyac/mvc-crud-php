<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">IT Departments</h2>
                    <a href="index.php?controller=department&action=showNew" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Department</a>
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
                            <td><?php echo "\$dept['progs_count']" ?></td>
                            <td><?php echo $dept["level"] ?></td>
                            <td>
                                <a class="btn btn-outline-primary" href="index.php?controller=department&action=details&id=<?php echo $dept['id']; ?>">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;info</a>
                                <a class="btn btn-outline-danger" href="index.php?controller=department&action=delete&id=<?php echo $dept['id'] ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a></td>
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

<?php include_once 'footer.php';?>