function AbrirModalRegistroNotas() {
    //para que no se nos salga del modal haciendo click a los costados
    $("#modal_registro_notas").modal({ backdrop: 'static', keyboard: false });
    $("#modal_registro_notas").modal('show');//abrimos el modal
     document.getElementById('text_notas').value="";
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
}







/**********************************************************************
                                REGISTRAR MOTIVO
***********************************************************************/
function Registrarnotas() {
    let notas_r = document.getElementById('text_notas').value;
    let idusunot_r = document.getElementById('text_Idprincipal').value;
    //let estado = document.getElementById('select_estado').value;
    if (notas_r== "") {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
    }

    $.ajax({
        url: '../controller/notas/controlador_notas_registar.php',
        type: 'POST',
        data: {
            notas_r: notas_r,
            idusunot_r:idusunot_r

        }
    }).done(function (resp) {
        //console.log(resp);
        if (resp>0) {
            //validamos la respuesta del procedure si retorna 1 o 2
                Swal.fire("Mensaje de Confirmacion","Nota Registrada","success").then((value)=>{
                        $("#modal_registro_notas").modal('hide');//abrimos el modal
                        Notas_usuario(idusunot_r);
                    }); 
                
            }else{
                Swal.fire("Mensaje de Error","No se puede registrar la Nota","error");
            }
    })   
}

///TRAER DATA DE NOTAS PARA EDITAR
function editar(idnota) {
    $.ajax({
        url: '../controller/notas/controlador_traer_data_editar.php',
        type: 'POST',
        data: {
            idnota:idnota

        }
    }).done(function (resp) {
        let data = JSON.parse(resp);
        //console.log(data);
        $("#modal_editar_notas").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_notas").modal('show');//abrimos el modal

        document.getElementById('idnota_e').value=data[0][0];
        document.getElementById('text_notas_e').value=data[0][1];
        
    })   
}



/**********************************************************************
                                MODIFICAR MOTIVO
***********************************************************************/
function Modificar_notas() {
    let notas_e = document.getElementById('text_notas_e').value;
    let idnotas_e = document.getElementById('idnota_e').value;
    let idusunot_e = document.getElementById('text_Idprincipal').value;
    if (notas_e== "") {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
    }

    $.ajax({
        url: '../controller/notas/controlador_notas_editar.php',
        type: 'POST',
        data: {
            idnotas_e:idnotas_e,
            notas_e: notas_e
            

        }
    }).done(function (resp) {
        //console.log(resp);
        if (resp>0) {
            //validamos la respuesta del procedure si retorna 1 o 2
                Swal.fire("Mensaje de Confirmacion","Nota Actualizada","success").then((value)=>{
                        $("#modal_editar_notas").modal('hide');//abrimos el modal
                        Notas_usuario(idusunot_e);
                    }); 
                
            }else{
                Swal.fire("Mensaje de Error","No se puede actualizar la Nota","error");
            }
    })   
}




 /********************************************************************
 		    METODO   ELIMINAR LAS NOTAS
 ********************************************************************/
function eliminar(id) {
    let idusunot_e = document.getElementById('text_Idprincipal').value;
    $.ajax({
        url: '../controller/notas/controlador_eliminar_notas.php',
        type: 'POST',
        data: {
            id: id


        }
    }).done(function (resp) {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmacion", "Nota Eliminada", "success").then((value) => {
                Notas_usuario(idusunot_e);
            });
        } else {
            Swal.fire("Mensaje de Error", "No se puede eliminar la nota", "error");
        }
    })
}