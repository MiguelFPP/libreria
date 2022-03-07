<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <?php if (isset($edit) && isset($lib) && is_object($lib)) : ?>
                <h4 class="page-title">Editar Libro: <?= $lib->nombre ?></h4>
                <?php $url_action = base_url . 'Libro/edit&id=' . $lib->id ?>
            <?php else : ?>
                <h4 class="page-title">Crear Nuevo Libro</h4>
                <?php $url_action = 'Libro/save' ?>
            <?php endif; ?>
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
<?php
$Categorias = Utils::showCategorias();
$autores = Utils::showAutores();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="<?= $url_action ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="hue-demo" class="form-control demo" data-control="hue" value="<?= isset($lib) && is_object($lib) ? $lib->nombre : '' ?>" placeholder="Ingrese el nombre del libro">

                                <?php echo isset($_SESSION['error_datos']) ? Utils::erroresDatos($_SESSION['error_datos'], 'nombre') : '' ?>
                            </div>
                            <div class="form-group col-6">
                                <label for="autor">Autor</label>
                                <select name="autor" class="form-control" id="">
                                    <option value="0">Selccione El Autor</option>
                                    <?php while ($aut = $autores->fetch_object()) : ?>
                                        <option value="<?= $aut->id ?>" <?= isset($lib) && is_object($lib) && $aut->id == $lib->autor_id ? 'selected' : '' ?>><?= $aut->nombre ?></option>
                                    <?php endwhile; ?>
                                </select>

                                <?php echo isset($_SESSION['error_datos']) ? Utils::erroresDatos($_SESSION['error_datos'], 'autor') : '' ?>
                            </div>
                            <div class="form-group col-6">
                                <label for="categoria">Categoria</label>
                                <select name="categoria" class="form-control" id="">
                                    <option value="0">Selccione La Categoria</option>
                                    <?php while ($cat = $Categorias->fetch_object()) : ?>
                                        <option value="<?= $cat->id ?>" <?= isset($lib) && is_object($lib) && $cat->id == $lib->categoria_id ? 'selected' : '' ?>><?= $cat->nombre ?></option>
                                    <?php endwhile; ?>
                                </select>
                                
                                <?= isset($_SESSION['error_datos']) ? Utils::erroresDatos($_SESSION['error_datos'], 'categoria') : '' ?>
                            </div>
                            <div class="form-group col-6">
                                <label for="editorial">Editorial</label>
                                <input type="text" name="editorial" id="hue-demo" class="form-control demo" data-control="hue" value="<?= isset($lib) && is_object($lib) ? $lib->editorial : '' ?>" placeholder="Ingrese el nombre de la editorial">
                                
                                <?php echo isset($_SESSION['error_datos']) ? Utils::erroresDatos($_SESSION['error_datos'], 'editorial') : '' ?>
                            </div>
                            <div class="form-group col-6">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" id="hue-demo" class="form-control demo" data-control="hue" value="<?= isset($lib) && is_object($lib) ? $lib->stock : '' ?>" placeholder="Ingrese el stock inicial">

                                <?php echo isset($_SESSION['error_datos']) ? Utils::erroresDatos($_SESSION['error_datos'], 'stock') : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php Utils::borrar_alertas() ?>