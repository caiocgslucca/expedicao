<?php
use Symfony\Component\Console\Input\Input;
include('conexao.php');
include('verifica_login.php');
date_default_timezone_set('America/Recife');
include('Header_CSS_JS.php');
$datahora = (date('Y-m-d H:i:s'));
$usuario = $_SESSION['usuario'];
$status = 1;


 $pacote_biper  =  $_POST['biper'];

 $result = ("SELECT db1.*, COUNT(db1.nro_pedido) as qtde_item, 
( SELECT COUNT(db2.nro_pedido) FROM `expedicao` as db2 WHERE db2.nro_pedido = db1.nro_pedido and db2.finalizado is null and db2.deleted_at is null) as qtde_total_pedido,
( SELECT COUNT(pr.nro_etiqueta) from expedicao_recebido pr where pr.nro_etiqueta = db1.nro_etiqueta and pr.finalizado is null and pr.deleted_at is null ) as nro_etiqueta_recebido,
( SELECT COUNT(pr.nro_pedido) from expedicao_recebido pr where pr.nro_pedido = db1.nro_pedido and pr.finalizado is null and pr.deleted_at is null ) as pedido_recebido
FROM `expedicao` as db1
where db1.nro_etiqueta = '$pacote_biper' and db1.finalizado is null and db1.deleted_at is null ");

$recebidos = mysqli_query($conexao, $result);

// echo $result;
// exit();

while ($rows = mysqli_fetch_assoc($recebidos)) {

            // print_r($rows);
            // exit();
            $nro_documento = $rows['nro_documento'];
            $nro_pedido = $rows['nro_pedido'];
            $nro_etiqueta = $rows['nro_etiqueta'];
            $dt_recebimento = $rows['dt_recebimento'];
            $nro_romaneio_expedicao = $rows['nro_romaneio_expedicao'];
            $qtde_volumes = $rows['qtde_volumes'];
            $qtde_itens = $rows['qtde_itens'];
            $status = $rows['status'];
            $unidade_atual = $rows['unidade_atual'];
            $nome_pessoa_visita = $rows['nome_pessoa_visita'];

            $qtde_total_pedido = $rows['qtde_total_pedido'];
            $nro_etiqueta_recebido = $rows['nro_etiqueta_recebido'];
            $pedido_recebido = $rows['pedido_recebido'];
           

         if( $nro_etiqueta == "" ){
              ?>

              <form action="receber_romaneio" method="POST">

                  <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header text-center">
                                  <h4 class="modal-title w-100 font-weight-bold">Erro</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body mx-3">
                                  <div class="md-form mb-5">
                                      <div class="alert alert-danger text-center " role="alert">
                                          <h1> <b> Pacote não localizado na base: </b>
                                              <p>
                                                  <?php echo $pacote_biper ?>
                                              </p> 
                                          </h1>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer d-flex justify-content-center">
                                  <!-- <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button> -->
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
              <script>
                  var senha = 0;

                  if (senha != 1) {
                      $('#modalSubscriptionForm').modal('show');
                  }
              </script>
          <?php
                       echo '<meta http-equiv="refresh" content="1;URL=recebido_romaneio" />';
              die();
         }else{
        
                    if( $qtde_total_pedido == $pedido_recebido ){
                        ?>

                        <form action="receber_romaneio" method="POST">

                            <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title w-100 font-weight-bold">Erro</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-3">
                                            <div class="md-form mb-5">
                                                <div class="alert alert-danger text-center " role="alert">
                                                    <h1> <b> Todos os itens Recebido do pedido: </b>
                                                        <p>
                                                            <?php echo $nro_pedido ?>
                                                        </p> 
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <!-- <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            var senha = 0;

                            if (senha != 1) {
                                $('#modalSubscriptionForm').modal('show');
                            }
                        </script>
                    <?php
                                 echo '<meta http-equiv="refresh" content="1;URL=receber_romaneio" />';
                                 die();
                    }else{

                        // print_r( "nro_etiqueta_recebido: ". $nro_etiqueta_recebido);
                        // die();
                        if( $nro_etiqueta_recebido >= 1 ){
                            ?>

                                <!-- <form action="receber.php" method="POST"> -->

                                    <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">Erro</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body mx-3">
                                                    <div class="md-form mb-5">
                                                        <div class="alert alert-danger text-center " role="alert">
                                                            <h1> <b> Pacote já inserido: </b>
                                                                <p>
                                                                    <?php echo $nro_etiqueta ?>
                                                                </p> 
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <!-- <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                                <script>
                                    var senha = 0;

                                    if (senha != 1) {
                                        $('#modalSubscriptionForm').modal('show');
                                    }
                                </script>
                            <?php
                                 echo '<meta http-equiv="refresh" content="1;URL=receber_romaneio" />';
                                 die();
                        }else{
                            $obs = strtoupper($_POST['observacao']);

                            $insert_sql = "INSERT INTO `expedicao_recebido`  VALUES 
                                                (null, 
                                                '$nro_documento',
                                                '$nro_pedido',
                                                '$nro_etiqueta',
                                                '$dt_recebimento',
                                                '$nro_romaneio_expedicao',
                                                '$qtde_volumes',
                                                '$qtde_itens',
                                                '$status',
                                                '$unidade_atual',
                                                '$nome_pessoa_visita',
                                                 null,
                                                '$usuario',
                                                '$datahora',
                                                 null,
                                                '$obs'
                                                 )";
                                            $salvar = mysqli_query($conexao, $insert_sql);
                                            // echo $insert_sql;
                                            echo '<meta http-equiv="refresh" content="0;URL=receber_romaneio" />';
                                            
                                            
                        }

                    }

}
}
    
