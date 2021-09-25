<?php 
session_start();
$username = "";
$senha = "";
$erro = array();
$erro_status = array();

try {
	
	$pdo = NEW PDO($_SESSION['HOST'],$_SESSION['DB_USER'],$_SESSION['DB_PASSWD']);
} catch (PDOException $e) {
	echo "Falha no erro: ".$e->getMessage();
}

if (isset($_POST['login'])) {

	$username = addslashes($_POST['username']);
	$senha = addslashes($_POST['senha']);

	if (empty($username)) {
		array_push($erro,"Por Favor, Digite seu usuario!");
	}
	if (empty($senha)) {
		array_push($erro,"Por Favor, Digite sua senha!");
	}

	if (count($erro)==0) {
		$senha = md5($senha);
		$query =$pdo->query( "SELECT us_id, us_status, us_rule FROM sis_user WHERE us_user = '$username' AND us_senha = '$senha'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if (!empty($result)) {
			if ($result['us_status'] == "2") {
				$_SESSION['us_id'] = $result['us_id'];
				$_SESSION['usuario'] = $username;
				$_SESSION['us_rule'] = $result['us_id'];
				header('Location: ../index.php');
			}else{
				array_push($erro_status,"Antes de poder acessar sua conta, voce precisa verificar seu email.");
			}
    		
		}else{
			array_push($erro,"Usuario ou senha inexistentes! Por Favor, tente novamente.");
		}
	}
}

 ?>