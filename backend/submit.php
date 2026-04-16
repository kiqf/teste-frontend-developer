<?php

declare(strict_types=1);

require_once 'connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /?status=metodo-invalido');
        exit;
    }

    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $mensagem = $_POST['mensagem'] ?? null;

    if (!$nome || !$email || !$telefone) {
        header('Location: /?status=campos-obrigatorios');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: /?status=email-invalido');
        exit;
    }

    $pdo = createDatabaseConnection();

    $stmt = $pdo->prepare("
        INSERT INTO contatos (nome, email, telefone, mensagem)
        VALUES (:nome, :email, :telefone, :mensagem)
    ");

    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':telefone' => $telefone,
        ':mensagem' => $mensagem,
    ]);

    header('Location: /teste-frontend-developer/?status=sucesso');
    exit;

} catch (Throwable $e) {
    header('Location: /?status=erro-servidor');
    exit;
}