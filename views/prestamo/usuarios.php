<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Usuarios Con Prestamos</h4>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- fin seccion de alertas -->
                    <div class="table-responsive">
                        <!-- funcion para mostrar todas la categorias -->
                        <?php $prestamos = PrestamoController::usuariosConPrestamos() ?>
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Identificacion</th>
                                    <th>Nombres</th>
                                    <th>Cant Prestamos</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($pres = $prestamos->fetch_object()) : ?>
                                    <tr class="">
                                        <td><?= $pres->identificacion ?></td>
                                        <td><?= $pres->nombre ?> <?= $pres->apellido ?></td>
                                        <td><?= $pres->cantPres ?></td>
                                        <td class="text-center">
                                            <a href="prestamo/prestamosPorUsuario&id=<?= $pres->id ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <th>Identificacion</th>
                                <th>Nombres</th>
                                <th>Cant Prestamos</th>
                                <th>Accion</th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->