// Almacena los IDs de los cronogramas a eliminar
let cronogramasAEliminar = [];

document.addEventListener("DOMContentLoaded", function () {
  // Agrega un evento click a todos los botones de eliminar
  let botonesEliminar = document.querySelectorAll(".datos button");

  botonesEliminar.forEach(function (boton) {
    boton.addEventListener("click", function () {
      // Obtén el ID del cronograma desde el atributo data-id
      let idCronograma = boton.parentNode.parentNode.dataset.id;

      // Agrega el ID al array de cronogramas a eliminar si no está presente
      if (!cronogramasAEliminar.includes(idCronograma)) {
        cronogramasAEliminar.push(idCronograma);
      }

      // Oculta la fila de la tabla al presionar Eliminar
      boton.parentNode.parentNode.style.display = "none";
    });
  });

  // Maneja el envío del array como JSON al formulario al hacer clic en "Guardar Cambios"
  document.getElementById("guardar").addEventListener("click", function () {
    // Agrega el array como un campo oculto al formulario
    let inputJSON = document.createElement("input");
    inputJSON.type = "hidden";
    inputJSON.name = "eventosJSON";
    inputJSON.value = JSON.stringify(cronogramasAEliminar);
    document.querySelector("form1").appendChild(inputJSON);

    // Envía el formulario
    document.querySelector("form1").submit();
  });
});
