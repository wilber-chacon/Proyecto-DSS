

<footer class="sticky-footer bg-dark">
        <div class="my-auto">
            <div class="copyright pt-4 pb-4 text-center my-auto text-white">
                <span>Copyright &copy; 2023 - Banco de Agricultura Salvadoreño SA de CV</span>
            </div>
        </div>
    </footer>

    <script src="../js/jquery-1.12.0.min.js"></script>
    <script src="../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/alertify.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/datatables-demo.js"></script>

    <script type="text/javascript">
        var mensaje="";
        var title="";
        //Creamos la instancia
        let params = new URLSearchParams(document.location.search);
        //Accedemos a los valores
        let mensaj = params.get("msj");
        let titulo = params.get("titulo");
        
        mensaje = mensaj;
        title = titulo;
        if(mensaje == "si"){
            alertify.success(title);

        }else if(mensaje == "no"){
            alertify.error(title);
        }
    </script>
</body>

</html>