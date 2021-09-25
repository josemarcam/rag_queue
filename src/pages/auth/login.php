<?php
session_start();
require('../../app/login.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Filas do Modão | Login</title>
        <link href="../../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                        <?php if(count($erro) > 0):  ?>
                                            <div>
                                                <?php foreach ($erro as $err):?>
                                                    <p class="text-danger">* <?php echo $err; ?></p>	
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif  ?>
                                        <?php if(count($erro_status) > 0):  ?>
                                            <div>
                                                <?php foreach ($erro_status as $err_status):?>
                                                    <p class="text-danger">* <?php echo $err_status; ?></p>	
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <form method='POST' action='login.php'>
                                            <div class="form-group">
                                                <!-- <label class="small mb-1" for="inputEmailAddress">Usuario</label> -->
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name='username' placeholder="Usuario" />
                                            </div>
                                            <div class="form-group">
                                                <!-- <label class="small mb-1" for="inputPassword">Senha</label> -->
                                                <input class="form-control py-4" id="inputPassword" type="password" name='senha' placeholder="Senha" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Forgot Password?</a>
                                                <button class='btn btn-success' name='login' type='submit'>Login</button> 
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php require("../../assets/template/footer.php"); ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script>
            <?php if(isset($_SESSION['us_id'])): ?>
                window.location.replace("index.php");
            <?php endif; ?>
        </script>
    </body>
</html>
