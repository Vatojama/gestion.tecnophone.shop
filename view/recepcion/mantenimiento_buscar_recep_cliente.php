    <!-- Content Header (Page header) -->

    <script src="../js/recepcion.js?rev=<?php echo time(); ?>"></script>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title"><b>Listado de Recepciones por cliente</b></h3> 
           
        </div>
        <div class="card-body">

          <div class="row">

             <div class="col-lg-8   col-10">
                <label>Cliente:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_cliente" style="width:100%"> </select>
              </div>
              <div class="  col-lg-1 col-2">
                <label for="">&nbsp;</label><br>
                <button class="btn btn-success btn-sm " id="btn_buscar_recexcliente"><i class="fas fa-search"></i></button>
              </div>

          </div><br>
          <div class="row">

            <div class="col-12 table-responsive">
              <table id="tabla_buscar_recep_cli" class="display compact" style="display:none;">
                <thead style="background:#343A40; color:white" class="small text left">
                  <tr>
                    <!-- <th>#</th> -->
                    <th>Rece</th>
                    <th>Cliente</th>
                    <th>Observacion</th>
                    <th>Monto</th>
                    <th>F. registro</th>
                    <th>Motivo</th>
                    <th>Estado</th> 
                    <th>D. Tecnico</th>
                    <th>F. Entrega</th>
                    <th >Equipo</th>
                    <th >Falla</th>
                    <th >Diagnostico</th>
                     <th >Sucursal</th>
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
    
    
    
     <script>
      //para el dise del combo
      $(document).ready(function() {
          
          $('.js-example-basic-single').select2();
          cargar_SelectCliente_buscar();
          
          $("#btn_buscar_recexcliente").on('click', function() {
              let clienteid = $("#select_cliente").val();
              $("#tabla_buscar_recep_cli").show();
             Ver_recepciones_cliente(clienteid);
          })
          
          
          
      })
      
      
      
       </script>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          