const urlAuth = "../../controllers/auth.controller.php";

const sweetAlert = (title, text, icon) => {
  return Swal.fire({
    title: `${title}`,
    text: `${text}`,
    icon: `${icon}`,
    showConfirmButton: false,
    timer: 2000,
    allowOutsideClick: false,
    heightAuto: false,
  });
};

const cerrarSesion = async () => {
  const { ok, mensaje } = await fetch(`${urlAuth}?accion=cerrar`).then((res) =>
    res.json()
  );
  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.reload();
    });
  }
};

$("#btn-cerrar").click(async function (e) {
  e.preventDefault();
  await cerrarSesion();
});
