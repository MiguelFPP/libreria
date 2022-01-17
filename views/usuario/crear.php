<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <?php if (isset($edit) && isset($cat) && is_object($cat)) : ?>
                <h4 class="page-title">Editar Categoria: <?= $cat->nombre ?></h4>
                <?php $url_action = base_url . 'categoria/save&id=' . $cat->id ?>
            <?php else : ?>
                <h4 class="page-title">Crear Nuevo Usuario</h4>
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
                <form action="usuario/save" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="identificacion">Identificacion</label>
                                <input type="number" name="identificacion" id="hue-demo" class="form-control demo" data-control="hue" value="" placeholder="Ingrese la identificacion">
                            </div>
                            <div class="form-group col-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="hue-demo" class="form-control demo" data-control="hue" value="" placeholder="Ingrese el nombre">
                            </div>
                            <div class="form-group col-6">
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" id="hue-demo" class="form-control demo" data-control="hue" value="" placeholder="Ingrese el apellido">
                            </div>
                            <div class="form-group col-6">
                                <label for="correo">Correo</label>
                                <input type="email" name="correo" id="hue-demo" class="form-control demo" data-control="hue" value="" placeholder="Ingrese el correo">
                            </div>
                            <div class="form-group col-6">
                                <label for="rol">Rol</label>
                                <select name="rol" class="form-control" id="">
                                    <option value="0">Selccione Rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="secret">Secretari@</option>
                                    <option value="client">Usuario</option>
                                </select>
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