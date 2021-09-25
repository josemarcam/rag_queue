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
        $sql = $this->pdo->query( "INSERT INTO `sis_instance`(`in_name`) VALUES (\"$in_name\")");
        return $sql;
    }
    
    function delete(int $in_id){
        $sql = $this->pdo->query( "DELETE FROM `sis_instance` WHERE in_id = $in_id");
        return $sql;
    }
    
    function edit(int $in_id, string $in_name){
        $sql = $this->pdo->query( "UPDATE `sis_instance` SET in_name=\"$in_name\" WHERE in_id = $in_id");
        return $sql;
    }
    
    function list_all(){
        $sql = $this->pdo->query("SELECT * FROM `sis_instance` ORDER BY in_id DESC");
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($results){
            return $results;
        }
        return [];
    }
}


?>