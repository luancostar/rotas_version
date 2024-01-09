<?php
require_once '../../database/index.php';

$id_cidade = $_POST['id_cidade'];

$sql = "DELETE  
        FROM cidades
        WHERE id = '$id_cidade' ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
header('Location: ../../pages/cadastros/cidades/listar_cidades.php');
