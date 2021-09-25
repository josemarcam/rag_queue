<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../../app/filas.php");
require_once("../../app/instancias.php");


$instancia_repository = new InstanciaRepository();
$instancia_list = $instancia_repository->list_all();

if(isset($_POST['submit'])){
    
    $referer = $_SERVER['HTTP_REFERER'];
    $domain = parse_url($referer);
    if($domain['host'] == $_SESSION['DOMAIN']){
        $fila_repository = new FilaRepository();
        unset($_POST["submit"]);
        $args = array_values($_POST);
        $sql_return = $fila_repository->create(...$args);
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Filas do Modão | Cadastro de fila</title>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        <?php require("../../assets/template/topbar.php"); ?>
        <div id="layoutSidenav">
            <?php require("../../assets/template/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Cadastro de filas </h1>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Nova Fila
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action='cadastro-filas.php'>
                                            <div class="form-row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="inputPassword" class='form-label'><b> Vagas Abertas </b></label>
                                                        <input class="form-control py-4" id="inputPassword" min='1' value='1' type="number" name='qu_max_spots' />
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <label for="inputPassword" class='form-label'> <b> Instâncias dispovívels </b></label>
                                                    <select name="in_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                        <?php foreach ($instancia_list as $key): ?>
                                                            <option value="<?= $key['in_id'] ?>"><?= $key['in_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="inputPassword" class='form-label'> <b> Status Inicial da Fila </b></label>
                                                    <select name="qu_status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                        <option value="1">Aberta</option>
                                                        <option value="2">Pausada</option>
                                                        <option value="3">Fechada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <button class="btn btn-primary btn-block" type="submit" name='submit'>
                                                    Criar Fila
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer small text-muted"></div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </main>
                <?php require("../../assets/template/footer.php"); ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script>
            <?php if(isset($sql_return)): ?>
                <?php if($sql_return): ?>
                    toastr.success('A fila foi cadastrada com sucesso', 'Cadastrado com sucesso!', {timeOut: 3000})
                <?php endif; ?>
                <?php if(!$sql_return): ?>
                    toastr.error('Erro ao cadastrar fila, por favor entre em contato com o suporte', 'Erro ao cadastrar', {timeOut: 3000})
                <?php endif; ?>
            <?php endif; ?>
        </script>
    </body>
</html>
