 
$(document).ready(function () { // una vez que se termina de cargar la pagina va cargar lo que esta adentro

    // jquery a una clase le vamos asignar una funcion
    $('.filtrar-item').change(function (e) {
        const estado = document.getElementById('estado').value;
        const tipoCuenta = document.getElementById('tipoCuenta').value;

        fetch('filterUser.php?tipoCuenta=' + tipoCuenta + "&estado=" + estado, { // le pasamos los filtros para armar el php
            method: 'GET',
        })
            .then(response => {
                // Comprueba si la respuesta del servidor no es exitosa
                if (!response.ok) {
                    
                    throw new Error('Error en la respuesta del servidor: ' + response.status);
                }
                    return response.json()  // Convierte la respuesta en un objeto JSON
            })
            .then(data => {
                const tabla = $('#tabla-info'); // seleccionamos la tabla usuarios
                tabla.find('tbody').html(' '); // limpiamos el tbody para que las filas que estan ya no esten
                // Llenar la tabla con los resultados filtrados
                
                if (data && data.data) {

                    const usuarios = data.data;
                     //definimos los usuarios y obtenemos los usuarios filtrados
                    usuarios.forEach(usuario => {
                    // creo una fila
                    const fila = $('<tr></tr>');
                    // creo las columnas

                    const dni = $('<td width="126px"></td>').text(usuario.dni);
                    const nombre = $('<td></td>').text(usuario.nombre);
                    const apellido = $('<td></td>').text(usuario.apellido);
                    const telefono = $('<td></td>').text(usuario.telefono);
                    const correo = $('<td></td>').text(usuario.correo);
                    const estado = $('<td></td>').text(usuario.estado);
                    const tipoCuenta = $('<td width="125px"></td>').text(usuario.tipoCuenta);
                    const modificar = $('<td></td>');



                    modificar.append('<form class="form-editar" action="../user/update/editarUser.php" method="get"><button class="editar" type="submit" name="dni" value='+ usuario.dni +'><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></button></form>');

              
                
                  
                    // agrego las columnas a la fila
                    fila.append(dni);
                    fila.append(nombre);
                    fila.append(apellido);
                    fila.append(telefono);
                    fila.append(correo);
                    fila.append(estado);
                    fila.append(tipoCuenta);
                    fila.append(modificar);
                
                    // agrego la fila a la tabla
                    tabla.find('tbody').append(fila); 
                });
    }else{
        console.error('Data or data.data is undefined');
    }
})
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
});


