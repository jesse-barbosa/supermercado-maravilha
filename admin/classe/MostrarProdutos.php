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
                c.id as idCategory,
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
                            <th class='text-secondary fw-lighter'>ID</th>
                            <th class='text-secondary fw-lighter'>Produto</th>
                            <th class='text-secondary fw-lighter'>Descrição</th>
                            <th class='text-secondary fw-lighter'>Valor</th>
                            <th class='text-secondary fw-lighter'>Quantidade</th>
                            <th class='text-secondary fw-lighter'>Imagem</th>
                            <th class='text-secondary fw-lighter'>Categoria</th>
                            <th class='text-secondary fw-lighter'>Situação</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($produtos as $resultado) {
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter text-dark'>" . $resultado['idProduct'] . "</td>";
                        echo "<td class='fw-lighter text-dark'>" . $resultado['nameProduct'] . "</td>";
                        echo "<td class='fw-lighter text-dark'>" . $resultado['descProduct'] . "</td>";
                        echo "<td class='fw-lighter text-dark'>" . $resultado['priceProduct'] . "</td>";
                        echo "<td class='fw-lighter text-dark'>" . $resultado['quantProduct'] . "</td>";
                        if (!empty($resultado['urlImage'])) {
                            echo "<td class='fw-lighter text-dark'><img src='" . $resultado['urlImage'] . "' class='h-25 w-25' alt='Imagem do Produto'/></td>";
                        } else {
                            echo "<td class='fw-lighter text-dark'>Sem imagem</td>";
                        }
                        echo "<td class='fw-lighter text-dark'>" . $resultado['nameCategory'] . "</td>";
                        echo "<td class='fw-lighter text-dark'>" . $resultado['statusProduct'] . "</td>";
                        echo "<td><a href='#' class='bi bi-pencil text-black fs-5' 
                        data-bs-toggle='modal' 
                        data-bs-target='#editProductModal' 
                        data-id='" . $resultado['idProduct'] . "' 
                        data-url='" . $resultado['urlImage'] . "' 
                        data-nome='" . $resultado['nameProduct'] . "' 
                        data-descricao='" . $resultado['descProduct'] . "' 
                        data-quantidade='" . $resultado['quantProduct'] . "' 
                        data-preco='" . $resultado['priceProduct'] . "'
                        data-categoria='" . $resultado['idCategory'] . "'
                        data-situacao='" . $resultado['statusProduct'] . "'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash text-black fs-5' data-id='" . $resultado['idProduct'] . "'></a></td>";
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
