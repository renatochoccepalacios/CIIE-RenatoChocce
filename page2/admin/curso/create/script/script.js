document.addEventListener("DOMContentLoaded", function() {
    const botonAgregarClase = document.getElementById("agregarClase");
    const cronogramaContainer = document.getElementById("cronograma-container");
   // let contadorClases = 2;

    botonAgregarClase.addEventListener("click", function() {
        const nuevaClase = cronogramaContainer.querySelector(".clase").cloneNode(true);
       // const tituloClase = document.createElement("h4");
       // tituloClase.textContent = "Clase " + contadorClases;
        nuevaClase.insertBefore(tituloClase, nuevaClase.firstChild);
        cronogramaContainer.appendChild(nuevaClase);
        //contadorClases++;
    });
    });
