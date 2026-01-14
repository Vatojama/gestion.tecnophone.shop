
<?php
session_start();
require_once '../../model/modelo_tienda.php';

    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],29);// EL 10 ES MENU VENTAS
    //$nombre_sist2 = Modelo_Gasto::Listar_data_Configuracion();
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
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
      <h3 class="card-title"><b>Listado de Banner</b></h3><label for="" id="text_estado" hidden></label>
      <!-- <button class="btn btn-info btn-sm float-right" id="textnuevo_banner" ><i class="fas fa-plus"></i> Nuevo</button> -->
      <button class="btn btn-info btn-sm float-right" id="textnuevo_banner"><i class="fas fa-plus"></i> Nuevo</button>
    </div>
    <div class="card-body">
      
      <div class="row">
        <div class="col-12 table-responsive">
          <table id="tabla_banner" class="display compact">
            <thead style="background:#343A40; color:white" class="small text left">
              <tr>
                <th style="width:1%">#</th>
                <th>Descripcion </th>
                <th>Foto </th>
              
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


   <!-- Modal REGISTRAR BANNER -->
   <div class="modal fade" id="modal_registrar_banner" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Banner: <label for="" id="lbl_producto"></label></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                      <div class="col-12 ">
                          <label for="text_num_compro">Descripcion</label>
                          <input type="text" name="text_descripcion" class="form-control form-control-sm" id="text_descripcion"  onkeyup="mayus(this);" placeholder="Descripcion">
                      </div>

                      

                    </div><br>

                    <div class="row">
                   
                       <div class="col-12">
                         <label for="text_num_compro">Seleccione Imagen:</label><br>
                            <input type="text" id="idproducto_foto" hidden >
                            <input type="file"  id="text_imagen" accept="image/*" onchange="previewFile(this);">
                        </div>
                  

                        <div class="col-12">
                            <div class="form-group">
                                <!-- <label for="">Banner</label> -->
                                <div class="card">
                                    <div class="card-body">


                                    </div>

                                    <img class="" id="previewImg">

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_registrarBanner" >Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->

<script>
$(document).ready(function() { 
  Listar_Banner();
// Agregar evento para limpiar la imagen cuando se cierra el modal
$('#modal_registrar_banner').on('hidden.bs.modal', function () {
        $("#previewImg").attr("src", "");
        $("#text_imagen").val("");
    });

});


$("#textnuevo_banner").on('click', function() {
      AbrirModalRegistroBanner();
 });


$("#btn_registrarBanner").on('click', function() {
  RegistrarBanner();
  });


  /*===================================================================*/
        //PARA MAYUSCULAS
        /*===================================================================*/
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

</script>











<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>