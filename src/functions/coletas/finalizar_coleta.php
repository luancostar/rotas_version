<?php
session_start();
require_once('../../database/index.php');
function getValoresOriginaisColeta($db, $id_coleta)
{
        $sql = "SELECT * FROM coletas WHERE id = '$id_coleta'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        return $row;
}

function registrarAuditoria($db, $tabela, $id_registro, $coluna, $valor_original, $novo_valor, $id_usuario)
{
        $sql = "INSERT INTO auditorias(tabela, id_registro, coluna, valor_original, novo_valor, id_usuario, data_hora_alteracao)
                VALUES ('$tabela','$id_registro','$coluna','$valor_original','$novo_valor','$id_usuario', NOW())";
        $db->query($sql);
}



$id_usuario_finalizacao = $_POST['id_usuario_finalizacao'];
$data_coleta = $_POST['data_coleta'];
$_POST['hora_coleta'] = date("H:i:s", strtotime($_POST['hora_coleta']));
$hora_coleta = $_POST['hora_coleta'];
$obs = $_POST['obs_finalizacao_coleta'];
$status_coleta = $_POST['status_coleta'];
$_POST['id_ocorrencia'] = $status_coleta == 2 ? 0 : $_POST['id_ocorrencia'];
$ocorrencia = $status_coleta == 2 ? 0 : $_POST['id_ocorrencia'];

$id_coleta = $_POST['id_coleta'];
$valores_originais = getValoresOriginaisColeta($db, $id_coleta);

foreach ($valores_originais as $coluna => $valor_original) {
        if (isset($_POST[$coluna])) {
                if ($_POST[$coluna] != $valor_original) {
                        registrarAuditoria($db, 'coletas', $id_coleta, $coluna, $valor_original, $_POST[$coluna], $_SESSION['usuario']['id']);
                }
        }
}

// STATUS COLETA
// 2 - REALIZADO
// 3 - NÃO REALIZADO

$sql = "UPDATE coletas
        SET data_coleta = ?, hora_coleta = ?, status_coleta = ?, obs_finalizacao_coleta = ?, id_ocorrencia = ?, finalizacao_manual = 1, id_usuario_finalizacao = ?
        WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("ssisiii", $data_coleta, $hora_coleta, $status_coleta, $obs, $ocorrencia, $id_usuario_finalizacao,  $id_coleta);
$stmt->execute();

header('Location: ../../pages/cadastros/coletas/listar_coletas.php');
