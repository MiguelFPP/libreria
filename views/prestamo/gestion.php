<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Gestion de Prestamos</h4>
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
                    <a href="prestamo/librosPrestamo" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Iniciar Prestamo</a>
                    <!-- alertas de error o completo al terminar -->
                    <?php if (isset($_SESSION['term']) && $_SESSION['term'] == 'complete') : ?>
                        <div class="alert alert-success">
                            Prestamo Terminado
                        </div>
                    <?php elseif (isset($_SESSION['term']) && $_SESSION['term'] == 'failed') : ?>
                        <div class="alert alert-success">
                            Problemas al terminar el prestamo
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['edit']) && $_SESSION['edit'] == 'complete') : ?>
                        <div class="alert alert-success">
                            Usuario Editado Correctamente
                        </div>
                    <?php elseif (isset($_SESSION['edit']) && $_SESSION['register'] == 'failed') : ?>
                        <div class="alert alert-success">
                            Problemas al editar
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
                        <div class="alert alert-success">
                            Usuario Eliminada Correctamente
                        </div>
                    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
                        <div class="alert alert-success">
                            Problemas al eliminar
                        </div>
                    <?php endif; ?>
                    <?php Utils::borrar_alertas() ?>
                    <!-- fin seccion de alertas -->
                    <div class="table-responsive">
                        <!-- funcion para mostrar todas la categorias -->
                        <?php $prestamos = PrestamoController::prestamosNoConcluidos() ?>
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Identificacion</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($pres = $prestamos->fetch_object()) : ?>
                                    <tr class="">
                                        <td><?= $pres->identificacion ?></td>
                                        <td><?= $pres->fechaInicio ?></td>
                                        <td><?= $pres->fechaFin ?></td>
                                        <td>
                                            <?php if ($pres->estado == 'pres') : ?>
                                                <span class="badge badge-pill badge-primary">Prestado</span>
                                            <?php elseif ($pres->estado == 'multa') : ?>
                                                <span class="badge badge-pill badge-danger">Multa</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="prestamo/terminar&id=<?= $pres->id ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-check "></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <th>Identificacion</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
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