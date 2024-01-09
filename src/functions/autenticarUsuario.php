<?php
require_once('../database/index.php');
session_start();
$erros = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['email'] != '' && $_POST['password'] != '') :
        $email = $_POST['email'];
        $password = $_POST['password'];

        $db->real_escape_string($email);
        $db->real_escape_string($password);

        $sql = "SELECT *
                FROM users
                WHERE email = ?";
        $stmt = $db->prepare($sql);

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row['password'] == $password && $row['status_ativacao'] == 1) {
                unset($row['password']);
                $_SESSION['usuario'] = $row;
                $_SESSION['logado_roteirizador'] = true;
                $_SESSION['id_usuario'] = $row['id'];

                header('Location: ../home.php');
                exit;
            } else {
                $erros[] = 'Login inválido';
            }
        } else {
            $erros[] = 'Login inválido';
        }
    else :
        $erros[] = 'Todos os campos são obrigatórios';
    endif;

    $_SESSION['erros_login'] = $erros;
    header('Location: ../../index.php');
    exit;
}
