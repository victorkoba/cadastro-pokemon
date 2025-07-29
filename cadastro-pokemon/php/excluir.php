<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM pokemon WHERE id_pokemon = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>
        localStorage.setItem('pokemon_excluido', '1');
        window.location.href = 'informacoes-pokemon.php';
    </script>";
    exit;
}

else {
        echo "Erro ao excluir Pokémon.";
    }
} else {
    echo "ID inválido.";
}

$conexao->close();
?>
