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
		$sql = new Sql();

		$resultado = $sql->select("select * from tb_usuarios where idusuario = :ID", array(
			"ID"=>$id));

		if (count($resultado) > 0){
			$this->setData($resultado[0]);
		}
	}

	public static function getLista(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			'SEARCH'=>"%".$login."%"));
	}

	public function login($login, $senha){
		$sql = new Sql();

		$resultado = $sql->select("select * from tb_usuarios where deslogin = :LOGIN AND dessenha = :SENHA", array(
			"LOGIN"=>$login,
			"SENHA"=>$senha));

		if (count($resultado) > 0){

			$this->setData($resultado[0]);
		}
		else {
			throw new Exception("Login e/ou senha inválidos.", 1);
			
		}
	}

	public function setData($dado){
			$this->setIdUsuario($dado['idusuario']);
			$this->setDesLogin($dado['deslogin']);
			$this->setDesSenha($dado['dessenha']);
			$this->setDtCadastro(new DateTime($dado['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuario_insert(:LOGIN, :SENHA)", array(
			"LOGIN"=>$this->getDesLogin(),
			"SENHA"=>$this->getDesSenha()
		));

		if (count($results) > 0){
			$this->setData($results[0]);
		}
	}

	public function update($login, $senha){
		$this->setDesLogin($login);
		$this->setDesSenha($senha);

		$usuario = new Sql();
		$usuario->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(
		"LOGIN"=>$this->getDesLogin(),
		"SENHA"=>$this->getDesSenha(),
		"ID"=>$this->getIdUsuario())
	);
	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setDesLogin("");
		$this->setDesSenha("");
		$this->setDtCadastro(new DateTime());
	}

	public function __construct($login = "", $senha = ""){
		$this->setDesLogin($login);
		$this->setDesSenha($senha);
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