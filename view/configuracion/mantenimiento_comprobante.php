<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],17);// EL 17 ES MENU comprobantes
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>

<script src="../js/comprobante.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title"><b>Listado de Comprobantes</b></h3>
                <button class="btn btn-info btn-sm float-right" onclick="AbrirModalRegistroComprobante();"><i class="fas fa-plus"></i> Nuevo</button>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-12 table-responsive" >
                  <table id="tabla_comprobante" class="display compact">
                      <thead style="background:#343A40; color:white" class="small text left">
                          <tr>
                              <th>#</th>
                              <th >Comprobante</th>
                              <th >Serie</th>
                              <th >Correlativo</th>
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
<div class="modal fade" id="modal_registro_comprobante"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Comprobante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="input-group input-group-sm mb-3 col-12">
              <div class="input-group-prepend">
               <span class="input-group-text">Comprobante</span>
              </div>
               <input type="text" id="text_tipoc" class="form-control form-control-sm" placeholder="Comprobante">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Serie</span>
              </div>
               <input type="text" id="text_seriec" class="form-control form-control-sm" placeholder="Serie">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Correlativo</span>
              </div>
               <input type="text" id="text_numeroc" class="form-control form-control-sm" placeholder="Correlativo">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="RegistrarComprobante();">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

  <!-- Modal Editar  -->
<div class="modal fade" id="modal_editar_comprobante"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Comprobantes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="input-group input-group-sm mb-3 col-12">
              <div class="input-group-prepend">
                <input type="text" id="idcomprobante" hidden="">
               <span class="input-group-text">Comprobante</span>
              </div>
               <input type="text" id="text_tipoc_editar" class="form-control form-control-sm" placeholder="Comprobante">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Serie</span>
              </div>
               <input type="text" id="text_seriec_editar" class="form-control form-control-sm" placeholder="Serie">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Correlativo</span>
              </div>
               <input type="text" id="text_numeroc_editar" class="form-control form-control-sm" placeholder="Correlativo">
          </div>

          <div class="input-group input-group-sm mb-3 col-12">
              <div class="input-group-prepend">
               <span class="input-group-text">Estado</span>
              </div>
               <select class="form-control form-control-sm js-example-basic-single" id="select_estado_compro_editar" style="width: 84%"> 
                <option value="ACTIVO">ACTIVO</option><!--iniciar el select 2 en el script -->
                <option value="INACTIVO">INACTIVO</option>
               </select>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="ModificarComprobante();">Modificar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

<script>
  //para el diseño del combo
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
 });
  Listar_Comprobante();


</script>
<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>