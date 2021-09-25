<?php
require('../../app/register.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Fila Modão | Cadastro</title>
        <link href="../../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Criação de conta</h3>
                                        <?php if(count($erros) > 0):  ?>
                                            <div>
                                                <?php foreach ($erros as $err):?>
                                                    <p class="text-danger">* <?php echo $err; ?></p>	
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif;  ?>
                                    </div>
                                        <div class="card-body">
                                            <form method="POST" action='register.php'>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control py-4" id="inputPassword" type="email" name='email' placeholder="Email" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control py-4" id="inputConfirmPassword" type="text" name='username' placeholder="Usuario" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control py-4" id="inputPassword" type="password" name='senha-1' placeholder="Senha" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control py-4" id="inputConfirmPassword" type="password" name='senha-2' placeholder="Confirmação da senha" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-4 mb-0">
                                                    <button class="btn btn-primary btn-block" name='register'>
                                                        Criar Conta
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Já tem conta? Vá para o Login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php require("../assets/template/footer.php"); ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
    </body>
</html>
