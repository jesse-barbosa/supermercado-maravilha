<?php
include_once("Conexao.php");

class ListarSubCategorias extends Conexao {
    public function listarSubCategorias(): array
    {
        try {
            $sql = "SELECT idSubCategory, nameSubCategory FROM subcategories WHERE deletedSubCategory = 0";
            $resultado = self::execSql($sql);

            if (mysqli_num_rows($resultado) > 0) {
                $subcategorias = [];
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $subcategorias[] = $row;
                }
                return $subcategorias;
            } else {
                return [];
            }
        } catch (Exception $e) {
            echo "Erro ao listar subcategorias: " . $e->getMessage();
            return [];
        }
    }
}
?>
