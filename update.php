<?php
include 'bd.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM professor WHERE id = :id");
$stmt->execute(['id' => $id]);
$professor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $stmt = $pdo->prepare("UPDATE professor SET nome = :nome WHERE id = :id");
    $stmt->execute(['nome' => $nome, 'id' => $id]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Professor</title>
</head>
<body>
    <h1>Editar Professor</h1>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $professor['nome']; ?>" required>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>