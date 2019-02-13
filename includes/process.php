<?php
include('config.php');
$accion = $_POST['accion'];


if($accion == 'preguntas_categorias'){
	$categoria = $_POST['categoria'];
	$preguntas = explode('|', $_POST['preguntas']);
	$orden = explode('|', $_POST['orden']);
	$ok = 0;
	for($i=0; $i < count($preguntas); $i++){
		$sql = "UPDATE test_preguntas SET categoria=" . $categoria . ", orden=" . $orden[$i] . " WHERE id=" . $preguntas[$i] . " LIMIT 1;";
		if($conDB->query($sql) === TRUE){ $ok++;}
		if($ok == 0){
			$mensaje = 'Error al vincular preguntas a la categoría seleccionada.';
			$status = 'ERROR';
		}
		else{
			$mensaje = 'Se han vinculado correctamente las preguntas a la categoría seleccionada.';
			$status = 'SUCCESS';
		}
	}
	$data = array(
		'mensaje' => $mensaje,
		'status' => $status
	);
}


$output = json_encode($data);
echo $output;
?>