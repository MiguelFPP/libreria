<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Seleccion de Usuarios</h4>
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
                    <a href="Prestamo/carrito" class="btn btn-primary mb-2"><i class="fas fa-eye"></i> Ver Libros</a>
                    <?php Utils::borrar_alertas() ?>
                    <!-- fin seccion de alertas -->
                    <div class="table-responsive">
                        <!-- funcion para mostrar todas la categorias -->
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Identificacion</th>
                                    <th>Nombre</th>
                                    <th>correo</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $usuarios = Utils::getAllClientLibres() ?>
                                <?php while ($user = $usuarios->fetch_object()) : ?>
                                    <tr class="">
                                        <td><?= $user->identificacion ?></td>
                                        <td><?= $user->nombre ?> <?= $user->apellido ?></td>
                                        <td><?= $user->correo ?></td>
                                        <td class="text-center">
                                            <a href="Prestamo/previewPrestamo&id=<?= $user->id ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-inbox "></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <th>Identificacion</th>
                                <th>Nombre</th>
                                <th>Rol</th>
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