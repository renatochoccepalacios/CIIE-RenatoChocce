/* RENATO */
const corazones = document.querySelectorAll('.corazon-item');
corazones.forEach((corazon,index) => {
    // definimos una clave unica para cada corazon en localStorage
    const storageKey = `corazon-${index}`;

    // obtenemos el estado del corazón del localStorage si existe
    const corazonState = localStorage.getItem(storageKey);

    // si existe un estado previo en localStorage establece el color correspondiente
    if (corazonState) {
        corazon.style.color = corazonState;
    }

    corazon.addEventListener("click", () => {
        corazon.style.color = corazon.style.color === "rgb(218, 37, 37)" ? "#000" : "#da2525";
        // guardamos el estado del color del corazon en localStorage
        localStorage.setItem(storageKey, corazon.style.color);
    });
});

function redireccionar() {
    window.location.href = "/index.php";
  }
  