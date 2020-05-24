<?php
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Indicamos al server los métodos permitidos.
	header('Access-Control-Allow-Origin: https://cabifyactivaciones.scm.azurewebsites.net:443/cabifyactivaciones.git');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
    // Indicamos los encabezados permitidos.
    header('Access-Control-Allow-Headers: Authorization');
    http_response_code(204);
}
header('Content-Type: application/json');
//conexion con la base de datos y el servidor
//PHP Data Objects(PDO) :
try {
    $conn = new PDO ("sqlsrv:server = tcp:symphony-server-cabify.database.windows.net,1433; Database = activaciones_CCA", "symphony-root", "Aquiestoy1");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Cabify Activation Server :( ");
    die(print_r($e));
}

	echo $_POST['jsonObj'] [0]['value'];
	//Creación de variables
	$ID				= $_POST['jsonObj'] [0]['value'];
	//obtenemos los valores del formulario del Licencia 
	$Licencia_LC	= $_POST['jsonObj'] [4]['value'];  	
	$NomApell_LC 	= $_POST['jsonObj'] [5]['value'];
	$Sexo_DP		= $_POST['jsonObj'] [6]['value'];	
	$FechNac_LC		= $_POST['jsonObj'] [7]['value'];  
	$Vencimiento_LC	= $_POST['jsonObj'] [8]['value'];  
  	$Accion_LC 	= $_POST['jsonObj'] [9]['value'];  
	//obtenemos los valores del formulario del Cedula Automotor
	$Plate_CA 		= $_POST['jsonObj'] [10]['value'];  
	$Marca_CA  		= $_POST['jsonObj'] [11]['value'];  
	$ModVeh_CA		= $_POST['jsonObj'] [12]['value'];  
	$Tipo_CA  		= $_POST['jsonObj'] [13]['value'];  
	$Uso_CA  		= $_POST['jsonObj'] [14]['value'];  
	$VigCed_CA		= $_POST['jsonObj'] [15]['value'];  
	$Titular_CA 	= $_POST['jsonObj'] [16]['value'];  	 
	$Autorizado_CA 	= $_POST['jsonObj'] [17]['value'];  
	$Radicado_CA 	= $_POST['jsonObj'] [18]['value'];  
	$Accion_CA 		= $_POST['jsonObj'] [19]['value'];  
	//obtenemos los valores del formulario del seguro
	$Dominio_SG 	= $_POST['jsonObj'] [20]['value'];  
	$Anio_SG		= $_POST['jsonObj'] [21]['value']; 
	$Vigencia_SG 	= $_POST['jsonObj'] [22]['value'];  
	$Accion_SG	 	= $_POST['jsonObj'] [23]['value']; 
	//obtenemos los valores del formulario del la foto
	$Accion_Photo 	= $_POST['jsonObj'] [24]['value']; 	
	//Asignamos el status Final
		$Status_Final = '';
	///////////////////////////////////////////
	//if ($Tipo_CA = 'Furgon' || $Tipo_CA = 'Utilitario'){
		//$Status_Final = 'Reject';	
	//}else{
		//if ($Accion_Photo = 'ReCollect'){
			//$Status_Final = 'ReCollect';	
		//}else{			
			if ($Accion_LC == 'Activar' and $Accion_CA == 'Activar' and $Accion_SG == 'Activar' and $Accion_Photo == 'Activar' && $Tipo_CA <> 'Furgon' && $Tipo_CA <> 'Utilitario' ){	
				$Status_Final = 'OK';	
					}else{
						if ($Tipo_CA == 'Furgon' || $Tipo_CA == 'Utilitario'){
							$Status_Final = 'Reject';
									}else{
							$Status_Final = 'ReCollect';	
						}
					}
				
			
$Trabajado_Por = "Agente1";
$currDate = getDate(); 
$FechaUsuario = $currDate['year'] . "-" . $currDate['mon'] . "-" . $currDate['mday']  . " " .  $currDate['hours'] . $currDate['minutes'] . $currDate['seconds'] ;
// Update SQL Server Query:
$sql = 	    "UPDATE datos_cca SET   Licencia_LC=?, NomApell_LC=?, Sexo_DP=?, FechNac_LC=?, Vencimiento_LC=?, Accion_LC=?, Plate_CA=?, Prod_CA=?, ModVeh_CA=?, Tipo_CA=?, Uso_CA=?, VigCed_CA=?,Titular_CA=?, Autorizado_CA =?, Radicado_CA=?, Accion_CA=?, Vigencia_SG=?, Dominio_SG=?,  Anio_CA=?,Accion_SG=?, Status_Final=?, Trabajado_Por=?,  Fecha_Hora=? WHERE ID=?";
$stmt= $conn->prepare($sql);
					$stmt->execute([$Licencia_LC, $NomApell_LC, $Sexo_DP,    $FechNac_LC,  $Vencimiento_LC, $Accion_LC,    $Plate_CA, $Marca_CA,  $ModVeh_CA,   $Tipo_CA, $Uso_CA, $VigCed_CA,$Titular_CA,     $Autorizado_CA,$Radicado_CA,   $Accion_CA,  $Vigencia_SG,  $Dominio_SG,    $Anio_SG, $Accion_SG,   $Status_Final, $Trabajado_Por, $FechaUsuario, $ID]);
//$sql2 = "SELECT * FROM datos_cca WHERE ID = $ID"; 
//$row = $conn->query($sql2)->fetch();
//echo json_encode($row);
//};
//};		
?>
