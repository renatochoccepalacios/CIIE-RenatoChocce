<?php

include_once '../../../app/templates/header.php';

require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");
require_once(MODELS_PATH . "\DAL\CursoDAL.php");
require_once(MODELS_PATH . "\DAL\AreaDAL.php");
require_once(MODELS_PATH . "\DAL/nivelDAL.php");

$cursoDAL = new CursoDAL();
$dni = $_SESSION['user'];

// traer los datos del usuario
$usuarioDAL = new UsuarioDAL();
$data = $usuarioDAL->getPerId($dni);

$areaDAL = new AreaDAL();
$areas = $areaDAL->getAreas();

$nivelDAL = new NivelDAL();
$niveles = $nivelDAL->getNivel(); ?>

<main>

    <h1>Editar Datos</h1>

    <form action="validateEdit.php" method="post">

        <!-- datos personales -->
        <section class="top">
            <h2>Datos personales</h2>

            <div class="left">


                <label>
                    <span>Nombre</span>
                    <input type="text" name="name" id="name" value="<?= $data->getNombre() ?>" required>
                </label>

                <label>
                    <span>DNI</span>
                    <input type="text" name="dni" id="dni" value="<?= $data->getDni() ?>" required>
                </label>

                <label>
                    <span>Teléfono</span>
                    <input type="tel" name="telefono" id="telefono" value="<?= $data->getTelefono() ?>" required>
                </label>

            </div>

            <div class="right">
                <label>
                    <span>Apellido</span>
                    <input type="text" name="apellido" id="apellido" value="<?= $data->getApellido() ?>" required>
                </label>

                <label>
                    <span>Correo</span>
                    <input type="mail" name="mail" id="mail" value="<?= $data->getCorreo() ?>" required>
                </label>
            </div>
        </section>

        <?php
        if ($data->getTipoCuenta() != 'Admin' && $data->getTipoCuenta() != 'ETR') {
            ?>

            <!-- niveles y areas (solo cursantes) -->
            <section class="bottom">

                <h2>Niveles y áreas</h2>

                <!-- niveles -->
                <div class="left">
                    <h4>Niveles</h4>

                    <div id="niveles">
                        <?php foreach ($niveles as $nivel): ?>
                            <label>
                                <input type="checkbox" name="niveles[]" value="<?= $nivel->getId() ?>">
                                <span>
                                    <?= $nivel->getNivel() ?>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- areas -->
                    <div class="right">
                        <h4>Áreas</h4>

                        <div id="areas">
                            <?php foreach ($areas as $area): ?>
                                <label>
                                    <input type="checkbox" name="areas[]" value="<?= $area->getId() ?>">
                                    <span>
                                        <?= $area->getArea() ?>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
            </section>

        <?php } ?>

        <button type="submit" name="accion" value="update">Validar</button>
    </form>

    <?php

    if ($data->getTipoCuenta() != 'Admin' && $data->getTipoCuenta() != 'ETR') { ?>
        <script src="..\..\..\app\features\fillCheckboxes.js"></script>
    <?php } ?>

</main>