<?php
require_once '../../database/index.php';
require_once '../../vendor/autoload.php';

function getStatuscoleta($codigo_status)
{
  $status = [
    0 => 'Em aberto',
    1 => 'Cancelado',
    2 => 'Coletado',
    3 => 'Não coletado'
  ];

  return $status[$codigo_status];
}

function getColetas($db, $data_inicial, $data_final)
{
  $coletas = [];

  $coletas[] = [
    'ORDEM DE COLETA',
    'DATA DE SOLICITAÇÃO',
    'HORA DE SOLICITAÇÃO',
    'DATA PROGRAMADA',
    'DATA DA COLETA',
    'HORA DA COLETA',
    'OCORRÊNCIA',
    'DATA DA OCORRÊNCIA',
    'HORA DA OCORRÊNCIA',
    'STATUS DA COLETA',
    'CLIENTE RAZÃO SOCIAL',
    'CLIENTE CNPJ',
    'LOCAL DA COLETA',
    'BAIRRO DA COLETA',
    'CIDADE DA COLETA',
    'UF DA COLETA',
    'OBS DO SOLICITANTE',
    'COLETA AUTOMÁTICA',
    'PLACA VEÍCULO',
    'MOTORISTA',
    'OBS COLETA',
    'VOLUME SOLICITADO',
    'PESO',
    'DESTINATARIO',
    'CONTATO DESTINATÁRIO'
  ];

  $sql = "SELECT coletas.id,
                 coletas.data_solicitacao,
                 coletas.hora_solicitacao,
                 coletas.data_agendamento,
                 coletas.data_coleta AS data_coleta,
                 coletas.hora_coleta AS hora_coleta,
                 ocorrencias.ocorrencia,
                 coletas.data_coleta AS data_ocorrencia,
                 coletas.hora_coleta AS hora_ocorrencia,
                 coletas.status_coleta,
                 clientes.razao_social AS razao_social, 
                 clientes.cpf_cnpj AS cpf_cnpj_cliente,
                 enderecos_clientes.endereco,
                 enderecos_clientes.endereco_num,
                 bairros.nome AS nome_bairro,
                 cidades.nome AS nome_cidade,
                 cidades.uf,
                 coletas.obs,
                 coletas.coleta_automatica,
                 placas.placa,
                 motoristas.nome AS nome_motorista,
                 coletas.obs_finalizacao_coleta,
                 coletas.volume_solicitado,
                 coletas.peso,
                 coletas.nome_destinatario,
                 coletas.telefone_destinatario
          FROM coletas
          LEFT JOIN clientes ON coletas.id_cliente = clientes.id 
          LEFT JOIN enderecos_clientes ON coletas.id_endereco_coleta = enderecos_clientes.id
          LEFT JOIN bairros ON enderecos_clientes.id_bairro = bairros.id
          LEFT JOIN cidades ON enderecos_clientes.id_cidade = cidades.id
          LEFT JOIN placas ON coletas.id_placa_veiculo = placas.id
          LEFT JOIN motoristas ON coletas.id_motorista = motoristas.id
          LEFT JOIN ocorrencias ON coletas.id_ocorrencia = ocorrencias.id
          WHERE data_agendamento BETWEEN '$data_inicial' AND '$data_final'
          ORDER BY coletas.data_solicitacao";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $row['coleta_automatica'] = $row['coleta_automatica'] == 1 ? 'SIM' : 'NÃO';

    $row['status_coleta'] = getStatuscoleta($row['status_coleta']);

    $row['endereco'] = $row['endereco'] . ', ' . $row['endereco_num'];
    unset($row['endereco_num']);
    $coletas[] = $row;
  }
  return $coletas;
}

$coletas = getColetas($db, $_POST['data_inicial'], $_POST['data_final']);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->fromArray($coletas);
$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="COLETAS.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
