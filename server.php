<?php
// Verifica se foi recebido um POST válido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe o código de barras enviado pelo cliente
    $data = json_decode(file_get_contents("php://input"));
    $barcode = $data->barcode;

    // Aqui você pode processar o código de barras recebido
    // Por exemplo, você pode armazená-lo em um banco de dados ou realizar qualquer outra ação necessária

    // Envia uma resposta de confirmação ao cliente
    echo "Código de barras recebido: " . $barcode;
} else {
    // Se o método de requisição não for POST, retorna um erro
    http_response_code(405);
    echo "Método não permitido.";
}
?>
