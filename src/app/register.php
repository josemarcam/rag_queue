<?php
session_start();
$erros = array();

try {
	$pdo = NEW PDO($_SESSION['HOST'],$_SESSION['DB_USER'],$_SESSION['DB_PASSWD']);
} catch (PDOException $e) {
	echo "Falha no erro: ".$e->getMessage();
}

if(isset($_POST["register"])){

    $username = addslashes($_POST["username"]);
    $email = addslashes($_POST["email"]);
    $senha_1 = addslashes($_POST["senha-1"]);
    $senha_2 = addslashes($_POST["senha-2"]);

    if(empty($username)){
    array_push($erros, "É preciso preencher o campo de usuário");
    }

    if(empty($email)){
    array_push($erros, "É preciso preencher o campo de email");
    }

    if(empty($senha_1)){
    array_push($erros, "É preciso preencher o campo de Senha");
    }

    if($senha_1 != $senha_2 ){
    array_push($erros, "As senhas não coincidem");
    }

    $dados_rc_us = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    $dados_st_us = array_map('strip_tags', $dados_rc_us);
    $dados_us = array_map('trim', $dados_st_us);
    $select_us = $pdo->query("SELECT us_user FROM sis_user WHERE us_user = '".$dados_us['username']."'");
    $result_us = $select_us->fetch(PDO::FETCH_ASSOC);

    if (!empty($result_us['us_user']) ) {
        array_push($erros, "Usuario ja em uso, por favor, escolha outro!");
    }


    $dados_rc_em = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    $dados_st_em = array_map('strip_tags', $dados_rc_em);
    $dados_em = array_map('trim', $dados_st_em);
    $select_em = $pdo->query("SELECT us_email FROM sis_user WHERE us_email = '".$dados_em['email']."'");
    $result_em = $select_em->fetch(PDO::FETCH_ASSOC);
    
    if (!empty($result_em['us_email']) ) {
        array_push($erros, "E-mail ja em uso, por favor, escolha outro!");
    }

    //if there is no erros, just save user on database
    if(count($erros)==0){

            $senha = md5($senha_1);
            
            $sql =$pdo->query( "INSERT INTO  sis_user(us_user,us_email,us_senha,us_status,us_rule) VALUES ('$username','$email','$senha',2,1)");
            
            if(!$sql){
                array_push($erros, "Erro ao Regisrar usuario, entre em contato com a equipe de suporte!");
            }else{
                $_SESSION['usuario'] = $username;
                $_SESSION['sucesso'] = "Registro";
                header('location: ../index.php');
            }
                
            // include_once "PHPMailer/PHPMailer.php";

            // $mail = new PHPMailer();
            // // Escrevendo o email
            // $id = $pdo->lastInsertId();
            // $md5 = md5($id);
            // $link = "cobrancax.com.br/sis_accont/comp_perfil.php?h=".$md5;

            // $mail->setFrom('contato@cobrancax.com.br');
            // $mail->addAddress($email);
            // $mail->Subject = "Verifique seu email!";
            // $mail->isHTML(true);
            // $mail->Body ="<h3> Parabens! voce esta quase la!</h3><br>
            // <p> Para confirmar seu email e continuar seu cadastro, <a href='http://cobrancax.com.br/sis_accont/comp_perfil.php?h=$md5'> Clique aqui</a></p>
            // ";
            // $mail->send();

            //Redirecionamento e captura de informações

            $_SESSION['usuario'] = $username;
            $_SESSION['sucesso'] = "Registro";
            // header('location: ../index.php');

    }
}

?>