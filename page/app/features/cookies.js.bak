// const { REFUSED } = require("dns");

console.log(document.cookie);
document.addEventListener("DOMContentLoaded", verify());

function verifyCookie(name) {
    name += "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0 && name.length != c.length) {
            return true;
        }
    }
    return false;
}

function getCookie(name) {
    name += "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(name, cvalue, exdays) {
    var d = new Date();

    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();

    document.cookie = name + "=" + cvalue + ";" + expires + ";path=/";
}

function deleteCookie(name) {
    setCookie(name, "", -1);
}

function verify() {
    if (verifyInfo() === 1) {
        return;
    } else {
        verifyErrors();
    }
}

function setDataCookie(msg) {
    generateAlert("data", msg);
}

function verifyErrors() {
    if (verifyCookie("ERROR")) {
        // debugger;
        const errCode = getCookie("ERROR");
        deleteCookie("ERROR");

        fetch("/SuperCIIE/page/app/errors/errors.json")
            .then((Response) => Response.json())
            .then(({ errors }) => {
                generateAlert("error", errors[errCode]);
            })
            .catch((error) => {
                console.log(error);
            });

        return 1;
    }

    return 0;
}

function verifyInfo() {
    if (verifyCookie("INFO")) {
        const infoCode = getCookie("INFO");
        deleteCookie("INFO");

        fetch("/SuperCIIE/page/app/messages/messages.json")
            .then((Response) => Response.json())
            .then(({ messages }) => {
                generateAlert("info", messages[infoCode]);
            })
            .catch((error) => {
                console.log(error);
            });

        return 1;
    }
    return 0;
}

function generateAlert(type, msg) {
    // contenedor del grupo de mensajes de error
    const alerts = document.querySelector("#alerts");

    // icono
    const icon = document.createElement("div");
    icon.classList.add("icon");

    if (type == "error") {
        icon.innerHTML = `<span style="font-size: 30px" class="material-symbols-outlined">error</span>`;
    } else if (type == "info") {
        icon.innerHTML = `<span style="font-size: 30px" class="material-symbols-outlined">done</span>`;
    } else {
        icon.innerHTML = `<span style="font-size: 30px" class="material-symbols-outlined">info</span>`;
    }

    // contenedor del mensaje individual
    const container = document.createElement("div");
    container.classList.add(type, "message-container");

    // boton para cerrar
    const button = document.createElement("div");
    button.innerHTML = `<span style="font-size:12px;color:#444" class="material-symbols-outlined">close</span>`;
    button.classList.add("close-button");

    button.addEventListener("click", () => {
        container.style.translate = "50vw";
        container.style.filter = "opacity(0)";

        setTimeout(() => {
            container.remove();
        }, 100);
    });

    container.appendChild(button);

    // mensaje del cartel
    const message = document.createElement("div");
    message.classList.add("message");

    message.innerHTML = msg;
    container.appendChild(icon);
    container.appendChild(message);
    alerts.appendChild(container);

    setTimeout(() => {
        container.style.translate = "0";
    }, 100);

    setTimeout(() => {
        container.style.translate = "50vw";
        container.style.opacity = "0";
    }, 3000);

    setTimeout(() => {
        container.remove();
    }, 3100);
}
