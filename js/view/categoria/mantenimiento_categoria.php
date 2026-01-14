<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],10);// EL 9 ES MENU GASTOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
<script src="../js/categoria.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title"><b>Listado de Categorias</b></h3>
                <button class="btn btn-info btn-sm float-right" onclick="AbrirModalRegistroCategoria();"><i class="fas fa-plus"></i> Nuevo</button>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="tabla_categoria" class="display compact">
                      <thead style="background:#343A40; color:white"  class="small text left">
                          <tr>
                              <th>#</th>
                              <th style="width:30%">Descripcion</th>
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
<div class="modal fade" id="modal_registro_categoria"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Motivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
               <span class="input-group-text">Categoria</span>
              </div>
               <input type="text" id="text_categoria" class="form-control form-control-sm" placeholder="Nombre de categoria">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="text-align: left;">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="RegistrarCategoria();">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

  <!-- Modal Editar  -->
<div class="modal fade" id="modal_editar_categoria"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <input type="text" id="idcategoria" hidden="">
               <span class="input-group-text">Categoria</span>
              </div>
               <input type="text" id="text_categoria_editar" class="form-control form-control-sm" placeholder="Nombre de categoria">
          </div>
          <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
               <span class="input-group-text">Estado</span>
              </div>
               <select class="form-control form-control-sm js-example-basic-single" id="select_estado_categoria_editar" style="width: 84%"> 
                <option value="ACTIVO">ACTIVO</option><!--iniciar el select 2 en el script -->
                <option value="INACTIVO">INACTIVO</option>
               </select>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="ModificarCategoria();">Modificar</button>
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
  Listar_Categoria();


</script>




<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>