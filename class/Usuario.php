<?php

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($value){
		$this->idusuario = $value;
	}

	public function getDesLogin(){
		return $this->deslogin;
	}

	public function setDesLogin($value){
		$this->deslogin = $value;
	}

	public function getDesSenha(){
		return $this->dessenha;
	}

	public function setDesSenha($value){
		$this->dessenha = $value;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){
		$sql = new SQL();

		$resultado = $sql->select("select * from tb_usuarios where idusuario = :ID", array(
			"ID"=>$id));

		if (count($resultado) > 0){

			$row = $resultado[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
	}

	public static function getLista(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new SQL();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			'SEARCH'=>"%".$login."%"));
	}

	public function login($login, $senha){
		$sql = new SQL();

		$resultado = $sql->select("select * from tb_usuarios where deslogin = :LOGIN AND dessenha = :SENHA", array(
			"LOGIN"=>$login,
			"SENHA"=>$senha));

		if (count($resultado) > 0){

			$row = $resultado[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
		else {
			throw new Exception("Login e/ou senha inválidos.", 1);
			
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"deslogin"=>$this->getDesLogin(),
			"dessenha"=>$this->getDesSenha(),
			"dtcadastro"=>$this->getDtCadastro()->format('d/m/Y H:i:s')
		));
	}
}

?>