<!-- Content Header (Page header) -->

<script src="../js/movimientos_cliente.js?rev=<?php echo time(); ?>"></script>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="col-lg-12">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"><b>Listado de Articulos</b></h3>
            <!-- <button class="btn btn-info btn-sm float-right" onclick="AbrirModalRegistroUsuario();"><i class="fas fa-plus"></i> Nuevo</button> -->
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="tabla_mov_clientes" class="display compact">
                        <thead style="background:#343A40; color:white" class="small text left">
                            <tr>
                                <th>#</th>
                                <th>Nombre Art.</th>
                                <th>Imei</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Vendedor</th>
                              
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
//para el diseño del combo
  $(document).ready(function() {
    Listar_Mov_Cliente();
 });

 </script>

