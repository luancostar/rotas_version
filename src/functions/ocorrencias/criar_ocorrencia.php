<?php
require_once('../../database/index.php');

$num_ocorrencia = $_POST['num_ocorrencia'];
$ocorrencia = $_POST['ocorrencia'];
$inef_cliente = isset($_POST['inef_cliente']) ? 1 : 0;
$app_motorista = isset($_POST['app_motorista']) ? 1 : 0;

function ocorrenciaExiste($db, $num_ocorrencia)
{
        $sql = "SELECT * 
                FROM ocorrencias
                WHERE num_ocorrencia = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $num_ocorrencia);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
                return false;
        }
        return true;
}

if (!ocorrenciaExiste($db, $num_ocorrencia)) {
        $sql = "INSERT INTO ocorrencias(num_ocorrencia, ocorrencia, inef_cliente, app_motorista)
        VALUES(?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("isii", $num_ocorrencia, $ocorrencia, $inef_cliente, $app_motorista);
        $stmt->execute();
        $stmt->close();
}

header('Location: ../../pages/cadastros/ocorrencias/listar_ocorrencias.php');
