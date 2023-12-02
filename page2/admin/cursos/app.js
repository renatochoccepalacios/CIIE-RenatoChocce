function ActualizarEstado(elemento, idCurso){
    const estado = elemento.getAttribute("estado"); // obtenemos un atributo del elemento estado
    // Utiliza la función fetch para enviar una solicitud GET al servidor
    fetch('actualizarEstadoCurso.php?id='+ idCurso + '&estado=' + estado, {
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
        if(data.status == "success"){ //  Si la propiedad 'status' en la respuesta del servidor es igual a "success",
            let textoEstado = document.getElementById('span-estado-' + idCurso);
            
            elemento.children[0].classList.remove("fa-toggle-off");
            elemento.children[0].classList.remove("fa-toggle-on");

            if(estado == 2){
                textoEstado.innerHTML= "Disponible";
                elemento.setAttribute("estado", '1'); // modificando el atributo estado del elemento
                elemento.children[0].classList.add("fa-toggle-on");
            }else{
                textoEstado.innerHTML= "Fuera de servicio";
                elemento.setAttribute("estado", '2'); // modificando el atributo estado del elemento
                elemento.children[0].classList.add("fa-toggle-off");
            }

        }else{
            alert("ocurrio un error al actualizar");
        }
    })
}