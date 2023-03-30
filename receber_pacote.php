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

//  $result = ("SELECT db1.pedido, db1.pacote, db1.nota_fiscal, COUNT(db1.pedido) as qtde_item, 
// ( SELECT COUNT(pedido) FROM `db` as db2 WHERE db2.pedido = db1.pedido and db2.finalizado is null and db2.deleted_at is null) as qtde_total_pedido,
// ( SELECT COUNT(pr.pacote) from pcp_recebido pr where pr.pacote = db1.pacote and pr.finalizado is null and pr.deleted_at is null ) as pacote_recebido,
// ( SELECT COUNT(pr.pedido) from pcp_recebido pr where pr.pedido = db1.pedido and pr.finalizado is null and pr.deleted_at is null ) as pedido_recebido
// FROM `db` as db1
// where db1.pacote = '$pacote_biper' and db1.finalizado is null and db1.deleted_at is null ");

$result = ("SELECT producao.pacote, expedicao.*, expedicao.status as 'status_expedicao', producao.pedido, producao.nota_fiscal, COUNT(producao.pedido) as qtde_item,
case WHEN recebido.pacote <> '' THEN 'Recebido' ELSE 'Faltando Receber ' END 'EAD Status',
case WHEN expedicao.nro_etiqueta = producao.pacote THEN 'Na base Romaneio' ELSE 'Faltando na Base Romaneio' END 'Status Base Romaneio',
case WHEN expedicao_recebido.nro_etiqueta <> '' THEN 'Recebido Romaneio' ELSE 'Faltando Receber Romaneio' END 'Romaneio Status',
( SELECT COUNT(pedido) FROM `db` as db2 WHERE db2.pedido = producao.pedido and db2.finalizado is null and db2.deleted_at is null) as qtde_total_pedido,
( SELECT COUNT(pr.pacote) from pcp_recebido pr where pr.pacote = producao.pacote and pr.finalizado is null and pr.deleted_at is null ) as pacote_recebido,
( SELECT COUNT(pr.pedido) from pcp_recebido pr where pr.pedido = producao.pedido and pr.finalizado is null and pr.deleted_at is null ) as pedido_recebido
FROM `db` as producao 
LEFT OUTER JOIN `pcp_recebido` as recebido on recebido.pacote = producao.pacote and recebido.deleted_at IS NULL and recebido.finalizado IS NULL
LEFT OUTER JOIN `expedicao` as expedicao on expedicao.nro_etiqueta = producao.pacote and expedicao.deleted_at IS NULL and expedicao.finalizado IS NULL
LEFT OUTER JOIN `expedicao_recebido` as expedicao_recebido on expedicao_recebido.nro_etiqueta = expedicao.nro_etiqueta and expedicao_recebido.deleted_at IS NULL and expedicao_recebido.finalizado IS NULL
WHERE producao.pacote = '$pacote_biper' and producao.deleted_at IS NULL and producao.finalizado IS NULL;");

$recebidos = mysqli_query($conexao, $result);

while ($rows = mysqli_fetch_assoc($recebidos)) {

            // print_r($rows);
           
        //  die();
            $pacote = $rows['pacote'];
            $_SESSION['pacote'] = $pacote;
            $pedido = $rows['pedido'];
            $nota_fiscal = $rows['nota_fiscal'];
            $qtde_item = $rows['qtde_item'];
            $qtde_total_pedido = $rows['qtde_total_pedido'];
            $pedido_recebido = $rows['pedido_recebido'];
            $pacote_recebido = $rows['pacote_recebido'];
            $Status_Base_Romaneio = $rows['Status Base Romaneio'];
            

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
                       echo '<meta http-equiv="refresh" content="1;URL=receber" />';
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
                                 echo '<meta http-equiv="refresh" content="1;URL=receber" />';
                                 die();
                    }else{

                        if( $pacote_recebido >= 1 ){
                            ?>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                <script>
                                    var senha = 0;

                                    if (senha != 1) {
                                        $('#modalSubscriptionForm').modal('show');
                                    }
                                </script>
                            <?php
                                 echo '<meta http-equiv="refresh" content="1;URL=receber" />';
                                 die();
                        }else{

                            if( $Status_Base_Romaneio == "Na base Romaneio" ){

                                $obs = strtoupper($_POST['observacao']);

                                $nro_documento = $rows['nro_documento'];
                                $nro_pedido = $rows['nro_pedido'];
                                $nro_etiqueta = $rows['nro_etiqueta'];
                                $dt_recebimento = $rows['dt_recebimento'];
                                $nro_romaneio_expedicao = $rows['nro_romaneio_expedicao'];
                                $qtde_volumes = $rows['qtde_volumes'];
                                $qtde_itens = $rows['qtde_itens'];
                                $status_expedicao = $rows['status_expedicao_expedicao'];
                                $unidade_atual = $rows['unidade_atual'];
                                $nome_pessoa_visita = $rows['nome_pessoa_visita'];
                    
                                $insert_sql_expedicao = "INSERT INTO `expedicao_recebido`  VALUES 
                                (null, '$nro_documento', '$nro_pedido', '$nro_etiqueta', '$dt_recebimento', '$nro_romaneio_expedicao',
                                 '$qtde_volumes', '$qtde_itens', '$status', '$unidade_atual', '$nome_pessoa_visita',  null, 
                                 '$usuario', '$datahora',  null, '$obs')";
                            $salvar = mysqli_query($conexao, $insert_sql_expedicao);

                            $insert_sql = "INSERT INTO `pcp_recebido`(`id`, `pacote`, `pedido`, `nota_fiscal`, `usuario`, `data_hora`, `deleted_at`, `finalizado`, `obs`) VALUES 
                                            (NULL, '$pacote', '$pedido', '$nota_fiscal', '$usuario', '$datahora',null,null,'$obs')";
                                        $salvar = mysqli_query($conexao, $insert_sql);
                                        
                                        echo '<meta http-equiv="refresh" content="0;URL=etiqueta" />';
                                die();
                            }else{
                                
                                $obs = strtoupper($_POST['observacao']);
                                $insert_sql = "INSERT INTO `pcp_recebido`(`id`, `pacote`, `pedido`, `nota_fiscal`, `usuario`, `data_hora`, `deleted_at`, `finalizado`, `obs`) VALUES 
                                                (NULL, '$pacote', '$pedido', '$nota_fiscal', '$usuario', '$datahora',null,null,'$obs')";
                                            $salvar = mysqli_query($conexao, $insert_sql);
                                            
                                            echo '<meta http-equiv="refresh" content="0;URL=etiqueta" />';
                            }
                                            
                        }

                    }

}
    
