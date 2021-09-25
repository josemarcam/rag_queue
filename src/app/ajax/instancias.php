<?php
session_start();
require('../instancias.php');

$referer = $_SERVER['HTTP_REFERER'];
$domain = parse_url($referer);

if (isset($_POST['action']) && $domain['host'] == $_SESSION['DOMAIN']) {
    $instance_repository = new InstanciaRepository();
    $list_instances = $instance_repository->list_all();
    $clean_list = array();
    foreach ($list_instances as $instance) {
        $instance_dict = array();
        $instance_dict['in_name'] = $instance['in_name'];
        $in_id = $instance['in_id'];
        
        $instance_dict['action_html'] = "<div class=\"row\">
        <div class=\"col-6 d-flex justify-content-center\">
            <button class=\"btn btn-sm btn-info text-white edit-btn\" id=\"$in_id\">Editar</button>
        </div>
        <div class=\"col-6 d-flex justify-content-center\">
            <button class=\"btn btn-sm btn-danger delete-btn \" id=\"$in_id\">Excluir</button>
        </div>
    </div>";
        array_push($clean_list,$instance_dict);
    }
    echo json_encode($clean_list);
}

?>