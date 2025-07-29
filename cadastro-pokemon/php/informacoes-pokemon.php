<?php
include 'conexao.php'; 

$termo = "";
if (isset($_GET['pesquisa'])) {
    $termo = $_GET['pesquisa'];
    $sql = "SELECT * FROM pokemon WHERE nome_pokemon LIKE ?";
    $stmt = $conexao->prepare($sql);
    $busca = "%$termo%";
    $stmt->bind_param("s", $busca);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
$sql = "SELECT * FROM pokemon";
    $resultado = $conexao->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pokémons Encontrados</title>
    <link rel="stylesheet" href="../css/style-inform.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body class="body-inform">
      <!-- Botão hambúrguer -->
  <div class="hamburguer" onclick="toggleMenu()">
    &#9776; <!-- Ícone de menu hambúrguer -->
  </div>

  <!-- Menu lateral -->
  <nav class="menu-lateral" id="menuLateral">
    <h2>PokéMenu</h2>
    <ul>
      <li><a href="../index.php">Cadastrar Pokémon</a></li>
      <li><a href="informacoes-pokemon.php">Lista dos Pokémons</a></li>
    </ul>
  </nav>
    <div class="container">
        <h1>Pokémons Encontrados</h1>

        <form method="GET" action="">
            <input type="text" name="pesquisa" placeholder="Pesquisar por nome..." value="<?= htmlspecialchars($termo) ?>">
            <button type="submit">Buscar</button>
        </form>

        <?php if ($resultado->num_rows > 0): ?>
            <table>
                <thead>
    <tr>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Localização</th>
        <th>Data</th>
        <th>HP</th>
        <th>Ataque</th>
        <th>Defesa</th>
        <th>Observações</th>
        <th>Ações</th>
    </tr>
</thead>
<tbody>
    <?php while ($row = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nome_pokemon']) ?></td>
            <td><?= htmlspecialchars($row['tipo_pokemon']) ?></td>
            <td><?= htmlspecialchars($row['localizacao_pokemon']) ?></td>
            <td><?= date('d/m/Y', strtotime($row['data_registro_pokemon'])) ?></td>
            <td><?= $row['hp_pokemon'] ?></td>
            <td><?= $row['ataque_pokemon'] ?></td>
            <td><?= $row['defesa_pokemon'] ?></td>
            <td><?= htmlspecialchars($row['observacao_pokemon']) ?></td>
            <td>
    <a href="editar.php?id=<?= $row['id_pokemon'] ?>" class="edit">Editar</a>
    <button onclick="confirmarExclusao(<?= $row['id_pokemon'] ?>)" class="btn-excluir">Excluir</button>
</td>

        </tr>
    <?php endwhile; ?>
</tbody>

            </table>
        <?php else: ?>
            <p>Nenhum Pokémon encontrado.</p>
        <?php endif; ?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function confirmarExclusao(id) {
    Swal.fire({
      title: 'Tem certeza?',
      text: "Você deseja excluir este Pokémon?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Salva no localStorage e redireciona
        window.location.href = `excluir.php?id=${id}`;
      }
    });
  }

  // SweetAlert pós-exclusão (verifica localStorage)
  if (localStorage.getItem('pokemon_excluido')) {
    Swal.fire({
      icon: 'success',
      title: 'Excluído!',
      text: 'O Pokémon foi removido com sucesso.'
    });
    localStorage.removeItem('pokemon_excluido');
  }
</script>


</body>
</html>

<?php $conexao->close(); ?>
