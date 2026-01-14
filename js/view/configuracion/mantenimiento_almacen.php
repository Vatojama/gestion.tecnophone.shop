<?php
session_start();
require_once("../../model/modelo_conexion.php");
require_once("../../model/modelo_rol.php");
$rol = new Modelo_Rol();
$datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'], 32); // EL 32 ES MENU sucursales
//var_dump($datos);
if (isset($_SESSION['S_IDUSUARIO'])) {

  if (is_array($datos) and count($datos) > 0) {
?>
    <script src="../js/almacen.js?rev=<?php echo time(); ?>"></script>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title"><b>Listado de Almacenes</b></h3>
          <button class="btn btn-info btn-sm float-right" id="btn_abrir_modalAlmaca"><i class="fas fa-plus"></i> Nuevo</button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 table-responsive">
              <table id="tabla_almacen" class="display compact">
                <thead style="background:#343A40; color:white" class="small text left">
                  <tr>
                    <th>Nombre</th>
                    <th>Abreviatura</th>
                    <th style="text-align: center;">Estado</th>
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

    <!-- Modal registrar -->
 <div class="modal fade" id="modal_registro_almacen" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Almacen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-8 col-12 ">
                <label form="">Desripcion: </label>
                <input type="text" id="text_descrip_al" class="form-control form-control-sm" placeholder="Descripcion del almacen">
              </div>
              <div class="col-md-4 col-12 ">
                <label form="">Abreviatura: </label>
                <input type="text" id="text_abre_al" class="form-control form-control-sm" placeholder="abreviatura del almacen">
              </div>
             
                <!-- <div class="col-12 col-xs-12">
                      <label form="">Estado: </label>
                    <select class="form-control form-control-sm js-example-basic-single" id="select_estado_su" style="width: 100%">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
              </div> -->
            </div>


          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btn_registrar_almacen">Registrar</button>
            </div>
          </div>
        </div>
</div>
</div>
      <!-- fin Modal --> 


    <!-- Modal editar -->
 <div class="modal fade" id="modal_editar_almacen" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar Almacen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <input type="text" id="id_almacen" class="form-control form-control-sm" hidden> 
              
              <div class="col-md-8 col-12 ">
                <label form="">Desripcion: </label>
                <input type="text" id="text_descrip_al_editar" class="form-control form-control-sm" placeholder="Descripcion del almacen">
              </div>
              <div class="col-md-4 col-12 ">
                <label form="">Abreviatura: </label>
                <input type="text" id="text_abre_al_editar" class="form-control form-control-sm" placeholder="abreviatura del almacen">
              </div>
             
                <div class="col-md-12 col-12">
                      <label form="">Estado: </label>
                    <select class="form-control form-control-sm js-example-basic-single" id="select_estado_al" style="width: 100%">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
              </div> 
            </div>


          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btn_actualizar_almacen">Actualizar</button>
            </div>
          </div>
        </div>
</div>
</div>
      <!-- fin Modal --> 


<script>
        //para el diseño del combo
        $(document).ready(function() {
          $('.js-example-basic-single').select2();


          Listar_Almacenes();
          
        });
       


         $('#btn_abrir_modalAlmaca').click(function() {
            AbrirModalRegistroAlmacen();
          });

           $('#btn_registrar_almacen').click(function() {
            RegistrarAlmacen();
          });

           $('#btn_actualizar_almacen').click(function() {
            ModificarAlmacen();
          });





</script>

  <?php
  } else {
    header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
  }
} else {
  header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
}
  ?>