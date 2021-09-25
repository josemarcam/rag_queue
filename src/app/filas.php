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
    
    function register_user_on_queue($qu_id,$us_id){
        
        $queue_info = $this->get_queue($qu_id);
        $queue_user_info = $this->get_queue_user($qu_id,$us_id);

        if(!$queue_user_info){
            if($queue_info['qu_current_spots'] == $queue_info['qu_max_spots'] ){
                return [false,"A fila ja esta cheia."];
            }else{
                
                $sql = $this->pdo->query( "INSERT INTO `sis_queue_user`(`qu_id`, `us_id`) VALUES ($qu_id,$us_id)");
                
                if($sql){

                    $status = 1;
                    $current_spots_updated = $queue_info['qu_current_spots'] + 1;
                    
                    if($current_spots_updated == $queue_info['qu_max_spots'] ){
                        $status = 2;
                    }
    
                    $sql = $this->pdo->query( "UPDATE `sis_queue` SET `qu_current_spots`=$current_spots_updated,`qu_status`=$status WHERE qu_id=$qu_id");
                    
                    return [true,"Você foi cadastrado na fila com sucesso!"];
                }else{
                    return [false,"Erro ao cadastrar usuario na fila. INSERT INTO `sis_queue_user`(`qu_id`, `us_id`) VALUES ($qu_id,$us_id) "];
                } 
                    
            }
        }else{
            return [false,"Você ja está cadastrado nessa fila"];
        }
    }
    
    function list_all_with_status(int $status=1){
        $sql = $this->pdo->query("SELECT * FROM `sis_queue` INNER JOIN sis_instance ON sis_queue.in_id = sis_instance.in_id WHERE qu_status = $status");
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($results){
            return $this->rearrange_queue_array($results);
        }
        return [];
    }
    
    function get_queue(int $qu_id){
        $sql = $this->pdo->query("SELECT * FROM `sis_queue` INNER JOIN sis_instance ON sis_queue.in_id = sis_instance.in_id WHERE qu_id = $qu_id");
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result){
            return $result;
        }
        return False;
    }
    
    function get_my_queues(){
        $us_id = $_SESSION['us_id'];
        $sql = $this->pdo->query("SELECT * FROM `sis_queue_user` 
            INNER JOIN sis_queue ON sis_queue_user.qu_id = sis_queue.qu_id
            INNER JOIN sis_instance ON sis_queue.in_id = sis_instance.in_id
            WHERE sis_queue_user.us_id = $us_id ");
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($results){
            return $this->rearrange_queue_array($results);
        }
        return False;
    }
    
    function get_queue_user(int $qu_id, int $us_id){
        $sql = $this->pdo->query("SELECT * FROM `sis_queue_user` WHERE qu_id = $qu_id AND us_id = $us_id");
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result){
            return $result;
        }
        return False;
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