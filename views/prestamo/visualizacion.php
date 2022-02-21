<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Invoice</h4>
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

        <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
            <div class="col-md-12">
                <div class="card card-body printableArea">
                    <h3><b>Prestamo</b> <span class="pull-right">#</span></h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (isset($_SESSION['prestamo']) && $_SESSION['prestamo'] == 'failed') : ?>
                                <div class="alert alert-danger">
                                    Selecciona fecha de inicio y termino para el prestamo.
                                </div>
                            <?php endif; ?>
                            <div class="card">
                                <div class="card-body">
                                    <form action="prestamo/save_prestamo&id=<?= $per->id ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="fechaInicio">Fecha Inicio</label>
                                                <input type="date" name="fechaInicio" class="form-control" id="" value="<?= date('Y-m-d') ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fechaFin">Fecha Fin</label>
                                                <input type="date" name="fechaFin" class="form-control" id="">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="pull-left">
                                            <address>
                                                <h3> &nbsp;<b class="text-danger"><?= $per->nombre . ' ' . $per->apellido ?></b></h3>
                                                <p class="text-muted m-l-5"><?= $per->identificacion ?>,
                                                    <br /> <?= $per->correo ?>
                                                </p>
                                            </address>
                                        </div>
                                        <div class="pull-right text-right">
                                            <address>
                                                <h3>Prestamo hecho por:</h3>
                                                <h4 class="font-bold"><?= $_SESSION['identity']->nombre . ' ' . $_SESSION['identity']->apellido ?>,</h4>
                                                <p class="text-muted m-l-30"><?= $_SESSION['identity']->correo ?>,
                                                    <br /> Nr' Viswakarma Temple,
                                                    <br /> Talaja Road,
                                                    <br /> Bhavnagar - 364002
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
                                                    <?php foreach ($carrito as $indice => $elemento) :
                                                        $libro = $elemento['libro'];
                                                    ?>
                                                        <tr class="">
                                                            <td><?= $libro->nombre ?></td>
                                                            <td><?= $libro->autor ?></td>
                                                            <td><?= $libro->categoria ?></td>
                                                            <td><?= $libro->editorial ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="pull-right m-t-30 text-right">
                                            <hr>
                                            <h3><b>Total :</b> <?= count($_SESSION['carrito']) ?> Libros</h3>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-success" value="Comenzar Prestamo">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php else : ?>
    <h2>No hay carrito</h2>
<?php
        endif;
        Utils::borrar_alertas();
?>

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