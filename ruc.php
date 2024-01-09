<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta RUC</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="js/jquery.min.js"></script>
</head>

<body>

    <a href="index.php">→ → →Consulta DNI← ← ←</a>
    <div class="container">
    <img src="image/logo.jpg" alt="Logo" class="logo">
        <h1>Consulta RUC</h1>
        <div>INGRESAR EL NUMERO DE RUC:</div>
        <input type="text" autocomplete="off" id="ruc" name="ruc">
        <button id="pruebaruc">Consultar</button>
        <br>
        <br>
        <div>RUC: <input type="text" id="rucNumero"></div>
        <div>Nombre o Razón social: <input type="text" id="razonsocial"></div>
        <div>Estado: <input type="text" id="estado" readonly></div>
        <div>Dirección: <input type="text" id="direccion"></div>
        <div>Distrito: <input type="text" id="distrito"></div>
        <div>Departamento: <input type="text" id="departamento"></div>
        <div>DNI: <input type="text" id="dniResultado"></div>
        <div>Celular o Teléfono: <input type="text" id="telefono"></div>
        <div>Correo: <input type="text" id="correo"></div>
        <div>Zona: <input type="text" id="zona"></div>
        <div>ID Vendedor: <input type="text" id="idVendedor"></div>
        <textarea id="datosCliente" rows="10" cols="50" readonly></textarea>
        <button id="copiarDatos">Copiar</button>
        <button id="completarManualmente">Completar Manualmente</button>
    </div>

    <script>
        $("#pruebaruc").click(function () {
            var ruc = $("#ruc").val();
            $.ajax({
                type: "POST",
                url: "consultar-ruc-ajax.php",
                data: 'ruc=' + ruc,
                dataType: 'json',
                success: function (data) {
                    if (data == 1) {
                        alert('El RUC tiene que tener 11 digitos');
                    }
                    else {
                        console.log(data);
                        $("#rucNumero").val(data.numeroDocumento);
                        $("#razonsocial").val(data.nombre);
                        $("#estado").val(data.estado);
                        $("#direccion").val(data.direccion);
                        $("#departamento").val(data.departamento);
                        // Llenar automáticamente el campo de DNI
                        var dni = data.numeroDocumento;
                        if (ruc.startsWith("10") && dni.length === 11) {
                            dni = dni.substring(2, 10);
                        } else {
                            dni = "--";
                        }
                        $("#dniResultado").val(dni);
                        // Actualizar el contenido del cuadro de texto
                        var updatedText =
                            "DATOS RUC:\n" +
                            data.nombre + "\n" +
                            data.numeroDocumento + "\n" +
                            $("#dniResultado").val() + "\n" +
                            $("#direccion").val() + " " + $("#distrito").val() + " " + $("#departamento").val() + "\n" +
                            $("#telefono").val() + "\n" +
                            $("#correo").val() + "\n" +
                            $("#zona").val() + "\n" +
                            $("#idVendedor").val();
                        $("#datosCliente").val(updatedText);
                    }
                }
            });
        });

        $("#copiarDatos").click(function () {
            var copyText = document.getElementById("datosCliente");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            document.execCommand("copy");
            alert("Texto copiado");
        });

        $("#completarManualmente").click(function () {
            // Actualizar el contenido del cuadro de texto
            var updatedText =
                "DATOS RUC:\n" +
                $("#razonsocial").val() + "\n" +
                $("#rucNumero").val() + "\n" +
                $("#dniResultado").val() + "\n" +
                $("#direccion").val() + " " + $("#distrito").val() + " " + $("#departamento").val() + "\n" +
                $("#telefono").val() + "\n" +
                $("#correo").val() + "\n" +
                $("#zona").val() + "\n" +
                $("#idVendedor").val();
            $("#datosCliente").val(updatedText);
            updatedText = updatedText.replace(/,/g, '');
            $("#datosCliente").val(updatedText);
        });
    </script>
</body>

</html>
