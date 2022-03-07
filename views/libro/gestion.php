<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Gestion Libros</h4>
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
                    <a href="Libro/crear" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Agregar</a>
                    <!-- alertas de error o completo -->
                    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
                        <div class="alert alert-success">
                            Libro Agregado Correctamente
                        </div>
                    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
                        <div class="alert alert-success">
                            Problemas al agregar
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['edit']) && $_SESSION['edit'] == 'complete') : ?>
                        <div class="alert alert-success">
                            Libro Editado Correctamente
                        </div>
                    <?php elseif (isset($_SESSION['edit']) && $_SESSION['register'] == 'failed') : ?>
                        <div class="alert alert-success">
                            Problemas al editar
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
                        <div class="alert alert-success">
                            Libro Eliminado Correctamente
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
                        <?php $libros = Utils::showLibros(); ?>
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Autor</th>
                                    <th>Categoria</th>
                                    <th>Editorial</th>
                                    <th>Stock</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($lib = $libros->fetch_object()) : ?>
                                    <tr class="">
                                        <td><?= $lib->nombre ?></td>
                                        <td><?= $lib->autor ?></td>
                                        <td><?= $lib->categoria ?></td>
                                        <td><?= $lib->editorial ?></td>
                                        <td><?= $lib->stock ?></td>
                                        <td class="text-center">
                                            <a href="Libro/editar&id=<?= $lib->id ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit "></i>
                                            </a>
                                            <a href="Libro/delete&id=<?= $lib->id ?>" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <th>Nombre</th>
                                <th>Autor</th>
                                <th>Categoria</th>
                                <th>Editorial</th>
                                <th>Stock</th>
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