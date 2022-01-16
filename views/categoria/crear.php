<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <?php if (isset($edit) && isset($cat) && is_object($cat)) : ?>
                <h4 class="page-title">Editar Categoria: <?= $cat->nombre ?></h4>
                <?php $url_action = base_url . 'categoria/save&id=' . $cat->id ?>
            <?php else : ?>
                <h4 class="page-title">Crear Nueva Categoria</h4>
                <?php $url_action = 'categoria/save' ?>
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="<?= $url_action ?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="hue-demo" class="form-control demo" data-control="hue" value="<?= isset($cat) && is_object($cat) ? $cat->nombre : '' ?>" placeholder="Ingrese el nombre de la categoria">
                            <?php echo isset($_SESSION['error_datos']) ? Utils::erroresDatos($_SESSION['error_datos'], 'nombre') : '' ?>
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