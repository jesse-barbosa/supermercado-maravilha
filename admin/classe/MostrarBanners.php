<?php
include_once("CriaPaginacao.php");

class MostrarBanners extends CriaPaginacao {
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

    public function totalBanners() {
        try {
            $sql = "SELECT COUNT(*) as total FROM banners";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os banners: " . $e->getMessage();
        }
    }

    public function mostrarBanners() {
        try {
            $sql = "SELECT * FROM banners";

            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(3);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $banners = $this->results();

            if (count($banners) > 0) {
                echo "
                    <table class='table table-hover'>
                        <thead>
                            <tr class='text-center'>
                                <th>ID</th>
                                <th>Imagem</th>
                                <th>Status</th>
                                <th width='30'></th>
                                <th width='30'></th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                foreach ($banners as $resultado) {
                    echo "<tr class='text-center'>";
                    echo "<td class='fw-lighter'>" . $resultado['id'] . "</td>";
                    echo "<td class='fw-lighter'><img src='" . $resultado['image'] . "' alt='Imagem do Banner' width='100'></td>";
                    echo "<td class='fw-lighter'>" . $resultado['status'] . "</td>";
                    echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editBannerModal' data-id='" . $resultado['id'] . "' data-url='" . $resultado['image']. "' data-situacao='" . $resultado['status'] . "'></a></td>";
                    echo "<td><i class='bi bi-trash btn btn-dark' data-id='" . $resultado['idBanner'] . "'></i></td>";
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
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
