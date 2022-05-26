<?php
error_reporting(E_ALL);
session_start();
include('Header_CSS_JS.php');

?>

<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm"> <img src="./images-on-off/logo_trocafone_2.png" width="900%" height="900%" class="img-fluid z-depth-1" alt="Responsive image"> </div>
    <div class="col-sm"></div>
</div>

<form action="login.php" method="POST">
    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100 font-weight-bold">
                        <a class="logo"><img src="./images-on-off/logo_trocafone_2.png" height="120" width="380" /></a>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">PCP</h4>
                </div>
                <?php
                if (isset($_SESSION['nao_autenticado'])) :
                ?>
                    <div class="alert alert-danger text-center " role="alert">
                        ERRO: Usuário ou senha inválidos.
                    </div>
                <?php
                endif;
                unset($_SESSION['nao_autenticado']);
                ?>

                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input required name="usuario" type="text" id="form34" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="form34">Seu login</label>
                    </div>

                    <div class="md-form mb-5">
                        <i class="fas fa-lock prefix grey-text"></i>
                        <input required="" name="senha" type="password" id="orangeForm-pass" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="orangeForm-pass">Sua senha</label>
                    </div>
                    <div class="md-form pb-3">
                        <p class="font-small blue-text d-flex justify-content-end">Esquceu<a href="perdipassword.php" class="blue-text ml-1">
                                a senha?</a></p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-unique">Acessar<i class="fas fa-paper-plane-o ml-1"></i></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var senha = 0;

        if (senha != 1) {
            $('#modalContactForm').modal('show');
        }
    </script>
</form>