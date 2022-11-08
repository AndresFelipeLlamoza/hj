/*--------------------------------------------------RETIRAR--------------------------------------------------*/
function retirar(e){
    if (confirm("¿Desea retirar la reserva?")){
        return true;
    }else{
        e.preventDefault();
    }
}
let ret = document.querySelectorAll(".rr");
for(var i = 0; i < ret.length; i++){
    ret[i].addEventListener('click',retirar);
}

/*--------------------------------------------------CANCELAR--------------------------------------------------*/
function cancelar(e){
    if (confirm("¿Estás seguro de cancelar la reserva?")){
        return true;
    }else{
        e.preventDefault();
    }
}
let can = document.querySelectorAll(".cr");
for(var i = 0; i < can.length; i++){
    can[i].addEventListener('click',cancelar);
}