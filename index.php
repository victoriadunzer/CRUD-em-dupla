<?php
include 'bd.php';

$stmt = $pdo->query("SELECT * FROM professor");
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM aulas");
$aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM diario");
$diarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD - Professores</title>
</head>
<body>
    <h1>Professores</h1>
    <a href="create.php">Adicionar Professor</a>
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
                <a href="update.php?id=<?php echo $professor['id']; ?>">Editar</a>
                <a href="delete.php?id=<?php echo $professor['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h1>Aulas</h1>
    <a href="create.php">Adicionar Aula</a>
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
                <a href="update.php?id=<?php echo $aula['id']; ?>">Editar</a>
                <a href="delete.php?id=<?php echo $aula['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h1>Diário</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Professor</th>
            <th>ID Aula</th>
            <th>Hora Aula</th>
        </tr>
        <?php foreach ($diarios as $diario): ?>
        <tr>
            <td><?php echo $diario['id']; ?></td>
            <td><?php echo $diario['id_professor']; ?></td>
            <td><?php echo $diario['id_aula']; ?></td>
            <td><?php echo $diario['hora_aula']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>