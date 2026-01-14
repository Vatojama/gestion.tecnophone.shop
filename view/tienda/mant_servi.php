<?php
session_start();
require_once '../../model/modelo_tienda.php';

require_once("../../model/modelo_conexion.php");
require_once("../../model/modelo_rol.php");
$rol = new Modelo_Rol();
$datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'], 31); // ID DEL MENU TIENDA - SERVICIOS

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
          <h3 class="card-title"><b>Listado de Servicios</b></h3><label for="" id="text_estado" hidden></label>
          <!-- <button class="btn btn-info btn-sm float-right" id="textnuevo_banner" ><i class="fas fa-plus"></i> Nuevo</button> -->
          <button class="btn btn-info btn-sm float-right" id="textnuevo_servi"><i class="fas fa-plus"></i> Nuevo</button>
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-12 table-responsive">
              <table id="tabla_servic" class="display compact">
                <thead style="background:#343A40; color:white" class="small text left">
                  <tr>

                    <th>Titulo </th>
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


    <!-- Modal REGISTRAR SERVICIO -->
    <div class="modal fade" id="modal_registrar_servi" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">
            <div class="col-12 ">
                          <label for="">Titulo</label>
                          <input type="text" name="text_titulo" class="form-control form-control-sm" id="text_titulo"  onkeyup="mayus(this);" placeholder="Descripcion">
                      </div>

            <div class="col-12">
            <label for="servicio_descripcion">Descripción del Servicio</label>
            <textarea id="servicio_descripcion" name="servicio_descripcion"></textarea>
          </div>



            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btn_registrarServi">Registrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->

     <!-- Modal EDITAR SERVICIO -->
     <div class="modal fade" id="modal_editar_servi" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">
            <div class="col-12 ">
              <input type="text" id="id_Servicio">
                          <label for="">Titulo</label>
                          <input type="text" name="text_titulo_editar" class="form-control form-control-sm" id="text_titulo_editar"  onkeyup="mayus(this);" placeholder="Descripcion">
                      </div>

            <div class="col-12">
            <label for="servicio_descripcion">Descripción del Servicio</label>
            <textarea id="servicio_descripcion_editar" name="servicio_descripcion_editar"></textarea>
          </div>



            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btn_editarServi">Registrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->

    <script>
      $(document).ready(function() {
         Listar_Servi();
        $('#servicio_descripcion').summernote({
          height: 200
        });
        $('#servicio_descripcion_editar').summernote({
          height: 200
        });



      });


      $("#textnuevo_servi").on('click', function() {
        AbrirModalRegistroServi();
      });


      $("#btn_registrarServi").on('click', function() {
        RegistrarServi();
      });

      $("#btn_editarServi").on('click', function() {
        EditarServi();
      });


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