<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>Scale | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../css/icon.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="../js/ie/html5shiv.js"></script>
    <script src="../js/ie/respond.min.js"></script>
    <script src="../js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div class="container aside-xl">
      <a class="navbar-brand block" href="../index.php"><img src="../images/logo.png"/> Galería</a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>Sign up to find interesting thing</strong>
        </header>
          <form action="phpInsertaUsuario.php" method="post" enctype="multipart/form-data">
          <div class="list-group">
            <div class="list-group-item">
              <input placeholder="Email" type="email" class="form-control no-border" id="email" name="email">
            </div>
            <div class="list-group-item">
              <input type="password" placeholder="Password" class="form-control no-border" id="contrasena" name="contrasena">
                <span id="01"></span>
            </div>
            <div class="list-group-item">
               <input type="password" placeholder="Confirm password" class="form-control no-border" id="validaContrasena" name="validaContrasena">
                <span id="02"></span>
            </div>
          </div>
          <div>
          </div>
          <button type="submit" class="btn btn-lg btn-primary btn-block" id="registrarse">Sign up</button>
          <div class="line line-dashed"></div>
          <a href="../index.php" class="btn btn-lg btn-default btn-block">Back to the gallery</a>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>Gestión de usuarios || DWES<br>&copy; 2016</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="../js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
  <script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="../js/app.plugin.js"></script>
  <script src="../js/validarPass.js"></script>
</body>
</html>