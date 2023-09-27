<?php
session_start();

require_once('vendor/autoload.php'); // Certifique-se de carregar a biblioteca PHP-JWT

use Firebase\JWT\JWT;

if (isset($_SESSION["token"])) {
    $token = $_SESSION["token"];
    
    // Chame a função para validar o token
    $decodedToken = validateToken($token);

    if ($decodedToken !== false) {
        // O token é válido, o usuário está autenticado
        // Exiba o conteúdo protegido aqui
        header("Location: ../php/workspace.php"); // Redirecionar para a página de login
    } else {
        // O token é inválido ou expirou, redirecione para a página de login
        header("Location: ../php/login.php"); // Redirecionar para a página de login
        exit();
    }
} else {
    // O usuário não está autenticado, redirecione para a página de login
    header("Location: ../php/login.php"); // Redirecionar para a página de login
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_emailLogin = $_POST["emailLogin"];
    $input_passwordLogin = $_POST["passwordLogin"];

    $sql = "SELECT * FROM users WHERE username = '$input_emailLogin' AND password = '$input_passwordLogin'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Autenticação bem-sucedida

        // Gerar um token JWT
        $secretKey = "sua_chave_secreta"; // Substitua pela sua chave secreta
        $payload = array(
            "email" => $input_emailLogin,
            "exp" => time() + 3600 // Define a expiração do token para 1 hora a partir do momento atual
        );
        $token = JWT::encode($payload, $secretKey);

        // Armazene o token na sessão ou envie-o de volta para o cliente
        $_SESSION["emailLogin"] = $input_emailLogin;
        $_SESSION["token"] = $token;

        header("Location: ../php/workspace.php"); // Redirecionar para a página de boas-vindas
        exit();
    } else {
        $error_message = "Usuário ou senha inválidos.";
    }

    // Feche a conexão com o banco de dados
    $conn->close();
}

function validateToken($token) {
    try {
        $secretKey = "sua_chave_secreta"; // Substitua pela sua chave secreta
        $decoded = JWT::decode($token, $secretKey, array('HS256'));

        // Check token expiration
        $currentTime = time();
        if ($decoded->exp < $currentTime) {
            // Token has expired
            return false;
        }

        // Token is valid
        return $decoded;
    } catch (Exception $e) {
        // Token is invalid
        return false;
    }
}
?>