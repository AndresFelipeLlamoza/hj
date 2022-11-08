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
        alert("El campo NOMBRE esta vacio");
        return false;
    }else if(name.length>35){
        alert("El nombre es muy largo");
        return false;
    }else if(name.length<10){
        alert("El nombre es muy corto");
        return false;
    }

    /*CORREO*/
    if(email===""){
        alert("El campo CORREO esta vacio");
        return false;
    }else if(!expresion.test(email)){
        alert("El correo debe contener un dominio");
        return false;
    }

    /*CONTRASEÑA*/
    if(pass===""){
        alert("El campo CONTRASEÑA esta vacio");
        return false;
    }else if(pass.length>18){
        alert("La contraseña es larga. Debe ser como minimo 5 caracteres y maximo de 10 caracteres");
        return false;
    }else if(pass.length<5){
        alert("La contraseña es muy corta");
        return false;
    }
}
/*--------------------------------------------------LOGIN--------------------------------------------------*/
function login(e){
    const name = document.getElementById("nombre2").value;
    const pass = document.getElementById("contraseña2").value;

    /*NOMBRE*/
    if(name===""){
        alert("El campo NOMBRE esta vacio");
        return false;
    }

    /*CONTRASEÑA*/
    else if(pass===""){
        alert("El campo CONTRASEÑA esta vacio");
        return false;
    }
}
/*--------------------------------------------------PQRS--------------------------------------------------*/
function pqrs(e){
    const tel = document.getElementById("tel").value;
    const msg = document.getElementById("text").value;

    /*TELEFONO*/
    if(tel===""){
        alert("El campo TELEFONO esta vacio");
        return false;
    }else if(tel.length<10){
        alert("Numero Inválido");
        return false;
    }

    /*MENSAJE*/
    if(msg===""){
        alert("El campo MENSAJE esta vacio");
        return false;
    }else if(msg.length<10){
        alert("El mensaje es muy corto");
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
        alert("Introduzca el nombre del producto");
        return false;
    }else if(pname.length<15){
        alert("El nombre es corto");
        return false;
    }else if(pname.length>20){
        alert("El nombre es muy largo");
        return false;
    }
    
    /*PRECIO*/
    if(pprice===""){
        alert("Introduzca el precio");
        return false;
    }else if(pprice.length<4){
        alert("El precio debe ser mayor de 4 digitos");
        return false;
    }else if(pprice>30000){
        alert("El precio no debe superar de los 30.000 pesos");
        return false;
    }
    
    /*CANTIDAD*/
    if(pcant===""){
        alert("Introduzca la cantidad");
        return false;
    }else if(pcant>150){
        alert("La cantidad no debe superar a los 150");
        return false;
    }

    /*DESCRIPCION*/
    if(pdesc===""){
        alert("Introduzca la descripción");
        return false;
    }else if(pdesc.length<18){
        alert("La descripcion es corta");
        return false;
    }else if(pdesc.length>300){
        alert("La descripcion es demasiada larga");
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
        alert("Digite el correo");
        return false;
    }else if(!expresion.test(email)){
        alert("El correo debe contener un dominio");
        return false;
    }
}
/*--------------------------------------------------PASSWORD--------------------------------------------------*/
function changepassword(e){
    const pass1 = document.getElementById("passA").value;
    const pass2 = document.getElementById("passB").value;

    /*PASS1*/
    if(pass1===""){
        alert("Introduzca la contraseña actual");
        return false;
    }

    /*PASS2*/
    if(pass2===""){
        alert("Digite la nueva contraseña");
        return false;
    }else if(pass2.length<8){
        alert("La contraseña nueva debe ser como mínimo 8 caracteres");
        return false;
    }else if(pass2.length>15){
        alert("La contraseña es muy larga. Máximo 15 caracteres");
        return false;
    }
}