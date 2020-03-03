<?php
require_once("config.php");

//$sql = new Sql();
//$resultado = $sql->select("select * from tb_usuarios");
//echo json_encode($resultado);

//$root = new Usuario();

//$root->loadById(2);

//echo $root;;

//$lista = Usuario::getLista();
//echo json_encode($lista);

//$search = Usuario::search("r");
//echo json_encode($search);

$usuario = new Usuario();
$usuario->login("Mauro", "@$%66");

echo $usuario;


?>