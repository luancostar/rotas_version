<?php
require_once '../../database/index.php';
require_once '../../vendor/autoload.php';


function getOcorrenciaById($db, $id_ocorrencia)
{
  $sql = "SELECT ocorrencia FROM ocorrencias WHERE id = '$id_ocorrencia'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();

  return $row['ocorrencia'];
}

function getMotoristaById($db, $id_motorista)
{
  $sql = "SELECT motoristas.nome AS nome_motorista 
          FROM motoristas
          WHERE id = '$id_motorista'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();

  return $row['nome_motorista'];
}

$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];

$grupo = [];

$sql = "SELECT coletas.id, 
                coletas.id_ocorrencia, 
                clientes.razao_social,
                coletas.id_motorista_coleta,
                bairros.nome AS nome_bairro, 
                cidades.nome AS nome_cidade 
        FROM coletas 
        LEFT JOIN clientes ON coletas.id_cliente = clientes.id 
        LEFT JOIN bairros ON clientes.bairro = bairros.id 
        LEFT JOIN cidades ON clientes.cidade = cidades.id 
        WHERE data_agendamento BETWEEN '$data_inicial' AND '$data_final'
        AND coletas.status_coleta NOT IN ('1', '2')
        ORDER BY clientes.razao_social
        ";
$result = $db->query($sql);
while ($row = $result->fetch_assoc()) {

  $nome_motorista = $row['id_motorista_coleta'] != 0 ? getMotoristaById($db, $row['id_motorista_coleta']) : 'SEM MOTORISTA';
  $row['nome_motorista'] = $nome_motorista;
  unset($row['id_motorista_coleta']);

  $ocorrencia = $row['id_ocorrencia'] == 0 ? 'EM ABERTO' : getOcorrenciaById($db, $id_ocorrencia);
  $row['ocorrencia'] = $ocorrencia;
  unset($row['id_ocorrencia']);

  $grupo[] = $row;
}

array_unshift($grupo, ['ID', 'CLIENTE', 'BAIRRO', 'CIDADE', 'MOTORISTA', 'OCORRÊNCIA']);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->fromArray($grupo);
$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Fechamento.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
