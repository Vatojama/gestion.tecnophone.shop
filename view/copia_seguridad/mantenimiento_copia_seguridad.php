<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Copia de Seguridad</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Generar Respaldo de Base de Datos</h3>
            </div>
            <div class="card-body">
                <p>Al hacer clic en el botón, el sistema generará un archivo SQL completo con la estructura y los datos
                    de todas las tablas. Este proceso puede tardar unos segundos dependiendo del tamaño de la base de
                    datos.</p>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Se recomienda realizar copias de seguridad antes de
                    actualizaciones críticas o cambios masivos de inventario.
                </div>

                <a href="../controller/copia_seguridad/controlador_generar_respaldo.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-download"></i> Descargar Copia de Seguridad (.sql)
                </a>
            </div>
        </div>
    </div>
</div>