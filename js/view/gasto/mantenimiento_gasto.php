<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],6);// EL 9 ES MENU GASTOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
<script src="../js/gasto.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title"><b>Listado de Movimiento</b></h3><label for="" id="text_estado" hidden "></label>
                <button class="btn btn-info btn-sm float-right" id="textnuevogasto" onclick="AbrirModalRegistroGasto();"><i class="fas fa-plus"></i> Nuevo</button>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-12 table-responsive" >
                  <table id="tabla_gasto" class="display compact">
                      <thead style="background:#343A40; color:white" class="small text left">
                          <tr>
                              <th>#</th>
                              <th>Tipo Mov.</th>
                              <th >Descripcion</th>
                              <th >Monto</th>
                              <th >Responsable</th>
                              <th >Fecha</th>
                               <th >Sucursal</th>
                              <th style="text-align: center;">Estado</th>
                              <!-- <th style="text-align: center;">Caja</th> -->
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
<div class="modal fade" id="modal_registro_gasto"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Movimientos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

       
          <div class="col-12 col-xs-12">
                  <label>Tipo Mov.:</label>
                  <select class="form-control form-control-sm js-example-basic-single" id="select_tipo_mov" style="width: 100%"> 
                <option value="Seleccione" selected>Seleccione</option>
                <option value="INGRESO">INGRESO</option>
                <option value="EGRESO">EGRESO</option>
               </select>
          </div>
          <div class="col-12 col-xs-12">
                  <label>Descripcion:</label>
                  <input type="text" id="text_gasto" class="form-control form-control-sm" placeholder="Descripcion">
          </div>

          <div class="col-12 col-xs-12">
                  <label>Monto:</label>
                  <input type="number" id="text_monto" class="form-control form-control-sm" placeholder="Monto">
          </div>

          <div class="col-12 col-xs-12">
                  <label>Responsable:</label>
                  <input type="text" id="text_responsable" class="form-control form-control-sm" placeholder="Responsable">
          </div>
          <div class="col-12" id="div_sucursal">
                    <label form="">Sucursal:</label>
                     <select class="form-control form-control-sm js-example-basic-single" id="select_sucur" style="width: 100%"> </select>
              </div> 

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="RegistrarGasto();">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

  <!-- Modal Editar  -->
<div class="modal fade" id="modal_editar_gasto"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Gasto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-12 col-xs-12">
                  <label>Tipo Mov.:</label>
                  <select class="form-control form-control-sm js-example-basic-single" id="select_tipo_mov_editar" style="width: 100%"> 
                <option value="Seleccione" selected>Seleccione</option>
                <option value="INGRESO">INGRESO</option>
                <option value="EGRESO">EGRESO</option>
               </select>
          </div>

          <div class="col-12 col-xs-12">
                  <label>Descripcion:</label>
                  <input type="text" id="idgasto" hidden="">
                  <input type="text" id="text_gasto_editar" class="form-control form-control-sm" placeholder="Descripcion">
          </div>

          <div class="col-12 col-xs-12">
                  <label>Monto:</label>
                  <input type="text" id="text_monto_editar" class="form-control form-control-sm" placeholder="Monto">
          </div>

          <div class="col-12 col-xs-12">
                  <label>Responsable:</label>
                  <input type="text" id="text_responsable_editar" class="form-control form-control-sm" placeholder="Responsable">
          </div>

          <div class="col-12 col-xs-12">
                  <label>Estado:</label>
                  <select class="form-control form-control-sm js-example-basic-single" id="select_estado_gasto_editar" style="width: 100%"> 
                  <option value="ACTIVO">ACTIVO</option><!--iniciar el select 2 en el script -->
                <option value="INACTIVO">INACTIVO</option>
               </select>
          </div>
          <div class="col-12">
                    <label form="">Sucursal:</label>
                     <select class="form-control form-control-sm js-example-basic-single" id="select_sucur_editar" style="width: 100%"> </select>
          </div> 


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-sm aaaa btn-primary" onclick="ModificarGasto();">Modificar</button>
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
  Listar_Gasto();
   cargar_SelectSucursales();
  Traer_estado_caja();

</script>

<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>