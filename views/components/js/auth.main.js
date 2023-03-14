const url = "../../controllers/auth.controller.php";

const registrarCliente = async () => {
  const { ok, mensaje } = await fetch(`${url}?accion=registrar`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./";
    });
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-register").click(async (e) => {
  e.preventDefault();
  await registrarCliente();
});

const verificarSesion = async () => {
  const { ok, mensaje } = await fetch(`${url}?accion=login`, {
    method: "POST",
    body: new FormData($("#form-login")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./";
    });
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-login").click((e) => {
  e.preventDefault();
  let timerInterval;
  Swal.fire({
    title: "¡Verificando!",
    html: "La verificación termina en <b></b> milisegundos",
    timer: 1500,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
      const b = Swal.getHtmlContainer().querySelector("b");
      timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft();
      }, 50);
    },
    willClose: () => {
      clearInterval(timerInterval);
    },
  }).then((result) => {
    if (result.dismiss === Swal.DismissReason.timer) {
      verificarSesion();
    }
  });
});

const verificarCorreo = async () => {
  const { ok, mensaje } = await fetch(`${url}?accion=verificar`, {
    method: "POST",
    body: new FormData($("#form-verificacion")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./";
    });
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-verificar").click(async (e) => {
  e.preventDefault();
  await verificarCorreo();
});
