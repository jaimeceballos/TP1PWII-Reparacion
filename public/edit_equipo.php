<?php (!empty($_SESSION['tipos_equipo'])) ? $tipos_equipo = $_SESSION['tipos_equipo'] : $tipos_equipo = Array();
      (!empty($_SESSION['clientes'])) ? $clientes = $_SESSION['clientes'] : $clientes = Array();
      if(isset($_SESSION['equipo'])){
          $equipo = unserialize($_SESSION['equipo']);
      }
?>

<div class="row clearfix">
    <h1>Editar Equipo</h1>
    <hr>
    <div class="col-md-12 column">
        <?php if (isset($conf)): ?>
            <div class="alert alert-dismissable alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Equipo guardado correctamente</strong> 
            </div>
        <?php endif; ?>
        <?php if (isset($err)): ?>
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>El equipo no se guardo</strong> 
            </div>
        <?php endif; ?>
        <form role="form" method="POST" action = "controller/controller.php">

            <input type="hidden" name="formulario" value="edit_equipo">
            <input type="hidden" name="id" value="<?php echo $equipo->id ?>">
            
            <div class="form-group">
                <label for="tipo_equipo_id">Tipo Equipo</label><select  class="form-control" name="tipo_equipo_id" id="tipo_equipo_id" required>
                    <option value="">Seleccione un tipo</option>
                    <?php foreach ($tipos_equipo as $tipo): ?>
                        <?php if($equipo->tipo_equipo_id == $tipo['id']): ?>
                            <option value="<?php echo $tipo['id'] ?>" selected="selected" ><?php echo $tipo['descripcion'] ?></option>
                        <?php else: ?>
                            <option value="<?php echo $tipo['id'] ?>"><?php echo $tipo['descripcion'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
		<label for="cliente_id">Cliente</label>
                <select  class="form-control" name="cliente_id" id="cliente_id" required>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <?php if($equipo->cliente_id == $cliente['id']): ?>
                    <option value="<?php echo $cliente['id'] ?>" selected="selected"><?php echo $cliente['ape_nom'] ?></option>
                        <?php else: ?>
                            <option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['ape_nom'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion_equipo">Descripcion del equipo</label><textarea class="form-control" rows="4" cols="50" id="descripcion_equipo" name ="descripcion_equipo" required><?php echo $equipo->descripcion_equipo ?></textarea>
            </div>
            <div class="form-group">
                <label for="estado_general">Estado general del equipo recibido</label><textarea class="form-control" rows="4" cols="50" id="estado_general" name ="estado_general" required><?php echo $equipo->estado_general ?></textarea>
            </div>
            
     <a href="controller/controller.php?op=abm_equipo" class="btn btn-link">Volver al listado</a>
     <button type="submit" class="btn btn-success pull-right">Guardar</button>
     
</form>
</div>
</div>