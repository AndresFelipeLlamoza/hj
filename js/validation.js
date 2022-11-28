//*SOLO LETRAS*\\
function sololetras(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    letras=" abcdefghijklmnñopqrstuvwxyz";
    especiales="8-37-38-46-164";
    teclado_especial=false;
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial==true;break;
        }
    }
    if(letras.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}
//*SOLO NUMEROS*\\
function solonumeros(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    numeros="1234567890";
    especiales="8-37-38-46-164";
    teclado_especial=false;
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial==true;break;
        }
    }
    if(numeros.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}
//*RSV*\\
function rsv(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    numero="12345";
    especiales="8-37-38-46-164";
    teclado_especial=false;
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial==true;break;
        }
    }
    if(numero.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}
/*--------------------------------------------------LOGIN--------------------------------------------------*/
function login(e){
    const name = document.getElementById("nombre2").value;
    const pass = document.getElementById("contraseña2").value;

    /**/
    if(name==="" && pass ===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Completa el formulario de inicio de sesión',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }

    /*NOMBRE*/
    if(name===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El campo de nombre esta vacío',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }

    /*CONTRASEÑA*/
    else if(pass===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El campo de contraseña esta vacío',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
}