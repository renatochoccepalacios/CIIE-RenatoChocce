const eventos = []; // Declarar un array para almacenar los eventos

document.addEventListener('DOMContentLoaded', function() {
    const listaEventos = document.querySelector('#lista-eventos');

    // Event listeners
    eventlisteners();

    function eventlisteners() {
        // Cuando el usuario agrega un nuevo evento
        const botonAgregarCronograma = document.querySelector('#agregar-cronograma');
        botonAgregarCronograma.addEventListener('click', agregarEvento);

        // Cuando el documento está listo
        document.addEventListener('DOMContentLoaded', () => {
            crearHTML();
            JSONificar();
        });
    }

    // Funciones
    function configurarFechasCronograma() {
        // Obtenemos las referencias a los elementos de fecha
        const fechaInicioInput = document.getElementById("fechaInicio");
        const fechaFinalInput = document.getElementById("fechaFinal");
        const fechaInput = document.getElementById("fecha");
      
        // Agregamos un evento change a fechaInicioInput para actualizar fechaInput
        fechaInicioInput.addEventListener("change", function () {
          fechaInput.min = fechaInicioInput.value; // Establecemos el valor mínimo
        });
      
        // Agregamos un evento change a fechaFinalInput para actualizar fechaInput
        fechaFinalInput.addEventListener("change", function () {
          fechaInput.max = fechaFinalInput.value; // Establecemos el valor máximo
        });
      }
      
      // Llamamos a la función para configurar las fechas del cronograma
      configurarFechasCronograma();

      
    function agregarEvento(e) {
        e.preventDefault();

        const dia = document.querySelector('#dia').value;
        const horario = document.querySelector('#horario').value;
        const presencialidad = document.querySelector('#presencialidad').value;
        const fecha = document.querySelector('#fecha').value;

        if (dia === '' || horario === '' || presencialidad === '' || fecha === '') {
            mostrarError('Todos los campos son requeridos.');
            return;
        }

        const eventoObj = {
            dia: dia,
            horario: horario,
            presencialidad: presencialidad,
            fecha: fecha
        };

        // Agregar el eventoObj al array eventos
        eventos.push(eventoObj);

        crearHTML();
        JSONificar();
    }

    function JSONificar() {
        const eventosJSON = JSON.stringify(eventos);

        // Agregar el JSON al campo oculto en el formulario
        const campoJSON = document.createElement('input');
        campoJSON.type = 'hidden';
        campoJSON.name = 'eventosJSON';
        campoJSON.value = eventosJSON;

        // Agregar el campo oculto al formulario
        document.form1.appendChild(campoJSON);
    }

    function mostrarError(error) {
        const mensajeError = document.createElement('p');
        mensajeError.textContent = error;
        mensajeError.classList.add('error');

        const contenido = document.querySelector('#contenido');
        contenido.appendChild(mensajeError);

        setTimeout(() => {
            mensajeError.remove();
        }, 1000);
    }

    function crearHTML() {
        limpiarHTML();

        if (eventos.length > 0) {
            eventos.forEach((eventoObj, index) => {
                const btnEliminar = document.createElement('a');
                btnEliminar.classList.add('borrar-evento');
                btnEliminar.innerHTML = 'X';

                btnEliminar.onclick = () => {
                    borrarEvento(index); // Pasar el índice del evento a borrar
                }

                const li = document.createElement('li');
                li.innerHTML = `
                    <p><strong>Día:</strong> ${eventoObj.dia}</p>
                    <p><strong>Horario:</strong> ${eventoObj.horario}</p>
                    <p><strong>Presencialidad:</strong> ${eventoObj.presencialidad}</p>
                    <p><strong>Fecha:</strong> ${eventoObj.fecha}</p>
                `;

                li.appendChild(btnEliminar);

                listaEventos.appendChild(li);
            })
        }
    }

    function borrarEvento(index) {
        eventos.splice(index, 1); // Eliminar el evento en la posición especificada
        crearHTML();
        JSONificar();
    }

    function limpiarHTML() {
        while (listaEventos.firstChild) {
            listaEventos.removeChild(listaEventos.firstChild);
        }
    }
});
