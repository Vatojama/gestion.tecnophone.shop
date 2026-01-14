
<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],14);// EL 9 ES MENU GASTOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
<script src="../js/formapago.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title"><b>Forma de Pagos</b></h3>
                <!-- <button class="btn btn-info btn-sm float-right" onclick="AbrirModalRegistroFormaPago();"><i class="fas fa-plus"></i> Nuevo</button> -->
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="tabla_forma_pago" class="display compact">
                      <thead style="background:#343A40; color:white" class="small text left">
                          <tr>
                              <th>#</th>
                              <th style="width:30%">Tipo Pago</th>
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
<div class="modal fade" id="modal_registro_forma_pago"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Forma de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">


          <div class="col-sm-12">
                    <label form="">Descripcion</label>
                     <input type="text" id="text_f_pago" class="form-control form-control-sm"  placeholder="Forma de Pago">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"  style="float: left;">Cerrar</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="RegistrarFormaPago();">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

  <!-- Modal Editar  -->
<div class="modal fade" id="modal_editar_forma_Pago"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Forma de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
              <div class="col-sm-12">
                     <input type="text" id="idformapago" hidden="">
                        <label form="">Descripcion</label>
                         <input type="text" id="text_f_pago_editar" class="form-control form-control-sm" >
              </div>

              <div class="col-sm-12">
                    <label form="">Estado</label>
                    
                    <select class="form-control form-control-sm js-example-basic-single" id="select_estado_fpago_editar" style="width: 100%"> 
                        <option value="ACTIVO">ACTIVO</option><!--iniciar el select 2 en el script -->
                        <option value="INACTIVO">INACTIVO</option>
                      </select>
              </div>
      
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="ModificarFormaPago();">Modificar</button>
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
  Listar_FormaPAgo();


</script>



<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>