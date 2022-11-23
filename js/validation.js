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
/*--------------------------------------------------SIGNUP--------------------------------------------------*/
function signup(e){
    const name = document.getElementById("nombre1").value;
    const email = document.getElementById("correo1").value;
    const pass = document.getElementById("contraseña1").value;
    var expresion;

    expresion = /\w+@\w+\.+[a-z]/;

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
    }else if(name.length>35){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El nombre es muy largo',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(name.length<10){
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
    if(email===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El campo de correo esta vacío',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(!expresion.test(email)){
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
    if(pass===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El campo de contraseña esta vacío',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pass.length>10){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La contraseña es larga. Debe ser entre 5 y 10 caracteres',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pass.length<5){
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
/*--------------------------------------------------PQRS--------------------------------------------------*/
function pqrs(e){
    const tel = document.getElementById("tel").value;
    const msg = document.getElementById("text").value;

    /*TELEFONO*/
    if(tel===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El campo de teléfono esta vacío',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(tel.length<10){
        swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Número de teléfono inválido',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }

    /*MENSAJE*/
    if(msg===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El campo de mensaje esta vacío',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(msg.length<10){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El mensaje es muy corto',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
}
/*--------------------------------------------------PRODUCTO--------------------------------------------------*/
function product(e){
    const pname = document.getElementById("nombreP").value;
    const pprice = document.getElementById("precioP").value;
    const pcant = document.getElementById("cantidadP").value;
    const pdesc = document.getElementById("descP").value;

    /*NOMBRE*/
    if(pname===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduzca el nombre del producto',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pname.length<15){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El nombre es corto',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pname.length>20){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El nombre es muy largo',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
    
    /*PRECIO*/
    if(pprice===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduzca el precio',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pprice.length<4){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El precio debe ser mayor de 3<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> digitos',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pprice>30000){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El precio no debe superar de los $30.000',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
    
    /*CANTIDAD*/
    if(pcant===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduzca la cantidad',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pcant>150){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La cantidad no debe superar a los 150',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }

    /*DESCRIPCION*/
    if(pdesc===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduzca la descripción',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pdesc.length<18){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La descripción es corta',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pdesc.length>300){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La descripción es demasiada larga',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
}
/*--------------------------------------------------EMAIL--------------------------------------------------*/
function changeemail(e){
    const email = document.getElementById("email2").value;
    var expresion;

    expresion = /\w+@\w+\.+[a-z]/;

    /*CORREO*/
    if(email===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Digite el correo',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(!expresion.test(email)){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'El correo debe tener un dominio',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
}
/*--------------------------------------------------PASSWORD--------------------------------------------------*/
function changepassword(e){
    const pass1 = document.getElementById("passA").value;
    const pass2 = document.getElementById("passB").value;

    /*PASS1*/
    if(pass1===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Introduzca la contraseña actual',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }

    /*PASS2*/
    if(pass2===""){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Digite la nueva contraseña',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pass2.length<5){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La contraseña nueva debe tener mínimo 5 caracteres',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }else if(pass2.length>10){
        swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'La contraseña debe ser como máximo 10 caracteres',
            showConfirmButton: false,
            timer: 3000
        });
        return false;
    }
}