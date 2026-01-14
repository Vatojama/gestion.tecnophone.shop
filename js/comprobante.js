 /********************************************************************
 		LISTAR COMPROBANTE CON METODO NORMAL
 ********************************************************************/
var tbl_comprobante;
 function Listar_Comprobante(){//enviarlo al scrip en MANTENIMIENTO ROL
    tbl_comprobante = $("#tabla_comprobante").DataTable({
        "responsive" :true,
        "ordering" :false,
        "bLengthChange" : true,
        "searching" : {"regex" : false},
        "lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
        "pageLength" : 10,
        "destroy" :true,
        "async" : false,
        "processing": true,
        "ajax" : {
            "url": "../controller/comprobante/controlador_comprobante_listar.php",
            type: 'POST'
        },
        "columns":[
        //todos los datos del procedimiento almacenado
        {"defaultContent": ""},//cintador 
        {"data": "compro_tipo"},
        {"data": "compro_serie"},
        {"data": "compro_numero"},
        {"data": "compro_estado",
            render: function(data,type,row){
                if (data==="ACTIVO") {
                    return "<center>"+'<span class="badge badge-success">ACTIVO</span>';+"</center>"
                }else{
                    return "<center>"+'<span class="badge badge-danger">INACTIVO</span>';+"</center>"
                }
            }
        },
        {"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class='fa fa-edit'></i></span>&nbsp;"+"</center>"}


        ],
        "language":idioma_espanol,
        select:true
    });
    //contador en cada tabla
    tbl_comprobante.on('draw.td',function(){
        var PageInfo = $("#tabla_comprobante").DataTable().page.info();
        tbl_comprobante.column(0,{page: 'current'}).nodes().each(function(cell,i){
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
 }




 /********************************************************************
        ABRIR MODAL REGISTRAR COMPROBANTE
 ********************************************************************/
 function AbrirModalRegistroComprobante(){
    //para que no se nos salga del modal haciendo click a los costados
    $("#modal_registro_comprobante").modal({backdrop:'static', keyboard: false});   
    $("#modal_registro_comprobante").modal('show');//abrimos el modal
    LimpiarModalComprobante();
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }






 /********************************************************************
        ABRIR MODAL EDITAR COMPROBANTE
 ********************************************************************/
 $('#tabla_comprobante').on('click', '.editar', function() {//class foto tiene que ir en el boton
    var data = tbl_comprobante.row($(this).parents('tr')).data();//tamaño de escritorio
    if (tbl_comprobante.row(this).child.isShown()) {
        var data = tbl_comprobante.row(this).data();//para celular y usas el responsive datatable
    }
        $("#modal_editar_comprobante").modal({backdrop:'static', keyboard: false}); 
        $("#modal_editar_comprobante").modal('show');//abrimos el modal

        document.getElementById('idcomprobante').value=data.compro_id;//id del procedure
        document.getElementById('text_tipoc_editar').value=data.compro_tipo;//enviamos el nombre del usu al modal
        document.getElementById('text_seriec_editar').value=data.compro_serie;
        document.getElementById('text_numeroc_editar').value=data.compro_numero;
        //console.log(data.rol_id);//para enviar el dato  en console
        $("#select_estado_compro_editar").select2().val(data.compro_estado).trigger('change.select2');
 });






 /********************************************************************
        REGISTRAR COMPROBANTE
 ********************************************************************/
 function RegistrarComprobante(){
    let tipo = document.getElementById('text_tipoc').value;
    let serie = document.getElementById('text_seriec').value;
    let numeroc = document.getElementById('text_numeroc').value;
    if (tipo.length ==0 || serie.length ==0 || numeroc.length ==0  ) {
        ValidarCamposComprobante("text_tipoc","text_seriec","text_numeroc");
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
    }
 
    $.ajax({
        url:'../controller/comprobante/controlador_comprobante_registar.php',
        type: 'POST',
        data:{
            tipo: tipo,//le enviamos los campos al controlador
            serie: serie,
            numeroc: numeroc

        }
    }).done(function(resp){
        if (resp>0) {
            //validamos la respuesta del procedure si retorna 1 o 2
                Swal.fire("Mensaje de Confirmacion","Comprobante Registrado","success").then((value)=>{
                        $("#modal_registro_comprobante").modal('hide');//abrimos el modal
                        tbl_comprobante.ajax.reload();//recargar dataTable
                        //TraerNotificaciones();
                    }); 
            
                                
            }else{
                Swal.fire("Mensaje de Error","No se puede registrar el Comprobante","error");
            }
    })   
 }

 




  /********************************************************************
        VALIDAR TEXBOX COMPROBANTE
 ********************************************************************/
 function ValidarCamposComprobante(tipo,serie,numeroc){
    Boolean(document.getElementById(tipo).value.length>0) ? $("#"+tipo).removeClass("is-invalid").addClass("is-valid") : $("#"+tipo).removeClass("is-valid").addClass("is-invalid");
    Boolean(document.getElementById(serie).value.length>0) ? $("#"+serie).removeClass("is-invalid").addClass("is-valid") : $("#"+serie).removeClass("is-valid").addClass("is-invalid");
    Boolean(document.getElementById(numeroc).value.length>0) ? $("#"+numeroc).removeClass("is-invalid").addClass("is-valid") : $("#"+numeroc).removeClass("is-valid").addClass("is-invalid");
   
 }




 /********************************************************************
        LIMPIAR TEXBOX COMPROBANTE
 ********************************************************************/
 function LimpiarModalComprobante(){
    document.getElementById('text_tipoc').value="";
    document.getElementById('text_seriec').value="";
    document.getElementById('text_numeroc').value="";
    //$("#select_estado_compro_editar").select2().val("").trigger('change.select2');
    
 }







 /********************************************************************
        MODIFICAR COMPROBANTE
 ********************************************************************/
 function ModificarComprobante(){//enviamos los datos del ajax al controlador y al onclick del boton editar
    let id = document.getElementById('idcomprobante').value;
    let tipo = document.getElementById('text_tipoc_editar').value;
    let serie = document.getElementById('text_seriec_editar').value;
    let numeroc = document.getElementById('text_numeroc_editar').value;
    let estado = document.getElementById('select_estado_compro_editar').value;

    if (tipo.length ==0 || serie.length ==0 || numeroc.length ==0  ) {
        ValidarCamposComprobante("text_tipoc_editar","text_tipoc_editar","text_numeroc_editar");
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
    }

    $.ajax({
        url:'../controller/comprobante/controlador_modificar_comprobante.php',
        type: 'POST',
        data:{
            id: id,//le enviamos los campos al controlador
            tipo: tipo,
            serie: serie,
            numeroc: numeroc,
            estado: estado
        }
    }).done(function(resp){
        if (resp>0) {
                    //ValidarCampos("text_usuario_editar","","select_rol_editar");  
                    Swal.fire("Mensaje de Confirmacion","Comprobante actualizado","success").then((value)=>{
                        $("#modal_editar_comprobante").modal('hide');//ocultamos modal despues de registrar
                        tbl_comprobante.ajax.reload();//recargar dataTable
                        //TraerNotificaciones();
                    });             
            }else{
                Swal.fire("Mensaje de Error","No se puede modificar el Comprobante","error");
            }
    })
 }


