/********************************************************************
		   LISTAR BANNER
********************************************************************/
var tbl_banner;
function Listar_Banner() {
  tbl_banner = $("#tabla_banner").DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/tienda/Listar_banner.php",
      type: "POST",
    },
    dom: "lfrtip",
    // "buttons": [
    // 	{
    // 		"extend": 'excelHtml5',
    // 		"title": 'Reporte Productos',
    // 		"exportOptions": {
    // 			'columns': [0, 1, 2, 3, 4, 5, 6, 7]
    // 		},
    // 		"text": '<i class="fa fa-file-excel"></i>',
    // 		"titleAttr": 'Exportar a Excel'
    // 	},
    // ],
    columns: [
      { data: "id_banner" },

      { data: "descripcion_b" },

      {
        data: "foto_b",
        render: function (data, type, row) {
          return (
            '<img class="img-responsive" style="width:40px;" src="../' +
            data +
            '">'
          );
        },
      },

      {
        defaultContent:
          "<center>" +
          "<span class='eliminar_b text-danger px-1' style='cursor:pointer;' title='Eliminar Banner'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
}

/********************************************************************
			  ABRIR MODAL REGISTRAR  BANNER
********************************************************************/
function AbrirModalRegistroBanner() {
  //se jala en el boton nuevo
  //para que no se nos salga del modal haciendo click a los costados
  $("#modal_registrar_banner").modal({ backdrop: "static", keyboard: false });
  $("#modal_registrar_banner").modal("show"); //abrimos el modal
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
  // Limpiar la imagen de previsualización
  $("#previewImg").attr("src", "");
  $("#text_imagen").val("");
}

async function convertToWebP(file) {
  return new Promise((resolve) => {
    const image = new Image();
    image.onload = () => {
      const canvas = document.createElement("canvas");
      canvas.width = image.width;
      canvas.height = image.height;
      canvas.getContext("2d").drawImage(image, 0, 0);
      canvas.toBlob((blob) => {
        resolve(blob);
      }, "image/webp");
    };
    image.src = URL.createObjectURL(file);
  });
}

function RegistrarBanner() {
  let foto = document.getElementById("text_imagen").value;
  let descrip = document.getElementById("text_descripcion").value;

  // Modificar la extensión a .webp
  let nombrefoto = "";
  let f = new Date();
  if (foto.length > 0) {
    nombrefoto =
      "BANNER" +
      f.getDate() +
      "" +
      (f.getMonth() + 1) +
      "" +
      f.getFullYear() +
      "" +
      f.getHours() +
      "" +
      f.getMilliseconds() +
      ".webp";
  }

  let formData = new FormData();
  let fotoObject = $("#text_imagen")[0].files[0];

  // Convertir la imagen a WebP antes de enviar
  convertToWebP(fotoObject).then((webpBlob) => {
    formData.append("descrip", descrip);
    formData.append("nombrefoto", nombrefoto);
    formData.append("foto", webpBlob, nombrefoto);

    $.ajax({
      url: "../controller/tienda/Registrar_Banner.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (resp) {
        if (resp.includes("Consulta exitosa")) {
          Swal.fire(
            "Mensaje de Confirmacion",
            "Banner Registrado",
            "success"
          ).then((value) => {
            document.getElementById("text_descripcion").value = "";
            tbl_banner.ajax.reload();
            $("#modal_registrar_banner").modal("hide");
          });
        } else {
          Swal.fire(
            "Mensaje de Error",
            "No se puede registrar el banner",
            "error"
          );
        }
      },
    });
  });
  return false;
}

/*===================================================================*/
//PREVIEW DE LA IMAGEN
/*===================================================================*/
function previewFile(input) {
  var file = $("input[type=file]").get(0).files[0];
  if (
    file["type"] != "image/jpeg" &&
    file["type"] != "image/png" &&
    file["type"] != "image/webp" &&
    file["type"] != "image/jpg"
  ) {
    $("#text_imagen").val("");

    Swal.fire("Error", "Extension de imagen no valida!", "warning");
  } else if (file["size"] > 2000000) {
    $("#text_imagen").val("");

    Swal.fire("Erro", "La imagen no debe pesar más de 2mb!", "warning");
  } else {
    // if(file){
    var reader = new FileReader();
    reader.onload = function () {
      $("#previewImg").attr("src", reader.result);
    };
    reader.readAsDataURL(file);
  }
}

/**********************************************************************
 				MENSAJE ELIMINAR BANNER
 ***********************************************************************/
$("#tabla_banner").on("click", ".eliminar_b", function () {
  //campo activar tiene que ir en el boton
  var data = tbl_banner.row($(this).parents("tr")).data(); //tamaño de escritorio
  if (tbl_banner.row(this).child.isShown()) {
    var data = tbl_banner.row(this).data(); //para celular y usas el responsive datatable
  }
  // console.log(data);
  Swal.fire({
    title: "Desea Eliminar el Banner?",
    text: "Se borrara el registro de la base de datos",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, confirmar",
  }).then((result) => {
    if (result.isConfirmed) {
      Eliminar_Banner(data.id_banner); //campo id de la marca luego llamamos al metodo
    }
  });
});

/********************************************************************
 		    METODO   ELIMINAR BANNER 
 ********************************************************************/
function Eliminar_Banner(id) {
  $.ajax({
    url: "../controller/tienda/Eliminar_Banner.php",
    type: "POST",
    data: {
      id: id, //le enviamos los campos al controlador
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire("Mensaje de Confirmacion", "Banner Eliminado", "success").then(
        (value) => {
          tbl_banner.ajax.reload(); //recargar dataTable
          //TraerNotificaciones();
        }
      );
    } else {
      Swal.fire("Mensaje de Error", "No se puede eliminar Banner", "error");
    }
  });
}

/********************************************************************
			  ABRIR MODAL REGISTRAR  SERVICIO
********************************************************************/
function AbrirModalRegistroServi() {
  //se jala en el boton nuevo
  //para que no se nos salga del modal haciendo click a los costados
  $("#modal_registrar_servi").modal({ backdrop: "static", keyboard: false });
  $("#modal_registrar_servi").modal("show"); //abrimos el modal
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
  // Limpiar la imagen de previsualización
  //   $("#previewImg").attr("src", "");
  //   $("#text_imagen").val("");
}

function RegistrarServi() {
  let titulo = document.getElementById("text_titulo").value;
  var descripcion = $("#servicio_descripcion").summernote("code");
  if (titulo == "") {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Debe ingresar un titulo del servicio",
      "warning"
    );
  }
  $.ajax({
    url: "../controller/tienda/Registrar_Servicio.php",
    type: "POST",
    data: {
      titulo: titulo,
      descripcion: descripcion,
    },
    success: function (resp) {
      console.log(resp);
      if (resp.includes("ok")) {
        Swal.fire("Éxito", "Servicio registrado correctamente", "success");
        $("#modal_registrar_servi").modal("hide");
        // Aquí puedes recargar tu tabla si lo necesitas
      } else {
        Swal.fire("Error", "No se pudo registrar el servicio", "error");
      }
    },
  });
}

/********************************************************************
		   LISTAR SERVICIO EN TABLA
********************************************************************/
var tbl_servic;
function Listar_Servi() {
  tbl_servic = $("#tabla_servic").DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/tienda/Listar_Servici.php",
      type: "POST",
    },
    dom: "lfrtip",

    columns: [
      { data: "titulo" },

      // { data: "descripcion_b" },

      // {
      //   data: "foto_b",
      //   render: function (data, type, row) {
      //     return (
      //       '<img class="img-responsive" style="width:40px;" src="../' +
      //       data +
      //       '">'
      //     );
      //   },
      // }
      {
        defaultContent:
          "<center>" +
          "<span class='editar_serv text-danger px-1' style='cursor:pointer;' title='Editar Serv'><i class= 'fa fa-edit'></i></span>" +
          "<span class='eliminar_serv text-danger px-1' style='cursor:pointer;' title='Eliminar Serv'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
}

/********************************************************************
 		ABRIR MODAL EDITAR CLIENTE
 ********************************************************************/
$("#tabla_servic").on("click", ".editar_serv", function () {
  //class foto tiene que ir en el boton
  var data = tbl_servic.row($(this).parents("tr")).data(); //tamaño de escritorio
  if (tbl_servic.row(this).child.isShown()) {
    var data = tbl_servic.row(this).data(); //para celular y usas el responsive datatable
  }

  $("#modal_editar_servi").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_servi").modal("show"); //abrimos el modal

  document.getElementById("text_titulo_editar").value = data.titulo;
  $("#servicio_descripcion_editar").summernote("code", data.descripcion);
  document.getElementById("id_Servicio").value = data.idserv;
  console.log(data);
});

/********************************************************************
		   MODIFICAR SERVICIO
********************************************************************/
function EditarServi() {
  let idserv = document.getElementById("id_Servicio").value;
  let titulo = document.getElementById("text_titulo_editar").value;
  var descripcion = $("#servicio_descripcion_editar").summernote("code");
  if (titulo == "") {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Debe ingresar un titulo del servicio",
      "warning"
    );
  }
  $.ajax({
    url: "../controller/tienda/Editar_Servicio.php",
    type: "POST",
    data: {
      idserv: idserv,
      titulo: titulo,
      descripcion: descripcion,
    },
    success: function (resp) {
      console.log(resp);
      if (resp.includes("ok")) {
        Swal.fire("Éxito", "Servicio Actualizado correctamente", "success");
        $("#modal_editar_servi").modal("hide");
        // Aquí puedes recargar tu tabla si lo necesitas
      } else {
        Swal.fire("Error", "No se pudo actualizar el servicio", "error");
      }
    },
  });
}


////////////////////////////////PARA LOS PEDIDOS////////////////////////
/********************************************************************
		   LISTAR PEDIDOS EN TABLA
********************************************************************/
var tbl_pedido;
function Listar_Pedidos() {
  var finicio = document.getElementById('text_finicio').value;
	var ffin = document.getElementById('text_ffin').value;
  tbl_pedido = $("#tabla_pedido").DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/tienda/Listar_pedidos_fechas.php",
      type: "POST",
      data: {
				finicio: finicio,
				ffin: ffin
				
			},
    },
    dom: "lfrtip",
    // "buttons": [
    // 	{
    // 		"extend": 'excelHtml5',
    // 		"title": 'Reporte Productos',
    // 		"exportOptions": {
    // 			'columns': [0, 1, 2, 3, 4, 5, 6, 7]
    // 		},
    // 		"text": '<i class="fa fa-file-excel"></i>',
    // 		"titleAttr": 'Exportar a Excel'
    // 	},
    // ],
    columns: [
      { data: "pedido_correlativo" },

      { data: "cliente_nombres" },
      { data: "cliente_dni" },
      { data: "cliente_celular" },
      { data: "pedidofecha" },
      { data: "pedido_total" },
     // { data: "pedido_estado" },
      {data: "pedido_estado",
        render: function(data,type,row){
          if (data==="PENDIENTE") {
            return "<span class='badge badge-info'>"+data+"</span>"
          } else if (data==="EN PROCESO"){
            return "<span class='badge badge-warning'>"+data+"</span>"
          }  else if (data==="ENVIADO"){
            return "<span class='badge badge-primary'>"+data+"</span>"
          } else if (data==="COMPLETADO"){
            return "<span class='badge badge-success'>"+data+"</span>"
          }  else {
            return "<span class='badge badge-danger'>"+data+"</span>"
          }
        }
      },

      {
        defaultContent:
          "<center>" +
          "<span class='ver_detalle_pedido text-info px-1' style='cursor:pointer;' title='Ver detalles del pedido'><i class= 'fa fa-eye'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
}

///LISTAR DETALLE DEL PEDIDO
var tbl_pedido_det;
function Listar_Detalle_Pedido(idpedido) {
	
  tbl_pedido_det = $("#tabla_pedido_detalle").DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/tienda/Listar_Detalle_pedido.php",
      type: "POST",
      data: {
				idpedido: idpedido
				
			},
    },
    dom: "rtip",
    // "buttons": [
    // 	{
    // 		"extend": 'excelHtml5',
    // 		"title": 'Reporte Productos',
    // 		"exportOptions": {
    // 			'columns': [0, 1, 2, 3, 4, 5, 6, 7]
    // 		},
    // 		"text": '<i class="fa fa-file-excel"></i>',
    // 		"titleAttr": 'Exportar a Excel'
    // 	},
    // ],
    columns: [
      { data: "producto_nombre" },

      { data: "total_cantidad" },
      { data: "precio" },
      { data: "subtotal" }

      // {
      //   defaultContent:
      //     "<center>" +
      //     "<span class='ver_detalle_pedido text-info px-1' style='cursor:pointer;' title='Ver detalles del pedido'><i class= 'fa fa-eye'></i></span>" +
      //     "</center>",
      // },
    ],
    language: idioma_espanol,
    select: true,
  });
}



//VER DETALLES  DEL PEDIDO
$('#tabla_pedido').on('click', '.ver_detalle_pedido', function () {//class foto tiene que ir en el boton
	var data = tbl_pedido.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_pedido.row(this).child.isShown()) {
		var data = tbl_pedido.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data);
	$("#modal_detalle_pedido").modal({ backdrop: 'static', keyboard: false });
	$("#modal_detalle_pedido").modal('show');//abrimos el modal
  document.getElementById('text_nrocorrel').textContent = data.pedido_correlativo;
  document.getElementById('text_monto_tot').value = data.pedido_total;
  document.getElementById('pedidoid').value = data.pedido_id;
  $("#Select_estado_p").select2().val(data.pedido_estado).trigger('change.select2');
	Listar_Detalle_Pedido(data.pedido_id);


});


/********************************************************************
		   REGISTRAR VENTA CABECERA
********************************************************************/
function Actualizar_estado_pedido() {
	
	let estadopedi = document.getElementById('Select_estado_p').value;
  let pedidoid = document.getElementById('pedidoid').value;

	$.ajax({
		url: '../controller/tienda/controlador_actualizar_Estado_pedido.php',
		type: 'POST',
		data: {
			estadopedi: estadopedi,
      pedidoid:pedidoid
		}
	}).done(function (resp) {
		//console.log(resp);
		if (resp > 0) {
			Swal.fire("Mensaje de Confirmacion", "Estado del pedido actualizado", "success").then(
        (value) => {
          tbl_pedido.ajax.reload(); //recargar dataTable
        }
      );

		} else {
			return Swal.fire("Mensaje de Error", "No se pudo actualizar el registro", "error");
		}
	})
}
