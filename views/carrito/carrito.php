<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
                <div class="card-body">
                    <h4 class="card-title">Carrito Prestamo de Libros</h4>
                    <a class="btn btn-danger" href="prestamo/limpiarCarrito"><i class="fas fa-trash"></i> Limpiar</a>
                    <a class="btn btn-primary" href="prestamo/librosPrestamo"><i class="fas fa-book"></i> Seleccionar Libros</a>
                    <a class="btn btn-success" href="prestamo/usuariosPrestamo"><i class="fas fa-users"></i> Sleccionar Usuario</a>
                </div>
                <div class="comment-widgets scrollable">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- funcion para mostrar todas la categorias -->
                                <table id="" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Autor</th>
                                            <th>Categoria</th>
                                            <th>Editorial</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($carrito as $indice => $elemento) :
                                            $libro = $elemento['libro'];
                                        ?>
                                            <tr class="">
                                                <td><?= $libro->nombre ?></td>
                                                <td><?= $libro->autor ?></td>
                                                <td><?= $libro->categoria ?></td>
                                                <td><?= $libro->editorial ?></td>
                                                <td class="text-center">
                                                    <a href="prestamo/quitarLibro&index=<?= $indice ?>" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-window-close "></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <th>Nombre</th>
                                        <th>Autor</th>
                                        <th>Categoria</th>
                                        <th>Editorial</th>
                                        <th>Accion</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <h2>No hay carrito</h2>
            <?php endif; ?>
        </div>
    </div>
</div>