<?php
include './php/conexao.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pokemon</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="body-cadastro">
    <form action="" method="POST" class="form-pokemon">
        <div class="form-pokemon">
            <label for="nome">Nome:</label>
            <input required type="text" name="nome" id="nome">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="">Selecione...</option>
                <option value="Fogo">Fogo</option>
                <option value="Água">Água</option>
                <option value="Planta">Planta</option>
                <option value="Elétrico">Elétrico</option>
                <option value="Pedra">Pedra</option>
            </select>

        <label for="localizacao">Localização Encontrada:</label>
        <input type="text" name="localizacao" id="localizacao" placeholder="Rua, Bairro..." required>

        <label for="data_registro">Data do Registro:</label>
        <input type="date" name="data_registro" id="data_registro" required>

        <label for="hp">HP:</label>
        <input type="number" name="hp" id="hp" required>

        <label for="ataque">Ataque:</label>
        <input type="text" name="ataque" id="ataque" required>

        <label for="defesa">Defesa:</label>
        <input type="text" name="defesa" id="defesa" required>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" id="observacoes" rows="4" placeholder="Comportamento, condição, etc."></textarea>

        <button type="submit">Registrar Pokémon</button>
        </div>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $data = $_POST['data_registro'];
    $hp = $_POST['hp'];
    $ataque = $_POST['ataque'];
    $defesa = $_POST['defesa'];
    $observacoes = $_POST['observacoes'];

    // Criar a query com prepared statement
    $stmt = $conn->prepare("INSERT INTO pokemons (nome, tipo, localizacao, data_registro, hp, ataque, defesa, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Verificar se a preparação falhou
    if (!$stmt) {
        die("Erro ao preparar: " . $conexao->error);
    }

    // Vincular os parâmetros (todos como string exceto hp que é inteiro)
    $stmt->bind_param("ssssisss", $nome, $tipo, $localizacao, $data, $hp, $ataque, $defesa, $observacoes);

    // Executar e verificar
    if ($stmt->execute()) {
        echo "Pokémon registrado com sucesso!";
    } else {
        echo "Erro ao registrar: " . $stmt->error;
    }

    // Fechar
    $stmt->close();
    $conexao->close();
}
?>