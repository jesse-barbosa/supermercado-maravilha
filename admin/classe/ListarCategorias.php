<?php
include_once("Conexao.php");

class ListarCategorias extends Conexao {
    public function listarCategorias(): array
    {
        try {
            $sql = "SELECT idCategory, nameCategory FROM categories WHERE deletedCategory = 0";
            $resultado = self::execSql($sql);

            if (mysqli_num_rows($resultado) > 0) {
                $categorias = [];
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $categorias[] = $row;
                }
                return $categorias;
            } else {
                return [];
            }
        } catch (Exception $e) {
            echo "Erro ao listar categorias: " . $e->getMessage();
            return [];
        }
    }
}
?>
