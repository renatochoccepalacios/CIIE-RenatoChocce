const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.querySelector("#progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

const inputName = document.querySelector("input#name");
const inputSurname = document.querySelector("input#surname");
const inputDni = document.querySelector("input#dni");
const inputMail = document.querySelector("input#mail");
const inputPhone = document.querySelector("input#phone");
const inputPassword = document.querySelector("input#password");
const inputConfirmPassword = document.querySelector("input#confirmPassword");

function validateInput({ name, value }) {
    let regName =
        /^[a-zA-Z._-\s{1}\u00C6\u00D0\u018E\u018F\u0190\u0194\u0132\u014A\u0152\u1E9E\u00DE\u01F7\u021C\u00E6\u00F0\u01DD\u0259\u025B\u0263\u0133\u014B\u0153\u0138\u017F\u00DF\u00FE\u01BF\u021D\u0104\u0181\u00C7\u0110\u018A\u0118\u0126\u012E\u0198\u0141\u00D8\u01A0\u015E\u0218\u0162\u021A\u0166\u0172\u01AFY\u0328\u01B3\u0105\u0253\u00E7\u0111\u0257\u0119\u0127\u012F\u0199\u0142\u00F8\u01A1\u015F\u0219\u0163\u021B\u0167\u0173\u01B0y\u0328\u01B4\u00C1\u00C0\u00C2\u00C4\u01CD\u0102\u0100\u00C3\u00C5\u01FA\u0104\u00C6\u01FC\u01E2\u0181\u0106\u010A\u0108\u010C\u00C7\u010E\u1E0C\u0110\u018A\u00D0\u00C9\u00C8\u0116\u00CA\u00CB\u011A\u0114\u0112\u0118\u1EB8\u018E\u018F\u0190\u0120\u011C\u01E6\u011E\u0122\u0194\u00E1\u00E0\u00E2\u00E4\u01CE\u0103\u0101\u00E3\u00E5\u01FB\u0105\u00E6\u01FD\u01E3\u0253\u0107\u010B\u0109\u010D\u00E7\u010F\u1E0D\u0111\u0257\u00F0\u00E9\u00E8\u0117\u00EA\u00EB\u011B\u0115\u0113\u0119\u1EB9\u01DD\u0259\u025B\u0121\u011D\u01E7\u011F\u0123\u0263\u0124\u1E24\u0126I\u00CD\u00CC\u0130\u00CE\u00CF\u01CF\u012C\u012A\u0128\u012E\u1ECA\u0132\u0134\u0136\u0198\u0139\u013B\u0141\u013D\u013F\u02BCN\u0143N\u0308\u0147\u00D1\u0145\u014A\u00D3\u00D2\u00D4\u00D6\u01D1\u014E\u014C\u00D5\u0150\u1ECC\u00D8\u01FE\u01A0\u0152\u0125\u1E25\u0127\u0131\u00ED\u00ECi\u00EE\u00EF\u01D0\u012D\u012B\u0129\u012F\u1ECB\u0133\u0135\u0137\u0199\u0138\u013A\u013C\u0142\u013E\u0140\u0149\u0144n\u0308\u0148\u00F1\u0146\u014B\u00F3\u00F2\u00F4\u00F6\u01D2\u014F\u014D\u00F5\u0151\u1ECD\u00F8\u01FF\u01A1\u0153\u0154\u0158\u0156\u015A\u015C\u0160\u015E\u0218\u1E62\u1E9E\u0164\u0162\u1E6C\u0166\u00DE\u00DA\u00D9\u00DB\u00DC\u01D3\u016C\u016A\u0168\u0170\u016E\u0172\u1EE4\u01AF\u1E82\u1E80\u0174\u1E84\u01F7\u00DD\u1EF2\u0176\u0178\u0232\u1EF8\u01B3\u0179\u017B\u017D\u1E92\u0155\u0159\u0157\u017F\u015B\u015D\u0161\u015F\u0219\u1E63\u00DF\u0165\u0163\u1E6D\u0167\u00FE\u00FA\u00F9\u00FB\u00FC\u01D4\u016D\u016B\u0169\u0171\u016F\u0173\u1EE5\u01B0\u1E83\u1E81\u0175\u1E85\u01BF\u00FD\u1EF3\u0177\u00FF\u0233\u1EF9\u01B4\u017A\u017C\u017E\u1E93]+$/;

    if (value != "" && !regName.test(value)) {
        generateError("Debe introducir caracteres válidos.", name);
        return 0;
    }

    return 1;
}

nextBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        document.querySelector("#final-response-screen").innerHTML = "";

        cleanErrors();

        let error;

        switch (formStepsNum) {
            case 0:
                inputName.style.borderColor = "#EFF1F8";
                inputSurname.style.borderColor = "#EFF1F8";

                if (inputName.value == "") {
                    error = true;
                    generateError(
                        "Debe completar este campo.",
                        `${inputName.name}`
                    );
                }

                if (validateInput(inputName) == 0) {
                    error = true;
                }

                if (inputSurname.value == "") {
                    error = true;
                    generateError(
                        "Debe completar este campo.",
                        `${inputSurname.name}`
                    );
                }

                if (validateInput(inputSurname) == 0) {
                    error = true;
                }

                if (verifyDni() != 0) {
                    error = true;
                } else {
                    inputDni.style.borderColor = "#EFF1F8";

                    if (isNaN(inputDni.value)) {
                        error = true;
                        generateError(
                            "Sólo puede ingresar caracteres válidos.",
                            `${inputDni.name}`
                        );
                    }
                }

                if (error) return;
                break;

            case 1:
                const phone = document.querySelector("input#phone").value;

                if (phone == "") {
                    error = true;
                    generateError("Debe completar este campo.", "phone");
                } else {
                    inputPhone.style.borderColor = "#EFF1F8";
                }

                if (verifyMail() != 0) {
                    error = true;
                } else {
                    inputMail.style.borderColor = "#EFF1F8";
                }

                if (error) return;
                break;

            case 2:
                if (!validatePassword(inputPassword.value)) {
                    error = true;
                } else {
                    inputPassword.style.borderColor = "#EFF1F8";
                }

                if (inputPassword.value != inputConfirmPassword.value) {
                    error = true;
                    generateError(
                        "Las contraseñas no coinciden.",
                        "confirmPassword"
                    );
                } else {
                    inputConfirmPassword.style.borderColor = "#EFF1F8";
                }

                if (error) return;

            default:
                break;
        }

        formStepsNum++;
        updateFormSteps();
        updateProgressBar();

        if (formStepsNum == 5) {
            generateFinalScreen();
        }
    });
});

prevBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        document.querySelector("#final-response-screen").innerHTML = "";

        formStepsNum--;
        updateFormSteps();
        updateProgressBar();
    });
});

function cleanErrors() {
    const error = document.querySelectorAll(".form-step .error");

    if (error) {
        error.forEach((e) => {
            e.remove();
        });
    }
}

function updateFormSteps() {
    formSteps.forEach((formStep) => {
        formStep.classList.contains("form-step-active") &&
            formStep.classList.remove("form-step-active");
    });

    formSteps[formStepsNum].classList.add("form-step-active");

    /*     setTimeout(() => {
        formSteps[formStepsNum].classList.add("form-step-active");
    }, 1500); */
}

function updateProgressBar() {
    progressSteps.forEach((progressStep, idx) => {
        if (idx < formStepsNum + 1) {
            progressStep.classList.add("progress-step-active");
        } else {
            progressStep.classList.remove("progress-step-active");
        }
    });

    const progressActive = document.querySelectorAll(".progress-step-active");
    progress.style.width =
        ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

function generateFinalScreen() {
    const finalScreen = document.querySelector(".final-screen");
    cleanHTML(finalScreen);

    const name = document.querySelector("input#name").value;
    const surname = document.querySelector("input#surname").value;
    const dni = document.querySelector("input#dni").value;
    const mail = document.querySelector("input#mail").value;
    const phone = document.querySelector("input#phone").value;

    const niveles = [];
    document.querySelectorAll('input[name="niveles"]').forEach((checkbox) => {
        if (checkbox.checked) {
            niveles.push(
                checkbox.parentElement.childNodes[3].childNodes[3].textContent
            );
        }
    });

    const areas = [];
    document.querySelectorAll('input[name="areas"').forEach((checkbox) => {
        if (checkbox.checked) {
            areas.push(
                checkbox.parentElement.childNodes[
                    checkbox.parentElement.childNodes.length - 2
                ].textContent
            );
        }
    });

    const userData = {
        Nombre: name,
        Apellido: surname,
        DNI: dni,
        Correo: mail,
        Teléfono: phone,
        Niveles: niveles,
        Áreas: areas,
    };

    const mainDiv = document.createElement("div");

    for (let data in userData) {
        const div = document.createElement("div");

        console.log(data == "Niveles" || data == "Áreas");
        if (data == "Niveles" || data == "Áreas") {
            div.innerHTML = `<p class="subtitle">${data}</p>`;

            userData[data].forEach((elem) => {
                console.log(elem);
                const p = document.createElement("p");
                p.innerHTML = elem;
                p.classList.add("value");

                div.appendChild(p);
            });
        } else {
            div.innerHTML = `
            <p class="subtitle">${data}</p>
            <p class="value">${userData[data]}</p>
            `;
        }

        div.classList.add("user-data");
        mainDiv.appendChild(div);
    }

    finalScreen.appendChild(mainDiv);
}

function cleanHTML(e) {
    e.innerHTML = "";
}

const form = document.querySelector("form");

form.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
        e.preventDefault();
        return;
    }
});

function verifyDni() {
    const dni = document.querySelector("input#dni").value;
    let resp;

    $.ajax({
        method: "post",
        async: false,
        url: "checkDni.php",
        data: {
            dni: dni,
        },

        success: function (response) {
            console.log(response + "r");
            if (response != 0) {
                // prevBtns[formStepsNum].click();
                generateError(response, "dni");
            } else {
                resp = 1;
            }
        },

        complete: function ({ responseText }) {
            resp = responseText;
        },
    });

    return resp;
}

const verifyMail = () => {
    const mail = document.querySelector("input#mail").value;
    let resp;

    $.ajax({
        method: "post",
        async: false,
        url: "checkMail.php",
        data: {
            mail: mail,
        },

        success: function (response) {
            console.log(response + "r");
            if (response != 0) {
                // prevBtns[formStepsNum].click();
                generateError(response, "mail");
            } else {
                resp = 1;
            }
        },

        complete: function ({ responseText }) {
            resp = responseText;
        },
    });

    return resp;
};

function consultaTiempoReal() {
    const name = document.querySelector("input#name").value;
    const surname = document.querySelector("input#surname").value;
    const dni = document.querySelector("input#dni").value;
    const mail = document.querySelector("input#mail").value;
    const phone = document.querySelector("input#phone").value;
    const password = document.querySelector("input#password").value;

    const niveles = [];
    document.querySelectorAll('input[name="niveles"]').forEach((checkbox) => {
        if (checkbox.checked) {
            niveles.push(parseInt(checkbox.value));
        }
    });

    const nivelesJSON = JSON.stringify(niveles);

    const areas = [];
    document.querySelectorAll('input[name="areas"').forEach((checkbox) => {
        if (checkbox.checked) {
            areas.push(parseInt(checkbox.value));
        }
    });

    const areasJSON = JSON.stringify(areas);

    $.ajax({
        method: "post",
        url: "test.php",
        data: {
            name: name,
            surname: surname,
            dni: dni,
            mail: mail,
            phone: phone,
            password: password,
            niveles: nivelesJSON,
            areas: areasJSON,
        },

        success: function (response) {
            console.log(response);
            if (response == 1) {
                document.querySelector(".form-step-active h1").innerHTML =
                    "¡Felicidades!";
                document.querySelector("#final-response-screen").innerHTML = `
                <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.0//EN'  'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'><svg height="80" style="overflow:visible;enable-background:new 0 0 32 32" viewBox="0 0 32 32" width="80" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g id="Complete_x5F_Symbol_1_"><g id="Complete_x5F_Symbol"><circle cx="16" cy="16" id="BG" r="16" style="fill:#19D873;"/><polygon id="Done_x5F_Symbol" points="14,17.9 14,17.9 14,17.9 10.1,14 8,16.1         14,22.1 24,12.1 21.9,10 " style="fill:#FFFFFF;"/></g></g></g></svg>
                <p style="margin: 30px auto 10px auto; font-weight: normal">La cuenta fue creada exitosamente.</p>
                <p style="margin-top:0; font-weight: 700">Redirigiendo</p>`;

                document.querySelector(".form-step-active .actions").remove();

                setTimeout(() => {
                    window.location.href = "/SuperCIIE/page/public/test.php";
                }, 1500);
                return;
            }

            document.querySelector(".form-step-active h1").innerHTML =
                "Ha habido un error";
            document.querySelector("#final-response-screen").innerHTML =
                response;
        },
    });

    /* let tabla = $.ajax({
        url: "test.php",
        dataType: "text",
        async: false,
    }).responseText; */

    /* document.querySelector("#test-final-screen").innerHTML = tabla; */
}

const generateError = (error, name) => {
    const div = document.createElement("div");
    div.classList.add("error");

    div.innerHTML = `
    <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.0//EN'  'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'><svg height="18" style="overflow:visible;enable-background:new 0 0 32 32" viewBox="0 0 32 32" width="32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g id="Error_1_"><g id="Error"><circle cx="16" cy="16" id="BG" r="16" style="fill:#D72828;"/><path d="M14.5,25h3v-3h-3V25z M14.5,6v13h3V6H14.5z" id="Exclamatory_x5F_Sign" style="fill:#E6E6E6;"/></g></g></g></svg>
    <p>${error}</p>`;

    let input;

    input = document.querySelector(`.input-group input[name='${name}']`);
    input.parentElement.appendChild(div);

    input.style.borderColor = `#D72828`;
};

function validateEmail(email) {
    // Define our regular expression.
    let validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    // Using test we can check if the text match the pattern
    if (validEmail.test(email)) {
        console.log("Email is valid, continue with form submission");
        return true;
    } else {
        console.log("Email is invalid, skip form submission");
        return false;
    }
}

function validatePassword(password) {
    // al menos 8 caracteres
    if (password.length < 8) {
        generateError(
            "La contraseña debe tener al menos 8 caracteres",
            "password"
        );
        return false;
    }

    // al menos una mayuscula
    if (!/[A-Z]/.test(password)) {
        generateError(
            "La contraseña debe contener al menos una mayúscula.",
            "password"
        );
        return false;
    }

    // al menos una minuscula
    if (!/[a-z]/.test(password)) {
        generateError(
            "La contraseña debe contener al menos una minúscula.",
            "password"
        );
        return false;
    }

    // al menos un numero
    if (!/[0-9]/.test(password)) {
        generateError(
            "La contraseña debe contener al menos un número",
            "password"
        );
        return false;
    }

    // al menos un simbolo
    if (!/[!@#$%^&*()_+={}\[\]:;"\\|<>,.?/]+/.test(password)) {
        generateError(
            "La contraseña debe contener al menos un símbolo.",
            "password"
        );
        return false;
    }

    // paso las pruebas !
    return 1;
}

function handleLevel(e, span) {
    setTimeout(() => {
        if (e) span.textContent = "check_box";
        else span.textContent = "check_box_outline_blank";
    }, 100);
}

const levels = document.querySelectorAll("#niveles input[type='checkbox']");

levels.forEach((level) => {
    level.addEventListener("change", (e) => {
        const span = e.target.parentElement.childNodes[3].childNodes[1];
        handleLevel(e.target.checked, span);
    });
});

function checkPassword(pass1, pass2) {}
