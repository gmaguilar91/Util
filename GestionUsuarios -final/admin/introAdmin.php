<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
if (!$sesion) {
    header("Location:../index.php");
}

$usuario = $sesion->getUser();
$avatar = $usuario->getAvatar();
$email = $usuario->getEmail();
$alias = $usuario->getAlias();

?>
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
        <link rel="stylesheet" href="../js/intro/introjs.css" type="text/css" />
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
                                <img src="<?php echo $avatar; ?>" alt="...">
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
                                <a href="index.php">Logout</a>
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
                                                    <img src="<?php echo $avatar; ?>" class="dker" alt="...">
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
                                                    <a href="index.php">Logout</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>                
                                    <!-- nav -->                 
                                    <nav class="nav-primary hidden-xs">
                                        <ul class="nav nav-main" data-ride="collapse">
                                            <li  class="active">
                                                <a href="profileAdmin.php" class="auto">
                                                    <i class="i i-statistics icon">
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
                                <a href="index.php" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
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
                            <header class="header bg-white b-b b-light">
                                <p>This is a header</p>
                            </header>
                            <section>
                                <section class="hbox stretch">
                                    <section>
                                        <section class="vbox">
                                            <section  class="scrollable wrapper">                    
                                                <p class="h4">Contents...</p>
                                            </section>
                                        </section>
                                    </section>
                                    <aside class="bg-light dker  b-l aside-md">
                                        <div class="wrapper dker" id="aside">
                                            This is a aside content
                                        </div>
                                    </aside>
                                </section>                  
                            </section>
                            <footer class="footer bg-white b-t b-light">
                                <p>This is a footer</p>
                            </footer>
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
        <script src="../js/intro/intro.min.js"></script>
        <script src="../js/intro/demo.js"></script>
        <script src="../js/app.plugin.js"></script>
    </body>
</html>