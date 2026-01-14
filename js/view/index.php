<?php
session_start();

if (!isset($_SESSION['S_IDUSUARIO'])) { 
    header('Location: ../index.php');
}

require_once '../model/modelo_gasto.php';
require_once("../model/modelo_rol.php");

$rol = new Modelo_Rol();


$datos = $rol->get_menu_x_rol($_SESSION['S_ROL']);

$vistaInicioRuta = null;

// Iterar sobre los datos para buscar el registro con vista_inicio = 1
foreach ($datos as $row) {
    if ($row['vista_inicio'] == 1) {
        $vistaInicioRuta = $row['men_ruta'];
        break; // Salir al encontrar la primera vista de inicio
    }
}

// Si se encontró una ruta, generar un script para cargarla dinámicamente
if ($vistaInicioRuta !== null) {
    echo "<script>
        window.onload = function() {
            cargar_contenido('contenido_principal', '$vistaInicioRuta');
        }
    </script>";
} else {
    // Si no hay vista de inicio, puedes cargar una vista por defecto
    echo "<script>
        window.onload = function() {
            cargar_contenido('contenido_principal', '404/mant_error.php');
        }
    </script>";
}


$nombre_sist2 = Modelo_Gasto::Listar_data_Configuracion();


?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $nombre_sist2['data'][0]['confi_nombre_sistema']; ?> </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" type="text/css" href="../utilitarios/summernote/font/summernote.woff2" />
    <link rel="stylesheet" type="text/css" href="../utilitarios/summernote/font/summernote.woff" />
    <link rel="stylesheet" type="text/css" href="../utilitarios/summernote/font/summernote.ttf" />

    


    <!-- Font Awesome Icons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" type="text/css" href="../utilitarios/ionicons.min.css" />
    <link rel="stylesheet" href="../plantilla/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../plantilla/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="../utilitarios/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/select2/css/select2.min.css" />
     <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="../utilitarios/select2.min.css"/> -->
    <link rel="stylesheet" type="text/css" href="../utilitarios/summernote/summernote-lite.min.css" />

   
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet"> -->
</head>

<body class="sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- NOTAS -->
                <li class="nav-item dropdown" id="ocultar_notas" >
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-info navbar-badge" id="lbl_contador_notas">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <div id="div_cuerpo_notas" style="max-height: 200px; overflow-y: auto; word-wrap: break-word; overflow-wrap: break-word;  white-space: normal;">

                        </div>



                        <div class="dropdown-divider"></div>
                     <a  class="dropdown-item dropdown-footer regist_not"><b>Registrar</b></a>
                    </div>
                </li>

                <!--NOTIFICACIONES-->
                <li class="nav-item dropdown" id="ocultar_notifi" hidden>
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge" id="lbl_contador">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <div id="div_cuerpo">

                        </div>



                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer"><b>Equipos
                                por Entregar</b></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">

                        <!-- llamamos el nombre del usuario (sesion ya creada) -->
                        <?php echo $_SESSION['S_USUARIO'] ?>
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" style="font-size:large;" onclick="cargar_contenido('contenido_principal','usuario/mantenimiento_perfil.php')">
                            <i class="fas fa-user-cog mr-2"></i>
                            <span class="text-muted text-sm">Perfil</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../controller/usuario/destruir_sesion.php" class="dropdown-item" style="font-size:large;">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span class="text-muted text-sm">Cerrar Sesion</span>
                        </a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../<?php echo $nombre_sist2['data'][0]['config_foto']; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light"><?php echo $nombre_sist2['data'][0]['confi_nombre_sistema']; ?></span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- SidebarSearch Form -->
                <div class="form-inline">

                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class  -->
                        <input type="text" value="<?php echo $_SESSION['S_IDUSUARIO'];  ?>" id="text_Idprincipal" hidden disabled>
                        <input type="text" value="<?php echo $_SESSION['S_ROL'];  ?>" id="text_idrol" hidden disabled>
                         <input type="text" value="<?php echo $_SESSION['S_IDSUCURSAL'];  ?>" id="text_idsucurs" hidden  disabled>
                         <input type="text" value="<?php echo $_SESSION['S_IDALMACEN'];  ?>" id="text_idalmacen" hidden  disabled>

                        <!-- <li class="nav-header" style="text-align:center;">RECEPCION</li> -->
                          <!-- DASHBOARD -->
                          <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "17") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="fas fa-tachometer-alt nav-icon"></i>
                                                
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                        ?>


                        <!-- RECEPCION -->

                        <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "5" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>
                            <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Recepción
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "5" && $row["mend_permi"] == "Si")  {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>

                        <!-- REPARACION PARA EL TECNICO -->
                        <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "6") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="fas fa-coins nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                        ?>

                         <!-- FINALIZAR RECEPCION - SERVICIO -->
                         <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "7") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="fas fa-coins nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                        ?>

                        <!-- <li class="nav-header" style="text-align:center;">VENTAS</li> -->

                        <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "8" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas  fas fa-cash-register"></i>
                                <p>
                                    Caja
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "8") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>

                         <!-- VENTAS -->
                         <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "13") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="fas fa-shopping-cart nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                        ?>

                         <!-- CLIENTES -->
                         <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "14") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="fas fa-user-tie nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                        ?>

                          <!-- PRODUCTOS -->    
                           
                          <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "9" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-box-open"></i>
                                        <p>
                                            Productos
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <?php
                                        foreach ($datos as $row) {
                                            if ($row["grupo_id"] == "9") {
                                                ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p><?php echo $row["men_vista"]; ?></p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                             <?php
                            }
                            ?>


                            <!-- TIENDA -->    
                                                    
                            <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "19" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-box-open"></i>
                                        <p>
                                            Tienda
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <?php
                                        foreach ($datos as $row) {
                                            if ($row["grupo_id"] == "19") {
                                                ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p><?php echo $row["men_vista"]; ?></p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                             <?php
                            }
                            ?>

                          <!-- COTIZACIONES --> 
                          <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "10" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>          
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Cotizacion
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <?php
                                        foreach ($datos as $row) {
                                            if ($row["grupo_id"] == "10") {
                                                ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p><?php echo $row["men_vista"]; ?></p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>


                        <!-- <li class="nav-header" style="text-align:center;">MANTENIMIENTO</li> -->

                        <!-- USUARIOS -->    
                         
                        <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "2" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>     
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Usuarios
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <?php
                                        foreach ($datos as $row) {
                                            if ($row["grupo_id"] == "2") {
                                                ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p><?php echo $row["men_vista"]; ?></p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>

                       
                         <!-- EMPRESA  Y SUCURSAL -->
                       

                         <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "4" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>              
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Configuracion
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <?php
                                        foreach ($datos as $row) {
                                            if ($row["grupo_id"] == "4") {
                                                ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p><?php echo $row["men_vista"]; ?></p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                       

                         <!-- COPIA DE SEGUIDAD QUITADO -->

                         <!-- <li class="nav-header" style="text-align:center;">REPORTES</li> -->

                         <!-- REPORTE REPARACIONES -->
                         <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "15") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="fas fa-file-alt nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                        ?>


                        <!-- REPORTE GASTOS -->
                        <?php
                                foreach ($datos as $row) {
                                    if ($row["grupo_id"] == "16") {
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                <i class="fas fa-file-alt nav-icon"></i>
                                                <p><?php echo $row["men_vista"]; ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                        ?>

                         <!-- REPORTE VENTAS -->  
                         <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "11" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>              
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Reporte Ventas
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <?php
                                        foreach ($datos as $row) {
                                            if ($row["grupo_id"] == "11") {
                                                ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p><?php echo $row["men_vista"]; ?></p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>


                         <!-- REPORTE PRODUCTOS -->        
                         <?php
                            $haySubmenu = false;
                            foreach ($datos as $row) {
                                if ($row["grupo_id"] == "12" && $row["mend_permi"] == "Si") {
                                    $haySubmenu = true;
                                    break; 
                                }
                            }
                            if ($haySubmenu) {
                            ?>        
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Reporte Productos
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <?php
                                        foreach ($datos as $row) {
                                            if ($row["grupo_id"] == "12") {
                                                ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','<?php echo $row['men_ruta'];?>')">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p><?php echo $row["men_vista"]; ?></p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>

                         




                        


                       


                    </ul>


                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="contenido_principal">
            <!-- Content Header (Page header) -->
            <div class="content-header">



            </div>
            <!-- /.content-header -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024 <a href="#">SerTec</a>.</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Gustavo Masias</b>
            </div>
        </footer>

 <!-- Modal registrar -->
<div class="modal fade" id="modal_registro_notas"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Registro de notas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-12 col-xs-12">
          
                    <label form="">Descripcion: </label>
                    <textarea class="form-control" rows="3" id="text_notas" placeholder="Descripcion.."></textarea>
                  <!-- <input type="text" id="text_notas"   class="form-control form-control-sm"  placeholder="Nombre notas"> -->
            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnregistrarNotas" >Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->



<!-- Modal EDITAR -->
  <div class="modal fade" id="modal_editar_notas"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar notas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-12 col-xs-12">
                        <input type="text" id="idnota_e" hidden>
                    <label form="">Descripcion: </label>
                    <textarea class="form-control" rows="3" id="text_notas_e" placeholder="Descripcion.."></textarea>
                  <!-- <input type="text" id="text_notas"   class="form-control form-control-sm"  placeholder="Nombre notas"> -->
            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnactualizarNotas" >Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../plantilla/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> -->

   
    <!-- Bootstrap 4 -->
    <script src="../plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plantilla/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="../utilitarios/DataTables/datatables.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- PARA FIRMA EN RECEPCION -->
     <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>

    <script src="../utilitarios/sweetalert.js"></script>
    <script src="../js/usuario.js?rev=<?php echo time(); ?>"></script>
     <script src="../js/notas.js?rev=<?php echo time(); ?>"></script> 
    <!-- <script type="text/javascript" src="../utilitarios/select2.min.js"></script> -->
    <script  src="../plantilla/plugins/select2/js/select2.full.min.js"></script>
    <!-- Para los estilos en Excel     -->
    <script src="../utilitarios/buttons.html5.styles.min.js"></script>
    <script src="../utilitarios/buttons.html5.styles.templates.min.js"></script>
    <script src="../utilitarios/sum().js"></script>
    <script src="../plantilla/dist/js/adminlte.min.js"></script>
    <script src="../utilitarios/summernote/summernote-lite.min.js"></script>

   



  <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script> -->

    <script>
        /**********************************************************************
          PRA COLOCAR FECHA DE HOY EN LOS CAMPOS 
 ***********************************************************************/
        $(document).ready(function() {

            let usuid = document.getElementById('text_Idprincipal').value;
            let rolid = document.getElementById('text_idrol').value;
            
            //Traer_datos_widget();
 
            if (rolid == 1) {
                $('#ocultar_notifi').attr('hidden', false);
              
                cargar_Notificaiones_Recepcion(); //administrador
                Notas_usuario(usuid);

            }
            else if (rolid == 4) {
                 $('#ocultar_notifi').attr('hidden', false);
               
                Notificacion_Tecnico(usuid);
                Notas_usuario(usuid);
            }else {

            }

            //AL HACER CLICK EN REGISTRAR
            $(document).on("click","#btnregistrarNotas",function(){
                Registrarnotas();
             
               
            })


            //EDITAR
            $(document).on("click","#btnactualizarNotas",function(){
                Modificar_notas();
             
               
            })
           



        });

        //ABRIR MODAL PARA REGISTRAR
        $(document).on("click",".regist_not",function(){
            AbrirModalRegistroNotas();
        })



        function cargar_contenido(id, vista) {
            $("#" + id).load(vista);
        }


       

        /********************************************************************/
        // PARA BLOQUEAR ANTICLICK F12 CTR U
        /********************************************************************/
        // document.oncontextmenu = function() {
        //      return false
        //  };

        //  onkeydown = e => {
        //      let tecla = e.which || e.keyCode;

        //      // Evaluar si se ha presionado la tecla Ctrl:
        //      if (e.ctrlKey) {
        //          // Evitar el comportamiento por defecto del nevagador:
        //          e.preventDefault();
        //             e.stopPropagation();

        //          // Mostrar el resultado de la combinaci贸n de las teclas:
        //      if (tecla === 85)// U
        //              console.log(" ");

        //          if (tecla === 83) //S
        //              console.log(" ");

        //          if (tecla === 123) //F12
        //              console.log(" ");
        //      }
        //  }


        //  $(document).keydown(function(event) {
        //      if (event.keyCode == 123) { // Prevent F12
        //          return false;
        //      } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        //          return false;
        //      }
        //     });


       




        /**********************************************************************
                    CREAR COLORES RGB ALEATORIOS
         ************************************************************************/
        function generarNumero(numero) {
            return (Math.random() * numero).toFixed(0);
        }

        function colorRGB() {
            var coolor = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
            return "rgb" + coolor;
        }







        /**********************************************************************
              TRAER DATOS PARA LA NOTIFICACION
 ***********************************************************************/
        function cargar_Notificaiones_Recepcion() {
            $.ajax({
                url: '../controller/usuario/controlador_traer_notificaciones_rece.php',
                type: 'POST'
            }).done(function(resp) {
                let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
                document.getElementById('lbl_contador').innerHTML = data
                    .length; //cuantas recepciones tengo pendientes
                let llenardata = "";
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        llenardata += '<a href="#" class="dropdown-item">' +
                            '<div class="media">' +
                            '<div class="media-body">' +
                            '<h4 class="dropdown-item-title">' +
                            '<b>Cliente: </b>' + data[i][0] + '' +
                            '<span class="float-right text-sm text-warning"><i class="fas fa-folder-minus"></i></i></span>' +
                            '</h4>' +
                            '<p class="text-sm">Estado: ' + data[i][1] + ' | ' + data[i][3] + '</p>' +

                            '<p class="text-sm text-muted"><i class="fas fa-calendar-alt"></i> Fecha: ' + data[i][
                                2
                            ] + ' </p>' +
                            ' </div>' +
                            '</div>' +

                            '</a>' +
                            '<div class="dropdown-divider"></div>';
                    }
                    document.getElementById('div_cuerpo').innerHTML = llenardata;

                } else {
                    llenardata += "<option value=''>No se encontraron datos</option>";
                    document.getElementById('div_cuerpo').innerHTML = llenardata;
                    //  document.getElementById('select_rol_editar').innerHTML = llenardata;

                }
            })
        }


        function Notificacion_Tecnico(idtecnico) {
            $.ajax({
                url: '../controller/usuario/controlador_notificaciones_tecnico.php',
                type: 'POST',
                data: {

                    idtecnico: idtecnico
                }
            }).done(function(resp) {
                let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
                //console.log(data);
                document.getElementById('lbl_contador').innerHTML = data.length; //cuantas recepciones tengo pendientes
                let llenardata = "";
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        llenardata += '<a href="#" class="dropdown-item">' +
                            '<div class="media">' +
                            '<div class="media-body">' +
                            '<h4 class="dropdown-item-title">' +
                            '<b>Recepcion: </b>' + data[i][4] + '' +
                            '<span class="float-right text-sm text-warning"><i class="fas fa-folder-minus"></i></i></span>' +
                            '</h4>' +
                            '<h4 class="dropdown-item-title">' +
                            '<b>Cliente: </b>' + data[i][0] + '' +
                            '</h4>' +
                            '<h4 class="dropdown-item-title">' +
                            '<b>Estado: </b>' + data[i][1] + '' +
                            '</h4>' +
                            '<p class="text-sm">Equipos: ' + data[i][5] + '</p>' +
                            '<p class="text-sm text-muted"><i class="fas fa-calendar-alt"></i> Fecha: ' + data[i][2] + ' </p>' +
                            ' </div>' +
                            '</div>' +

                            '</a>' +
                            '<div class="dropdown-divider"></div>';
                    }
                    document.getElementById('div_cuerpo').innerHTML = llenardata;

                } else {
                    llenardata += "<option value=''>No se encontraron datos</option>";
                    document.getElementById('div_cuerpo').innerHTML = llenardata;
                    //  document.getElementById('select_rol_editar').innerHTML = llenardata;

                }
            })
        }

        //NOTAS POR USUARIO
        function Notas_usuario(idusuario) {
            $.ajax({
                url: '../controller/notas/controlador_notas_por_usuario.php',
                type: 'POST',
                data: {
                    idusuario: idusuario
                }
            }).done(function(resp) {
                let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
                //console.log(data);
                document.getElementById('lbl_contador_notas').innerHTML = data.length; //cuantas recepciones tengo pendientes
                let llenardata = "";
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        llenardata += '<a href="#" class="dropdown-item">' +
                            '<div class="media">' +
                                '<div class="media-body">' +
                                    '<h4 class="dropdown-item-title">' +
                                    '<b>Nota: </b>' + data[i][1] + '' +
                                    '<span class="float-right text-sm text-warning edit_nota" onClick="editar('+ data[i][0]+')"  id=' + data[i][0] + '><i class="fas fa-edit"></i></i></span>' +
                                    '</h4>' +
                                    '<p class="text-sm text-muted"><i class="fas fa-calendar-alt"></i> ' + data[i][3] + ' <span class="float-right text-sm text-danger" onClick="eliminar('+ data[i][0]+')"  id=' + data[i][0] + '><i class="fas fa-trash"></i></i></span></p>'+
                                
                                ' </div>' +
                            '</div>' +

                            '</a>' +
                            '<div class="dropdown-divider"></div>';
                    }
                    document.getElementById('div_cuerpo_notas').innerHTML = llenardata;

                } else {
                    llenardata += "<option value=''>No se encontraron datos</option>";
                    document.getElementById('div_cuerpo_notas').innerHTML = llenardata;
                    //  document.getElementById('select_rol_editar').innerHTML = llenardata;

                }
            })
        }




      
           

        //  $(document).on("click","#btnnuevo",function(){
        //     $("#modal_registro_notas").modal({
        //         backdrop: 'static',
        //         keyboard: false
        //     });
           
        //     $("#modal_registro_notas").modal('show');
        // });

       



        var idioma_espanol = {
            select: {
                rows: "%d fila seleccionada"
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Ver _MENU_ ",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay informacion en esta tabla",
            "sInfo": "Mostrando (_START_ a _END_) total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
            "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "SInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b>No se encontraron datos</b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "aria": {
                "sSortAscending": ": ordenar de manera Ascendente",
                "SSortDescending": ": ordenar de manera Descendente ",
            }
        }





        /********************************************************************
                       FUNCION SOLO NUMEROS
         ********************************************************************/
        function soloNumeros(e) {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros
            patron = /[0-9]/;
            //patron = /^\d{0,8}(\.\d{1,2})?$/
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }





        /********************************************************************
                       FUNCION SOLO LETRAS
         ********************************************************************/
        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";

            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }


        $(function() {
            var menues = $(".nav-link");
            menues.click(function() {
                menues.removeClass("active");
                $(this).addClass("active");
            });

        });
    </script>
</body>

</html>