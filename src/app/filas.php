<?php

class FilaRepository
{
    function __construct(){
        try {	
            $pdo = NEW PDO($_SESSION['HOST'],$_SESSION['DB_USER'],$_SESSION['DB_PASSWD']);
            $this->pdo = $pdo;
        } catch (PDOException $e) {
            echo "Falha no erro: ".$e->getMessage();
        }
    }
    function create($in_id,$qu_max_spots,$qu_status,$qu_current_spots=0){
        $sql = $this->pdo->query( "INSERT INTO `sis_queue`(`in_id`, `qu_max_spots`, `qu_current_spots`, `qu_status`) VALUES ($in_id,$qu_max_spots,$qu_current_spots,$qu_status)");
        return $sql;
    }
}


?>