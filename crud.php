<?php
$host = 'localhost';
$dbname = 'CRUDEm2VJ';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Conexão falhou: ' . $e->getMessage());
}

// CRUD para professor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add_professor') {
        $nome = $_POST['nome'];
        $stmt = $pdo->prepare("INSERT INTO professor (nome) VALUES (:nome)");
        $stmt->execute(['nome' => $nome]);
    } elseif ($_POST['action'] == 'update_professor') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $stmt = $pdo->prepare("UPDATE professor SET nome = :nome WHERE id = :id");
        $stmt->execute(['nome' => $nome, 'id' => $id]);
    } elseif ($_POST['action'] == 'add_aula') {
        $sala = $_POST['sala'];
        $stmt = $pdo->prepare("INSERT INTO aulas (sala) VALUES (:sala)");
        $stmt->execute(['sala' => $sala]);
    } elseif ($_POST['action'] == 'update_aula') {
        $id = $_POST['id'];
        $sala = $_POST['sala'];
        $stmt = $pdo->prepare("UPDATE aulas SET sala = :sala WHERE id = :id");
        $stmt->execute(['sala' => $sala, 'id' => $id]);
    }
}

// Excluir professor ou aula
if (isset($_GET['delete_professor'])) {
    $id = $_GET['delete_professor'];
    $stmt = $pdo->prepare("DELETE FROM professor WHERE id = :id");
    $stmt->execute(['id' => $id]);
} elseif (isset($_GET['delete_aula'])) {
    $id = $_GET['delete_aula'];
    $stmt = $pdo->prepare("DELETE FROM aulas WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Listar professores
$stmt = $pdo->query("SELECT * FROM professor");
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Listar aulas
$stmt = $pdo->query("SELECT * FROM aulas");
$aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD - Professores e Aulas</title>
</head>
<body>
    <h1>Professores</h1>
    <form method="post">
        <input type="hidden" name="action" value="add_professor">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <button type="submit">Adicionar Professor</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($professores as $professor): ?>
        <tr>
            <td><?php echo $professor['id']; ?></td>
            <td><?php echo $professor['nome']; ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="action" value="update_professor">
                    <input type="hidden" name="id" value="<?php echo $professor['id']; ?>">
                    <input type="text" name="nome" value="<?php echo $professor['nome']; ?>" required>
                    <button type="submit">Atualizar</button>
                </form>
                <a href="?delete_professor=<?php echo $professor['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h1>Aulas</h1>
    <form method="post">
        <input type="hidden" name="action" value="add_aula">
        <label>Sala:</label>
        <input type="text" name="sala" required>
        <button type="submit">Adicionar Aula</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Sala</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($aulas as $aula): ?>
        <tr>
            <td><?php echo $aula['id']; ?></td>
            <td><?php echo $aula['sala']; ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="action" value="update_aula">
                    <input type="hidden" name="id" value="<?php echo $aula['id']; ?>">
                    <input type="text" name="sala" value="<?php echo $aula['sala']; ?>" required>
                    <button type="submit">Atualizar</button>
                </form>
                <a href="?delete_aula=<?php echo $aula['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>