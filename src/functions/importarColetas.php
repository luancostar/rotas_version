<?php
require_once '../vendor/autoload.php';
require_once('../database/index.php');

use PhpOffice\PhpSpreadsheet\IOFactory;

$file1 = $_FILES['arquivo'];
$spreadsheet = IOFactory::load($file1['tmp_name']);
$sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
$data = $sheet->toArray();
array_shift($data);
array_shift($data);

// $includedColumns = [6, 7, 8, 9, 26, 36, 22, 10, 11, 12, 13, 14, 25];
$dateCells = [1, 2, 4, 7,];
$moneyColumns = [];

$skipFirstRow = 0;

foreach ($data as $row) {

    $rowData = [];

    foreach ($row as $cell => $dataCell) {
        if (in_array($cell, $dateCells)) {
            if ($dataCell != '') {
                $array_date = explode('/', $dataCell);
                $dataCell = $array_date[2] . '-' . $array_date[0] . '-' . $array_date[1];
            }
        }

        if (in_array($cell, $moneyColumns)) {
            $dataCell = str_replace(',', '.', $data);
        }



        $rowData[] = $dataCell;
    }

    $rowData[20] = ucfirst(strtolower($rowData[20]));

    $sql = "INSERT INTO coletas(num_coleta, data_solicitacao, data_coleta, hora_coleta, data_programada, hora_programada, ultima_ocorrencia, data_ultima_ocorrencia, hora_ultima_ocorrencia, obs_ultima_ocorrencia, status_coleta, dias_atraso, ano, cliente, cliente_cpf_cnpj, local_coleta, ultima_atualizacao, cancelada, motivo, hora_solicitacao, bairro, cidade, uf, orcamento, coleta_automatica, placa_veiculo, motorista, cpf_motorista, tipo_veiculo, obs, qtd_volumes, destinatario, contato, peso_solicitado)
            VALUES('{$rowData[0]}', '{$rowData[1]}','{$rowData[2]}','{$rowData[3]}','{$rowData[4]}','{$rowData[5]}','{$rowData[6]}','{$rowData[7]}','{$rowData[8]}','{$rowData[9]}','{$rowData[10]}','{$rowData[11]}','{$rowData[12]}','{$rowData[13]}','{$rowData[14]}','{$rowData[15]}','{$rowData[16]}','{$rowData[17]}','{$rowData[18]}','{$rowData[19]}','{$rowData[20]}','{$rowData[21]}','{$rowData[22]}','{$rowData[23]}','{$rowData[24]}','{$rowData[25]}','{$rowData[26]}','{$rowData[27]}', '{$rowData[28]}', '{$rowData[29]}', '{$rowData[30]}', '{$rowData[31]}', '{$rowData[32]}', '{$rowData[33]}')";

    $db->query($sql);
}

$db->close();

header('Location: ../pages/import.php');
exit;
