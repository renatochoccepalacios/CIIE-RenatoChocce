<?php

include('../../app/templates/header.php');

// incluimos directorios
require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");
require_once(MODELS_PATH . "\DAL\cursoDAL.php");

$cursoDAL = new CursoDAL();
$dni = $_SESSION['user'];

// traer los datos del usuario
$usuarioDAL = new UsuarioDAL();
$data = $usuarioDAL->getPerId($dni);

// traer cursos
$cursos = $cursoDAL->getPerDni($dni);
?>

<!-- google fonts -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24
    }
</style>

<main id="profile">
    <section class="row-1">
        <div class="col-1">

            <!-- imagen de perfil -->
            <div class="image">

                <!-- inicial del nombre -->
                <span>
                    <?= substr($data->getNombre(), 0, 1); ?>
                </span>
            </div>

            <div class="name">
                <!-- nombre, apellido y tipo de cuenta -->
                <div class="row-1">
                    <?= $data->getNombre() . " " . $data->getApellido() ?>
                </div>
                <div class="row-2">
                    <?= $data->getTipoCuenta() ?>
                </div>

            </div>
        </div>

        <div class="col-2">

            <!-- editar -->
            <a href="edit/index.php">
                <span class="material-symbols-outlined">
                    edit
                </span>
            </a>

        </div>
    </section>

    <section class="row-2">
        <article>
            <div class="row-1">
                <h2>Cursos</h2>
            </div>
            <!-- cursos -->
            <div id="cursos"></div>
            <div id="navigation"></div>
        </article>

        <aside>
            <div class="row-1">
                <h2>Datos personales</h2>
            </div>

            <div class="row-2">

                <div class="data">
                    <h6>DNI</h6>
                    <span>
                        <?= $data->getDNI() ?>
                    </span>
                </div>

                <div class="data">
                    <h6>Correo</h6>
                    <span>
                        <?= $data->getCorreo() ?>
                    </span>
                </div>

                <div class="data">
                    <h6>Telefono</h6>
                    <span>
                        <?= $data->getTelefono() ?>
                    </span>
                </div>

                <?php

                if ($data->getTipoCuenta() != 'Admin' && $data->getTipoCuenta() != 'ETR') {
                    ?>

                    <div class="data" id="niveles">
                        <h6>Niveles</h6>
                        <?php
                        foreach ($data->getNiveles() as $nivel):
                            ?>
                            <span>
                                <?= $nivel->getNivel() ?>
                            </span>
                            <?php
                        endforeach;
                        ?>
                    </div>

                    <div class="data" id="areas">
                        <h6>Áreas</h6>
                        <?php
                        foreach ($data->getAreas() as $area):
                            ?>
                            <span>
                                <?= $area->getArea() ?>
                            </span>
                            <?php
                        endforeach;
                        ?>
                    </div>

                <?php } ?>
            </div>

        </aside>
    </section>

</main>


<style>
    button.paginationBtn {
        padding: 8px 24px;
        cursor: pointer;
        transition: .35s all;
        border-radius: 10px;
        background-color: white;
        color: blue;
        border: none;
        transition: .35s all
    }

    button.selected {
        color: white;
        background-color: blue;
        transition: .35s all
    }
</style>

<script src="../../app/features/getCourses.js"></script>
<?php include APP_PATH . '/templates/footer.php';