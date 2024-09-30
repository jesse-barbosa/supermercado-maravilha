<?php
include_once("CriaPaginacao.php");
class MostrarSubCategoria extends CriaPaginacao {
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
    
    public function totalSubCategorias() {
        try {
            $sql = "SELECT COUNT(*) as total FROM subcategories WHERE deletedSubCategory = 0";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os categorias: " . $e->getMessage();
        }
    }
    public function mostrarSubCategoria() {
        try {
            $sql = "SELECT * FROM subcategories WHERE deletedSubCategory = 0";

            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(6);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;
            $subCategorias = $this->results();
            
            if (count($subCategorias) > 0) {
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
                foreach($subCategorias as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter'>".$resultado['idSubCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['nameSubCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['descSubCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['statusSubCategory']."</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editSubCategoryModal' data-id='".$resultado['idSubCategory']."' data-nome='".$resultado['nameSubCategory']."' data-descricao='".$resultado['descSubCategory']."' data-situacao='".$resultado['statusSubCategory']."'></a></td>";
                        echo "<td><i class='bi bi-trash btn btn-dark' data-id='".$resultado['idSubCategory']."'></i></td>";
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
