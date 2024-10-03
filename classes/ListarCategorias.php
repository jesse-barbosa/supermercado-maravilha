<?php
include_once("Conexao.php");
class ListarCategorias extends Conexao {
    public function listarCategorias() {
        try {
            // Executa a consulta para listar as categorias
            $sql = "SELECT id, name FROM categories";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            // Verifica se há dados e gera o HTML
            if (count($resultado) > 0) {
                foreach ($resultado as $categoria) {
                    // Passa o ID da categoria corretamente na URL
                    echo "<li><a class='dropdown-item' href='index.php?categoria_id=" . $categoria['id'] . "'>" . $categoria['name'] . "</a></li>";
                }
            } else {
                echo "<li><a class='dropdown-item' href='#'>Nenhuma categoria encontrada</a></li>";
            }
        } catch (Exception $e) {
            echo "<li><a class='dropdown-item' href='#'>Erro: " . $e->getMessage() . "</a></li>";
        }
    }
}
?>
