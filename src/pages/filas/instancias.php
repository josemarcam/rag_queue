<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../../app/instancias.php");

if(isset($_POST['submit'])){
    $instancia_repository = new InstanciaRepository();
    unset($_POST["submit"]);
    $args = array_values($_POST);
    $sql_return = $instancia_repository->create(...$args);
}

if(isset($_POST['delete_instance'])){
    
    $referer = $_SERVER['HTTP_REFERER'];
    $domain = parse_url($referer);
    
    if($domain['host'] == $_SESSION['DOMAIN']){

        $instancia_repository = new InstanciaRepository();
        $delete_return = $instancia_repository->delete($_POST['delete_instance']);
    }

}

if(isset($_POST['edit_instance'])){
    
    $referer = $_SERVER['HTTP_REFERER'];
    $domain = parse_url($referer);
    
    if($domain['host'] == $_SESSION['DOMAIN']){

        $instancia_repository = new InstanciaRepository();
        $edit_return = $instancia_repository->edit($_POST['edit_instance'],$_POST['in_name']);
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
        <title>Filas do Modão | Gestão de instâncias</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php require("../../assets/template/topbar.php"); ?>
        <div id="layoutSidenav">
            <?php require("../../assets/template/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Gestão de instâncias </h1>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Nova Fila
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action='instancias.php'>
                                            <div class="form-row">
                                                <div class="col-md">
                                                    <label for="inputPassword" class='form-label'> <b> Nome da Instância </b></label>
                                                    <input class="form-control py-4" id="inputPassword" type="text" name='in_name' />
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <button class="btn btn-primary btn-block" type="submit" name='submit'>
                                                    Criar Instância
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer small text-muted"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Lista de instâncias
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer small text-muted"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php require("../../assets/template/footer.php"); ?>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Remover Instância</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body">
                            <p>Tem certeza que quer remover a instância?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="instancias.php" method="post">
                                <button type="submit" id="in_btn_delete" name='delete_instance' value="" class="btn btn-primary">Deletar Instância</button>
                            </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="editModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Instância</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <form action="instancias.php" method="post">
                            <div class="modal-body">
                                <input type="text" required name="in_name" id="" placeholder="Novo nome da instância" class="form-control">
                            </div>
                            <div class="modal-footer">
                                    <button type="submit" id="in_btn_edit" name='edit_instance' value="" class="btn btn-primary">Editar Instância</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- <script src="../../js/scripts.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script>
            <?php if(isset($delete_return)): ?>
                <?php if($delete_return): ?>
                    toastr.success('A instância foi deletada com sucesso', 'Deletado com sucesso!', {timeOut: 3000})
                <?php endif; ?>
                <?php if(!$delete_return): ?>
                    toastr.error('Erro ao deletar instância, por favor entre em contato com o suporte', 'Erro ao deletar', {timeOut: 3000})
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if(isset($sql_return)): ?>
                <?php if($sql_return): ?>
                    toastr.success('A instância foi criada com sucesso', 'Criado com sucesso!', {timeOut: 3000})
                <?php endif; ?>
                <?php if(!$sql_return): ?>
                    toastr.error('Erro ao criar instância, por favor entre em contato com o suporte', 'Erro ao criar', {timeOut: 3000})
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if(isset($edit_return)): ?>
                <?php if($edit_return): ?>
                    toastr.success('A instância foi editada com sucesso', 'Editado com sucesso!', {timeOut: 3000})
                <?php endif; ?>
                <?php if(!$edit_return): ?>
                    toastr.error('Erro ao editar instância, por favor entre em contato com o suporte', 'Erro ao editar', {timeOut: 3000})
                <?php endif; ?>
            <?php endif; ?>
        </script>
        <script>
            
            let data;
            data = {
                "action":"get_instances"
            }
            $.ajax({
                url: "../../app/ajax/instancias.php",
                data: data,
                type:"POST",
            }).done(function(ret) {
                    
                json_ret = $.parseJSON(ret);
                
                $('#dataTable').DataTable({
                    data:json_ret,
                    columns: [
                        { data: 'in_name' },
                        { data: 'action_html' }
                    ],
                    order: [],
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json'
                    },
                    responsive: true,
                    initComplete: function(settings, json) {
                        $(".delete-btn").on("click",function (params) {
                            $("#deleteModal").modal('show')
                            
                            let in_id = $(this).attr("id")
                            $("#in_btn_delete").val(in_id)
                            console.log($("#in_btn_delete").val())
                        });
                        
                        $(".edit-btn").on("click",function (params) {
                           $("#editModal").modal('show')
                           
                           let in_id = $(this).attr("id")
                            $("#in_btn_edit").val(in_id)
                            console.log($("#in_btn_edit").val())
                        });
                    }
                })

            });
            
                
        </script>
    </body>
</html>
