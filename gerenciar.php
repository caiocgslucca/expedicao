<?php
// error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
// session_start();
include('header_novo.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
include('conexao.php');
$data = date("d/m/Y");
?>
<title>Gerenciar</title>

<form action="salvar_destino.php" method="POST">

<ul class="nav nav-tabs justify-content-center lighten-4 py-4">
        <li class="nav-item">
            <a class="nav-link " href="destino.php">Produtividade</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active " href="gerenciar.php">Gerenciar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="historico.php">Historico</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="receber.php">Receber</a>
        </li>

    </ul>

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Novo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-tag prefix grey-text"></i>
          <input autofocus="" type="text" id="defaultForm-text" name="destino" class="form-control validate" required="" >
          <label data-error="wrong" data-success="right" for="defaultForm-email">Destino</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default">Salvar</button>
      </div>
    </div>
  </div>
</div>

<div class="text-center">
  <a href="" type="submit" class="btn btn-info btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Novo destino</a>
</div>
</form>
        <form id="add_form" action="alterar_destino.php" class="card ml-3 p-3" enctype="multipart/form-data" method="POST">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <!-- <th class="th-sm">Acesso
                        </th> -->
                        <th class="th-sm">Destino
                        </th>
                        <th class="th-sm">Usuário
                        </th>
                        <th class="th-sm">Data hora
                        </th>
                        <th class="th-sm">Status
                        </th>
                        <th class="th-sm">Farol
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result_usuarios = ("SELECT * FROM `pcp_destino`");
                    $recebidos = mysqli_query($conexao, $result_usuarios);
                    $index = 0;
                    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                        if ($row_usuario['status'] == 1) {
                            $status = "Ativo";
                        } else {
                            $status = "Desativado";
                        }
                    ?>
                        <tr>

                            <td>
                                <?php echo $row_usuario['destino']?>
                            </td>
                            <td>
                                <?php echo $row_usuario['usuario']?>
                            </td>
                            <td>
                                 <?php echo date('d/m/Y H:i:s', strtotime($row_usuario['data_hora'])) ?>
                                 </td>
                            <input name="pecadetalhe[<?= $index ?>][id]" class="input is-large" value="<? echo $row_usuario['id']?>" type="hidden">

                            <td>
                            
                                <select id="inputState" class="browser-default custom-select" name="pecadetalhe[<?= $index ?>][status]" class="col-md-12 p-0" data-live-search="true">
                                    <option selected disabled><?php echo $status ?></option>

                                    <?php if ($row_usuario['status'] <= 0) {
                                    ?> <option value='1'> <?php echo "Ativar"; ?></option> <?php
                                                                                } else {
                                                                                    ?> <option value='0'> <?php echo "Desativar"; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <?php

                                ?>
                                <?php if ($row_usuario['status'] <= 0) {
                                ?> <a class="logo"><img src="/images-on-off/off.png" height="40" width="40" /> </a> <?php
                                                                                                        } else {
                                                                                                            ?> <a class="logo"><img src="/images-on-off/on.png" height="40" width="40" /> </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                        $index++;
                    }
                    ?>
                </tbody>

            </table>
            <div class="container-fluid">
                    <div class="row">
                        <div class="card card-info">
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-block btn-success">Salvar Alterações</button>
                                </td>
                            </tr>
                        </div>
                    </div>
                </div>
        </form>
    </head>
</div>
</html>
<br><br>