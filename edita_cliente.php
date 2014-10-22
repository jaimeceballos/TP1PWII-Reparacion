<?php if(isset($_SESSION['cliente'])){
    $cliente = unserialize($_SESSION['cliente']);
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
            <input type="hidden" name="id" value="<?php echo $cliente->id ?>">
            <div class="form-group">
                <label for="ape_nom">Apellido y nombre / razon social</label><input type="text" class="form-control" name="ape_nom" id="ape_nom" value="<?php echo $cliente->ape_nom ?>" required />
            </div>
            <div class="form-group">
                <label for="nombre">Es persona Juridica?</label> <select class="form-control" id="juridica" name="juridica" readonly="readonly">
                    <?php for ($i = 0; $i < 2; $i++): ?>
                        <?php if ($i == $cliente->juridica): ?>
                            <option value="<?php echo $i ?>" selected="selected"><?php echo ($i == 0) ? 'no' : 'si' ?></option>
                        <?php else: ?>
                            <option value="<?php echo $i ?>" ><?php echo ($i == 0) ? 'no' : 'si' ?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="<?php echo ($cliente->juridica == 0) ? 'dni' : 'cuit'; ?>"><?php echo ($cliente->juridica == 0) ? 'DNI' : 'CUIT'; ?></label><input type="text" class="form-control" name="<?php echo ($cliente->juridica == 0) ? 'dni' : 'cuit'; ?>" id="<?php echo ($cliente->juridica == 0) ? 'dni' : 'cuit'; ?>" value="<?php echo ($cliente->juridica == 0) ? $cliente->dni : $cliente->cuit ?>" required readonly="readonly"/>
            </div>
            <div class="form-group">
                <label for="domicilio">Domicilio</label><input type="text" class="form-control" name="domicilio" id="domicilio" value="<?php echo $cliente->domicilio ?>" required />
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label><input type="number" class="form-control" name="telefono" id="telefono" value="<?php echo $cliente->telefono ?>" />
            </div>
            <div class="form-group">
                <label for="email">Correo electronico</label><input type="email" class="form-control" name="email" id="email" value="<?php echo $cliente->email ?>"/>
            </div>
    <a href="controller/controller.php?op=abm_Cliente" class="btn btn-link">Volver al listado</a>        
    <button type="submit" class="btn btn-success pull-right">Modificar</button>
</form>
</div>
    </div> 