<?php
require_once('../../database/index.php');

$pergunta = $_POST['pergunta'];
$id_usuario = $_POST['id_usuario'];

$sql = "INSERT INTO perguntas(pergunta, usuario_inclusao)
VALUES(?, ?)";

$stmt = $db->prepare($sql);
$stmt->bind_param("si", $pergunta, $id_usuario);
$stmt->execute();
$stmt->close();

header('Location: ../../pages/cadastros/feedback/listar_perguntas.php');
