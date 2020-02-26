<?php

spl_autoload_register(function($nome_classe){

	$filename = "class" .DIRECTORY_SEPARATOR. $nome_classe . ".php";

	if (file_exists($filename)){
		require_once($filename);
	}
});

?>