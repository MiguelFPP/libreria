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
                    <a href="Prestamo/usuarios" class="btn btn-primary mb-2"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                    <!-- fin seccion de alertas -->
                    <div class="table-responsive">
                        <!-- funcion para mostrar todas la categorias -->
                        
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Multa</th>
                                    <th>Prestado Por</th>
                                    <th>Cant Libros</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($pres = $prestamos->fetch_object()) : ?>
                                    <tr class="">
                                        <td><?= $pres->fechaInicio ?></td>
                                        <td><?= $pres->fechaFin ?></td>
                                        <td>
                                            <?php if ($pres->estado == 'entr') : ?>
                                                <span class="badge badge-pill badge-success">Entregado</span>
                                            <?php elseif ($pres->estado == 'pres') : ?>
                                                <span class="badge badge-pill badge-primary">Prestado</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($pres->multa == 'n') : ?>
                                                <span class="badge badge-pill badge-success">NO</span>
                                            <?php elseif ($pres->multa == 's') : ?>
                                                <span class="badge badge-pill badge-danger">SI</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $pres->presNombre ?> <?= $pres->presApellido ?></td>
                                        <td><?= $pres->cantLib ?></td>

                                        <td class="text-center">
                                            <a href="Prestamo/infoPrestamos&id=<?= $pres->id ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Multa</th>
                                <th>Prestado Por</th>
                                <th>Cant Libros</th>
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