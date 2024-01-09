<?php
session_start();
?>


<!doctype html>
<html lang="en">

<head>
        
        <meta charset="utf-8" />
        <title>ROTAS - TMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="src/assets/images/logo.png">

        <!-- Bootstrap Css -->
        <link href="src/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="src/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="src/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>


    <body class="bg-login">

        <div class="auth-page d-flex align-items-center min-vh-100">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                            <div class="d-flex flex-column h-100 py-5 px-4">
                                <div class="text-center text-muted mb-2">
                                    <div class="pb-3">
                                        <a href="index.html">
                                            <span class="d-flex align-items-center justify-content-center logo-lg">
                                                <img src="src/assets/images/logo.png" alt="" height="30"> <span class="logo-txt">ROTAS</span>
                                            </span>
                                        </a>
                                        <p class="logo-text-p text-black font-size-14 w-75 mx-auto mt-3 mb-0"> Roteirização e acompanhamento de coletas </p>
                                    </div>
                                </div>
         
         
                            </div>
                        
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
    
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                            <div class="bg-overlay-gradient"></div>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center g-0 align-items-center w-100">
                                <div class="col-xl-4 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="px-3 py-3">
                                                <div class="text-center">
                                            <img width="100px" src="src/assets/images/logo.png" alt="">

                                                    <h1 class="logo-name-text mb-0">ROTAS</h1>
                                                    <p class="text-muted mt-2"></p>
                                                </div>
                                                <form method="POST" action="src/functions/autenticarUsuario.php" class="mt-4 pt-2">
                                                    <div class="form-floating form-floating-custom mb-3">
                                                        <input type="text" class="form-control"  name="email"  id="input-username" placeholder="Insira email">
                                                        <label for="input-username">Usuário</label>
                                                        <div class="form-floating-icon">
                                                            <i class="uil uil-users-alt"></i>
                                                        </div>
                                                    </div>
                                                    <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                                        <input name="password" type="password" class="form-control" id="password-input" placeholder="Insira sua senha">
                                                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                        </button>
                                                        <label for="password-input">Senha</label>
                                                        <div class="form-floating-icon">
                                                            <i class="uil uil-padlock"></i>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-check-primary font-size-16 py-1">
                                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                                        <div class="float-end">
                                                            <a href="auth-resetpassword-basic.html" class="text-muted text-decoration-underline font-size-14">esqueceu a senha ?</a>
                                                        </div>
                                                        <label class="form-check-label font-size-14" for="remember-check">
                                                           Lembrar de mim
                                                        </label>
                                                    </div>
                                                    <?php
                                                    if (isset($_SESSION['erros_login'])) {
                                                        foreach ($_SESSION['erros_login'] as $erro) {
                                                        echo '<strong>' . $erro . '</strong> <br>';
                                                        }
                                                        unset($_SESSION['erros_login']);
                                                    }
                                                    ?>
                                                    <div class="mt-3">
                                                        <button class="btn btn-primary w-100" type="submit">Logar</button>
                                                    </div>
                                                </form><!-- end form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>
        <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        <script src="src/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="src/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="src/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="src/assets/libs/feather-icons/feather.min.js"></script>

        <script src="src/assets/js/pages/pass-addon.init.js"></script>

    </body>
</html>
