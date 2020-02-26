<?php
require_once("config.php");

$sql = new Sql();

$resultado = $sql->select("select * from tb_usuarios");

echo json_encode($resultado);

?>