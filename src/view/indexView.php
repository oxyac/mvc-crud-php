<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Programmer Details</h2>
                    <button class="btn btn-success pull-right" data-toggle='modal' data-target='#addModal'>
                        <i class="fa fa-plus"></i> Add New Programmer
                    </button>
                </div>
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Some text in the Modal..</p>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nume</th>
                        <th>Project</th>
                        <th>Limbaj</th>
                        <th>Nivelul</th>
                    </tr>
                    </thead>


                    <?php
                    $i = 1;
                    foreach ($receivedData["programmers"] as $proger) {
//                                $depId = $proger->department_id;
//                                $lang = function($depId){
//                                    return 0;
//                                };
//                                $project = $department->getDepProjectById($departmentId);
                        $level = function ($progerLevel) {
                            switch ($progerLevel) {
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
                                <a class="btn btn-outline-primary" href="index.php?controller=bodega&action=detalle&id=<?php echo $bodega['id']; ?>"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Entrar</a>
                                <a class="btn btn-outline-danger" href="index.php?controller=bodega&action=borrar&id=<?php echo $bodega['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Borrar</a> </td>
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

</body>
<script src="assets/js/script.js"></script>