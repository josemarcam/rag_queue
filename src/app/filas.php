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
    
    function create($qu_max_spots,$in_id,$qu_status,$qu_current_spots=0){
        $sql = $this->pdo->query( "INSERT INTO `sis_queue`(`in_id`, `qu_max_spots`, `qu_current_spots`, `qu_status`) VALUES ($in_id,$qu_max_spots,$qu_current_spots,$qu_status)");
        return $sql;
    }
    
    function list_all_with_status(int $status=1){
        $sql = $this->pdo->query("SELECT * FROM `sis_queue` INNER JOIN sis_instance ON sis_queue.in_id = sis_instance.in_id WHERE qu_status = $status");
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($results){
            return $this->rearrange_queue_array($results);
        }
        return [];
    }
    function rearrange_queue_array($queue_arr){
        $new_arr = array();
        foreach ($queue_arr as $element) {
            $new_arr[$element['in_name']][] = $element;
        }
        return $new_arr;
    }
}


?>