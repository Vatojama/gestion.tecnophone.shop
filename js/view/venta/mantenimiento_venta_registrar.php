<?php

//require_once '../controller/gasto/controlador_listar_data_configuracion.php';
require_once '../../model/modelo_gasto.php';
                       
                      
                        $nombre_sist2 = Modelo_Gasto::Listar_data_Configuracion();
                        //var_dump($nombre_sist2['data'][0][0]);

?>
<!-- Content Header (Page header) -->
   <script src="../js/venta.js?rev=<?php echo time(); ?>"></script>
   <div class="content-header">
       <div class="container-fluid">
           <div class="row mb-2">


           </div><!-- /.row -->
       </div><!-- /.container-fluid -->
   </div>
   <div class="content">
       <div class="container-fluid">
           <div class="row mb-3">
               <div class="col-md-9">
                   <div class="card card-gray shadow" style=" border: 1px solid gray;">

                       <div class="card-body py-2">
                           <div class="row">
                                 <div class="col-md-7 mb-3 rounded-3" style="background: lightgray;color: black;text-align:center;border:1px solid gray;">
                                    <h2 class="fw-bold m-0"> <?php echo $nombre_sist2['data'][0]['confi_moneda'] ; ?> <span class="fw-bold" id="totalVenta">0.00</span></h2>
                                </div>
                                <!-- BOTONES PARA VACIAR LISTADO Y COMPLETAR LA VENTA -->
                                <div class="col-md-5 text-right">
                                
                                    <a class="btn btn-primary dataval " id="btnIniciarVenta"  onclick="Registrar_Venta();"><i class="fas fa-shopping-cart"></i> Realizar Venta</a>
                                    
                                </div>
                                <!-- productos -->
                                <div class="col-lg-12 col-12">
                                    <label form="">Productos</label>
                                    <input type="text" id="text_nombre_producto" hidden>
                                    <input type="text" id="text_idproducto" hidden="">
                                    <select class="js-example-basic-single" id="text_producto" style="width:100%">

                                    </select>
                                </div>
                                <div class="col-lg-3 col-12" id="ocult_imei_vent" hidden>
                                    <label form="">Imei</label>

                                    <select class="js-example-basic-single" id="select_imei" style="width:100%">

                                    </select>
                                </div>
                                <div class="col-lg-2 " hidden>
                                    <label form="">Stock</label>
                                    <input type="text" name="" class="form-control form-control-sm" id="text_stock" disabled placeholder="Stock">
                                </div>
                                <div class="col-lg-3 col-4">
                                    <label form="">Precio</label>
                                    <input type="text" name="" class="form-control form-control-sm" id="text_precio" placeholder="Precio">
                                </div>
                                <div class="col-lg-3 col-4">
                                    <label form="">Descuento</label>
                                    <input type="text" name="" class="form-control form-control-sm" id="text_descuento">
                                </div>
                                <div class="col-lg-2 col-4">
                                    <label form="">Cantidad</label>
                                    <input type="number" name="" class="form-control form-control-sm" id="text_cantidad" placeholder="Cantidad">
                                </div>
                                <div class="col-lg-2" hidden>
                                    <label form="">tiene imei</label>
                                    <input type="text" name="" class="form-control form-control-sm" id="text_tiene_imei" placeholder="tiene imei">
                                </div>
                                <div class="col-lg-1">
                                    <label form="">&nbsp;</label><br>
                                    <button class="btn btn-success btn-sm" onclick="Agregar_Producto();"><i class="fas fa-plus"></i></button>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive"><br>
                                        <table id="tabla_detalle_pro" class="display nowrap table-striped w-100 " style="width: 100%">
                                            <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                                                <tr>

                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Desct.</th>
                                                    <th>Sub Total</th>
                                                    <th style="text-align: center;">Accion</th>
                                                    <th class="oculto" style="display: block;">imei</th>
                                                    <th class="ocultoimei" style="display: none;">#</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_tabla_detalle_pro" class="small text left">

                                            </tbody>

                                        </table>
                                        <div class="" hidden>
                                            <div class="col-12" style="text-align:right;">
                                                <h5 for="" id="lbl_subtotal"></h5>
                                            </div>
                                            <div class="col-12" style="text-align:right;">
                                                <h5 for="" id="lbl_impuesto"></h5>
                                            </div>
                                            <div class="col-12" style="text-align:right;">
                                                <h5 for="" id="lbl_descuento"></h5>
                                                <!-- <input type="text" id="lbl_descuento"> -->
                                            </div>
                                            <div class="col-12" style="text-align:right;">
                                                <h5 for="" id="lbl_totalneto"></h5>
                                            </div>

                                        </div><br>

                                    </div>
                               </div>

                           </div>

                       </div>

                   </div>

               </div>

               <div class="col-md-3">
                   <div class="card card-gray shadow" style=" border: 1px solid gray;">
                       <div class="form-group card-body py-2">
                           <div class="row">
                               <div class="col-lg-12 col-12">
                                   <label form="">Cliente</label>
                                   <button class="btn btn-success btn-sm " onclick="AbrirModalRegistroCliente();"><i class="fas fa-plus"></i></button>
                                   <input type="hidden" id="text_idcliente">
                                   <input type="hidden" id="text_idventa">
                                   <input type="hidden" id="text_idcaja">
                                   <select class="js-example-basic-single" id="select_cliente2" style="width:100%">

                                   </select>

                               </div>

                               <div class="col-lg-3" id="imp_ocultar" hidden>
                                   <label form="">Impuesto</label>
                                   <input type="text" name="" class="form-control form-control-sm" id="text_impuesto" value="0" disabled>
                               </div>
                               <div class="col-lg-12 col-12">
                                   <input type="text" id="text_idcompro" hidden>
                                   <input type="text" id="text_compro" hidden>
                                   <label form="">Comprobante</label>
                                   <select class="js-example-basic-single" id="select_tipo_com" style="width:100%">

                                   </select>
                               </div>
                               <div class="form-check" id="ch_ocultar" hidden>
                                   <label for="">&nbsp;</label><br>
                                   <input class="form-check-input" type="checkbox" value="" id="ch_impuesto">

                               </div>

                           </div>
                            <!-- COMPROBANTE , SERIE, CORRELATIVO -->
                           <div class="form-group">
                               <div class="row">
                                   <div class="col-lg-6 col-6">
                                       <label form="">Serie</label>
                                       <input type="text" name="" class="form-control form-control-sm" id="text_serie" disabled>
                                   </div>
                                   <div class="col-lg-6 col-6">
                                       <label form="">Numero</label>
                                       <input type="text" name="" class="form-control form-control-sm" id="text_num_compro" disabled>
                                   </div>
                                   

                               </div>

                           </div>
                           <!-- FORMA DE PAGO -->
                           <div class="form-group">
                               <div class="row">
                                   <div class="col-lg-12 col-12">
                                       <label form="">Forma de pago</label>
                                       <input type="text" id="text_idformapagoV" hidden>

                                       <select class="js-example-basic-single" id="select_forma_pago_V" style="width:100%">

                                       </select>
                                   </div>
                                  
                                   <div class="col-lg-12 col-12" id="efectivohabilitar" hidden>
                                       <label form="">Efectivo</label>
                                       <input type="text" name="" class="form-control form-control-sm" id="text_efe">
                                   </div>

                                   <div class="col-lg-12 col-12" id="codoperacionhabilitar" hidden>
                                       <label form="">Codigo O.</label>
                                       <input type="text" name="text_tarj" class="form-control form-control-sm" id="text_tarj">
                                   </div>

                                   <div class="col-lg-12 col-12" id="montoperacionhabilitar" hidden>
                                       <label form="">Monto O.</label>
                                       <input type="text" name="" class="form-control form-control-sm" id="text_monto_t">
                                   </div>
                                    <div class="col-lg-12" >
                                       <label form="">Observacion</label>
                                       <!--  <input type="texarea" name="" class="form-control form-control-sm" id="text_comentario">-->
                                       <textarea class="form-control" rows="3" id="text_comentario" placeholder="Descripcion.."></textarea>
                                   </div>

                               </div>
                               

                           </div>
                           <!-- MOSTRAR EL SUBTOTAL, IGV Y TOTAL DE LA VENTA -->
                           <div class="row fw-bold">
                               <div class="col-md-7">
                                   <span>SUBTOTAL</span>
                               </div>
                               <div class="col-md-5 text-right">
                               <?php echo $nombre_sist2['data'][0]['confi_moneda'] ; ?> <span class="" id="boleta_subtotal">0.00</span>
                               </div>
                               <div class="col-md-7">
                                 <?php
                                    $igv = $nombre_sist2['data'][0]['confi_igv'];
                                    $igv_porcentaje = $igv * 100;
                                 ?>
                                   
                               <span><?php echo $nombre_sist2['data'][0]['confi_tipo_igv'] ; ?> (<span><?php echo $igv_porcentaje; ?>%)</span>
                               </div>
                               <div class="col-md-5 text-right">
                               <?php echo $nombre_sist2['data'][0]['confi_moneda'] ; ?>  <span class="" id="boleta_igv">0.00</span>
                               </div>
                               <div class="col-md-7">
                                   <span>DESCUENTO</span>
                               </div>
                               <div class="col-md-5 text-right">
                               <?php echo $nombre_sist2['data'][0]['confi_moneda'] ; ?> <span class="" id="boleta_descuento">0.00</span>
                               </div>

                               <div class="col-md-7">
                                   <span>TOTAL</span>
                               </div>
                               <div class="col-md-5 text-right">
                               <?php echo $nombre_sist2['data'][0]['confi_moneda'] ; ?> <span class="" id="boleta_total">0.00</span>
                               </div>
                           </div>



                       </div>

                   </div>

               </div>


           </div>
       </div>
   </div>




   <!-- Modal registrar -->
   <div class="modal fade" id="modal_registro_cliente" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header" style="background:#343A40; color:white">
                   <h5 class="modal-title" id="exampleModalLabel">Registro de Clientes</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="row">

                       <div class="col-12   col-xs-12">

                           <label>Tipo Doc.:</label>
                           <select class="form-control form-control-sm js-example-basic-single" id="select_tipo_doc" style="width: 100%">
                               <option selected="true" disabled>Seleccione Tipo Docmento..</option>
                               <option value="DNI">DNI / NIF</option>
                               <!--iniciar el select 2 en el script -->
                               <option value="R.U.C">R.U.C</option>
                           </select>
                       </div>

                       <div class="col-10 col-xs-10">
                           <label for="">Nro Doc.: </label>
                           <input type="text" id="text_dni" class="form-control form-control-sm" placeholder="Documento">
                       </div>
                       <div class="col-2 col-xs-2">
                           <div class="form-group mb-2">
                               <label for="">&nbsp;</label> <br>
                               <button type="button" class="btn btn-sm btn-success" id="buscarDni"><i class="fas fa-search"></i></button>
                               <button type="button" class="btn btn-sm btn-danger" id="buscarRuc"><i class="fas fa-search"></i></button>
                           </div>
                       </div>


                       <!-- <div class="col-2 col-xs-2">
                            <label for="">&nbsp;</label> <br>
                            <button type="button" class="btn btn-sm btn-success" id="buscar"><i
                                    class="fas fa-search"></i></button>
                        </div> -->


                       <div class="col-12 col-xs-12">
                           <label for="">Nombres: </label>
                           <input type="text" id="text_nombre" class="form-control form-control-sm" onkeypress="return soloLetras(event)" placeholder="Nombre completo">
                       </div>
                       <div class="col-12 col-xs-12" hidden>
                           <label for="">Apellido P.: </label>
                           <input type="text" id="text_ape_p" class="form-control form-control-sm" onkeypress="return soloLetras(event)" placeholder="Apellido Paterno">
                       </div>
                       <div class="col-12 col-xs-12" hidden>
                           <label for="">Apellido M.: </label>
                           <input type="text" id="text_ape_m" class="form-control form-control-sm" onkeypress="return soloLetras(event)" placeholder="Apellido Materno">
                       </div>

                       <div class="col-12 col-xs-12">
                           <label for="">Direccion: </label>
                           <input type="text" id="text_direccion" class="form-control form-control-sm" placeholder="Direccion">
                       </div>

                       <div class="col-12 col-xs-12">
                           <label for="">Móvil: </label>
                           <input type="text" id="text_celular" class="form-control form-control-sm" placeholder="Celular">
                       </div>

                       <div class="col-12 col-xs-12">
                           <label for="">correo: </label>
                           <input type="text" id="text_correo" class="form-control form-control-sm" placeholder="Correo">
                       </div>

                        <div class="col-lg-12 col-xs-12">
                            <div class="form-check"><br>
                                <input class="form-check-input" type="checkbox" value="1" id="chkListanegra" name="chkListanegra" > 
                                <label class="form-check-label" for="chkListanegra">Lista <b>Negra</b></label>
                            </div>
                        </div>

                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                   <button type="button" class="btn btn-sm btn-primary" onclick="RegistrarCliente();">Registrar</button>
               </div>
           </div>
       </div>
   </div>
   <!-- fin Modal -->




   <script>
       //para el diseño del combo
       $(document).ready(function() {
           $('.js-example-basic-single').select2();
          // let sucurid = document.getElementById('text_idsucurs').value;
            let idalmac = document.getElementById('text_idalmacen').value;
         
           // $(".select2-search__field").focus();
           //OCULTAR LO BOTONES DE BUSQUEDAD
           $("#buscarDni").attr('hidden', true);
           $("#buscarRuc").attr('hidden', true);
           //$('#imp_ocultar').attr('hidden', true);

           // $("#text_producto").select2();

           // Enfoca el campo de búsqueda
           $(".select2-search__field").focus();

           //PARA HABILITAR LO BOTONES DE BUSQUEDAD
           $("#select_tipo_doc").change(function() {
               buscarDniRuc();
           });

           //Listar_Ver_Cliente();
           cargar_SelectCliente();
           //Listar_Ver_Producto();
           cargar_SelectComprobante();
           //cargar_Select_Productos2();
           cargar_Select_FormaPAgo_v();
           Traer_caja_id();

           $('#text_producto').select2({
                placeholder: "Seleccione un producto",
                allowClear: true,
                ajax: {
                     url: '../controller/venta/controlador_cargar_selectcombo_productos_venta.php',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            idalmac: idalmac
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            }).on('select2:select', function (e) {
                var data = e.params.data;

                if (data.imei === 'Si') {
                    $('#text_stock').val(data.stock);
                    $('#text_precio').val(data.precio_venta);
                    $('#text_nombre_producto').val(data.text);
                    $('#text_tiene_imei').val(data.imei);
                    $('#text_idproducto').val(data.id);
                    $('#text_cantidad').val("1");
                    $('#text_descuento').val("0");
                    $("#ocult_imei_vent").attr('hidden', false);
                    Traer_Imei_pro(data.id);
                  //  $("#text_producto").trigger('change');
                } else {
                    $('#text_stock').val(data.stock);
                    $('#text_precio').val(data.precio_venta);
                    $('#text_nombre_producto').val(data.text);
                    $('#text_tiene_imei').val(data.imei);
                    $('#text_idproducto').val(data.id);
                    $('#text_cantidad').val("1");
                    $('#text_descuento').val("0");
                    $('#text_cantidad').prop('disabled', false);
                    $("#select_imei").select2().val("").trigger('change.select2');
                    $("#ocult_imei_vent").attr('hidden', true);
                   // $("#text_producto").trigger('change');
                }
                //$(this).val(null).trigger('change');
             
              
            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }
                return repo.text;
            }

            function formatRepoSelection(repo) {
                return repo.text;
            }

        $('#select_tipo_com').on('select2:select', function(e) {
               //let idcpr = document.getElementById('select_tipo_com').value;
               var idcpr = $('#select_tipo_com').val();
               // alert(cli);
               document.getElementById('text_idcompro').value = idcpr;
               document.getElementById('text_serie').value = arreglo_serie_com[idcpr];
               document.getElementById('text_num_compro').value = "0000" + arreglo_numero_com[idcpr];
               document.getElementById('text_compro').value = arreglo_com[idcpr];
               SumarTotalneto();
           })



       });

       /*************************************************************************
               FUNCION PARA LLAMAR LOS DATOS DE RENIEC DESDE API
       ***************************************************************************/
       $('#buscar').click(function() {
           dni = $('#text_dni').val();
           $.ajax({
               url: '../controller/reniec/consultaDNI.php',
               type: 'post',
               data: 'dni=' + dni,
               dataType: 'json',
               success: function(r) {
                   if (r.numeroDocumento == dni) {
                       $('#text_ape_p').val(r.apellidoPaterno);
                       $('#text_ape_m').val(r.apellidoMaterno);
                       $('#text_nombre').val(r.nombres);
                   } else {
                       alert(r.error);
                   }
                   //console.log(r)
               }
           });
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


       /********************************************************************************************************************************************
        ****************************************************** FORMULARIO VENTA ACTUALIZADO ************************************
        ********************************************************************************************************************************************/






       /********************************************************************
          COMPROBANTE EN COMBO
       ********************************************************************/
       var arreglo_com = new Array();
       var arreglo_serie_com = new Array();
       var arreglo_numero_com = new Array();
       //cargar todos los Marca en combo
       function cargar_SelectComprobante() { //enviamos al scrpit mantenimiento examen
           $.ajax({
               url: '../controller/venta/controlador_cargar_select_comprobante.php',
               type: 'POST'
           }).done(function(resp) {
               let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
               let llenardata = "<option >Seleccione...</option>";
               if (data.length > 0) {
                   for (let i = 0; i < data.length; i++) {
                       llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                       arreglo_com[data[i][0]] = data[i][1];
                       arreglo_serie_com[data[i][0]] = data[i][2]; //PARA JALAR LA SERIE DEL PROCEDURE
                       arreglo_numero_com[data[i][0]] = data[i][3]; //PARA JALAR LA CORRELATIVO DEL PROCEDURE
                   }
                   document.getElementById('select_tipo_com').innerHTML =
                       llenardata; //primero para registrar luego en modificar colocamos el select editar
                   document.getElementById("select_tipo_com").selectedIndex = "0";
               } else {
                   llenardata += "<option value=''>No se encontraron datos</option>";
                   document.getElementById('select_tipo_com').innerHTML = llenardata;

               }
           })
       }





       //    $("#ch_impuesto").change(function() {
       //        if ($("#ch_impuesto").is(':checked')) {
       //            document.getElementById('text_impuesto').disabled = false;
       //            document.getElementById('text_impuesto').value = "0.18";
       //            $('#imp_ocultar').prop('hidden', false);
       //            SumarTotalneto();
       //        } else {
       //            document.getElementById('text_impuesto').disabled = true;
       //            document.getElementById('text_impuesto').value = "0";
       //            $('#imp_ocultar').prop('hidden', true);
       //            SumarTotalneto();
       //        }
       //    });

       $('#select_tipo_com').on('select2:select', function(e) {

           let tipofact = document.getElementById('select_tipo_com').value;
          //     console.log(tipofact);
           if (tipofact == 2) {
               document.getElementById('text_impuesto').disabled = false;
               document.getElementById('text_impuesto').value = <?php echo $igv; ?>;
               SumarTotalneto();
           }  
           else {
               document.getElementById('text_impuesto').disabled = true;
               document.getElementById('text_impuesto').value = "0";
               document.getElementById('lbl_impuesto').innerHTML = "";
               SumarTotalneto();
           }
       });



       //HABILITAR CAMPOS SEGUN LA FORMA DE PAGO
       $('#select_forma_pago_V').on('select2:select', function(e) {
           let formp = document.getElementById('select_forma_pago_V').value;
           let mont_tototo = document.getElementById('lbl_totalneto').innerHTML.substr(18);

           if (formp == 2) { //TARJETA
               $("#codoperacionhabilitar").attr('hidden', false); //HABILITAMOS

               $("#efectivohabilitar").attr('hidden', true);
               $("#montoperacionhabilitar").attr('hidden', false);


               document.getElementById('text_efe').value = "";
               document.getElementById('text_tarj').value = "";
               document.getElementById('text_monto_t').value = "";

               document.getElementById('text_efe').value = "0";
               //document.getElementById('text_monto_t').value = "0";
               document.getElementById('text_monto_t').value = mont_tototo;



           } else if (formp == 6) { //YAPE
               $("#codoperacionhabilitar").attr('hidden', false); //HABILITAMOS

               $("#efectivohabilitar").attr('hidden', true);
               $("#montoperacionhabilitar").attr('hidden', false);


               document.getElementById('text_efe').value = "";
               document.getElementById('text_tarj').value = "";
               document.getElementById('text_monto_t').value = "";

               document.getElementById('text_efe').value = "0";
               //document.getElementById('text_monto_t').value = "0";
               document.getElementById('text_monto_t').value = mont_tototo;



           } else if (formp == 7) { //PLIN
               $("#codoperacionhabilitar").attr('hidden', false); //HABILITAMOS

               $("#efectivohabilitar").attr('hidden', true);
               $("#montoperacionhabilitar").attr('hidden', false);


               document.getElementById('text_efe').value = "";
               document.getElementById('text_tarj').value = "";
               document.getElementById('text_monto_t').value = "";

               document.getElementById('text_efe').value = "0";
               //document.getElementById('text_monto_t').value = "0";
               document.getElementById('text_monto_t').value = mont_tototo;



           }else if (formp == 3) { //EFECTIVO Y TARJETA
               $("#efectivohabilitar").attr('hidden', false); //HABILITAMOS
               $("#codoperacionhabilitar").attr('hidden', false); //HABILITAMOS
               $("#montoperacionhabilitar").attr('hidden', false); //HABILITAMOS

               document.getElementById('text_efe').value = "";
               document.getElementById('text_tarj').value = "";
               document.getElementById('text_monto_t').value = "";

               document.getElementById('text_efe').value = "0";
               document.getElementById('text_monto_t').value = "0";


           } else if (formp == 1) { // EFECTIVO
               $("#efectivohabilitar").attr('hidden', true); //monto efectivo
               $("#codoperacionhabilitar").attr('hidden', true);
               $("#montoperacionhabilitar").attr('hidden', true); //monto tarjeta

               document.getElementById('text_efe').value = "";
               document.getElementById('text_tarj').value = "";
               document.getElementById('text_monto_t').value = "";

               //document.getElementById('text_efe').value = "0";
               document.getElementById('text_monto_t').value = "0";

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

               document.getElementById('text_efe').value = "";
               document.getElementById('text_tarj').value = "";
               document.getElementById('text_monto_t').value = "";

               //document.getElementById('text_efe').value = "0";
               document.getElementById('text_monto_t').value = "0";
               document.getElementById('text_efe').value = mont_tototo;

           }
       })





       /********************************************************************
          PRODUCTOS EN COMBO
       ********************************************************************/
       var arreglo_PRO = new Array();
       var arreglo_stock = new Array();
       var arreglo_precio = new Array();
       var arreglo_tie_imei = new Array();

       function cargar_Select_Productos2_oldddddd() { //enviamos al scrpit mantenimiento examen
           $.ajax({
               url: '../controller/venta/controlador_cargar_selectcombo_productos_venta.php',
               type: 'POST'
           }).done(function(resp) {
               //alert(arreglo_stock);
               let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
               let llenardata = "<option value=''>Seleccione</option>";
               // let llenardata = "";
               if (data.length > 0) {
                   for (let i = 0; i < data.length; i++) {
                       llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                       arreglo_PRO[data[i][0]] = data[i][1];
                       arreglo_stock[data[i][0]] = data[i][2]; //PARA JALAR LA STOCK DEL PROCEDURE
                       arreglo_precio[data[i][0]] = data[i][3]; //PARA JALAR LA PRECIO DEL PROCEDURE
                       arreglo_tie_imei[data[i][0]] = data[i][4];
                   }
                   document.getElementById('text_producto').innerHTML = llenardata; //primero para registrar luego en modificar colocamos el select editar

               } else {
                   llenardata += "<option value=''>No se encontraron datos</option>";
                   document.getElementById('text_producto').innerHTML = llenardata;

               }
           })
       }


   </script>