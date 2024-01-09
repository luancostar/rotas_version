<?php
session_start();

if (!isset($_SESSION['logado_roteirizador'])) {
  header('Location:  ../index.php');
  exit;
}
require_once('database/index.php');

date_default_timezone_set('America/Sao_Paulo');

$id_usuario = $_SESSION['id_usuario'];

if (!isset($_POST['data_inicial']) || !isset($_POST['data_final'])) {
  $data_inicial = date('Y-m-d');
  $data_final = date('Y-m-d');
} else {
  $data_inicial = $_POST['data_inicial'];
  $data_final = $_POST['data_final'];
}

function getOcorrenciaById($db, $id_ocorrencia)
{
  $sql = "SELECT ocorrencia FROM ocorrencias WHERE id = '$id_ocorrencia'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  return $row['ocorrencia'];
}

function getColetas($db, $data_inicial, $data_final)
{
  $coletas = [];
  $sql = "SELECT coletas.*, 
                  clientes.cpf_cnpj AS cpf_cnpj_cliente, 
                  clientes.razao_social AS razao_social, 
                  clientes.id_regiao AS regiao_cliente,
                  clientes.bairro AS bairro_cliente,
                  clientes.especial AS cliente_especial,
                  motoristas.nome AS nome_motorista,
                  placas.placa AS placa_veiculo,
                  users.name AS nome_responsavel
          FROM coletas
          LEFT JOIN clientes ON coletas.id_cliente = clientes.id
          LEFT JOIN motoristas ON coletas.id_motorista = motoristas.id
          LEFT JOIN placas ON coletas.id_placa_veiculo = placas.id
          LEFT JOIN users ON coletas.id_usuario_finalizacao = users.id
          WHERE data_agendamento BETWEEN '$data_inicial' AND '$data_final'";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $coletas[] = $row;
  }
  return $coletas;
}
function getMotoristaById($db, $id)
{
  $sql = "SELECT nome FROM motoristas WHERE id = '$id'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  $motorista = $row['nome'];

  return $motorista;
}

function getMotoristaPlacaByRegiao($db, $id_regiao)
{
  $sql = "SELECT regioes.*, motoristas.nome AS nome_motorista, placas.placa AS placa_veiculo 
          FROM regioes
          LEFT JOIN motoristas ON motoristas.id = regioes.id_motorista
          LEFT JOIN placas ON placas.id = regioes.id_placa_veiculo 
          WHERE regioes.id = '$id_regiao'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();

  return [
    "nome_motorista" => $row['nome_motorista'],
    "placa_veiculo" => $row['placa_veiculo']
  ];
}

function getMotoristaPlacaByBairro($db, $id_bairro)
{

  $sql = "SELECT id_regiao FROM bairros WHERE id = '$id_bairro'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  @$id_regiao = $row['id_regiao'];

  $sql = "SELECT regioes.*, motoristas.nome AS nome_motorista, placas.placa AS placa_veiculo 
          FROM regioes
          LEFT JOIN motoristas ON motoristas.id = regioes.id_motorista
          LEFT JOIN placas ON placas.id = regioes.id_placa_veiculo 
          WHERE regioes.id = '$id_regiao'";

  $result = $db->query($sql);
  $row = $result->fetch_assoc();

  return [
    "nome_motorista" => @$row['nome_motorista'],
    "placa_veiculo" => @$row['placa_veiculo']
  ];
}


function getStatuscoleta($codigo_status)
{
  $status = [
    0 => 'Em aberto',
    1 => 'Cancelado',
    2 => 'Coletado',
    3 => 'Não coletado (VB)',
    4 => 'Não coletado (cliente)'
  ];

  return $status[$codigo_status];
}

function getBairroById($db, $id_bairro)
{
  $sql = "SELECT nome FROM bairros WHERE id = '$id_bairro'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  $bairro = $row['nome'];

  return $bairro;
}

function getEmbalagemById($db, $id_embalagem)
{
  $sql = "SELECT nome FROM embalagens WHERE id = '$id_embalagem'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  $embalagem = $row['nome'];

  return $embalagem;
}

function getCidadeByid($db, $id_cidade)
{
  $sql = "SELECT nome, uf FROM cidades WHERE id = '$id_cidade'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();

  $cidade = "{$row['nome']} ({$row['uf']})";

  return $cidade;
}

function ineficienciaCliente($db, $id_ocorrencia)
{
  $sql = "SELECT inef_cliente FROM ocorrencias WHERE id = '$id_ocorrencia'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();

  if (@$row['inef_cliente'] == 1) {
    return true;
  }
  return false;
}



$query = "SELECT COUNT(*) AS total FROM coletas";
$result = $db->query($query);

if ($result) {
  $row = $result->fetch_assoc();

  $totalRegistros = $row['total'];
}

function getPerguntas($db)
{
  $perguntas = [];
  $sql = "SELECT * FROM perguntas WHERE status_ativacao = '1'";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $perguntas[] = $row;
  }

  return $perguntas;
}

$sql_coletas_automaticas = "SELECT count(id)
                            FROM coletas 
                            WHERE coleta_automatica = '1'
                            AND data_agendamento BETWEEN '$data_inicial' AND '$data_final'";
$resultado_coletas_automaticas = mysqli_query($db, $sql_coletas_automaticas);
$dados_coletas_automaticas = mysqli_fetch_array($resultado_coletas_automaticas);
$coletasAutomaticas = $dados_coletas_automaticas['count(id)'];

?>

<!doctype html>
<html lang="en">

<?php include 'components/head.php';?>
   

    
    <body data-layout="horizontal" data-topbar="light">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
    
    <!-- <------------------------------HEADER-------------------->  
    <?php include 'components/header.php';?>
    


    <!-------------------------- BARRA DE CUSTOMIZAÇÃO -------------->
    <?php include 'components/custom-bar.php';?>

        <div class="hori-overlay"></div>
    


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="w-100 container-fluid">

                <?php include 'components/table.php';?>
           
                       
                </div>
            <!-- End Page-content -->
            <?php include 'components/footer.php';?>
 
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

   
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    
    <?php include 'components/scripts.php';?>
 
    </body>

</html>