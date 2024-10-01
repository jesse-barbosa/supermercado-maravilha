<?php
include_once("CriaPaginacao.php");

class MostrarProdutos extends CriaPaginacao {
    private $strNumPagina, $strUrl, $strSessao;

    public function setNumPagina($x) {
        $this->strNumPagina = $x;
    }

    public function setUrl($x) {
        $this->strUrl = $x;
    }

    public function setSessao($x) {
        $this->strSessao = $x;
    }

    public function getPagina() {
        return $this->strNumPagina;
    }

    public function totalProdutos() {
        try {
            $sql = "SELECT COUNT(*) as total FROM products";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);
            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os produtos: " . $e->getMessage();
        }
    }

    public function mostrarProdutos() {
        try {
            $sql = "
            SELECT 
                p.id as idProduct, 
                p.name as nameProduct, 
                p.description as descProduct, 
                p.price as priceProduct, 
                p.in_stock as quantProduct, 
                p.image as urlImage, 
                c.name as nameCategory,
                p.status as statusProduct
            FROM 
                products p
            LEFT JOIN 
                categories c ON p.category_id = c.id";
        
            // Configurações de paginação
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(5);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            $this->iniciaPaginacao();
        
            $produtos = $this->results();
        
            if (count($produtos) > 0) {
                echo "
                <table class='table table-light table-hover'>
                    <thead>
                        <tr class='text-center table-dark'>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Quantidade</th>
                            <th>Imagem</th>
                            <th>Categoria</th>
                            <th>Situação</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($produtos as $resultado) {
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter'>" . htmlspecialchars($resultado['idProduct']) . "</td>";
                        echo "<td class='fw-lighter'>" . htmlspecialchars($resultado['nameProduct']) . "</td>";
                        echo "<td class='fw-lighter'>" . htmlspecialchars($resultado['descProduct']) . "</td>";
                        echo "<td class='fw-lighter'>" . htmlspecialchars($resultado['priceProduct']) . "</td>";
                        echo "<td class='fw-lighter'>" . htmlspecialchars($resultado['quantProduct']) . "</td>";
                        if (!empty($resultado['urlImage'])) {
                            echo "<td class='fw-lighter'><img src='" . htmlspecialchars($resultado['urlImage']) . "' class='h-25 w-25' alt='Imagem do Produto'/></td>";
                        } else {
                            echo "<td class='fw-lighter'>Sem imagem</td>";
                        }
                        echo "<td class='fw-lighter'>" . htmlspecialchars($resultado['nameCategory']) . "</td>";
                        echo "<td class='fw-lighter'>" . htmlspecialchars($resultado['statusProduct']) . "</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editProductModal' data-id='" . htmlspecialchars($resultado['idProduct']) . "' data-url='" . htmlspecialchars($resultado['urlImage']) . "' data-nome='" . htmlspecialchars($resultado['nameProduct']) . "' data-descricao='" . htmlspecialchars($resultado['descProduct']) . "' data-quantidade='" . htmlspecialchars($resultado['quantProduct']) . "' data-preco='" . htmlspecialchars($resultado['priceProduct']) . "'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash btn btn-outline-danger' data-id='" . htmlspecialchars($resultado['idProduct']) . "'></a></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "<p class='text-center'>Nenhum produto cadastrado.</p>";
            }
        } catch (Exception $e) {
            echo "Erro ao mostrar os produtos: " . $e->getMessage();
        }
    }
}
?>
