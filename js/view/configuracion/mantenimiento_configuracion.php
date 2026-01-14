<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],18);// EL 3 ES MENU USUARIOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
<script src="../js/empresa.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title"><b>Datos de la Empresa</b></h3>
                <!-- <button class="btn btn-info btn-sm float-right" onclick="AbrirModalRegistroEmpresa();"><i class="fas fa-plus"></i> Nuevo</button> -->
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-12 table-responsive" >
                  <table id="tabla_empresa" class="display compact">
                      <thead style="background:#343A40; color:white" class="small text left">
                          <tr>
                              <th>#</th>
                              <th >Razon S.</th>
                              <th >Ruc</th>
                              <th >Representante</th>
                              <th >Direccion</th>
                              <th >Celular</th>
                              <th >Correo</th>
                              <th >Foto</th>
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
<div class="modal fade" id="modal_registro_empresa"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Datos de la Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="input-group input-group-sm mb-3 col-8">
              <div class="input-group-prepend">
               <span class="input-group-text">Razon S.</span>
              </div>
               <input type="text" id="text_razon" class="form-control form-control-sm" placeholder="Razon Social">
          </div>
          <div class="input-group input-group-sm mb-3 col-4">
              <div class="input-group-prepend">
               <span class="input-group-text">DNI / NIF</span>
              </div>
               <input type="text" id="text_ruc" class="form-control form-control-sm" placeholder="Ruc">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Representante</span>
              </div>
               <input type="text" id="text_representante" class="form-control form-control-sm" placeholder="Representante">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Direccion</span>
              </div>
               <input type="text" id="text_direccion" class="form-control form-control-sm" placeholder="Direccion">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Celular</span>
              </div>
               <input type="text" id="text_celular" class="form-control form-control-sm" placeholder="Celular">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Telefono</span>
              </div>
               <input type="text" id="text_telefono" class="form-control form-control-sm" placeholder="Telefono">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Correo</span>
              </div>
               <input type="text" id="text_correo" class="form-control form-control-sm" placeholder="Correo">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Url</span>
              </div>
               <input type="text" id="text_url" class="form-control form-control-sm" placeholder="Url">
          </div>

            <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Siglas Cuenta 1</span>
              </div>
               <input type="text" id="text_cuenta01" class="form-control form-control-sm" placeholder="Cuenta">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Nro Cuenta 1</span>
              </div>
               <input type="text" id="text_nrocuenta01" class="form-control form-control-sm" placeholder="Nro de Cuenta">
          </div>

           <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Siglas Cuenta 2</span>
              </div>
               <input type="text" id="text_cuenta02" class="form-control form-control-sm" placeholder="Cuenta">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Nro Cuenta 2</span>
              </div>
               <input type="text" id="text_nrocuenta02" class="form-control form-control-sm" placeholder="Nro de Cuenta">
          </div>

          <div class="col-12">
           <label for="">Foto</label></br>
            <input type="file" id="text_foto" >
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="RegistrarEmpresa();">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

  <!-- Modal Editar  -->
<div class="modal fade" id="modal_editar_empresa"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header " style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos de la Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="input-group input-group-sm mb-3 col-lg-12">
              <div class="input-group-prepend">
                 <input type="text" id="idempresa" hidden="">
               <span class="input-group-text">Nombre Sistema</span>
              </div>
               <input type="text" id="text_nombre_sist_editar" class="form-control form-control-sm" placeholder="nombre del sistema">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-8">
              <div class="input-group-prepend">
                 
               <span class="input-group-text">Razon S.</span>
              </div>
               <input type="text" id="text_razon_editar" class="form-control form-control-sm" placeholder="Razon Social">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-4">
              <div class="input-group-prepend">
               <span class="input-group-text">Ruc</span>
              </div>
               <input type="text" id="text_ruc_editar" class="form-control form-control-sm" placeholder="Ruc">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Representante</span>
              </div>
               <input type="text" id="text_representante_editar" class="form-control form-control-sm" placeholder="Representante">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Direccion</span>
              </div>
               <input type="text" id="text_direccion_editar" class="form-control form-control-sm" placeholder="Direccion">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Celular</span>
              </div>
               <input type="text" id="text_celular_editar" class="form-control form-control-sm" placeholder="Celular">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Telefono</span>
              </div>
               <input type="text" id="text_telefono_editar" class="form-control form-control-sm" placeholder="Telefono">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Correo</span>
              </div>
               <input type="text" id="text_correo_editar" class="form-control form-control-sm" placeholder="Correo">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Url</span>
              </div>
               <input type="text" id="text_url_editar" class="form-control form-control-sm" placeholder="Url">
          </div>

           <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Siglas Cuenta 1</span>
              </div>
               <input type="text" id="text_cuenta01_editar" class="form-control form-control-sm" placeholder="Cuenta">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Nro Cuenta 1</span>
              </div>
               <input type="text" id="text_nrocuenta01_editar" class="form-control form-control-sm" placeholder="Nro de Cuenta">
          </div>

           <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Siglas Cuenta 2</span>
              </div>
               <input type="text" id="text_cuenta02_editar" class="form-control form-control-sm" placeholder="Cuenta">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Nro Cuenta 2</span>
              </div>
               <input type="text" id="text_nrocuenta02_editar" class="form-control form-control-sm" placeholder="Nro de Cuenta">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Moneda</span>
              </div>
               <input type="text" id="text_moneda_editar" class="form-control form-control-sm" placeholder="Simbolo moneda">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Codigo Postal</span>
              </div>
               <input type="text" id="text_cod_post_editar" class="form-control form-control-sm" placeholder="Codigo Postal">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Tipo Igv</span>
              </div>
               <input type="text" id="text_tipo_igv_editar" class="form-control form-control-sm" placeholder="tipo igv">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">IGV</span>
              </div>
               <input type="text" id="text_igv_editar" class="form-control form-control-sm" placeholder="igv">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Moneda 1</span>
              </div>
               <input type="text" id="text_moenda1_editar" class="form-control form-control-sm" placeholder="soles">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Moneda 2</span>
              </div>
               <input type="text" id="text_moneda2_editar" class="form-control form-control-sm" placeholder="centimos">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Link Sist.</span>
              </div>
               <input type="text" id="text_link_sist" class="form-control form-control-sm" placeholder="link sistema">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Cod. Pais</span>
              </div>
               <input type="text" id="text_codigo_pais" class="form-control form-control-sm" placeholder="codigo pais">
          </div>
          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Clave correo</span>
              </div>
               <input type="text" id="text_clave_correo" class="form-control form-control-sm" placeholder="clave correo">
          </div>

          <div class="input-group input-group-sm mb-3 col-lg-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Estado</span>
              </div>
               <select class="form-control form-control-sm js-example-basic-single" id="select_estado_empresa_editar" style="width: 84%"> 
                <option value="ACTIVO">ACTIVO</option><!--iniciar el select 2 en el script -->
                <option value="INACTIVO">INACTIVO</option>
               </select>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="ModificarEmpresa();">Modificar</button> 
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->


  <!-- Modal Editar FOTO -->
<div class="modal fade" id="modal_editar_foto"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar logo <label for="" id="lbl_empresa"></label></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

           <div class="col-12">
            <input type="text" id="idempresa_foto" hidden="" >
            <input type="text" id="fotoactual" hidden="" >
            <input type="file" id="text_foto_editar" >
          </div>
     
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="ModificarFotoEmpresa();">Modificar</button>
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
  Listar_Empresa();



  //validar que solo seleccione foto (editar foto)
 document.getElementById("text_foto_editar").addEventListener("change", () => {
        var fileName = document.getElementById("text_foto_editar").value; 
        var idxDot = fileName.lastIndexOf(".") + 1; 
        var extFile = fileName.substr(idxDot, fileName.length).
        toLowerCase(); 
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){ 
        //TO DO 
        }else{ 
        Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN IMAGENES - USTED SUBIO UN ARCHIVO CON EXTESION "+extFile,"warning");
        document.getElementById("text_foto_editar").value="";
        } 
 }); 

//validar que solo seleccione foto (Registrar foto)
 document.getElementById("text_foto").addEventListener("change", () => {
        var fileName = document.getElementById("text_foto").value; 
        var idxDot = fileName.lastIndexOf(".") + 1; 
        var extFile = fileName.substr(idxDot, fileName.length).
        toLowerCase(); 
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){ 
        //TO DO 
        }else{ 
        Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN IMAGENES - USTED SUBIO UN ARCHIVO CON EXTESION "+extFile,"warning");
        document.getElementById("text_foto").value="";
        } 
 }); 


</script>

<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>