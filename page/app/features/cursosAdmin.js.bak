function check() {
    setGrades();
    generateCertificates();
    setAttendance();
    // exportSheet();
}

async function setGrades() {
    // funcion para poner calificaciones
    const form = document.querySelector("#calificaciones form");

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            e.submitter.disabled = true;
            e.submitter.style.background = "gray";
            e.submitter.style.cursor = "not-allowed";

            const input = document.querySelectorAll(
                "#calificaciones input:checked"
            );

            let data = [];

            input.forEach(({ name, value }) => {
                obj = { dni: name, calificacion: value };
                data = [...data, obj];
            });

            fetchData(
                `/SuperCIIE/page/admin/curso/calificaciones/validarCalificacion.php?id=${idCurso}&from=js`,
                data
            );
        });
    }
}

async function generateCertificates() {
    // funcion para generar certificados
    const form = document.querySelectorAll("#certificates form");

    if (form[0]) {
        let data = [];

        form.forEach((form) => {
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                data = [];

                switch (e.submitter.value) {
                    case "generateAll":
                        const action = { action: e.submitter.value };
                        data = [...data, action];

                        const dniArr =
                            document.querySelectorAll("input[name='dni']");

                        dniArr.forEach((dni) => {
                            const obj = { dni: dni.value };
                            data = [...data, obj];
                        });

                        break;

                    case "generate":
                    case "retirar":
                        if (e.submitter.classList.contains("disabled")) {
                            setCookie("ERROR", "Cod50", 1);
                            verify();
                            return;
                        }

                        const dni = e.target.querySelector("input[name='dni']");

                        const obj = {
                            action: e.submitter.value,
                            dni: dni.value,
                        };

                        data = [...data, obj];
                        break;

                    default:
                        break;
                }

                fetchData(
                    `/SuperCIIE/page/admin/curso/certificados/validarCertificado.php?id=${idCurso}`,
                    data
                );

                call();
                verify();
            });
        });
    }
}

async function setAttendance() {
    //! @todo funcion para registrar presentismo
    const form = document.querySelector("#attendance form");

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            // e.submitter.disabled = true;
            // e.submitter.style.background = "gray";
            // e.submitter.style.cursor = "not-allowed";

            const checkboxes = form.querySelectorAll("input[type='checkbox']");
            let data = [];

            checkboxes.forEach(({ value, checked }) => {
                const obj = {
                    dni: value,
                    estado: checked ? "Presente" : "Ausente",
                };

                data = [...data, obj];
            });

            fetchData(
                `/SuperCIIE/page/admin/curso/presentismo/validarPresentismo.php?id=${idCurso}&from=js`,
                data
            );
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    check();

    const nomina = document.querySelector("#nomina");

    if (nomina) {
        nomina.addEventListener("click", () => {
            setTimeout(() => {
                verify();
            }, 1500);
        });
    }
});

async function fetchData(url, data) {
    await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((resp) => resp.json())
        // .then((resp) => resp.text())
        .then((data) => {
            // console.log(data);
            // return;
            if (data.done && data.source) {
                window.location.href = data.source;
            }

            if (data.done && !data.source && !data.info) {
                verify();
            }

            if (!data.done && data.info) {
                setDataCookie(data.info);
            }
        })
        .catch((error) => {
            console.error(error);
        });
}
