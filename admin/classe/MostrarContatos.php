<?php
include_once("CriaPaginacao.php");
class MostrarContato extends criaPaginacao {
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

    public function mostrarContato() {
        try {
            $sql = "SELECT * FROM contacts";
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(9);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;

            $contatos = $this->results();

            if (count($contatos) > 0) {
                echo "
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Mensagem</th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($contatos as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter'>".$resultado['id']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['name']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['email']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['message']."</td>";
                        echo "<td><a href='#' class='bi bi-trash btn btn-dark' data-id='".$resultado['id']."'></a></td>";
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
