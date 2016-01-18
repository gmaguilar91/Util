<?php 
  require '../clases/AutoCarga.php';
  $sesion = new Session();
  if(!$sesion){
    header("Location:../index.php");
  }
  
  $usuario = $sesion->getUser();
  $avatar = $usuario->getAvatar();
  $email = $usuario->getEmail();
  $alias = $usuario->getAlias();
  
  $bd = new DataBase();
  $gestor = new ManageUsuario($bd);
  $usuarios = $gestor->getList();
?>

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
  <link rel="stylesheet" href="../js/datatables/datatables.css" type="text/css"/>
  <!--[if lt IE 9]>
    <script src="../js/ie/html5shiv.js"></script>
    <script src="../js/ie/respond.min.js"></script>
    <script src="../js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="profileAdmin.php" class="navbar-brand">
          <img src="../images/logo.png" class="m-r-sm" alt="scale">
          <span class="hidden-nav-xs">Scale</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="../images/man.png" alt="...">
            </span>
            <?php echo $alias; ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">            
            <li>
              <span class="arrow top"></span>
              <a href="#">Settings</a>
            </li>
            <li>
              <a href="profileAdmin.php">Profile</a>
            </li>

            <li class="divider"></li>
            <li>
              <a href="../index.php">Logout</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
                <aside class="bg-black aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">                        
                        <img src="../images/man.png" class="dker" alt="...">
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt"><?php echo $alias; ?></strong> 
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block"><?php echo $email; ?></span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">                      
                      <li>
                        <span class="arrow top hidden-nav-xs"></span>
                        <a href="#">Settings</a>
                      </li>
                      <li>
                        <a href="profileAdmin.php">Profile</a>
                      </li>

                      <li class="divider"></li>
                      <li>
                        <a href="../index.php">Logout</a>
                      </li>
                    </ul>
                  </div>
                </div>                


                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav nav-main" data-ride="collapse">
                    <li  class="active">
                      <a href="profileAdmin.php" class="auto">
                        <i class="i i-statistics">
                        </i>
                        <span class="font-bold">Home</span>
                      </a>
                    </li>
                    <li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-lab icon">
                        </i>
                        <span class="font-bold">Community</span>
                      </a>
                      <ul class="nav dk">
                        <li >
                            <a href="tableAdmin.php" class="auto">                            
                            <span class="pull-right text-muted">
                              <i class="i i-circle-sm-o text"></i>
                              <i class="i i-circle-sm text-active"></i>
                            </span>                            
                            <i class="i i-dot"></i>
                            <span>Users</span>
                          </a>
                      </ul>
                    </li>
                    <li>
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-docs icon">
                        </i>
                        <span class="font-bold">Pages</span>
                      </a>
                      <ul class="nav dk">
                        <li >
                          <a href="profileAdmin.php" class="auto">
                            <i class="i i-dot"></i>
                            <span>Profile</span>
                          </a>
                        </li>
                        <li >
                          <a href="introAdmin.php" class="auto">
                            <i class="i i-dot"></i>
                            <span>Intro</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="../index.php" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>
              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable padder">
              <div class="m-b-md">
                <h3 class="m-b-none">Datatable</h3>
              </div>
              <section class="panel panel-default">
                <header class="panel-heading">
                  DataTables 
                  <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i> 
                </header>
                <div class="table-responsive">
                  <table class="table table-striped m-b-none">
                    <thead>
                      <tr>
                        <th width="20%">Email</th>
                        <th width="25%">Alias</th>
                        <th width="15%">Date</th>
                        <th width="15%">Active</th>
                        <th width="15%">Admin</th>
                        <th width="15%">Staff</th>
                        <th width="15%">Avatar</th>
                        <th width="15%"></th>
                        <th width="15%"></th>

                      </tr>
                    </thead>
                    <tbody>
                        <!-- Php code here-->
                        <tr>
                            <?php foreach ($usuarios as $indice => $user) { ?>
                            <tr><td width="20%"><?php echo $user->getEmail(); ?></td>
                            <td width="25%"><?php echo $user->getAlias(); ?></td>
                            <td width="15%"><?php echo $user->getFechaalta(); ?></td>
                            <td width="15%"><?php echo $user->getActivo(); ?></td>
                            <td width="15%"><?php echo $user->getAdministrador(); ?></td>
                            <td width="15%"><?php echo $user->getPersonal(); ?></td>
                            <td width="15%"><?php echo $user->getAvatar(); ?></td>
                            <td width="15%"><form action="editAdmin.php" method="post" enctype="multipart/form-data"><button type="submit"
                                            value="<?php echo $user->getEmail(); ?>" name="edit">Edit</button></form></td>
                            <td width="15%"><form action="editAdmin.php" method="post" enctype="multipart/form-data"><button type="submit"
                                            value="<?php echo $user->getEmail(); ?>" class="borrar">Delete</button></td></tr>
                            <?php } ?>
                            
                        </tr>
                    </tbody>
                  </table>
                    <br/>
                    <form action="phpNewUserAdmin.php" method="post" enctype="multipart/form-data">
                        <h2>New user</h2>
                        <input type="email" placeholder="Email" id="email" name="email"/>
                        <input type="password" placeholder="Password" id="contrasena" name="contrasena"/>
                        <input type="checkbox" id="activo" name="activo"/>Active
                        <input type="checkbox" id="admin" name="admin"/>Admin
                        <input type="checkbox" id="personal" name="personal"/>Staff
                        <input type="submit" value="New user"/>
                    </form>
                </div>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
  <script src="../js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
  <script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
  <!-- datatables -->
<script src="../js/datatables/jquery.dataTables.min.js"></script>
<script src="../js/datatables/jquery.csv-0.71.min.js"></script>
<script src="../js/datatables/demo.js"></script>
  <script src="../js/app.plugin.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>