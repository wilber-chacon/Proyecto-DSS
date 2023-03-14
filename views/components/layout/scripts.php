<script src="../components/template/jquery/jquery-3.6.4.js"></script>
<script src="../components/template/bootstrap-4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="../components/template/bootstrap-4.6.2/js/bootstrap.min.js"></script>
<script src="../components/template/alertify/js/alertify.js"></script>
<script src="../components/template/datatable/datatables.min.js"></script>
<script src="../components/template/sweetalert2/sweetalert2.js"></script>
<script src="../components/js/global.js"></script>
<script src="../components/js/datatables-demo.js"></script>
<script type="text/javascript">
  var mensaje = "";
  var title = "";
  //Creamos la instancia
  let params = new URLSearchParams(document.location.search);
  //Accedemos a los valores
  let mensaj = params.get("msj");
  let titulo = params.get("titulo");

  mensaje = mensaj;
  title = titulo;
  if (mensaje == "si") {
    alertify.success(title);

  } else if (mensaje == "no") {
    alertify.error(title);
  }
</script>