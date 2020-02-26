<?php
require_once("config.php");

//$sql = new Sql();
//$resultado = $sql->select("select * from tb_usuarios");
//echo json_encode($resultado);

$root = new Usuario();

$root->loadById(2);

echo $root;;

?>