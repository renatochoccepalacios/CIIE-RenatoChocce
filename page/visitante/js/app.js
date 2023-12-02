
/* llamamos a las flechas */
const btnLeft = document.querySelector(".btn-left");
const btnRight = document.querySelector(".btn-right");
/* necesitamos el contenedor que engloba las imagenes */
const slider = document.querySelector("#slider");
const sliderSection = document.querySelectorAll(".slider-section");/* como quiero traerme todas las imagenes le agrego el All */


// cada vez que le de click al boton nos va a ejecutar un evento click y quiero que me ejecute la funcion moveToLeft
btnLeft.addEventListener("click", e => moveToLeft())
btnRight.addEventListener("click", e => moveToRight())


let operacion = 0;
let counter = 0;
/* el ancho de nuestras imagenes */
let widthImg = 100 / sliderSection.length;/* es el 100% dividido a la cantidad de imagenes que tengo */
/* movemos a la derecha */
    /* una vez que nosotros le dimos click al boton derecho */
    /* se ejecuta esta funcion */
function moveToRight() {
    // si counter es mayor igual a la cantidad de imagenes de sliderSection
    if(counter >= sliderSection.length-1){
        counter = 0;
        operacion = 0;
        // me va a llevar a la primera imagen
        slider.style.transform = `translate(-${operacion}%)`;
        return;
    }
        
    counter++;
    operacion = operacion + widthImg;
    /* le agregamos estilos */
    slider.style.transform = `translate(-${operacion}%)`;
    slider.style.transition = "all ease .6s";
    
    
}


/* movemos a la izquierda */
function moveToLeft() {
    
    counter--;
    if(counter < 0){
        counter = sliderSection.length-1;
        operacion = widthImg * (sliderSection.length-1);
        slider.style.transform = `translate(-${operacion}%)`;
        slider.style.transition = "all ease .6s";

        return;    
    }
       
    operacion = operacion - widthImg;
    slider.style.transform = `translate(-${operacion}%)`;
    slider.style.transition = "all ease .6s";
    
    
}