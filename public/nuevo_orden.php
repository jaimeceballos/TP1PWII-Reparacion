<?php (!empty($_SESSION['tipos_orden'])) ? $tipos_orden = $_SESSION['tipos_orden'] : $tipos_orden = Array();
      (!empty($_SESSION['clientes'])) ? $clientes = $_SESSION['clientes'] : $clientes = Array();
?>

<div class="row clearfix">
    
   
    <h1>Nueva orden</h1>
    <hr>
    <div class="col-md-12 column">
        <?php if (isset($conf)): ?>
            <div class="alert alert-dismissable alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Orden guardada correctamente</strong> 
            </div>
        <?php endif; ?>
        <?php if (isset($err)): ?>
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>La orden no se guardo</strong> 
            </div>
        <?php endif; ?>
        <form role="form" method="POST" action = "controller/controller.php">

            <input type="hidden" name="formulario" value="nueva_orden">
            <div class="form-group">
              <label for="cliente_id">Cliente</label>
                <select  class="form-control" name="cliente_id" id="cliente_id" required>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['ape_nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo_orden_id">Tipo orden</label><select  class="form-control" name="tipo_orden_id" id="tipo_orden_id" required>
                    <option value="">Seleccione un tipo</option>
                    <?php foreach ($tipos_orden as $tipo): ?>
                        <option value="<?php echo $tipo['id'] ?>"><?php echo $tipo['descripcion'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
              <label for="equipo">Equipo</label>
                <select multiple class="form-control" name="equipo" id="equipo" required disabled>
                    <option value="">Seleccione un cliente</option>
                </select><br>
              <a href="controller/controller.php?op=alta_equipo" id="nuevo" class="btn btn-danger btn-xs pull-right" style="display: none">Cargar Equipo</a>
            </div>
            
            <div class="form-group">
                <label for="descripcion_falla">Describa la falla que presenta el equipo</label><textarea class="form-control" rows="4" cols="50" id="descripcion_falla" name ="descripcion_falla" required></textarea>
            </div>
            
     <a href="controller/controller.php?op=abm_equipo" class="btn btn-link">Volver al listado</a>
     <button type="submit" class="btn btn-success pull-right" id="guardar" disabled>Guardar</button>
     
</form>
</div>
</div>