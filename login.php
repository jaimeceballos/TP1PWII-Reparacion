<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Practico Integrador</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #fff;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }

      /* The white background content wrapper */
      .container > .content {
        /*background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);*/
        background-color: #f7f7f7;
		padding: 20px 25px 30px;
		margin: 0 auto 25px;
		width: 304px;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
		-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      }
      .signin-card {
		width: 274px;
		padding: 40px 40px;
	  }
      .login-form {
        margin-left: 2px;
      }

      legend {
        margin-right: -50px;
        font-weight: bold;
          color: #404040;
      }
      .profile-img {
		width: 96px;
		height: 96px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
		}

    </style>

</head>
<body>
  <div class="container">
  	<?php if(isset($_GET['error'])):

  		echo $_GET['error'];

  	 endif; ?>
	<center><label>Bienvenido</label></center>
	<center><label>Ingrese sus datos para comenzar</label></center>

    <div class="content signin-card">
      <div class="row">
        <div class="login-form">
         <center><img id="profile-img" class="profile-img" src="img/avatar_2x.png" alt="" style=""></center>
          <form action="controller/controller.php" method="POST">
            <center>
              <div>
                <input type="text" placeholder="Usuario" class="form-control" style="padding-bottom:10px" name="usuario" required >
   
                <input type="password" placeholder="Contraseña" class="form-control" name="password" required>
              </div>
              <br>
              <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
            </center>
          </form>
        </div>
      </div>
    </div>

  </div> <!-- /container -->
</body>
</html>