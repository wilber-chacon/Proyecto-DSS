var correoValido = false; //variable para saber si el correo se ingresó correctamente
var passValido = false;//variable para saber si la contraseña se ingresó correctamente

function iniciar() {
  var btnEnviar = document.getElementById("enviar");
  var txtcorreo = document.getElementById("username");
  var txtpass = document.getElementById("pass");

  if (btnEnviar.addEventListener) {
    btnEnviar.addEventListener("click", validarDatos, false);
  } else if (btnEnviar.attachEvent) {
    btnEnviar.attachEvent("onclick", validarDatos);
  }

  if (txtcorreo.addEventListener) {
    txtcorreo.addEventListener("keyup", validarCorreo, false);
  } else if (txtcorreo.attachEvent) {
    txtcorreo.attachEvent("keyup", validarCorreo);
  }

  //creando el evento blur cuando se pierde el foco del control en el que se ingresa el correo
  if (txtcorreo.addEventListener) {
    txtcorreo.addEventListener(
      "blur",
      function () {
        //aplicando estilos cuando se pierde el foco del control
        txtcorreo.style.border = "1px solid silver";
      },
      false
    );
  } else if (txtcorreo.attachEvent) {
    txtcorreo.attachEvent("blur", function () {
      //aplicando estilos cuando se pierde el foco del control
      txtcorreo.style.border = "1px solid silver";
    });
  }

  //creando el evento blur cuando se pierde el foco del control en el que se ingresa la contraseña
  if (txtpass.addEventListener) {
    txtpass.addEventListener(
      "blur",
      function () {
        //aplicando estilos cuando se pierde el foco del control
        txtpass.style.border = "1px solid silver";
      },
      false
    );
  } else if (txtpass.attachEvent) {
    txtpass.attachEvent("blur", function () {
      //aplicando estilos cuando se pierde el foco del control
      txtpass.style.border = "1px solid silver";
    });
  }


}

function validarCorreo() {
  //capturando el valor del correo
  var txtcorreo = document.getElementById("username").value;
  var correo = document.getElementById("username");
  //capturando por medio del id al span que muestra que el correo es erroneo
  var alerta = document.getElementById("alertMail");
  //expresiones regulares para validar el formato del correo
  var expresionMail1 = /^[\w.+]{1,}@([A-Z0-9]{1,}\.)(com|net|edu|org|gov)$/i;
  var expresionMail2 =
    /[\w.+]{1,}@([A-Z0-9]{1,}\.)([A-Z0-9]{1,}\.)(com|net|edu|org|gov)(\.[A-Z0-9]{1,})$/i;

  //comprovando si el correo ingresado coincide con alguna expresion regular
  if (expresionMail1.test(txtcorreo) || expresionMail2.test(txtcorreo)) {
    //actualizando la variable para indicar que se se ingresó correctamente
    correoValido = true;
  } else {
    correoValido = false;
  }

  //aplicando estilos al control si se ingresó bien o mal el correo
  if (correoValido == true) {
    correo.style.border = "2px solid green";
  } else if (correoValido == false) {
    correo.style.border = "2px solid red";
  }
}

function validarPass() {
  //capturando el valor del mensaje
  var txtpass = document.getElementById("pass").value;

  //validando si el usuario no ingreso ningun valor
  if (txtpass == null || txtpass == "" || txtpass.length == 0) {
    passValido = false;
  } else {
    passValido = true;
  }
}

function validarDatos() {
    var correo = document.getElementById("username");
    var pass = document.getElementById("pass");
  //llamando a la funcion para validar la contraseña
  validarPass();

  //comprobando si todos los datos son correctos
  if (correoValido == false && passValido == false) {
    correo.style.border = "2px solid red";
    pass.style.border = "2px solid red";
   
  } else {
    alerta.style.display = "block";
  }
}

if (window.addEventListener) {
  window.addEventListener("load", iniciar, false);
} else if (window.attachEvent) {
  window.attachEvent("onload", iniciar);
}
