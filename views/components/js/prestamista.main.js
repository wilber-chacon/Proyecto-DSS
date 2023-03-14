const url = "../../controllers/prestamista.controller.php";
let tbl_movimientos = "";

const obtenerCuentas = async () => {
  let html = "";
  $("#contenedor-cuentas").html(html);
  const { ok, cuentas } = await fetch(`${url}?accion=listar`).then((res) =>
    res.json()
  );
  if (ok) {
    cuentas.forEach((cuenta) => {
      html += `<div class="col-xl-4 col-md-6 mb-4 mt-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <p class="text-info" style="display: block; margin: 25px 10px">
                    <b>Cuenta: </b><span class="text-dark">${
                      cuenta.numCuenta
                    }</span>
                  </p>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <p class="text-info" style="display: block; margin: 25px 10px">
                    <b>Tipo: </b><span class="text-dark">${
                      cuenta.tipoCuenta
                    }</span>
                  </p>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <p class="text-info" style="display: block; margin: 25px 10px">
                    <b>Saldo: </b><span class="text-dark">${cuenta.saldoCuenta.toLocaleString(
                      "en",
                      {
                        style: "currency",
                        currency: "USD",
                      }
                    )}</span>
                  </p>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-5x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>`;
    });
  } else {
    html = `<div class="col-md-12 mt-4 alert alert-danger" role="alert">
      <h3 class="text-center">¡No tiene cuentas creadas!</h3>
    </div>`;
  }
  $("#contenedor-cuentas").html(html);
};

const crearCuenta = async () => {
  const { ok, mensaje } = await fetch(`${url}?accion=crear`, {
    method: "POST",
    body: new FormData($("#form-cuenta")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      limpiarFormulario();
      $("#modalCuenta").modal("hide");
      obtenerCuentas();
    });
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

const limpiarFormulario = () => {
  $("#tipo_cuenta").val("");
  $("#saldo").val("");
};

$("#btn-abrir-modal").click(function (e) {
  e.preventDefault();
  limpiarFormulario();
});

$("#btn-cancelar").click(function (e) {
  e.preventDefault();
  limpiarFormulario();
});

$("#btn-crear").click(async (e) => {
  e.preventDefault();
  await crearCuenta();
});

const listarMovimientos = async () => {
  tbl_movimientos = await $("#tbl_movimientos").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${url}?accion=movimientos`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "numTransaccion" },
      { data: "tipoTransaccion" },
      { data: "fechaTransaccion" },
      {
        data: "montoTransaccion",
        render: function (data) {
          return `${data.toLocaleString("en", {
            style: "currency",
            currency: "USD",
          })}`;
        },
      },
      { data: "lugarTransaccion" },
      { data: "numCuenta" },
    ],
    lengthMenu: [
      [5, 10, 15, 20, -1],
      [5, 10, 15, 20, "Todos"],
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
};
