<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../../app/filas.php");
$fila_repository = new FilaRepository();
$filas_disponiveis = $fila_repository->list_all_with_status();
var_dump(count($filas_disponiveis));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Filas do Modão | Filas Disponíveis</title>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php require("../../assets/template/topbar.php"); ?>
        <div id="layoutSidenav">
            <?php require("../../assets/template/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Filas Disponíveis</h1>
                        <hr>
                        <?php foreach ($filas_disponiveis as $queues):?>
                            <div class="row">
                                <div class="col-12">
                                    <?php
                                        $card_id = str_replace(" ","_",$queues[0]['in_name'])."_card";
                                    ?>
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-3">
                                                    <a data-toggle="collapse" href="#<?= $card_id ?>" class="collapse_btn" role="button">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </a>
                                                    
                                                </div>
                                                <div class="col-3 d-flex justify-content-end align-items-center">
                                                    <b> <?= $queues[0]['in_name']; ?> </b>
                                                    <i class="fas fa-chart-area mr-1 ml-1"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="<?= $card_id ?>">
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php foreach ($queues as $queue): ?>
                                                        <?php
                                                        $available_spots = $queue['qu_max_spots'] - $queue['qu_current_spots'];
                                                        ?>
                                                        <div class="col-xl-3 col-md-6">
                                                            <div class="card bg-primary text-white mb-4">
                                                                <div class="card-body"><?= ($available_spots > 1)? "$available_spots Vagas abertas": "$available_spots Vaga aberta";  ?> </div>
                                                                <div class="card-footer d-flex align-items-center justify-content-between">
                                                                    <a class="small text-white stretched-link" href="#" id="<?= $queue['qu_id'] ?>">Cadastrar-se</a>
                                                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            $total_queues = count($queues);
                                        ?>
                                        <div class="card-footer small text-muted"> <?= ($total_queues > 1)? "$total_queues Filas Disponíveis": "$total_queues Fila Disponível";  ?>  </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </main>
                <?php require("../../assets/template/footer.php"); ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script>
            $(".collapse_btn").on("click",function(event) {
                $(this).find('svg').toggleClass('fa-arrow-down').toggleClass('fa-arrow-up');
            });
        </script>
        
    </body>
</html>
