 /********************************************************************
 		LISTAR CLIENTE CON METODO NORMAL
 ********************************************************************/

         var tbl_cliente;
         function Listar_Mov_Cliente(){//enviarlo al scrip en MANTENIMIENTO CLIENTE
            var clienteid = document.getElementById('text_clienteid').value;
            tbl_cliente = $("#tabla_mov_clientes").DataTable({
                "responsive" :true,
                "ordering" :false,
                "bLengthChange" : true,
                "searching" : {"regex" : false},
                "lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                "pageLength" : 10,
                "dom": 'Blfrtip',
                "buttons":[
                    {
                       "extend":    'excelHtml5',
                       "text":      '<i class="fa fa-file-excel"></i>',
                       "titleAttr": 'Exportar a Excel'
                    },
        
                ],
                "destroy" :true,
                "async" : false,
                "processing": true,	
        
                "ajax" : {
                    "url": "../controller/cliente/controlador_movimientos_cliente.php",
                    type: 'POST',
                    data: {
                        clienteid: clienteid
                       
                    }
                },
        
                
                "columns":[
                //todos los datos del procedimiento almacenado
                {"defaultContent": ""},//cintador 
                {"data": "nombre_prod"},
                {"data": "imei"},	
                {"data": "cantidad"},
                {"data": "fecha"},
                {"data": "vendedor"},
              //  {"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class='fa fa-edit'></i></span>"+"</center>"}
        
        
                ],
                "language":idioma_espanol,
                select:true
            });
            //contador en cada tabla
            tbl_cliente.on('draw.td',function(){
                var PageInfo = $("#tabla_mov_clientes").DataTable().page.info();
                tbl_cliente.column(0,{page: 'current'}).nodes().each(function(cell,i){
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
         }
        