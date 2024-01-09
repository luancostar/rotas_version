<?php
require_once('../../database/index.php');

$id_cidade = $_POST['id_cidade'];
$cap_int = $_POST['cap_int'];

if (isset($_POST['desativar'])) {
        $sql = "SELECT status_ativacao FROM cidades WHERE id = '$id_cidade'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $novo_status = $row['status_ativacao'] == 0 ? 1 : 0;

        $sql = "UPDATE cidades 
                SET status_ativacao = '$novo_status' 
                WHERE id = '$id_cidade'";
        $db->query($sql);
        header('Location: ../../pages/cadastros/cidades/listar_cidades.php');
} else {
        $nome_cidade = strtoupper($_POST['nome_cidade']);
        $uf = $_POST['uf'];

        function cidadeExiste($db, $nome_cidade, $uf, $cap_int, $id_cidade)
        {       $sql = "SELECT * 
                        FROM cidades
                        WHERE nome = ? 
                        AND uf = ?
                        AND cap_int = ?
                        AND id <> '$id_cidade'";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("sss", $nome_cidade, $uf, $cap_int);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }

        if (!cidadeExiste($db, $nome_cidade, $uf, $cap_int, $id_cidade)) {
                

                $sql = "UPDATE cidades
                        SET nome = ?, uf = ?, cap_int = ?
                        WHERE id = ?";

                $stmt = $db->prepare($sql);
                $stmt->bind_param("sssi", $nome_cidade, $uf, $cap_int, $id_cidade);
                $stmt->execute();
                $stmt->close();
                
        }

        header('Location: ../../pages/cadastros/cidades/listar_cidades.php');
}
