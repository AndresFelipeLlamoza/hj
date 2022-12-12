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
/*--------------------------------------------------SIGNUP--------------------------------------------------*/
function signup(e){
    const name = document.getElementById("nombre1").value;
    const email = document.getElementById("correo1").value;
    const pass = document.getElementById("contraseña1").value;
    var expresion = /\w+@\w+\.+[a-z]/;

    if(name==="" && email==="" && pass===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Completa el formulario de registro',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }

    /*NOMBRE*/
    if (name === "") {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduzca nombre y apellido',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    } else if (name.length > 35) {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El nombre es muy largo',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    } else if (name.length < 10) {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El nombre es muy corto',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
    /*CORREO*/
    if (email === "") {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduce el correo',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    } else if (!expresion.test(email)) {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El correo debe tener el dominio',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
    /*CONTRASEÑA*/
    if (pass === "") {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduzca la contraseña',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    } else if (pass.length > 10) {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La contraseña es larga. Debe ser entre 5 y 10 caracteres',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    } else if (pass.length < 5) {
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La contraseña es corta. Debe ser entre 5 y 10 caracteres',
            showConfirmButton: false,
            timer: 3000
        });
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