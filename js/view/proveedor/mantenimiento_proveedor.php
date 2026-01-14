    <!-- Content Header (Page header) -->

<script src="../js/proveedor.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title"><b>Listado de Proveedores</b></h3>
                <button class="btn btn-info btn-sm float-right" onclick="AbrirModalRegistroProveedor();"><i class="fas fa-plus"></i> Nuevo</button>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-12 table-responsive" >
                  <table id="tabla_proveedor" class="display compact">
                      <thead style="background:#343A40; color:white">
                          <tr>
                               <th>#</th>
                               <th>Ruc</th>
                               <th>Razon Social</th>
                               <th>Direccion</th>
                               <th>Celular</th>                           
                              <th style="text-align: center;">Estado</th>
                              <th style="text-align: center;">Accion</th>
                          </tr>
                      </thead>

                  </table>
                  
                </div>
              </div>  
              </div>
            </div>
          </div>


  <!-- Modal registrar -->
<div class="modal fade" id="modal_registro_proveedor"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel" >Registro de Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-10 col-xs-10">
                    <label for="">Ruc: </label>
                    <input type="text" id="text_ruc" class="form-control form-control-sm" onkeypress="return soloNumeros(event)" placeholder="Ruc">
          </div>

          <div class="col-2 col-xs-2">
                    <label for="">&nbsp;</label> <br> 
                    <button type="button" class="btn btn-sm btn-success" id="buscar"><i class="fas fa-search"></i></button>
          </div>

          <div class="col-12 col-xs-12">
                    <label for="">Razon: </label>
                    <input type="text" id="text_razon" class="form-control form-control-sm"  placeholder="Razon Social">
          </div>

          <div class="col-12 col-xs-12">
                    <label for="">Direccion: </label>
                    <input type="text" id="text_direccion" class="form-control form-control-sm" placeholder="Direccion">
          </div>

          <div class="col-12 col-xs-12">
                    <label for="">Celular: </label>
                    <input type="text" id="text_celular" class="form-control form-control-sm" placeholder="Celular">
          </div>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="RegistrarProveedor();">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

  <!-- Modal Editar  -->
<div class="modal fade" id="modal_editar_proveedor"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#343A40; color:white">
        <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">Actualizar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="input-group input-group-sm mb-3 col-12">
              <div class="input-group-prepend">
                 <input type="text" id="idproveedor" hidden="">
               <span class="input-group-text">Ruc</span>
              </div>
               <input type="text" id="text_ruc_editar" class="form-control form-control-sm" onkeypress="return soloNumeros(event)" placeholder="Nombre completo">
          </div>
           <div class="input-group input-group-sm mb-3 col-12">
              <div class="input-group-prepend">
               <span class="input-group-text">Razon</span>
              </div>
               <input type="text" id="text_razon_editar" class="form-control form-control-sm" placeholder="Razon ">
          </div>
          <div class="input-group input-group-sm mb-3 col-12">
              <div class="input-group-prepend">
               <span class="input-group-text">Direccion</span>
              </div>
               <input type="text" id="text_direccion_editar" class="form-control form-control-sm" placeholder="Direccion">
          </div>
          <div class="input-group input-group-sm mb-3 col-6">
              <div class="input-group-prepend">
               <span class="input-group-text">Celular</span>
              </div>
               <input type="text" id="text_celular_editar" class="form-control form-control-sm" placeholder="Celular">
          </div>
          <div class="input-group input-group-sm mb-3 col-12">
              <div class="input-group-prepend">
               <span class="input-group-text">Estado</span>
              </div>
               <select class="form-control form-control-sm js-example-basic-single" id="select_estado_proveedor_editar" style="width: 85%"> 
                <option value="ACTIVO">ACTIVO</option><!--iniciar el select 2 en el script -->
                <option value="INACTIVO">INACTIVO</option>
               </select>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="ModificarProveedor();">Modificar</button>
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
  Listar_Proveedor();


   /*************************************************************************
             FUNCION PARA LLAMAR LOS DATOS DE SUNAT DESDE API
     ***************************************************************************/
    $('#buscar').click(function(){
        ruc=$('#text_ruc').val();
        $.ajax({
           url:'../controller/reniec/consultaRUC.php',
           type:'post',
           data: 'ruc='+ruc,
           dataType:'json',
           success:function(r){
            if(r.numeroDocumento==ruc){
               // $('#text_ruc').val(r.numeroDocumento);//ruc
                $('#text_direccion').val(r.direccion);//direccion
                $('#text_razon').val(r.nombre); //razon
            }else{
                alert(r.error);
            }
           // console.log(r)
           }
        });
    });


</script>