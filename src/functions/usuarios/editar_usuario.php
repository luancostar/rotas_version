<?php
require_once '../../database/index.php';

$id_usuario = $_POST['id_usuario'];
$acesso_cad_bairro = $_POST['acesso_cad_bairro'];
$acesso_cad_cidade = $_POST['acesso_cad_cidade'];
$acesso_cad_cliente = $_POST['acesso_cad_cliente'];
$acesso_cad_embalagem = $_POST['acesso_cad_embalagem'];
$acesso_cad_motorista = $_POST['acesso_cad_motorista'];
$acesso_cad_ocorrencia = $_POST['acesso_cad_ocorrencia'];
$acesso_cad_rota = $_POST['acesso_cad_rota'];
$acesso_cad_usuario = $_POST['acesso_cad_usuario'];
$acesso_cad_veiculo = $_POST['acesso_cad_veiculo'];
$acesso_cad_pergunta = $_POST['acesso_cad_pergunta'];

if (isset($_POST['status_ativacao'])) {
        $status_ativacao = $_POST['status_ativacao'] == 1 ? 0 : 1;

        $sql = "UPDATE users SET status_ativacao = '$status_ativacao' WHERE id = '$id_usuario'";
        $db->query($sql);
        $db->close();
        header('Location: ../../pages/cadastros/usuarios/usuarios.php');
        exit;
} else {
        $nome_usuario = $_POST['nome_usuario'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // VERIFICA SE JÁ HÁ MOTORISTA COM ESSE CPF
        function usuario_existe($db, $email, $id_usuario)
        {
                $sql = "SELECT * 
                        FROM users
                        WHERE email = ? AND id <> ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("si", $email, $id_usuario);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if (!$row) {
                        return false;
                }
                return true;
        }

        if (!usuario_existe($db, $email, $id_usuario)) {
                $sql = "UPDATE users 
                        SET name = ?, 
                        email = ?, 
                        password = ?, 
                        acesso_cad_bairro = ?, 
                        acesso_cad_cidade = ?, 
                        acesso_cad_cliente = ?, 
                        acesso_cad_embalagem = ?, 
                        acesso_cad_motorista = ?, 
                        acesso_cad_ocorrencia = ?, 
                        acesso_cad_rota = ?, 
                        acesso_cad_usuario = ?, 
                        acesso_cad_veiculo = ?,
                        acesso_cad_pergunta = ?
                WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('sssssssssssssi', $nome_usuario, $email, $senha, $acesso_cad_bairro, $acesso_cad_cidade, $acesso_cad_cliente, $acesso_cad_embalagem, $acesso_cad_motorista, $acesso_cad_ocorrencia, $acesso_cad_rota, $acesso_cad_usuario, $acesso_cad_veiculo, $acesso_cad_pergunta, $id_usuario);
                $stmt->execute();
        }
        header('Location: ../../pages/cadastros/usuarios/usuarios.php');
        exit;
}
