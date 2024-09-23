<?php
include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $stmt = $pdo->prepare("INSERT INTO professor (nome) VALUES (:nome)");
    $stmt->execute(['nome' => $nome]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Professor</title>
</head>
<body>
    <h1>Adicionar Professor</h1>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
