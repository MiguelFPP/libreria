<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Regitro Prestamo</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">

        <?php $presInfo = $pres->fetch_object() ?>

        <div class="col-md-12">
            <div class="card card-body printableArea">
                <h3><b>Prestamo</b> <span class="pull-right">#</span></h3>
                <hr>
                <div class="col-md-3">
                <a href="Prestamo/usuarios" class="btn btn-primary mb-2"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                <a href="Prestamo/pdfInfoPrestamo&id=<?= $presInfo->id ?>" class="btn btn-warning mb-2"><i class="fas fa-file-pdf"></i> PDF</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="fechaInicio">Fecha Inicio: </label>
                                        <span class="badge badge-primary"><?= $presInfo->fechaInicio ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="fechaFin">Fecha Fin: </label>
                                        <span class="badge badge-primary"><?= $presInfo->fechaFin ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="fechaEntrega">Fecha Entrega: </label>
                                        <?php if ($presInfo->fechaEntrega > $presInfo->fechaFin) : ?>
                                            <span class="badge badge-danger"><?= $presInfo->fechaEntrega ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-success"><?= $presInfo->fechaEntrega ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="pull-left">
                                    <address>
                                        <h3> &nbsp;<b class="text-danger"><?= $presInfo->perNombre . ' ' . $presInfo->perApellido ?></b></h3>
                                        <p class="text-muted m-l-5"><?= $presInfo->perIdentificacion ?>,
                                            <br /> <?= $presInfo->perCorreo ?>
                                        </p>
                                    </address>
                                </div>
                                <div class="pull-right text-right">
                                    <address>
                                        <h3>Prestamo hecho por:</h3>
                                        <h4 class="font-bold"><?= $perPrestamos->nombre . ' ' . $perPrestamos->apellido ?>,</h4>
                                        <p class="text-muted m-l-30"><?= $perPrestamos->correo ?>
                                        </p>
                                    </address>
                                </div>


                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Autor</th>
                                                <th>Categoria</th>
                                                <th>Editorial</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($rPresLibros = $pres->fetch_object()) :
                                            ?>
                                                <tr class="">
                                                    <td><?= $rPresLibros->libNombre ?></td>
                                                    <td><?= $rPresLibros->autor ?></td>
                                                    <td><?= $rPresLibros->categoria ?></td>
                                                    <td><?= $rPresLibros->libEditorial ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->