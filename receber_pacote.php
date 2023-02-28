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

 $result = ("SELECT db1.pedido, db1.pacote, db1.nota_fiscal, COUNT(db1.pedido) as qtde_item, 
( SELECT COUNT(pedido) FROM `db` as db2 WHERE db2.pedido = db1.pedido and db2.finalizado is null and db2.deleted_at is null) as qtde_total_pedido,
( SELECT COUNT(pr.pacote) from pcp_recebido pr where pr.pacote = db1.pacote and pr.finalizado is null and pr.deleted_at is null ) as pacote_recebido,
( SELECT COUNT(pr.pedido) from pcp_recebido pr where pr.pedido = db1.pedido and pr.finalizado is null and pr.deleted_at is null ) as pedido_recebido
FROM `db` as db1
where db1.pacote = '$pacote_biper' and db1.finalizado is null and db1.deleted_at is null ");

$recebidos = mysqli_query($conexao, $result);

while ($rows = mysqli_fetch_assoc($recebidos)) {

            // print_r($rows);
            $pacote = $rows['pacote'];
            $_SESSION['pacote'] = $pacote;
            $pedido = $rows['pedido'];
            $nota_fiscal = $rows['nota_fiscal'];
            $qtde_item = $rows['qtde_item'];
            $qtde_total_pedido = $rows['qtde_total_pedido'];
            $pedido_recebido = $rows['pedido_recebido'];
            $pacote_recebido = $rows['pacote_recebido'];

         if( $pacote == "" ){
              ?>

              <form action="receber.php" method="POST">

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
                       echo '<meta http-equiv="refresh" content="3;URL=receber.php" />';
              die();
         }
        
                    if( $qtde_total_pedido == $pedido_recebido ){
                        ?>

                        <form action="receber.php" method="POST">

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
                                                            <?php echo $pedido ?>
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
                                 echo '<meta http-equiv="refresh" content="3;URL=receber.php" />';
                                 die();
                    }else{

                        if( $pacote_recebido >= 1 ){
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
                                                                    <?php echo $pacote ?>
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
                                 echo '<meta http-equiv="refresh" content="3;URL=receber.php" />';
                                 die();
                        }else{
                            $obs = strtoupper($_POST['observacao']);
                            $insert_sql = "INSERT INTO `pcp_recebido`(`id`, `pacote`, `pedido`, `nota_fiscal`, `usuario`, `data_hora`, `deleted_at`, `finalizado`, `obs`) VALUES 
                                                (NULL, '$pacote', '$pedido', '$nota_fiscal', '$usuario', '$datahora',null,null,'$obs')";
                                            $salvar = mysqli_query($conexao, $insert_sql);

                                            echo '<meta http-equiv="refresh" content="0;URL=etiqueta.php" />';
                                            
                                            
                        }

                    }

}
    
