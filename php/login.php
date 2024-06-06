<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=localhost;dbname=projetoweb", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se os parâmetros esperados estão presentes
    if (isset($_GET['nome']) && isset($_GET['senha'])) {
        $username = $_GET['nome'];
        $password = $_GET['senha'];

        // Usando prepared statement para evitar SQL injection
        $sql = "SELECT * FROM cadastroweb WHERE nome = :nome AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $username);
        $stmt->bindParam(':senha', $password);
        $stmt->execute();

        // Verifica se encontrou o usuário
        if ($stmt->rowCount() > 0) {
            $response = ["success" => true, "message" => "Login efetuado com sucesso!"];
        } else {
            $response = ["success" => false, "message" => "Nome de usuário ou senha inválidos."];
        }
    } else {
        // Parâmetros ausentes
        $response = ["success" => false, "message" => "Parâmetros ausentes."];
    }
} catch (PDOException $e) {
    // Se houver um erro na conexão com o banco de dados, retorna um erro
    http_response_code(500); // Internal Server Error
    $response = ["success" => false, "message" => "Erro no servidor: " . $e->getMessage()];
}

// Retorna a resposta como JSON
echo json_encode($response);
?>
