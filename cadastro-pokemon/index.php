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
    <script src="./js/script.js"></script>
</head>
<body class="body-cadastro">
  <!-- Botão hambúrguer -->
  <div class="hamburguer" onclick="toggleMenu()">
    &#9776; <!-- Ícone de menu hambúrguer -->
  </div>

  <!-- Menu lateral -->
  <nav class="menu-lateral" id="menuLateral">
    <h2>PokéMenu</h2>
    <ul>
      <li><a href="index.php">Cadastrar Pokémon</a></li>
      <li><a href="./php/informacoes-pokemon.php">Lista dos Pokémons</a></li>
    </ul>
  </nav>

  <!-- Conteúdo principal -->
  <div class="conteudo-principal">
    <h1 class="titulo-cadastro">Cadastro de Pokémons</h1>

    <form action="" method="POST" class="form-pokemon">
      <label for="nome">Nome:</label>
      <input required type="text" name="nome" id="nome" placeholder="Nome do Pokémon">

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
      <input type="number" name="hp" id="hp" min="0" placeholder="Quanto de vida o Pokémon possui?" required>

      <label for="ataque">Ataque:</label>
      <input type="text" name="ataque" id="ataque" placeholder="Quanto de ataque o Pokémon possui?" required>

      <label for="defesa">Defesa:</label>
      <input type="text" name="defesa" id="defesa" placeholder="Quanto de defesa o Pokémon possui?" required>

      <label for="observacoes">Observações:</label>
      <textarea name="observacoes" id="observacoes" rows="4" placeholder="Comportamento, condição, etc."></textarea>

      <button type="submit">Registrar Pokémon</button>
    </form>
  </div>
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
    $stmt = $conexao->prepare("INSERT INTO pokemon (nome, tipo, localizacao, data_registro, hp, ataque, defesa, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

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