<?php
include_once("CriaPaginacao.php");

class MostrarUsuarios extends criaPaginacao {
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

    public function totalUsuarios() {
        try {
            $sql = "SELECT COUNT(*) as total FROM users WHERE deletedUser = 0";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            // Retornar o total de usuários
            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os usuários: " . $e->getMessage();
        }
    }
    public function mostrarUsuario() {
        try {
            $sql = "SELECT * FROM users WHERE deletedUser = 0";
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(6);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;

            $usuarios = $this->results();

            if (count($usuarios) > 0) {
                echo "
                <table class='table table-light table-hover'>
                    <thead>
                        <tr class='text-center table-dark'>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Situação</th>
                            <th>Tipo</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($usuarios as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter'>".$resultado['idUser']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['nameUser']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['emailUser']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['passwordUser']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['statusUser']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['typeUser']."</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-id='".$resultado['idUser']."' data-nome='".$resultado['nameUser']."' data-email='".$resultado['emailUser']."' data-situacao='".$resultado['statusUser']."' data-type='".$resultado['typeUser']."'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash btn btn-dark' data-id='".$resultado['idUser']."'></a></td>";
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
