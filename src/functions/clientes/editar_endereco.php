<?php
require_once('../../database/index.php');

$id_endereco = $_POST['id_endereco'];
$id_cliente = $_POST['id_cliente'];

$endereco = $_POST['endereco'];
$endereco_num = $_POST['endereco_num'];
$cep = $_POST['cep'];
$contato = $_POST['contato'];
$id_bairro = $_POST['bairro'];
$id_cidade = $_POST['cidade'];
$principal = isset($_POST['principal']) ? 1 : 0;

if ($principal == 1) {
  $sql = "UPDATE enderecos_clientes 
          SET principal = 0 
          WHERE id_cliente = '$id_cliente'";
  $db->query($sql);
}

$sql = "UPDATE enderecos_clientes
        SET endereco = ?, endereco_num = ?, cep = ?, contato = ?, id_bairro = ?, id_cidade = ?, principal = ?
        WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("ssssiiii", $endereco, $endereco_num, $cep, $contato, $id_bairro, $id_cidade, $principal, $id_endereco);
$stmt->execute();
$stmt->close();

header('Location: ../../pages/cadastros/clientes/listar_clientes.php');
exit;
