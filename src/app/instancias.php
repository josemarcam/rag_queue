<?php


class InstanciaRepository
{
    function __construct(){
        try {	
            $pdo = NEW PDO($_SESSION['HOST'],$_SESSION['DB_USER'],$_SESSION['DB_PASSWD']);
            $this->pdo = $pdo;
        } catch (PDOException $e) {
            echo "Falha no erro: ".$e->getMessage();
        }
    }
    function create($in_name){
        $sql = $this->pdo->query( "INSERT INTO `sis_instancia`(`in_name`) VALUES ($in_name)");
        return $sql;
    }
    
    function list_all(){
        $sql = $this->pdo->query("SELECT * FROM `sis_instance`");
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}


?>