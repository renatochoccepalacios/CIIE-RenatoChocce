<?php

require_once '../../../app/vendor/autoload.php';

use Dompdf\Dompdf;

function generateCertificate($idCurso, $dniAlumno, $idCertificado)
{
    $cursoDAL = new CursoDAL();
    $usuarioDAL = new UsuarioDAL();

    $alumno = $usuarioDAL->getPerId($dniAlumno);
    $curso = $cursoDAL->getCursoPorId($idCurso);

    $fechaEmision = $cursoDAL->getDateCertificateIssuance($idCertificado);

    $nombreAlumno = $alumno->getNombre();
    $apellidoAlumno = $alumno->getApellido();
    $dniAlumno = $alumno->getDni();

    $cursoNombre = $curso->getNombreCurso();
    $cargaHoraria = $curso->getCargaHoraria();
    $fechaInicio = $curso->getFechaInicio();
    $fechaFin = $curso->getFechaFinal();
    $resolucion = $curso->getResolucion();
    $dictamen = $curso->getDictamen();
    $nroProyecto = $curso->getNroProyecto();
    $ubicacion = $curso->getDireccion();

    // empezamos a "recolectar" la informacion html que venga
    ob_start();
    mb_internal_encoding('UTF-8');
    ?>

    <style>
        .text {
            font-style: normal;
            /* font-family: "Time"; */
            border: 4px solid gray;
            padding: 40px 80px 20px 80px;
            font-size: 22px;
        }

        p {
            margin: 0;
            margin: 20px 0;
            font-size: 22px;
            /* text-align: center; */
        }

        .name,
        .dni,
        .course {
            font-size: 30px;
        }

        .text p:first-child {
            margin-top: 0
        }

        .right {
            text-align: right
        }
    </style>

    <div class="container">
        <div class="text">

            <p>
                Certifico que
                <strong class="name">
                    <?= strtoupper("$apellidoAlumno, $nombreAlumno") ?>
                </strong>
            </p>

            <p>DNI: <strong class="dni" style="letter-spacing:1px"><?= "46 087 782" ?></strong>, ha asistido y aprobó el curso:</p>

            <p><strong class="course">
                    <?= '"' . $cursoNombre . '"' ?>
                </strong></p>
                <p>con una carga horaria de <strong><?= $cargaHoraria ?></strong> reloj, desde el <strong><?= $fechaInicio ?></strong> hasta el <strong><?= $fechaFin ?></strong> con la correspondiente evaluación final.

            </p>

            <p class="right" style="margin-top:50px;font-size:20px">
                <strong>
                    <i>
                        Aprobado por Resolución N°
                        <?= $resolucion ?>, Dictamen N°
                        <?= $dictamen ?>, Proy. N°
                        <?= $nroProyecto ?>
                    </i>
                </strong>
            </p>

            <p class="right" style="margin-top:20px;margin-bottom:120px;font-size:18px">
                <i>
                    <?= "$ubicacion, $fechaEmision" ?>
                </i>
            </p>

            <div style="width:100%;text-align:center">

                <div style="margin-right:72px;display:inline-block;width:24%;">
                    <div style="width:100%;border-bottom:1px solid black"></div>
                    <p style="margin-top:15px;font-size:16px">formador</p>
                </div>

                <div style="margin-left:72px;display:inline-block;width:24%;">
                    <div style="width:100%;border-bottom:1px solid black"></div>
                    <p style="margin-top:15px;font-size:16px">Director/a de CIIE</p>
                </div>
            </div>
        </div>
    </div>
    <div class="image" style="text-align:right;margin:30px 30px 0 auto;width:50%;object-fit:cover;">
        <img style="width:100%;height:auto"
            src="data:image/jpeg;base64,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"
            alt="" srcset="">
    </div>
    </div>

    <?php
    // exit();
    // dejamos de "recolectar" la informacion y almacenamos lo obtenido
    $html = ob_get_clean();

    // instanciamos la clase dompdf
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    // seteamos varias opciones (ver documentacion)
    $options->set(array('isRemoteEnabled' => false));

    // print_r($options->getRootDir());

    // seteamos la fuente
    $options->setDefaultFont('Helvetica');

    // establecemos las opciones que estuvimos modificando
    $dompdf->setOptions($options);

    // insertamos el html generado en el pdf
    $dompdf->loadHtml($html);

    // seteamos el tipo de papel con el que queremos trabajar y su orientacion
    $dompdf->setPaper('A4', 'landscape');

    // renderizamos el documento
    $dompdf->render();

    // lo generamos como para descargar y con el attachment false
    // lo abre en chrome en lugar de descargarlo
    $dompdf->stream("test.pdf", array("Attachment" => false));

    exit();

    // almacenamos el documento como archivo
    $output = $dompdf->output();

    // definimos el nombre de la carpeta
    $folder = ADMIN_PATH . "/curso/certificados/certificados/" . str_replace(' ', '_', strtolower($curso->getIdCurso() . " " . $curso->getNombreCurso()));

    // creamos la carpeta del curso si es que no existe
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    // definimos el nombre del archivo
    $filename = $alumno->getDni() . '.pdf';

    // guardamos el archivo en donde se nos cante con el nombre que queramos
    file_put_contents($folder . "/" . $filename, $output);
}