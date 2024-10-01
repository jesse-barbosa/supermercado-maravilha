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
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th class='text-secondary fw-light'>ID</th>
                            <th class='text-secondary fw-light'>Produto</th>
                            <th class='text-secondary fw-light'>Descrição</th>
                            <th class='text-secondary fw-light'>Valor</th>
                            <th class='text-secondary fw-light'>Quantidade</th>
                            <th class='text-secondary fw-light'>Imagem</th>
                            <th class='text-secondary fw-light'>Categoria</th>
                            <th class='text-secondary fw-light'>Situação</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($produtos as $resultado) {
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-normal text-dark'>" . htmlspecialchars($resultado['idProduct']) . "</td>";
                        echo "<td class='fw-normal text-dark'>" . htmlspecialchars($resultado['nameProduct']) . "</td>";
                        echo "<td class='fw-normal text-dark'>" . htmlspecialchars($resultado['descProduct']) . "</td>";
                        echo "<td class='fw-normal text-dark'>" . htmlspecialchars($resultado['priceProduct']) . "</td>";
                        echo "<td class='fw-normal text-dark'>" . htmlspecialchars($resultado['quantProduct']) . "</td>";
                        if (!empty($resultado['urlImage'])) {
                            echo "<td class='fw-normal text-dark'><img src='" . htmlspecialchars($resultado['urlImage']) . "' class='h-25 w-25' alt='Imagem do Produto'/></td>";
                        } else {
                            echo "<td class='fw-normal text-dark'>Sem imagem</td>";
                        }
                        echo "<td class='fw-normal text-dark'>" . htmlspecialchars($resultado['nameCategory']) . "</td>";
                        echo "<td class='fw-normal text-dark'>" . htmlspecialchars($resultado['statusProduct']) . "</td>";
                        echo "<td><a href='#' class='bi bi-pencil text-black fs-5' data-bs-toggle='modal' data-bs-target='#editProductModal' data-id='" . htmlspecialchars($resultado['idProduct']) . "' data-url='" . htmlspecialchars($resultado['urlImage']) . "' data-nome='" . htmlspecialchars($resultado['nameProduct']) . "' data-descricao='" . htmlspecialchars($resultado['descProduct']) . "' data-quantidade='" . htmlspecialchars($resultado['quantProduct']) . "' data-preco='" . htmlspecialchars($resultado['priceProduct']) . "'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash text-black fs-5' data-id='" . htmlspecialchars($resultado['idProduct']) . "'></a></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "<p class='text-center text-dark pt-2'>Nenhum produto cadastrado.</p>";
            }
        } catch (Exception $e) {
            echo "Erro ao mostrar os produtos: " . $e->getMessage();
        }
    }
}
?>
