<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM pokemon WHERE id_pokemon = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: informacoes-pokemon.php");
        exit;
    } else {
        echo "Erro ao excluir Pokémon.";
    }
} else {
    echo "ID inválido.";
}

$conexao->close();
?>
