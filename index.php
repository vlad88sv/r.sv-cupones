<?php
$rsv_benchmark = microtime(true);
header ('Content-type: text/html; charset=utf-8');
header ('Content-type: application/json');
header ('Access-Control-Allow-Origin: *');
require_once('configuracion.php');
require_once('PHP/vital.php');

define('__BASE__', str_replace('//','/',dirname(__FILE__).'/'));

$json['error'] = '';
$json['html'] = '';
$json['aux'] = '';

/////////////Codigo
//
//
$cupon = db_codex(trim(@$_POST['cupon']));
$operacion = db_codex(@$_POST['operacion']);

if (!empty($cupon) && $operacion == 'buscar')
{
    $c = 'SELECT cupon, valor, tipo, utilizado FROM cupones WHERE utilizado=0 AND cupon="'.$cupon.'"';
    $r = db_consultar($c);
    if (mysqli_num_rows($r) > 0)
    {
        $json['cupon'] = db_fetch($r);
    } else {
        $json['cupon']['utilizado'] = '1';
    }
}

if (!empty($cupon) && $operacion == 'invalidar')
{
    $c = 'UPDATE cupones SET utilizado=1 WHERE cupon="'.$cupon.'"';
    db_consultar($c);
}

//
//
/////////////Codigo

$json['benchmark'] = round(((microtime(true) - $rsv_benchmark) * 1000),1);

echo json_encode($json);

?>