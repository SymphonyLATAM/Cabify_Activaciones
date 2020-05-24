<?php



if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Indica los métodos permitidos.
	header('Access-Control-Allow-Origin: https://cabifyactivaciones.scm.azurewebsites.net:443/cabifyactivaciones.git');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
    
    // Indica los encabezados permitidos.
    header('Access-Control-Allow-Headers: Authorization');
    http_response_code(204);
}
header('Content-Type: application/json');
//conexion con la base de datos y el servidor
	
	
// PHP Data Objects(PDO):
try {
    $conn = new PDO ("sqlsrv:server = tcp:symphony-server-cabify.database.windows.net,1433; Database = activaciones_CCA", "symphony-root", "Aquiestoy1");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server :( ");
    die(print_r($e));
}

//Detectamos si ID tiene información
if(isset($_POST['myID']))
	{

$Trabajado_Por = "Agente1";
$currDate = getDate(); // generas un llamado al metodo

$FechaUsuario = $currDate['year'] . "-" . $currDate['mon'] . "-" . $currDate['mday']  . " " .  $currDate['hours'] . $currDate['minutes'] . $currDate['seconds'] ;
  
$currentid2  = $_POST['myID'];

$sql = 	    "UPDATE datos_cca SET Trabajado_Por=?,  Fecha_Hora=?  WHERE ID=?";
$stmt= $conn->prepare($sql);
$stmt->execute([$Trabajado_Por, $FechaUsuario , $currentid2]);
//And Trabajado_Por = 'Agente1' OR Trabajado_Por = ''  
//SELECT * FROM datos_cca WHERE ID = $currentid
//Select SQL Server Query:
		
		
		$currentid = $_POST['myID'];
		$sql = "SELECT TOP 1 * FROM datos_cca WHERE ID > $currentid ORDER BY ID "; 
		$row = $conn->query($sql)->fetch();
echo json_encode($row);

};



?>

