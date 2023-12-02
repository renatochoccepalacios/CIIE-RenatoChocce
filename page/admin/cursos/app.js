function confirmarBorrar(idCurso) {
    swal({
        title: "¿Estas seguro que quieres borrar este curso?",
        text: "Una vez eliminado, no podrás recuperar este curso.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                // Si se confirma la eliminación redirecciona a una página PHP para eliminar de la base de datos.
                window.location.href = "eliminarCurso.php?id=" + idCurso;
            } else {
                swal("No borraste el curso :)", {
                    icon: "info",
                });
            }
        });
}


function ActualizarEstado(elemento, idCurso) {
    const estado = elemento.getAttribute("estado"); // obtenemos un atributo del elemento estado
    // Utiliza la función fetch para enviar una solicitud GET al servidor
    fetch('actualizarEstadoCurso.php?id=' + idCurso + '&estado=' + estado, {
        method: 'GET',
    })
        .then(response => {
            // Comprueba si la respuesta del servidor no es exitosa
            if (!response.ok) {
                throw new Error(response.statusText) // se lanza un error
            }
            return response.json()  // Convierte la respuesta en un objeto JSON
        })
        .then(data => {
            console.log(data); // muestra los datos en la consola
            if (data.status == "success") { //  Si la propiedad 'status' en la respuesta del servidor es igual a "success",
                let textoEstado = document.getElementById('span-estado-' + idCurso);

                elemento.children[0].classList.remove("fa-toggle-off");
                elemento.children[0].classList.remove("fa-toggle-on");

                if (estado == 2) {
                    textoEstado.innerHTML = "Disponible";
                    elemento.setAttribute("estado", '1'); // modificando el atributo estado del elemento
                    elemento.children[0].classList.add("fa-toggle-on");
                } else {
                    textoEstado.innerHTML = "Fuera de servicio";
                    elemento.setAttribute("estado", '2'); // modificando el atributo estado del elemento
                    elemento.children[0].classList.add("fa-toggle-off");
                }

            } else {
                alert("ocurrio un error al actualizar");
            }
        })
}


$(document).ready(function () { // una vez que se termina de cargar la pagina va cargar lo que esta adentro

    // jquery a una clase le vamos asignar una funcion
    $('.filtrar-item').change(function (e) {
        const nivel = document.getElementById('nivel').value;
        const estado = document.getElementById('estado').value;
        const profesor = document.getElementById('profesor').value;
        const sede = document.getElementById('sede').value;

        fetch('filtrarCursos.php?nivel=' + nivel + "&estado=" + estado + "&profesor=" + profesor + "&sede=" + sede, { // le pasamos los filtros para armar el php
            method: 'GET',
        })
            .then(response => {
                // Comprueba si la respuesta del servidor no es exitosa
                if (!response.ok) {
                    throw new Error(response.statusText) // se lanza un error
                }
                return response.json()  // Convierte la respuesta en un objeto JSON
            })
            .then(data => {
                const tabla = $('#tabla-cursos'); // seleccionamos la tabla cursos
                tabla.find('tbody').html(' '); // limpiamos el tbody para que las filas que estan ya no esten
                // Llenar la tabla con los resultados filtrados
                
                const cursos = data.data; // definimos los cursos y obtenemos los cursos filtrados
                cursos.forEach(curso => {
                    // creo una fila
                    const fila = $('<tr></tr>');
                    // creo las columnas
                    const idCurso = $('<td width="40"></td>').text(curso.idCurso);
                    const nombreCurso = $('<td></td>').text(curso.curso);
                    const sede = $('<td></td>').text(curso.sede);
                    const profesor = $('<td></td>').text(curso.nombre_profesor);
                    const nivel = $('<td></td>').text(curso.nivel);
                    const estado = $('<td></td>');
                    // const destinatarios = $('<td></td>').text(curso.destinatarios);
                    const FechaInicio = $('<td></td>').text(curso.FechaInicio);
                    const FechaFinal = $('<td></td>').text(curso.FechaFinal);
                    const CargaHoraria = $('<td></td>').text(curso.CargaHoraria);
                    const cambiarEstado = $('<td></td>');
                    const gestionar = $('<td></td>');
                
                    const spanEstado = $('<span id="span-estado-' + curso.idCurso + '"></span>').text(curso.nombre_estado);
                    estado.append(spanEstado);
                    const claseEstado = curso.idestado == 1 ? 'on' : 'off';
                
                    // <td>
                    //     <button type="submit" class="cambiar-estado" estado="<?php echo $idEstado ?>" onclick="ActualizarEstado(this,<?php echo $curso->getIdCurso() ?>)">
                    //         <i class="fa-solid fa-toggle-<?php echo $claseEstado ?>"></i>
                    //     </button>
                    // </td>
                    const botonCambiarEstado = $('<button type="submit" class="cambiar-estado" estado="' + curso.estado + '" onclick="ActualizarEstado(this,' + curso.idCurso + ')"></button>');
                    const iconoCambiarEstado = $('<i class="fa-solid fa-toggle-' + claseEstado + '"></i>');
                    // append es aniadir
                    botonCambiarEstado.append(iconoCambiarEstado);
                    cambiarEstado.append(botonCambiarEstado);
                    gestionar.append('<a type="submit" class="editar-buttom" href="http://localhost/CIIE/page/admin/curso/?id=' + curso.idCurso + '"><i class="fa-solid fa-pen-to-square"></i></a>');
                    // agrego las columnas a la fila
                    fila.append(idCurso);
                    fila.append(nombreCurso);
                    fila.append(sede);
                    fila.append(profesor);
                    fila.append(nivel);
                    fila.append(estado);
                    // fila.append(destinatarios);
                    fila.append(FechaInicio);
                    fila.append(FechaFinal);
                    fila.append(CargaHoraria);
                    fila.append(cambiarEstado);
                    fila.append(gestionar);
                
                    // agrego la fila a la tabla
                    tabla.find('tbody').append(fila);
                })
            });
    });
});


