<?php
error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ERROR | E_PARSE);
// include('verifica_login.php');
include('conexao.php');
// include('header_novo.php');
include('Header_CSS_JS.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];
$qtd = 0;
$id_status = 2;

$nivel = $_SESSION['usuario'];
$nivel_necessario = 1;

// $sql = "SELECT `usuario`, `nivel`  FROM `usuario` WHERE (`usuario` = '" . $nivel . "') AND (`nivel` = '" . ($nivel_necessario) . "') LIMIT 1";
// $query = mysqli_query($conexao, $sql);

// if (mysqli_num_rows($query) != 1) {
//     // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
//     // echo "  Usuário ( $usuario ) sem acesso a esta página";
//     echo "<script> alert (' ( $usuario ) sem acesso a esta página!')</script>";
//     echo '<meta http-equiv="refresh" content="0;URL=index.php" />';
//     exit;
// }


?>
<form action="criar_login.php" method="POST">
<!-- Modal -->
<div class="modal fade" id="elegantModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!--Content-->
    <div class="modal-content form-elegant">
      <!--Header-->
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong> Criar Login</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body mx-4">
        <!--Body-->
        <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input name="login" type="text" id="form34" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form34">Login de acesso</label>
        </div>

        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input name="emailcriar" type="email" id="form29" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form29">E-mail para Recuperação de senha</label>
        </div>

        <input type="hidden" name="senha" value="paytec@123" id="form29" class="form-control validate">

        <div class="md-form mb-5">
          <i class="fas fa-tag prefix grey-text"></i>
          <input name="setor" type="text" id="form32" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form32">Setor</label>
        </div>

        <div class="text-center mb-3">
          <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Criar Login</button>
        </div>
        
        <div class="row my-3 d-flex justify-content-center">
         
        </div>
      </div>
      <!--Footer-->
      <div class="modal-footer mx-5 pt-3 mb-1">
        
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
</form>
<script>
    var senha = 0;

    if (senha != 1) {
        $('#elegantModalForm').modal('show');
    }
</script>


<?php


if (@empty($_POST['login'])) {
    @$login = "";
    echo "<script> alert (' ( $usuario ) o login não foi digitado')</script>";
    exit();
} else {
    if (empty($_POST['emailcriar'])) {
        $emailcriar = "";
        echo "<script> alert (' ( $usuario ) o e-mail não foi digitado')</script>";
        exit();
    } else {
        if (empty($_POST['setor'])) {
            $setor = "";
            echo "<script> alert (' ( $usuario ) o Setor não foi digitado')</script>";
            exit();
        } else {

            // $q = ("SELECT email FROM usuario WHERE `usuario` = '$usuario'");
            // $re = mysqli_query($conexao, $q);
            // $rest = mysqli_fetch_array($re);

            // if ($rest['email'] == NULL) {
                # code...
                // echo "<script> alert ('E-mail do usuario ( $usuario ) não localizado no banco de dados')</script>";
                // echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
                // exit();
            // } else {
                $email = trim($rest['email']);
                $email = trim(strtolower($email));
                $login = trim($_POST['login']);
                $login = trim(strtolower($login));
                $senha = ($_POST['senha']);
                $senha = MD5($senha);
                $emailcriar = trim($_POST['emailcriar']);
                $setor = trim($_POST['setor']);
                $setor = trim(ucfirst(strtolower($setor)));

                $inserir = "INSERT INTO `usuario`(`usuario_id`, `usuario`, `senha`, `email`, `setor`, `nivel`,`status`,`usuario_criacao`,`data_hora`)
                  VALUES (null, '$login', '$senha', '$emailcriar', '$setor', '0','1','$usuario','$datahora')";
                $conexaoinserir = mysqli_query($conexao, $inserir);

                if ($conexaoinserir) {
                    require_once('phpmailer/class.phpmailer.php');
                    $mail = new PHPMailer();
                    $assunto .= utf8_decode("<strong>Olá</strong> $usuario <br /><br />");
                    $assunto .= "<strong> Login criado para:</strong> $login <br />";
                    $assunto .= utf8_decode("<strong> Senha:</strong> paytec@123 <br />");
                    $assunto .= utf8_decode("<strong> Setor:</strong> $setor <br />");

                    $mail->IsHTML(true);
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->Port = '587';
                    $mail->SMTPSecure = 'tls';
                    $mail->Host = "smtp.hostinger.com.br";
                    $mail->Username = "contato@controle360grau.com.br";
                    $mail->Password =   "842413Ka@";
                    $mail->Subject  = utf8_decode("Criado login para: $login");
                    $mail->From = $mail->Username;
                    $mail->FromName = "Controle360grau";
                    $mail->AddAddress($emailcriar);
                    $mail->Body = "<html>
                                <head>
                                   <title>Alteração de senha</title>
                                </head>
                                <body>
                                    <font face=\"Arial\" size=\"4\" color=\"#333333\"><br />
                                        $assunto
                                    </font>			
                                </body>
                                </html>";
                    $mail->AltBody = $mail->Body;
                    $enviado = $mail->Send();

                    if ($enviado) {
                        # code...
                        echo "<script> alert ('E-mail enviado para ( $emailcriar ) com a senha e login ')</script>";
                        echo '<meta http-equiv="refresh" content="2;URL=index.php" />';

                    } else {
                        # code...
                        echo "<script> alert ('Erro ao enviar o E-mail')</script>";
                        // echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
                        // echo " (' Erro ao enviar o E-mail )";
                        exit();
                    }
                } else {
                    echo "<script> alert ('Login não criado ou já existi este login ( $login ) ')</script>";
                        echo '<meta http-equiv="refresh" content="2;URL=index.php" />';

                    exit();
                }
            // }
        }
    }
}


exit();

?>




</body>
</div>
</body>
</div>

</html>