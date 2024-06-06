<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    $conn = new PDO("mysql:host=localhost;dbname=projetoweb", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["nome"], $_POST["email"], $_POST["senha"])) {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            // Usando prepared statement para inserção segura de dados
            $sql = "INSERT INTO cadastroweb (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            $response = ["success" => true, "message" => "Dados recebidos com sucesso!"];
            echo json_encode($response);
        } else {
            http_response_code(400); // Bad Request
            $response = ["success" => false, "message" => "Dados incompletos ou inválidos."];
            echo json_encode($response);
        }
    } else {
        http_response_code(405); // Method Not Allowed
        $response = ["success" => false, "message" => "Método não permitido."];
        echo json_encode($response);
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    $response = ["success" => false, "message" => "Erro no servidor: " . $e->getMessage()];
    echo json_encode($response);
}
?>