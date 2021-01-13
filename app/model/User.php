<?php 

use Marcio\Database\Connection;

class User 
{
	private $id;
	private $name;
	private $email;
	private $password;

	public function validateLogin()
	{

		$conn = Connection::getConn();
		//var_dump($conn);
		
		// selecionar o usuário que tenha o mesmo email informado
		$sql = 'SELECT * FROM user WHERE email = :email ';

		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':email', $this->email);
		$stmt->execute();

		if($stmt->rowCount()){
			$result = $stmt->fetch();

			if($result['password'] === $this->password ){
				$_SESSION['usr'] = array(
					'id_user'=>$result['id'],
					 'name_user'=> $result['name']);

				return true;
			}
		}
		throw new \Exception('Login inválido');
		



		//conferir senha do usuário
		//se tivet tudo certo, criar uma session e direcionar para a tela do dashboard.
		//se tiver algum erro, voltará para a tela inicial. 
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getEmail()
	{
		return $this->email;
	}


}