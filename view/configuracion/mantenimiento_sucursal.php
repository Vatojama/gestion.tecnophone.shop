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
    <script src="../js/sucursales.js?rev=<?php echo time(); ?>"></script>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title"><b>Datos de la Sucursales</b></h3>
          <button class="btn btn-info btn-sm float-right" id="btn_abrir_modalsuc"><i class="fas fa-plus"></i> Nuevo</button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 table-responsive">
              <table id="tabla_sucursales" class="display compact">
                <thead style="background:#343A40; color:white" class="small text left">
                  <tr>
                    <th>Empresa</th>
                    <th>Sucursal</th>
                    <th>Ruc</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Almacen</th>
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
 <div class="modal fade" id="modal_registro_sucursal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Sucursales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">

             
              <!-- <div class="col-12 col-md-12" hidden>
                <label form="">Empresa: </label>
                 <input type="text" id="txt_id_sucursal" class="form-control form-control-sm" >
                 <select class="form-control form-control-sm js-example-basic-single" id="select_empresa" style="width: 100%"> </select> 
              </div> -->
              <div class="col-md-12 col-12 ">
                <label form="">Razon: </label>
                <input type="text" id="text_razon_su" class="form-control form-control-sm" placeholder="Razon social">
              </div>
              <div class="col-md-4 col-12 " hidden>
                <label form="">Ruc: </label>
                <input type="text" id="text_ruc_su" value="9999999999" class="form-control form-control-sm" placeholder="Ruc de la sucursal">
              </div>
              <div class="col-md-8 col-12 ">
                <label form="">Direccion: </label>
                <input type="text" id="text_direccion_su" class="form-control form-control-sm" placeholder="Direccion de la sucursal">
              </div>
              <div class="col-md-4 col-12 ">
                <label form="">Telefono: </label>
                <input type="text" id="text_telefono_su" class="form-control form-control-sm" placeholder="Telefono de la sucursal">
              </div>

              <div class="col-md-8 col-12 ">
                <label form="">Correo: </label>
                <input type="email" id="text_correo_su" class="form-control form-control-sm" placeholder="Correo de la sucursal">
              </div>
              <div class="col-md-4 col-12 ">
                <label form="">Almacen: </label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_almacen" style="width: 100%">

                </select>
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
              <button type="button" class="btn btn-primary" id="btn_registrar_sucu">Registrar</button>
            </div>
          </div>
        </div>
</div>
</div>
      <!-- fin Modal -->

    <!-- Modal Editar -->
 <div class="modal fade" id="modal_editar_sucursal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar de Sucursal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">

             <input type="text" id="id_sucursal" class="form-control form-control-sm" hidden >
              <!-- <div class="col-12 col-md-12" hidden>
                <label form="">Empresa: </label>
                 <input type="text" id="txt_id_sucursal" class="form-control form-control-sm" >
                 <select class="form-control form-control-sm js-example-basic-single" id="select_empresa" style="width: 100%"> </select> 
              </div> -->
              <div class="col-md-12 col-12 ">
                <label form="">Razon: </label>
                <input type="text" id="text_razon_su_editar" class="form-control form-control-sm" placeholder="Razon social">
              </div>
              <div class="col-md-4 col-12 " hidden>
                <label form="">Ruc: </label>
                <input type="text" id="text_ruc_su_editar" class="form-control form-control-sm" placeholder="Ruc de la sucursal">
              </div>
              <div class="col-md-8 col-12 ">
                <label form="">Direccion: </label>
                <input type="text" id="text_direccion_su_editar" class="form-control form-control-sm" placeholder="Direccion de la sucursal">
              </div>
              <div class="col-md-4 col-12 ">
                <label form="">Telefono: </label>
                <input type="text" id="text_telefono_su_editar" class="form-control form-control-sm" placeholder="Telefono de la sucursal">
              </div>

              <div class="col-md-8 col-12 ">
                <label form="">Correo: </label>
                <input type="email" id="text_correo_su_editar" class="form-control form-control-sm" placeholder="Correo de la sucursal">
              </div>
              <div class="col-md-4 col-12 ">
                <label form="">Almacen: </label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_almacen_editar" style="width: 100%">

                </select>
              </div>
              <div class="col-12 col-xs-12">
                    <label form="">Estado: </label>
                   <select class="form-control form-control-sm js-example-basic-single" id="select_estado_editar" style="width: 100%">
                       <option value="Activo">Activo</option>
                       <option value="Inactivo">Inactivo</option>
                   </select>
            </div>
            </div>


           </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btn_editar_sucu">Actualizar</button>
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


           Listar_Sucursales();
           Listar_Almacenes()
        });
       


         $('#btn_abrir_modalsuc').click(function() {
            AbrirModalRegistroSucursales();
          });

           $('#btn_registrar_sucu').click(function() {
            RegistrarSucursales();
          });

           $('#btn_editar_sucu').click(function() {
            ModificarSucursales();
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