<?php
// calculator_server.php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['operation']) && isset($data['operand1']) && isset($data['operand2'])) {
        $operation = $data['operation'];
        $operand1 = $data['operand1'];
        $operand2 = $data['operand2'];

        switch ($operation) {
            case '+':
                $result = $operand1 + $operand2;
                break;
            case '-':
                $result = $operand1 - $operand2;
                break;
            case 'X':
                $result = $operand1 * $operand2;
                break;
            case '÷':
                if ($operand2 != 0) {
                    $result = $operand1 / $operand2;
                } else {
                    $result = 'Error: Division by zero';
                }
                break;
            default:
                $result = 'Error: Invalid operation';
        }

        echo json_encode(['result' => $result]);
        exit;
    } else {
        echo json_encode(['error' => 'Invalid request']);
        exit;
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}
?>
