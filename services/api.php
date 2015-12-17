<?php
require '../Slim/Slim.php';
//include all DAO files
require_once('persistencia/include_dao.php');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->get('/getUsuarios', 'getUsuarios');
$app->post('/registrar', 'registrar');
$app->post('/registroCompleto', 'registroCompleto');
$app->get('/baja/:idUsuario', 'darseDeBaja');
$app->get('/getInfoUser/:idUsuario', 'getInfoUser');
$app->get('/mandarAmistad/:idUsuario', 'pedirAmistad');
$app->get('/borrarAmistad/:idUsuario', 'borrarAmistad');
$app->post('/modificarInformacion', 'modificarInformacion');
$app->post('/login', 'login');
$app->post('/subirImagen/:id', 'subirImagen');
$app->post('/crearApunte/:id', 'crearApunte');
$app->post('/subirPDF/:id/:idApunte', 'subirPDF');
$app->get('/getApuntesUser/:id', 'getApuntesUser');
$app->post('/borrarApunte', 'borrarApunte');
$app->post('/busqueda', 'busqueda');
$app->get('/apuntes', 'apuntes');
$app->post('/modificarApunte', 'modificarApunte');

$app->run();


function apuntes() {
	$apuntes = DAOFactory::getApuntesDAO()->queryAll();
	echo json_encode($apuntes);
}

function modificarApunte() {
	$request = \Slim\Slim::getInstance()->request();
	$apunte = json_decode($request->getBody());
	$modificado = DAOFactory::getApuntesDAO()->update($apunte);	
	if ($modificado == 1) {
		$token[0] = "ok";
	} else {
		$token[0] = "nok";
	}
	echo json_encode($token);
}

function busqueda() {
	$request = \Slim\Slim::getInstance()->request();
	$info = json_decode($request->getBody());		
	$universidades = DAOFactory::getUniversidadesDAO()->buscar($info->nombre);
	$token[0] = "ok";
	$token[1] = $universidades;
	$usuarios = DAOFactory::getUsuariosDAO()->buscar($info->nombre);
	$token[2] = $usuarios;
	$carreras = DAOFactory::getCarrerasDAO()->buscar($info->nombre);
	$token[3] = $carreras;
	$apuntes = DAOFactory::getApuntesDAO()->buscar($info->nombre);
	$token[4] = $apuntes;
	echo json_encode($token);
}


function borrarApunte() {
	$request = \Slim\Slim::getInstance()->request();
	$info = json_decode($request->getBody());
	$user = DAOFactory::getApuntesDAO()->load($info->idApunte);
	$user->bBorrado = 1;
	if (DAOFactory::getApuntesDAO()->update($user) == 0) {
		$token[0] = "nok";
	} else {
		$token[0] = "ok";
	}
	echo json_encode($token);
}

function getApuntesUser($id) {
	$arr = DAOFactory::getApuntesDAO()->getApuntes($id);
	echo json_encode($arr);
}
function subirPDF($id, $idApunte) {
	if ( !empty( $_FILES ) ) {

    	$tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    	$split = split("/" , $_FILES[ 'file' ]['type']);
    	if (strcmp($split[1], "pdf") == 0) {
    		$tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
		    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

		    $espec = 'archivosusers' 
		    . DIRECTORY_SEPARATOR . md5($id . "phyrion") . DIRECTORY_SEPARATOR . "Apuntes"  
		    . DIRECTORY_SEPARATOR . $idApunte . "_" . $_FILES[ 'file' ][ 'name' ];
		    //echo $uploadPath;
		    move_uploaded_file( $tempPath, $uploadPath . $espec );
		    $apunte = DAOFactory::getApuntesDAO()->load($idApunte);
		    $apunte->archivo = str_replace("\\", "/", "services/". $espec);
		    $apunte = DAOFactory::getApuntesDAO()->update($apunte);
    		echo json_encode("ok");
    	} else{
    		DAOFactory::getApuntesDAO()->delete($idApunte);
    		echo json_encode("nok");
    	}
    	
	} else {
		DAOFactory::getApuntesDAO()->delete($idApunte);
		echo json_encode("nok");
	}


}

function crearApunte($id) {
	$request = \Slim\Slim::getInstance()->request();
	$apu = json_decode($request->getBody());
	$apunte = new Apunte();
	$apunte->tipo = $apu->tipo;
	$apunte->titulo = $apu->titulo;
	$apunte->descripcion = $apu->descripcion;
	$apunte->fechaSubida = "12/05/1989";
	$apunte->bBorrado = 0;
	$apunte->idUsuario = $id;
	$apunte->idUniversidad = 1;
	$apunte->idCarrera = 1;
	$apunte->archivo = "esperando";
	$arr = DAOFactory::getApuntesDAO()->insert($apunte);
	if ($arr != null) {
		$token[0] = "ok";
		$token[1] = $arr;
	}


	echo json_encode($token);
}

function getUsuarios() {
	$usuario = new Usuario();
	$arr = DAOFactory::getUsuariosDAO()->queryAll();
	echo json_encode($arr);
}

function subirImagen($id) {
	if ( !empty( $_FILES ) ) {

    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

    $espec = 'archivosusers' 
    . DIRECTORY_SEPARATOR . md5($id . "phyrion") . DIRECTORY_SEPARATOR . 'imgs' 
    . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    //echo $uploadPath;
    move_uploaded_file( $tempPath, $uploadPath . $espec );
    $infoUser = DAOFactory::getInfoUsuarioDAO()->load($id);
    $infoUser->srcImg = str_replace("\\", "/", "services/". $espec);
    $infoUser = DAOFactory::getInfoUsuarioDAO()->update($infoUser);
    $answer = array( 'answer' => 'File transfer completed' );
    $json = json_encode( "Correcto");

    echo $json;

	} else {

	    echo 'No files';

	}
}
function registrar() {
	$request = \Slim\Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	$usuario = new Usuario();
	$valido = true;
	$usuario->nombre = $user->nombre;
	$usuario->email = $user->email;
	$usuario->pass = $user->pass;
	$usuario->bBorrado = 0;
	$usuario->bValidado = 0;
	$correos = DAOFactory::getCorreosValidadosDAO()->queryAll();
	$usuarios = DAOFactory::getUsuariosDAO()->queryAll();
	$userExiste = false;
	foreach ($usuarios as $user) {
		if (strcmp($user->email, $usuario->email) == 0) {
			$userExiste = true;
		}
		# code...
	}

	$correoValido = false;
	$correo = explode("@", $usuario->email);
	foreach ($correos as $corr) {
		if (strcmp($corr->email, $correo[1]) == 0) {
			$correoValido = true;
		}
		# code...
	}

	//echo json_encode($correoValido);
	if (!$userExiste) {
		if ($correoValido) {
			$infoUsuario = new InfoUsuario();

			$arr = DAOFactory::getUsuariosDAO()->insert($usuario);
			
			$infoUsuario->apellidos = "Apellidos prueba";
			$infoUsuario->poblacion = "Poblacion prueba";
			$infoUsuario->srcImg = "jpgs/user.jpg";
			$infoUsuario->fechaNacimiento = "12/4/2015";
			$infoUsuario->fechaCreacion = "12/4/2015";
			$infoUsuario->idCarrera = "1";
			$infoUsuario->idUniversidad = "1";
			$infoUsuario->idUsuario = $arr;
			DAOFactory::getInfoUsuarioDAO()->insert($infoUsuario);
			if ($arr != null) {
				//echo $arr->apellidos;
				$token[0] = "ok";
				$token[1] = $usuario;
				$token[3] = md5($arr . "phyrion");
				//$token[2] = DAOFactory::getInfoUsuarioDAO()->load($arr->idUsuario);
				echo json_encode($token);
			} else {
				echo json_encode($token[0] = "nok");
			}
		} else {
			$token[0] = "nok";
			$token[1] = "evalido";
			echo json_encode($token);
		}
	} else {
		$token[0] = "nok";
		$token[1] = "uexiste";
		echo json_encode($token);
	}
}

function login() {
	$request = \Slim\Slim::getInstance()->request();
	$login = json_decode($request->getBody());
	
	$arr = DAOFactory::getUsuariosDAO()->login($login->login, $login->password);
	//echo json_encode($arr->idUsuario);
	if ($arr != null) {
		//echo $arr->apellidos;
		$token[0] = "ok";
		$token[1] = $arr;
		$token[2] = DAOFactory::getInfoUsuarioDAO()->load($arr->idUsuario);
		$token[3] = md5($arr->idUsuario . "phyrion");
		echo json_encode($token);
	} else {
		echo json_encode($token[0] = "nok");
	}
	
}

function registroCompleto() {
	echo "RegistroCompleto";
}

function darseDeBaja($idUsuario) {
	DAOFactory::getUsuariosDAO()->baja($idUsuario);
	echo "Baja";
}

function pedirAmistad($idUsuario) {
	echo "Pedir " . $id;
}

function borrarAmistad($idUsuarios) {
	echo "Borrar " . $id;
}

function modificarInformacion() {
	$request = \Slim\Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	$infoUsuario = new InfoUsuario();
	$infoUsuario->idUsuario = $user->idUsuario;
	$infoUsuario->apellidos = $user->apellidos;
	$infoUsuario->poblacion = $user->poblacion;
	$infoUsuario->srcImg = $user->srcImg;
	$infoUsuario->fechaNacimiento = $user->fechaNacimiento;
	$infoUsuario->fechaCreacion = $user->fechaCreacion;
	$infoUsuario->idCarrera = $user->idCarrera;
	$infoUsuario->idUniversidad = $user->idUniversidad;

	$modificado = DAOFactory::getInfoUsuarioDAO()->update($infoUsuario);
	//echo $modificado;
	if ($modificado == 1) {
		$token[0] = "ok";
		$token[1] = $infoUsuario;
	} else {
		$token[0] = "nok";
	}


	echo json_encode($token);
}

function getInfoUser($idUsuario) {
	$result = DAOFactory::getInfoUsuarioDAO()->load(1);
	echo json_encode($result);
}

function getConnection() {
	$dbhost = "127.0.0.1";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "OPUniversity";
	$dbh = new PDO ( "mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass );
	$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	return $dbh;
}
?>

