<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta DNI</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="js/jquery.min.js"></script>
</head>

<body>

    <a href="ruc.php">→ → →Consulta RUC← ← ←</a>
    <div class="container">
    <img src="image/logo.jpg" alt="Logo" class="logo">
        <h1>Consulta DNI</h1>
        <div>INGRESAR EL NUMERO DE DNI:</div>
        <input type="text" id="dni" autocomplete="off" name="dni">
        <button id="prueba">Consultar</button>
        <br>
        <br>
        <div>Apellido Paterno: <input type="text" id="apellidop"></div>
        <div>Apellido Materno: <input type="text" id="apellidom"></div>
        <div>Nombres: <input type="text" id="nombre"></div>
        <div>DNI: <input type="text" id="dniResultado"></div>
        <div>Dirección: <input type="text" id="direccion"></div>
        <div>Celular o Teléfono: <input type="text" id="telefono"></div>
        <div>Correo: <input type="text" id="correo"></div>
        <div>Zona: <input type="text" id="zona"></div>
        <div>ID Vendedor: <input type="text" id="idVendedor"></div>
        <textarea id="datosCliente" rows="10" cols="50"></textarea>
        <button id="copiarDatos">Copiar</button>
        <button id="completarManualmente">Completar Manualmente</button>
    </div>

    <script>

        $("#prueba").click(function () {

            var dni = $("#dni").val();


            $.ajax({
                type: "POST",
                url: "consulta-dni-ajax.php",
                data: 'dni=' + dni,
                dataType: 'json',
                success: function (data) {


                    if (data == 1) {
                        alert('El DNI tiene que tener 8 digitos');
                    }
                    else {
                        console.log(data);
                        $("#nombre").val(data.nombres);
                        $("#apellidop").val(data.apellidoPaterno);
                        $("#apellidom").val(data.apellidoMaterno);
                        $("#direccion").val(data.direccion);
                        $("#dniResultado").val(dni);
                        // Aquí puedes utilizar los datos obtenidos para mostrarlos en el cuadro de texto
                        $("#datosCliente").val(
                            "DATOS DNI:\n" +
                            data.apellidoPaterno + " " + data.apellidoMaterno + " " + data.nombres + "\n" +
                            dni + ""

                        );
                    }

                }
            });

        });

        $("#copiarDatos").click(function () {
            var copyText = document.getElementById("datosCliente");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            document.execCommand("copy");
            alert("Texto copiado al portapapeles");
        });

        $("#completarManualmente").click(function () {
            // Actualizar el contenido del cuadro de texto
            var updatedText =
                "DATOS DNI:\n" +
                $("#nombre").val() + "\n" +
                $("#apellidop").val() + "\n" +
                $("#apellidom").val() + "\n" +
                $("#dniResultado").val() + "\n" +
                $("#direccion").val() + "\n" +
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