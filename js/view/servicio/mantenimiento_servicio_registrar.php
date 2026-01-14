   <!-- Content Header (Page header) -->
   <script src="../js/servicio.js?rev=<?php echo time(); ?>"></script>
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">


       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <div class="col-lg-12">
     <div class="card ">
       <div class="card-header">
         <h3 class="card-title" style="text-align:center;"><b>Registro de Servicios</b></h3> <b>
           <h4 style="text-align:right;" id="estado_recep"> </h4>
         </b>
       </div>
       <div class="card-body">
         <div class="row">

           <div class="col-lg-6 col-8">
             <label>Referencia:</label>
             <input type="hidden" id="text_idcaja">
             <input type="text" id="text_refe" class="form-control form-control-sm" disabled="" placeholder="Referencia">
           </div>
           <div class="  col-lg-1 col-4">
             <label for="">&nbsp;</label><br>
             <button class="btn btn-success btn-sm" title="Buscar Recepcion" onclick="AbrirModalVerRecepcion()"><i class="fa fa-search"></i> </button>
           </div>
         </div>

         <div class="row">

           <div class="col-lg-4   col-12">
             <input type="text" id="idcliente" hidden="">
             <input type="text" id="text_idrecepcion" hidden >
             <input type="text" id="text_idsucursa" hidden >
             <label>Cliente:</label>
             <input type="text" id="text_cliente" class="form-control form-control-sm" disabled="" maxlength="" placeholder="Cliente">
           </div>
           <div class="col-lg-6 col-12">
             <label>Concepto:</label>
             <input type="text" id="text_concepto" class="form-control form-control-sm" disabled="" placeholder="Cocepto de la recepcion">
           </div>
           <div class="col-lg-2 col-12">
             <label>Responsable:</label>
             <input type="text" id="text_responsable" class="form-control form-control-sm" onkeypress="return soloLetras(event)" placeholder="Responsable" disabled>
           </div>
           <div class="col-lg-4 col-xs-12" hidden>
             <label>Modelo:</label>
             <input type="text" id="text_model" class="form-control form-control-sm" disabled="" placeholder="modelo del equipo">
           </div>
           <!-- <div class="  col-1 col-xs-12">
                    <label for="">&nbsp;</label><br>
                   <button class="btn btn-success btn-sm" title="Buscar Recepcion" onclick="AbrirModalVerRecepcion()"><i class="fa fa-search"></i> </button>
              </div> -->



           <div class="col-lg-3 col-6">
             <label>Monto:</label>
             <input type="text" id="text_monto" class="form-control form-control-sm" disabled="" placeholder="Monto">
           </div>
           <div class="col-lg-3  col-6">
             <label>Adelanto:</label>
             <input type="text" id="text_adelanto" class="form-control form-control-sm" disabled="" placeholder="Adelanto">
           </div>
           <div class="col-lg-3 col-6">
             <label>Pendiente:</label>
             <input type="text" id="text_pendiente" class="form-control form-control-sm" disabled="" placeholder="Pendiente">
           </div>
           <div class="col-lg-3  col-6">
             <label>Entrega:</label>
             <input type="text" id="text_frecepcion" class="form-control form-control-sm" disabled="" placeholder="Fecha">
           </div>


           <div class="col-lg-8 col-12">
             <label>Observaciones:</label>
             <input type="text" id="text_comentario" class="form-control form-control-sm" placeholder="Diagnostico de la reparacion" disabled>
           </div>

           <div class="col-lg-12 col-12" hidden>
             <label>Observacion:</label>
             <input type="text" id="text_observa" class="form-control form-control-sm" placeholder="Observacion">
           </div>

           <div class="col-lg-4 col-12">
             <label form="">Forma de pago</label>
             <select class="js-example-basic-single" id="select_forma_pago_V" style="width:100%">

             </select>
           </div>

           <div class="col-lg-4" id="" hidden>
             <label form="">suma servicio este vale</label>
             <input type="text" name="" class="form-control form-control-sm" id="text_suma_servicio" disabled>
           </div>

           <div class="col-lg-4" id="">
             <label form="">Total servicio</label>
             <input type="text" name="" class="form-control form-control-sm" id="text_suma_servicio2" disabled>
           </div>

           <div class="col-lg-4" id="" hidden>
             <label form="">id tecnico</label>
             <input type="text" name="" class="form-control form-control-sm" id="text_idtecnico">
           </div>







           <div class="col-lg-3" id="efectivohabilitar" hidden>
             <label form="">Efectivo</label>
             <input type="number" name="" class="form-control form-control-sm" id="text_efe">
           </div>

           <div class="col-lg-3" id="codoperacionhabilitar" hidden>
             <label form="">Codigo O.</label>
             <input type="text" name="text_tarj" class="form-control form-control-sm" id="text_tarj">
           </div>

           <div class="col-lg-3" id="montoperacionhabilitar" hidden>
             <label form="">Monto O.</label>
             <input type="number" name="" class="form-control form-control-sm" id="text_monto_t">
           </div>


           <div class="col-lg-12" style="text-align: center;">
             <br>
             <button class="btn btn-info btn-lg  btn-sm" onclick="RegistrarServicio();"><i class="fa fa-save"></i> Registrar</button>
           </div>


         </div>
         <br>
         <br>


         <!-- tabpanel -->

         <div class="row">

           <div class="col-12">
             <!-- <div class="card card-dark card-outline card-tabs"> -->
             <div class="card-header p-0 pt-1 border-bottom-0">
               <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link active small text" id="equipos-tab" data-toggle="pill" href="#equipos" role="tab" aria-controls="equipos" aria-selected="true">Equipos Recepcionados</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link small text" id="insumos-tab" data-toggle="pill" href="#insumos" role="tab" aria-controls="insumos" aria-selected="false">Insumos</a>
                 </li>
               </ul>
             </div>
             <div class="card-body">
               <div class="tab-content" id="custom-tabs-three-tabContent">
                 <div class="tab-pane fade active show" id="equipos" role="tabpanel" aria-labelledby="equipos-tab">
                   <div class="row">
                     <div class="col-12 table-responsive">
                       <table id="tabla_detalle_recep" class="display" style="width: 100%">
                         <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                           <tr>
                             <th>#</th>
                             <th>Equipo</th>
                             <th>Falla</th>
                             <th>Monto</th>
                             <th>Abono</th>
                             <th>Diagnostico</th>
                             <th>Accion</th>
                           </tr>
                         </thead>
                         <tbody class="small text left">

                         </tbody>
                       </table>
                     </div>
                   </div>
                 </div>
                 <div class="tab-pane fade" id="insumos" role="tabpanel" aria-labelledby="insumos-tab">
                   <div class="row">
                     <div class="col-12 table-responsive">
                       <table id="tabla_insumos" class="display " style="width: 100%">
                         <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                           <tr>
                             <th>#</th>
                             <th>Articulo</th>
                             <th>Cantidad</th>
                             <th>Monto</th>
                             <th>Fecha</th>

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

           </div>
         </div>

         <!-- end tab panel -->






       </div>
     </div>
   </div>
   <!-- final del header -->


   <!-- Modal ver Recepcion -->
   <div class="modal fade" id="modal_ver_recepcion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header" style="background:#343A40; color:white">
           <h5 class="modal-title" id="exampleModalLabel">Seleccionar Recepcion</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="row">
             <div class="col-12 table-responsive">
               <table id="tabla_ver_recepcion" class="display compact" style="width: 100%">
                 <thead style="background:#343A40; color:white" class="small text left">
                   <tr>
                     <th>Refe</th>
                     <th>Cliente</th>
                     <!-- <th>Modelo</th> -->
                     <th style="width: 30%;">Concepto</th>
                     <th>Monto</th>
                     <th>Estado</th>
                     <th>Fecha</th>
                     <th>Accion</th>
                   </tr>
                 </thead>
                 <tbody class="small text left">

                 </tbody>
               </table>
             </div>
           </div>
         </div>
         <div class="modal-footer">

         </div>
       </div>
     </div>
   </div>
   <!-- fin Modal -->


   <!-- Modal CAMBIAR MOTNTOS DEL EQUIPO -->
   <div class="modal fade" id="modal_cambiar_monto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog " role="document">
       <div class="modal-content">
         <div class="modal-header" style="background:#343A40; color:white">
           <h5 class="modal-title" id="exampleModalLabel">Cambiar monto del equipo</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="row">
             <div class="col-lg-6   col-12">
               <input type="text" id="idequipo" hidden>
               <input type="text" id="idrece_e" hidden>
               <label>Monto:</label>
               <input type="text" id="text_monto_e" class="form-control form-control-sm" placeholder="monto">
             </div>

             <div class="col-lg-6   col-12">
               <label>Abono:</label>
               <input type="text" id="text_abono_e" class="form-control form-control-sm" placeholder="abono">
             </div>

           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" class="btn btn-primary" id="btn_regis_repara" onclick="registrar_monto_equipo();">Registrar</button>
         </div>

       </div>
     </div>
   </div>
   <!-- fin Modal -->






   <script>
     //para el diseño del combo
     $(document).ready(function() {
       $('.js-example-basic-single').select2();
       cargar_Select_FormaPAgo_v();
       Traer_caja_id();

     });


     function soloLetras(e) {
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for (var i in especiales) {
         if (key == especiales[i]) {
           tecla_especial = true;
           break;
         }
       }

       if (letras.indexOf(tecla) == -1 && !tecla_especial) {
         return false;
       }
     }


     function soloNumeros(e) {
       tecla = (document.all) ? e.keyCode : e.which;

       //Tecla de retroceso para borrar, siempre la permite
       if (tecla == 8) {
         return true;
       }

       // Patron de entrada, en este caso solo acepta numeros
       patron = /[0-9]/;
       tecla_final = String.fromCharCode(tecla);
       return patron.test(tecla_final);
     }

     Listar_Ver_Recepcion();



     //HABILITAR CAMPOS SEGUN LA FORMA DE PAGO
     $('#select_forma_pago_V').on('select2:select', function(e) {
       let formp = document.getElementById('select_forma_pago_V').value;
       let mont_tototo = document.getElementById('text_suma_servicio').value;

       if (formp == 2) { //TARJETA
         $("#codoperacionhabilitar").attr('hidden', false); //HABILITAMOS

         $("#efectivohabilitar").attr('hidden', true);
         $("#montoperacionhabilitar").attr('hidden', true); // para ver monto


         document.getElementById('text_efe').value = "";
         document.getElementById('text_tarj').value = "";
         document.getElementById('text_monto_t').value = "";

         document.getElementById('text_efe').value = "0";
         document.getElementById('text_monto_t').value = mont_tototo;



       } else if (formp == 3) { //EFECTIVO Y TARJETA
         $("#efectivohabilitar").attr('hidden', false); //HABILITAMOS
         $("#codoperacionhabilitar").attr('hidden', false); //HABILITAMOS
         $("#montoperacionhabilitar").attr('hidden', false); //HABILITAMOS

         document.getElementById('text_efe').value = "";
         document.getElementById('text_tarj').value = "";
         document.getElementById('text_monto_t').value = "";

         document.getElementById('text_efe').value = "0";
         document.getElementById('text_monto_t').value = "0";


       } else if (formp == 1) { // EFECTIVO
         $("#efectivohabilitar").attr('hidden', true); // para ver monto
         $("#codoperacionhabilitar").attr('hidden', true);
         $("#montoperacionhabilitar").attr('hidden', true);

         document.getElementById('text_efe').value = "";
         document.getElementById('text_tarj').value = "";
         document.getElementById('text_monto_t').value = "";


         document.getElementById('text_monto_t').value = "0";
         // $("#lbl_totalneto").html("<b>Total: </b> S/." + total.toFixed(2));
         document.getElementById('text_efe').value = mont_tototo;


       } else if (formp == "Seleccione...") {
         $("#codoperacionhabilitar").attr('hidden', true);
         $("#efectivohabilitar").attr('hidden', true);
         $("#montoperacionhabilitar").attr('hidden', true);

         document.getElementById('text_efe').value = "";
         document.getElementById('text_tarj').value = "";
         document.getElementById('text_monto_t').value = "";

         document.getElementById('text_efe').value = "0";
         document.getElementById('text_monto_t').value = "0";

       } else {
         $("#codoperacionhabilitar").attr('hidden', true);
         $("#efectivohabilitar").attr('hidden', true);
         $("#montoperacionhabilitar").attr('hidden', true);
         document.getElementById('text_efe').value = mont_tototo;

         document.getElementById('text_tarj').value = "";
         document.getElementById('text_monto_t').value = "";
         document.getElementById('text_monto_t').value = "0";

       }
     })
   </script>