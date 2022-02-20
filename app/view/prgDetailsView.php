<?php include_once 'header.php'; ?>
<div class="col-md-6 align-content-center" style="margin: auto">
    <div class="thin-panel">
        <div class="d-flex justify-content-between">
            <div>
                <h3>Artist Details</h3>
            </div>
            <div>
                <?php

                $returnURL = "index.php?Controller=department&action=details&id=" . $receivedData['proger']->department_id;
                $deleteURL = "index.php?Controller=department&action=delete&id=" . $receivedData['proger']->id .
                    "&department=" . $receivedData['proger']->department_id;
                ?>
                <script>
                    function enableA() {
                        document.getElementById('first_name').disabled = false;
                        document.getElementById('last_name').disabled = false;
                        document.getElementById('editBtn').disabled = false;
                        document.getElementById('phone').disabled = false;
                        document.getElementById('email').disabled = false;
                        document.getElementById('level').disabled = false;
                        document.getElementById('department_id').disabled = false;
                        document.getElementById('assText').innerHTML = 'Assign To';

                    }</script>
                <button onclick="enableA()" id="disable" class="btn btn-outline-warning"><i class="fa fa-edit"
                                                                                      aria-hidden="true"></i>&nbsp;&nbsp;Edit</button>
                <a href="<?php echo $returnURL ?>" class="btn btn-outline-primary"><i class="fa fa-arrow-left"
                                                                                      aria-hidden="true"></i>&nbsp;&nbsp;Go
                    Back</a>
                <a class="btn btn-outline-danger" href="<?php echo $deleteURL ?>"><i class="fa fa-trash-o"
                                                                                     aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
            </div>
        </div>
        <hr/>
        <form action="index.php?controller=programmer&action=update" method="post">

            <div class="form-group">
                <label for="first_name">Nume</label>
                <input disabled type="text" name="first_name" class="form-control" id="first_name"
                       value="<?php echo ucwords($receivedData["proger"]->first_name); ?>">


            </div>

            <div class="form-group">
                <label for="last_name">Prenume</label>
                <input disabled type="text" name="last_name" class="form-control" id="last_name"
                       value="<?php echo ucwords($receivedData["proger"]->last_name); ?>">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input disabled type="text" name="phone" class="form-control" id="phone" maxlength="10"
                       value="<?php echo $receivedData["proger"]->phone; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input disabled type="text" name="email" class="form-control" id="email"
                       value="<?php echo $receivedData["proger"]->email; ?>">
            </div>

            <div class="form-group">
                <label for="level">Level</label>
                <select disabled name="level" id="level" type="level">
                    <option value=1 <?php echo $receivedData['proger']->level == 1 ? "selected='selected'" : ""; ?>>Junior</option>
                    <option value=2 <?php echo $receivedData['proger']->level == 2 ? "selected='selected'" : ""; ?>>Middle</option>
                    <option value=3 <?php echo $receivedData['proger']->level == 3 ? "selected='selected'" : ""; ?>>Senior</option>
                </select>
            </div>

            <div class="form-group">
                <label id="assText" for="department_id">Assigned To </label>
                <select disabled name="department_id" id="department_id" type="department_id">

                    <?php foreach ($receivedData['depts'] as $dept) { ?>

                        <option value=<?php echo $dept['id'] ?>
                            <?php echo $dept['id'] == $receivedData['proger']->department_id ? "selected='selected'" : ""; ?>>
                            <?php echo $dept['project_name']; ?>
                        </option>

                    <?php } ?>

                </select>
            </div>


            <button disabled id ="editBtn" type="submit" class="btn btn-primary">UPDATE DETAILS</button>
        </form>
    </div>
</div>


<?php include_once 'footer.php'; ?>

