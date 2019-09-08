<?php

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

function json_response($code = 200, $message = null) {
	// clear the old headers
	header_remove();
	// set the actual code
	http_response_code($code);
	// set the header to make sure cache is forced
	//header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
	// treat this as json
	header('Content-Type: application/json');
	// ok, validation error['msg'], or failure
	//header('Status: ' . $message['msg']);
	// return the encoded json
	return json_encode($message, JSON_UNESCAPED_UNICODE);
}

function probarConexionPostgres($usuario, $pass, $host, $bd) {
    try{
            // $conexionP = pg_connect("user=" . $usuario . " " .
            // "password=" . $pass . " " .
            // "host=" . $host . " " .
            // "dbname=" . $bd
            // );

            $conexionP=@pg_connect("host=$host user=$usuario dbname=$bd password=$pass");

            //) or die( "Error al conectar: ".pg_last_error() );

            if ($conexionP) {
                return true;
            } else {
                //return "Error al conectar a la BDD: " . $conexionP . "<br/>";
                return false;
            }
    }catch(Exception $ex){
        return false;
    }
}

function probarConexionMysql($usuario, $pass, $host, $bd) {
	$conexion = mysqli_connect($host, $usuario, $pass) or die("No existe conexion con el Gestor BDD");
	mysqli_set_charset($conexion, 'utrf-8');

	if (mysqli_select_db($conexion, $bd)) {
		return true;
	} else {
		return false;
	}
}

$response_data = [
	'msg' => "No se pudo ejecutar correctamente el archivo PHP",
	"code" => 404,
];

if (isset($_POST['test_conexion'])) {
	$nombreBDD = $_POST['nameBDD'];
	$nombreHost = $_POST['hostBDD'];
	$usuarioBDD = $_POST['userBDD'];
	$passBDD = $_POST['passBDD'];
	$tipoBDD = $_POST["tipoBDD"];

	try {
		//Ejecutamos nuestro c�digo

		if ($tipoBDD == "postgresql") {
			if (probarConexionPostgres($usuarioBDD, $passBDD, $nombreHost, $nombreBDD)) {
				$response_data['msg'] = "Conexion Exitosa a PostgreSQL";
				$response_data['code'] = 200;
			} else {
				$response_data['msg'] = "Fallo la conexion con PostgreSQL";
				$response_data['code'] = 500;
			}

		} else if ($tipoBDD == "mysql") {
			//$response_data['msg'] = probarConexionMysql($usuarioBDD, $passBDD, $nombreHost, $nombreBDD);
			if (probarConexionMysql($usuarioBDD, $passBDD, $nombreHost, $nombreBDD)) {
				$response_data['msg'] = "Conexion Exitosa a MYSQL";
				$response_data['code'] = 200;
			} else {
				$response_data['msg'] = "Fallo la conexion con MYSQL";
				$response_data['code'] = 500;
			}
		} else {
			$response_data['msg'] = "No existe conexion con este gestor de BDD";
			$response_data['code'] = 500;
		}

	} catch (Exception $ex) {
		$response_data['msg'] = $ex->getMessage();
		$response_data['code'] = 500;
		/* guardamos en el log de errores nuestro error, warning o notice */
		error_log('ERROR CONEXION BDD: ' . $ex->getMessage());
	}

}

//header('Status: ' . $response_data['code']);
//echo json_encode($response_data);

echo json_response($response_data['code'], $response_data);
