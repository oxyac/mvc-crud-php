<?php include_once 'header.php';?>

<div class="thin-panel">
    <div class="d-flex justify-content-between">
        <div>
            <h3>Artist Details</h3>
        </div>
        <div>
            <?php
            var_dump("RECEIVED:\t", $receivedData);
            $returnURL = "index.php?controller=department&action=details&id=" . $receivedData['proger']->department_id;
            $deleteURL = "index.php?controller=department&action=delete&id=" . $receivedData['proger']->id .
                "&department=" . $receivedData['proger']->department_id;
            ?>
            <script>
                function enable(){
                    document.getElementById('project_name').disabled = false;
                    document.getElementById('language').disabled = false;
                    document.getElementById()
                }</script>
            <a onclick="enable()" id="disable" class="btn btn-outline-warning"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit</a>
            <a href="<?php echo $returnURL ?>" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Go Back</a>
            <a class="btn btn-outline-danger" href="<?php echo $deleteURL ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
        </div>
    </div>
    <hr/>
    <form action="index.php?controller=vino&action=actualizar" method="post">
        <input type="hidden" name="id" value="<?php echo $datos["vino"]->id ?>"/>
        <input type="hidden" name="department" value="<?php echo $datos["bodega"] ?>"/>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input disabled type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $data['vino']->nombre ?>">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea disabled class="form-control" name="descripcion" id="descripcion" rows="3"><?php echo $datos['vino']->descripcion ?></textarea>
        </div>

        <div class="form-group">
            <label for="ano">Año</label>
            <input  disabled type="text" name="ano" class="form-control" id="ano" value="<?php echo $data['vino']->ano ?>">
        </div>

        <div class="form-group">
            <label for="alcohol">Alcohol</label>
            <input disabled type="text" name="alcohol" class="form-control" id="alcohol" value="<?php echo $data['vino']->alcohol ?>">
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de vino</label>
            <select disabled class="form-control" id="tipo" name="tipo">
                <option value="tinto" <?php echo $data['vino']->tipo == 'tinto'? 'selected' : '' ?>>Tinto</option>
                <option value="blanco" <?php echo $data['vino']->tipo == 'blanco'? 'selected' : '' ?>>Blanco</option>
                <option value="rosado" <?php echo $data['vino']->tipo == 'rosado'? 'selected' : '' ?>>Rosado</option>
            </select>
        </div>


        <button disabled type="submit" class="btn btn-primary">Actualizar Vino</button>
    </form>
</div>





<?php include_once 'footer.php';?>

