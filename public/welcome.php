<?php //session_start();
	require_once("classes/Usuario.php");
	if(isset($_SESSION['archivo']) && $_SESSION['archivo']!="" ){
		$archivo =$_SESSION['archivo'];
	}
	if(isset($_SESSION['usuario'])){
		$usuario = unserialize($_SESSION['usuario']);
                //$usuario = new classes\Usuario($usuario['id'],$usuario['user'],$usuario['pass'],$usuario['rol']);
	}
	if(isset($_SESSION['session_begin']) && $_SESSION['session_begin'] !=""){
		$session_begin = $_SESSION['session_begin'];
	}
        if(isset($_GET['err'])){
            $error = $_GET['err'];
        }
        if(isset($_GET['conf'])){
            $conf = $_GET['conf'];
        }
        
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>sin título</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<style type="text/css">
	.cuerpo{
		padding-top:60px;
	}
        .body{
            margin-left: 100px;
            margin-right: 20px;
            width: 80%;
        }
	</style>
</head>
<?php if(empty($_SESSION['404'])): ?>
<body class="body">
	<div class="container">
	<div class="row clearfix">
            
		<div class="col-xs-10">
			<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#">Clientes_bd</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						
						<li class="dropdown">
                                                    <?php if($usuario->getRol() == 'cliente' ): ?>
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="controller/controller.php?op=listar">Listar</a>
								</li>
								<li>
									<a href="controller/controller.php?op=nuevo">Nuevo</a>
								</li>
								<li>
                                                                    <a href="controller/controller.php?op=buscar_form">Buscar</a>
								</li>
							</ul>
                                                    <?php else : ?>
                                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empleados<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="controller/controller.php?op=abm_Cliente">Alta/edicion de Clientes</a>
								</li>
								<li>
									<a href="controller/controller.php?op=abm_equipo">Alta de Equipo</a>
								</li>
								<li>
                                                                    <a href="controller/controller.php?op=abm_orden">Nueva orden de trabajo</a>
								</li>
							</ul>
                                                         
                                                    <?php endif; ?>   
						</li>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i><?php echo $usuario->getUser() ?><strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="controller/controller.php?op=salir">Salir</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
			</nav>
		</div>
             
	</div>

</div>
<div class="cuerpo">
       
	<?php if(isset($archivo)): ?>
	
	 	<?php include $archivo; ?>

	<?php else: ?>	
            <?php var_dump($usuario) ?>
	 	   <h3> Bienvenido <?php echo $usuario->getUser() ?> <small>iniciaste session el: <?php echo $session_begin ?></small></h3>
	<?php endif; ?>
</div>
</body>
<?php else: ?>
    <body>
        <?php include '404.php' ?>
        
    </body>
<?php endif; ?>
</html>