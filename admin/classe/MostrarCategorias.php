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
            $sql = "SELECT COUNT(*) as total FROM categories";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar as categorias: " . $e->getMessage();
        }
    }
    public function mostrarCategoria() {
        try {
            $sql = "SELECT * FROM categories";
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
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th class='text-secondary fw-light'>ID</th>
                            <th class='text-secondary fw-light'>Nome</th>
                            <th class='text-secondary fw-light'>Descrição</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($categorias as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-light'>".$resultado['id']."</td>";
                        echo "<td class='fw-light'>".$resultado['name']."</td>";
                        echo "<td class='fw-light'>".$resultado['description']."</td>";   
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editCategoryModal' data-id='".$resultado['id']."' data-nome='".$resultado['name']."' data-descricao='".$resultado['description']."'></a></td>";
                        echo "<td><i class='bi bi-trash btn btn-dark' data-id='".$resultado['id']."'></i></td>";
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
