<?php if(isset($_SESSION['cliente'])){
    $cliente = $_SESSION['cliente'];
}
?>
<div class="row clearfix">

    <div class="col-md-12 column">
        <?php if (isset($conf)): ?>
            <div class="alert alert-dismissable alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Cliente modificado correctamente</strong> 
            </div>
        <?php endif; ?>
        <?php if (isset($err)): ?>
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>El cliente no se modifico</strong> 
            </div>
        <?php endif; ?>
        <form role="form" method="POST" action = "controller/controller.php">

            <input type="hidden" name="formulario" value="modifica">
            <input type="hidden" name="id" value="<?php echo $cliente['id'] ?>">
            <div class="form-group">
                <label for="Apellido">Apellido</label><input type="text" class="form-control" name="apellido" value="<?php echo $cliente['apellido'] ?>" required />
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label><input type="text" class="form-control" name="nombre" value="<?php echo $cliente['nombre'] ?>" required />
            </div>
            <div class="form-group">
                <label for="edad">Edad</label><select  class="form-control" name="edad">
                    <option value="">Seleccione Edad</option>
                    <?php for ($i = 1; $i < 100; $i++) : ?>
                        <?php if($i == $cliente['edad']): ?>
                            <option value="<?php echo $i ?>" selected="selected"><?php echo $i ?></option>
                        <?php else: ?>
                            <option value="<?php echo $i ?>" ><?php echo $i ?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>
    <button type="submit" class="btn btn-success pull-right">Modificar</button>
</form>
</div>
    </div> 