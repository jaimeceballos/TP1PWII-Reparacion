<div class="row clearfix">
    <h1>Nuevo cliente</h1>
    <hr>
    <div class="col-md-12 column">
        <?php if (isset($conf)): ?>
            <div class="alert alert-dismissable alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Cliente guardado correctamente</strong> 
            </div>
        <?php endif; ?>
        <?php if (isset($err)): ?>
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>El cliente no se guardo</strong> 
            </div>
        <?php endif; ?>
        <form role="form" method="POST" action = "controller/controller.php">

            <input type="hidden" name="formulario" value="nuevo">
            <div class="form-group">
                <label for="ape_nom">Apellido y nombre / Razon social</label><input type="text" class="form-control" name="ape_nom" id="ape_nom" placeholder="Ingrese Apellido y nombre o razon social" required />
            </div>
            <div class="form-group">
		<label for="juridica">Es persona Juridica?</label>
                <select  class="form-control" name="juridica" id="juridica">
                    <option value="0">no</option>
                    <option value="1">si</option>
                </select>
            </div>
            <div class="form-group" style="display:none" id="divcuit">
                <label for="cuit">Cuit</label><input type="text" class="form-control" name="cuit" id="cuit" placeholder="Ingrese numero de cuit"/>
            </div>
            <div class="form-group" id="divdni">
                <label for="dni">DNI</label><input type="text" class="form-control" name="dni" id="dni" placeholder="Ingrese numero de dni" required />
            </div>
            <div class="form-group">
                <label for="domicilio">Domicilio</label><input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Ingrese el domicilio" required />
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label><input type="number" class="form-control" name="telefono" id="telefono" placeholder="Ingrese el numero de telefono" />
            </div>
            <div class="form-group">
                <label for="email">Correo Electronico</label><input type="email" class="form-control" name="email" id="email" placeholder="Ingrese el correo electronico" />
            </div>
     <a href="controller/controller.php?op=abm_Cliente" class="btn btn-link">Volver al listado</a>
     <button type="submit" class="btn btn-success pull-right">Guardar</button>
     
</form>
</div>
</div>