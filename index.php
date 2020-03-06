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

//$usuario = new Usuario();
//$usuario->login("Mauro", "@$%66");
//echo $usuario;

/*
$aluno = new Usuario('Corina', '12345');

//$aluno->setDeslogin("Aluno");
//$aluno->setDesSenha("@#45");
$aluno->insert();

echo $aluno;
*/

/*$aluno = new Usuario();

$aluno->loadById(19);

$aluno->update("Cardoso", "#$%76");

echo $aluno;
*/

$usuario = new Usuario();

$usuario->loadById(14);
$usuario->delete();

echo $usuario;

?>