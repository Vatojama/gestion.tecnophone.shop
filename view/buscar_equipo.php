<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seguimiento</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../plantilla/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="../utilitarios/DataTables/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="../plantilla/plugins/select2/css/select2.min.css"/>
  <link rel="stylesheet" type="text/css" href="../plantilla/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"/>
  <!--<link rel="stylesheet" type="text/css" href="../utilitarios/select2.min.css"/>-->
</head>
<body>

  <br><br>
  <div >
       <div class="col-lg-12">
            <div class="card ">
              <div class="card-header text-center">     
                <h4 ><b>SEGUIMIENTO DEL EQUIPO</b></h4>
              </div>
              <div class="card-body">

                <div class="row">
                  <div class="col-4">
                  </div>
          
                  <div class="col-4">
                    <input type="text" id="text_documento" class="form-control form-control-sm" placeholder="Documento del Cliente">
                  </div>

                  <div class="col-1">
                    
                    <button class="btn btn-info btn-sm" id="buscarrecep"  ><i class="fas fa-search"></i></button>
                  </div>  

                  
                <div class="col-12 table-responsive"><br>
                <label for="">EQUIPOS RECEPCIONADOS</label>
                  <table id="tabla_buscar_equipo" class="display" style="width: 100%">
                      <thead style="background:#343A40; color:white" class="small text left">
                          <tr>
                              <th >Nro.</th>
                              <th >Cliente </th>
                              <th >Equipo</th>
                              <th >Concepto</th>
                              <th >Fecha</th>
                              <th style="text-align: center;">Estado</th>
                          </tr>
                      </thead>
                      <tbody id="tbody_tabla_detalle_pro" class="small text left">
                    
                      </tbody>
                     
                  </table>

            
                </div>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <div class="col-12 table-responsive"><br>
                <label for="">VENTAS REALIZADAS AL CLIENTE</label>
                  <table id="tabla_buscar_ventas" class="display" style="width: 100%">
                      <thead style="background:#343A40; color:white" class="small text left">
                          <tr>
                              <th >Serie</th>
                              <th >Fecha </th>
                              <th >Monto</th>
                              <th >Equipo</th>
                              <th style="text-align: center;">Estado</th>
                          </tr>
                      </thead>
                      <!-- <tbody id="tbody_tabla_detalle_pro" class="small text left">
                    
                      </tbody> -->
                     
                  </table>

            
                </div>


              </div>  
             </div>
            </div>
          </div>
         
     
            <div class="col-12" style="text-align: right;">
            <a href="index.php"  class="btn btn-info btn-sm">Regresar al login</a><br><br>
          </div>
         

    </div>

<!-- jQuery -->
<script src="../plantilla/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plantilla/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="../utilitarios/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="../plantilla/plugins/select2/js/select2.full.min.js"></script>
<script src="../utilitarios/sweetalert.js"></script>
<script src="../js/usuario.js?rev=<?php echo time();?>"></script>
<!--<script type="text/javascript" src="../utilitarios/select2.min.js"></script>-->
<script src="../plantilla/dist/js/adminlte.min.js"></script>


<script src="../js/buscar_equipo.js?rev=<?php echo time();?>"></script>

<script>

   $('#buscarrecep').click(function() {

   Buscar_Equipo();
   Buscar_ventas();
  });

  //


  function validar(){
    let dni = document.getElementById('text_documento').value;
    if (dni.length == 0 ) {
    return Swal.fire("Mensaje de Advertencia","Ingrese Numero del dni del Cliente registrado","warning");
      }

   }

  //  function llamar_func(){
  //   Buscar_Equipo();
  //   Buscar_ventas();
  //   validar();
  //  }


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
    "sUrl":      "",
    "sInfoThousands":      ",",
    "sLoadingRecords": "<b>No se encontraron datos</b>",
    "oPaginate": {
          "sFirst":      "Primero",
          "sLast":       "Ultimo",
          "sNext":       "Siguiente",
          "sPrevious":   "Anterior"
        },
        "aria": {
          "sSortAscending":  ": ordenar de manera Ascendente",
          "SSortDescending": ": ordenar de manera Descendente ",
        }
  }


  </script>

  <!--
<script src="plantilla/dist/js/adminlte.min.js"></script>



<script src="../plantilla/dist/js/adminlte.min.js"></script> -->


</body>
</html>