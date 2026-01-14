<?php
session_start();
require_once '../../model/modelo_tienda.php';

require_once("../../model/modelo_conexion.php");
require_once("../../model/modelo_rol.php");
$rol = new Modelo_Rol();
$datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'], 30); // EL 10 ES MENU PEDIDO
//$nombre_sist2 = Modelo_Gasto::Listar_data_Configuracion();
//var_dump($datos);
if (isset($_SESSION['S_IDUSUARIO'])) {

  if (is_array($datos) and count($datos) > 0) {
?>
    <!-- Content Header (Page header) -->

    <script src="../js/tienda.js?rev=<?php echo time(); ?>"></script>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title"><b>Listado de Pedidos</b></h3><label for="" id="text_estado" hidden></label>

          <!-- <button class="btn btn-info btn-sm float-right" id="textnuevo_PEDIDO"><i class="fas fa-plus"></i> Nuevo</button> -->
        </div>
        <div class="card-body">
          <div class="row">

            <div class="col-5">
              <label for="">Fecha Inicio</label>
              <input type="date" name="" id="text_finicio" class="form-control  form-control-sm">
            </div>
            <div class="col-5">
              <label for="">Fecha Fin</label>
              <input type="date" name="" id="text_ffin" class="form-control  form-control-sm">
            </div>
            <div class="col-2">
              <label for="">&nbsp;</label><br>
              <button class="btn btn-info btn-sm" id="btn_buscarpedidos"><i class="fas fa-search"></i></button>

            </div>

          </div><br>

          <div class="row">
            <div class="col-12 table-responsive">
              <table id="tabla_pedido" class="display compact">
                <thead style="background:#343A40; color:white" class="small text left">
                  <tr>
                    <!-- <th style="width:1%">#</th> -->
                    <th>Nro Pedido </th>
                    <th>Cliente </th>
                    <th>Documento </th>
                    <th>Celular </th>
                    <th>Fecha </th>
                    <th>Total </th>
                    <th>Estado </th>
                    <th style="text-align: center;">Accion</th>
                  </tr>
                </thead>
                <tbody class="small text left">
                </tbody>

              </table>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal ver detalles del pedido -->

    <div class="modal fade" id="modal_detalle_pedido" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Detalles del pedido nro: <span id="text_nrocorrel"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 table-responsive">
                <table id="tabla_pedido_detalle" class="display compact" style="width: 100%">
                  <thead style="background:#343A40; color:white" class="small text left">
                    <tr>
                      <th>Descripcion </th>
                      <th>Cantidad </th>
                      <th>Precio </th>
                      <th>Subtotal </th>
                    </tr>
                  </thead>
                  <tbody class="small text left">

                  </tbody>
                </table>
              </div>
            </div>
            <div class=" row">

           

              <div class="col-lg-6" id="" >
                <input type="text" id="pedidoid" hidden>
             <label form="">Monto total:</label>
             <input type="number" name="" class="form-control form-control-sm" id="text_monto_tot" disabled>
           </div>

              <div class="col-lg-6 col-12">
                <label form="">Estado</label>
                <select class="js-example-basic-single" id="Select_estado_p" style="width:100%">
                  <option value="PENDIENTE">PENDIENTE</option>
                  <option value="EN PROCESO">EN PROCESO</option>
                  <option value="ENVIADO">ENVIADO</option>
                  <option value="COMPLETADO">COMPLETADO</option>
                  <option value="CANCELADO">CANCELADO</option>

                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->


    <script>
      $(document).ready(function() {
        $('.js-example-basic-single').select2();
        fechasmes();
        Listar_Pedidos();


        $('#Select_estado_p').on('change', function() {
            Actualizar_estado_pedido();
        });

      });


      $("#btn_buscarpedidos").on('click', function() {
        Listar_Pedidos();
      });

      function fechasmes() {
        var f = new Date();
        var anio = f.getFullYear();
        var mes = f.getMonth() + 1; // Los meses en JavaScript van de 0 a 11, por lo que sumamos 1.
        var d = f.getDate(); // Día actual

        // Obtener el primer día del mes
        var primerDia = '01';

        // Asegurar que el día y el mes tengan 2 dígitos
        if (d < 10) {
          d = '0' + d;
        }
        if (mes < 10) {
          mes = '0' + mes;
        }

        // Formatear las fechas en formato YYYY-MM-DD
        var fechaInicio = anio + "-" + mes + "-" + primerDia; // Primer día del mes actual
        var fechaFin = anio + "-" + mes + "-" + d; // Fecha actual

        // Establecer los valores en los inputs
        document.getElementById('text_finicio').value = fechaInicio;
        document.getElementById('text_ffin').value = fechaFin;
      }



      /*===================================================================*/
      //PARA MAYUSCULAS
      /*===================================================================*/
      function mayus(e) {
        e.value = e.value.toUpperCase();
      }
    </script>











<?php
  } else {
    header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
  }
} else {
  header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
}
?>