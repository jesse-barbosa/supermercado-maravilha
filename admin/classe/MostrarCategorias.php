<?php
include_once("CriaPaginacao.php");

class MostrarCategorias extends CriaPaginacao {
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
    public function totalCategorias() {
        try {
            $sql = "SELECT COUNT(*) as total FROM categories WHERE deletedCategory = 0";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar as categorias: " . $e->getMessage();
        }
    }
    public function mostrarCategoria() {
        try {
            $sql = "SELECT * FROM categories WHERE deletedCategory = 0";
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(6);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;
            $categorias = $this->results();

            if (count($categorias) > 0) {
                echo "
                <table class='table table-light table-hover'>
                    <thead>
                        <tr class='text-center table-dark'>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Situação</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($categorias as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter'>".$resultado['idCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['nameCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['descCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['statusCategory']."</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editCategoryModal' data-id='".$resultado['idCategory']."' data-nome='".$resultado['nameCategory']."' data-descricao='".$resultado['descCategory']."' data-situacao='".$resultado['statusCategory']."'></a></td>";
                        echo "<td><i class='bi bi-trash btn btn-dark' data-id='".$resultado['idCategory']."'></i></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "Nenhum dado encontrado.";
            }
        } catch (Exception $e) {
            echo "Erro: ".$e->getMessage();
        }
    }
}
?>
