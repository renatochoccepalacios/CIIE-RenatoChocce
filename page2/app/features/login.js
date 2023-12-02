const form = document.querySelector("form");

form.addEventListener("submit", (e) => {
    e.preventDefault();

    const dni = document.querySelector("input#dni").value;
    const password = document.querySelector("input#password").value;
    loginCall(dni, password);
});

const loginCall = async (dni, password) => {
    await fetch("../../public/login/validarLogin.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ dni: dni, password: password }),
    })
        .then((resp) => resp.json())
        .then((data) => {
            if (data.login) {
                setTimeout(() => {
                    window.location.href = data.source;
                }, 500);
            } else {
                verify();
            }
        })
        .catch((error) => {
            console.error(error);
        });
};
