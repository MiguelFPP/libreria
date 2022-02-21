<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Seleccion de Libros</h4>
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
                    <a href="prestamo/carrito" class="btn btn-primary mb-2"><i class="fas fa-eye"></i> Ver Libros</a>
                    <!-- alertas de error o completo -->
                    <?php if (isset($_SESSION['carrito_add']) && $_SESSION['carrito_add'] == 'complete') : ?>
                        <div class="alert alert-success">
                            Agregado al Carrito
                        </div>
                    <?php elseif (isset($_SESSION['carrito_repit']) && $_SESSION['carrito_repit'] == 'complete') : ?>
                        <div class="alert alert-warning">
                            Libro ya existente en el carrito
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
                                    <th>Stock</th>
                                    <th>Cant</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($lib = $libros->fetch_object()) : ?>
                                    <tr class="">
                                        <td><?= $lib->nombre ?></td>
                                        <td><?= $lib->autor ?></td>
                                        <td><?= $lib->categoria ?></td>
                                        <td><?= $lib->stock ?></td>
                                        <td class="text-center">

                                            <input type="number" name="cantidad" value="1" class="form-control" id="cantLibro">

                                        </td>
                                        <td class="text-center">
                                            <a href="prestamo/add&id=<?= $lib->id ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-check "></i>
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
                                <th>Stock</th>
                                <th>Cant</th>
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