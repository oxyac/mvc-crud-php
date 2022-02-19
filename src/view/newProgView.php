<?php include_once 'header.php';?>

    <div class="thin-panel">
        <div class="d-flex justify-content-between">
            <div>
                <h3>New Artist</h3>
            </div>
            <div>
                <a href="index.php" class="btn btn-info">Return to Home Page</a>
            </div>
        </div>
        <hr>
        <form action="index.php?controller=programmer&action=create" method="post">
            <input type="hidden" name="bodega" value="<?php echo $receivedData["depId"] ?>"/>
            <div class="form-group">
                <label for="first_name">Nume</label>
                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Grigore" required>
            </div>

            <div class="form-group">
                <label for="last_name">Prenume</label>
                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Vieru" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="(+373)">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="g.vieru@unifun.com">
            </div>



            <button type="submit" class="btn btn-primary">Add Artist</button>
        </form>
    </div>

    <script src="../assets/js/script.js"></script>


<?php include_once 'footer.php';?>