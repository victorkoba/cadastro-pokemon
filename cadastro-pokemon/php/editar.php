<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
    echo "ID não fornecido.";
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $data = $_POST['data'];
    $hp = $_POST['hp'];
    $ataque = $_POST['ataque'];
    $defesa = $_POST['defesa'];
    $obs = $_POST['observacao'];

    $sql = "UPDATE pokemon SET nome_pokemon=?, tipo_pokemon=?, localizacao_pokemon=?, data_registro_pokemon=?, hp_pokemon=?, ataque_pokemon=?, defesa_pokemon=?, observacao_pokemon=? WHERE id_pokemon=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssiiisi", $nome, $tipo, $localizacao, $data, $hp, $ataque, $defesa, $obs, $id);

    if ($stmt->execute()) {
        header("Location: informacoes-pokemon.php");
        exit;
    } else {
        echo "Erro ao atualizar Pokémon.";
    }
}

$sql = "SELECT * FROM pokemon WHERE id_pokemon = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows != 1) {
    echo "Pokémon não encontrado.";
    exit;
}

$pokemon = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style-editar.css">
    <title>Editar Pokémon</title>
</head>
<body>
    <div class="conteudo-principal">
        <form method="POST">
            <h1>Editar Pokémon</h1>
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($pokemon['nome_pokemon']) ?>"><br>
            
            <label>Tipo:</label>
            <input type="text" name="tipo" value="<?= htmlspecialchars($pokemon['tipo_pokemon']) ?>"><br>
            
            <label>Localização:</label>
            <input type="text" name="localizacao" value="<?= htmlspecialchars($pokemon['localizacao_pokemon']) ?>"><br>
            
            <label>Data:</label>
            <input type="date" name="data" value="<?= htmlspecialchars($pokemon['data_registro_pokemon']) ?>"><br>
            
            <label>HP:</label>
            <input type="number" name="hp" value="<?= $pokemon['hp_pokemon'] ?>"><br>
            
            <label>Ataque:</label>
            <input type="number" name="ataque" value="<?= $pokemon['ataque_pokemon'] ?>"><br>
            
            <label>Defesa:</label>
            <input type="number" name="defesa" value="<?= $pokemon['defesa_pokemon'] ?>"><br>
            
            <label>Observação:</label>
            <textarea name="observacao"><?= htmlspecialchars($pokemon['observacao_pokemon']) ?></textarea><br>
            
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>

<?php $conexao->close(); ?>
