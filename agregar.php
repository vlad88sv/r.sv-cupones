<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('configuracion.php');
require_once('PHP/vital.php');

if (isset($_POST['guardar'])) {
    $DATOS = array();
	$DATOS['valor'] = $_POST['monto'];
	$DATOS['tipo'] = "cantidad";
	$DATOS['utilizado'] = "0";
	
	$cupones = explode("\n", $_POST['cupones']);
	
	//var_dump($cupones);
	
	foreach($cupones as $cupon) {
		$cupon = str_replace(array('.', ' ', "\n", "\t", "\r"), '', $cupon);
		$DATOS['cupon'] = $cupon;
		db_agregar_datos('cupones', $DATOS);
		
	}
		
}
?>
<html>
<head>
</head>
<body>
<form method="POST">
<p>
Monto:<br />
<input type="text" name="monto" value="" />
</p>
<p>
Cupones:<br />
<textarea name="cupones"></textarea>
</p>
<br />
<input type="submit" name="guardar" />
</form>
</body>
</html>
