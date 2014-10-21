<div class="row clearfix">
    <h3>Realizar la busqueda de clientes</h3>
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
        <form role="form" method="GET" action = "controller/controller.php">

            <input type="hidden" name="formulario" value="buscar">
            <div class="form-group">
                <label for="Apellido">Apellido</label><input type="text" class="form-control" name="apellido" placeholder="Ingrese un Apellido" />
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label><input type="text" class="form-control" name="nombre" placeholder="Ingrese un nombre" />
            </div>
           <!-- <div class="form-group">
                <label for="edad">Edad</label><select  class="form-control" name="edad">
                    <option value="">Seleccione Edad</option>
                    <!--?php for ($i = 1; $i < 100; $i++) : ?>
                        <option value="<!--?php echo $i ?>" ><!--?php echo $i ?></option>
                    <!--?php endfor; ?>
                </select>
            </div>-->
            <button type="submit" class="btn btn-info pull-right">Buscar</button>
        </form>
    </div>
    <?php if(isset($_SESSION['listado'])): ?>
    <hr>
    <h3>Resultados de la busqueda</h3>
        <?php include 'listado.php'; ?>
    <?php endif; ?>
</div>