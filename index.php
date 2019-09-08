<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Probar Conexiones con MySQL o PostgreSQL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="shortcut icon" type="image/png" href="http://127.0.0.1/favicon_php.png">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1 class="text-center h2" style="margin-bottom: 1rem;padding: 1rem 0;">Probar conexiones a BDD [Postgresql, Mysql]</h1>
    <div class="container mx-auto jumbotron mt-3">

        <form autocomplete="on" name="formConexiones" id="formConexiones" method="post" action="conexion.php">

            <div class="form-group">
                <label>Gestor BDD:</label>
                <select name="tipoBDD" id="tipoBDD" class="form-control">
                    <option value="mysql" selected>MYSQL</option>
                    <option value="postgresql">POSTGRESQL</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nombre BDD</label>
                <input type="text" class="form-control" id="nameBDD" name="nameBDD" value="" required>
            </div>
            <div class="form-group">
                <label>Host BDD</label>
                <input type="text" class="form-control" name="hostBDD" id="hostBDD" value="127.0.0.1" required>
            </div>
            <div class="form-group">

                <label>User BDD:</label>
                <input type="text" class="form-control" name="userBDD" id="userBDD" value="root" required>
            </div>
            <div class="form-group">
                <label>Pass BDD:</label>
                <input type="password" class="form-control" name="passBDD" id="passBDD" value="">
            </div>


            <input type="submit" name="test_conexion" class="btn btn-primary btn-send" value="Enviar" />
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script src="js/main.js"></script>

</body>

</html>