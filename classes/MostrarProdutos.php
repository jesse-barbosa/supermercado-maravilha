<?php
include_once("Conexao.php");
class MostrarProdutos extends Conexao {
    public function mostrarProdutos($categoriaId = null) {
        try {
            // Query para buscar os produtos, com filtro opcional de categoria
            $sql = "
            SELECT 
                p.id as idProduct, 
                p.name as nameProduct, 
                p.description as descProduct, 
                p.price as priceProduct, 
                p.in_stock as quantProduct, 
                p.image as urlImage, 
                c.name as nameCategory,
                c.id as idCategory,
                p.status as statusProduct
            FROM 
                products p
            LEFT JOIN 
                categories c ON p.category_id = c.id
            WHERE 
                p.status = 'ATIVO'";

            // Adicionar o filtro de categoria, se o ID for passado
            if ($categoriaId) {
                $sql .= " AND c.id = " . intval($categoriaId);
            }

            // Executar a query
            $query = self::execSql($sql);
            $produtos = self::listarDados($query);

            // Verificar se há produtos
            if (count($produtos) > 0) {
                // Agrupar os produtos por categoria
                $produtosAgrupados = [];
                foreach ($produtos as $produto) {
                    $produtosAgrupados[$produto['nameCategory']][] = $produto;
                }

                // Loop por categorias e produtos para exibir no HTML
                foreach ($produtosAgrupados as $categoria => $produtos) {
                    echo "<h2 class='mt-4 fw-medium'>{$categoria}</h2>";
                    echo "<div class='product-scroll'>";
                    
                    foreach ($produtos as $produto) {
                        echo "
                        <div class='card text-center border-0 fixed-card'>
                            <img src='{$produto['urlImage']}' class='card-img-top mx-auto my-2' alt='{$produto['nameProduct']}' />
                            <div class='card-body'>
                                <h5 class='card-title'>{$produto['nameProduct']}</h5>
                                <p class='card-text'>R$ " . number_format($produto['priceProduct'], 2, ',', '.') . "</p>
                                <a href='#' class='btn btn-success form-control'>Adicionar</a>
                            </div>
                        </div>
                        ";
                    }

                    echo "</div>"; // Fechar o container da categoria
                }
            } else {
                echo "<p class='text-center text-dark pt-2'>Nenhum produto disponível no momento.</p>";
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao buscar produtos: " . $e->getMessage() . "</p>";
        }
    }
}

?>
