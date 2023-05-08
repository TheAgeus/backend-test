<?php
session_start();

if ( !empty($_SESSION['token']) ) {
   
} else {
    echo "No deberías estar aquí";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['rol']; ?></title>
    <div id="vista_container" class="vista_inicial">
        <h1>Bienvenido</h1>
    </div>
    <div class="barra_acciones">
        <div onclick="inicio()">Inicio</div>
        <div onclick="accion1()">Capturar</div>
        <?php 
            if ($_SESSION['rol'] == 'admin') {
                echo '<div onclick="list(' . "'CAPTURADO'" . ')">Lista de personas capturadas</div>';
                echo '<div onclick="list(' . "'ACTIVO'" . ')">Lista de personas activas</div>';
                echo '<div onclick="list(' . "'BAJA'" . ')">Lista de personas dadas de baja</div>';
            }
        ?>
    </div>
</head>
<body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<style>
    .vista_inicial {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .barra_acciones {
        position: absolute;
        top: 0;
    }
    .barra_acciones > div:hover {
        cursor: pointer;
    }
</style>

<script>
    const vistaContainer = document.getElementById("vista_container")
    function inicio() {
        vistaContainer.innerHTML = "<h1>Bienvenido</h1>"
    }
    function accion1() {
        vistaContainer.innerHTML = `
            <div class="capturar">
                <h1>Capturar</h1>
                <form name="capturarForm">
                    <input type="text" name="nombre_persona" id="nombre_persona" placeholder="Nombre">
                    <input type="number" name="edad_persona" id="edad_persona" placeholder="Edad">
                    <div class="boton" onclick="capturar()">Go</div>
                </form>
            </div>
        `
    }

    function list(estado) {
        <?php $token = (isset($_SESSION['token']))?$_SESSION['token']:'';?>
        const token = '<?php echo $token;?>'

        $.ajax({
            url: 'http://sistemasdigitalesapi.test/api/personas.php',
            method: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': token
            },
            success: function(response) {

                let listaHTML = '<ul>'
                for (let i=0; i<response.data.length; i++) {
                    if (response.data[i].estatus == estado) {
                        listaHTML += '<li>' + response.data[i].nombre + '</li>';
                    }
                }

                listaHTML += '</ul>'

                console.log(listaHTML)

                vistaContainer.innerHTML = `
                    <div class="personas">
                        <h1>Lista de personas estado: ${estado}</h1>
                        ${listaHTML}
                    </div>
                `
            }
        })
    }

    function capturar() {
        const nombrePersona = document.forms["capturarForm"]["nombre_persona"].value
        const edadPersona = document.forms["capturarForm"]["edad_persona"].value
        
        <?php $token = (isset($_SESSION['token']))?$_SESSION['token']:'';?>
        const token = '<?php echo $token;?>'

        if (nombrePersona == "") {
            alert("No hay nombre")
        }

        if (edadPersona == "") {
            alert("No hay edad")
        }

        $.ajax({
            url: 'http://sistemasdigitalesapi.test/api/personas.php',
            method: 'POST',
            dataType: 'json',
            data: {
                nombre: nombrePersona,
                edad: edadPersona
            },
            headers: {
                'Authorization': token
            },
            success: function(response) {
                
                
            }
        })
    }
</script>