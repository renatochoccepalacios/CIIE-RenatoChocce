<?php

include_once '../../templates/header.php';
include_once __DIR__ . '/../verifyCurso.php';

require_once MODELS_PATH . '/DAL/cursoDAL.php'; // curso a mayuscula
require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");

$idCurso = $_GET['id'];
$dni = $_SESSION['user'];

$cursoDAL = new CursoDAL();

// si el curso aún no termina ni hay notas, no se pueden emitir certificados
if ($cursoDAL->checkEnd($idCurso) == 1) {
    getError('Cod42');
    header("Location: ../../curso/?id=$idCurso");
}

if (!$cursoDAL->checkGrades($idCurso)) {
    getError('Cod51');
    header("Location: ../../curso/?id=$idCurso");
}

$alumnos = $cursoDAL->getApprovedStudents($idCurso);

?>

<main id="certificates" class="curso-admin">
    <script>

        let prevData = "";

        async function fetch2(url) {
            await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                // body: JSON.stringify(data),
            })
                // .then((resp) => resp.json())
                .then((resp) => resp.text())
                .then((data) => {

                    if (data != prevData) {
                        prevData = data;

                        const container = document.querySelector('#certificates');
                        container.innerHTML = data;

                        generateCertificates();
                    }
                    // return;
                    // if (data.done && data.source) {
                    // window.location.href = data.source;
                    // }

                    // if (data.done && !data.source) {
                    // verify();
                    // }
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        call();

        function call() {
            fetch2("data.php?id=<?= $idCurso ?>");
        }

    </script>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const disabled = document.querySelectorAll('.disabled');

        disabled.forEach(btn => {
            const form = btn.parentElement.parentElement;
            form.addEventListener('submit', e => {
                if (e.submitter.classList.contains('disabled')) {
                    e.preventDefault();
                    alert('PRIMERO SE DEBE GENERAR UN CERTIFICADO!!!!!')
                }
            })
        })
    })

</script>

<?php include_once '../../templates/footer.php';