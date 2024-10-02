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
            $sql = "SELECT COUNT(*) as total FROM users";
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
            $sql = "SELECT * FROM users";
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
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th class='text-secondary fw-lighter'>ID</th>
                            <th class='text-secondary fw-lighter'>Nome</th>
                            <th class='text-secondary fw-lighter'>Senha</th>
                            <th class='text-secondary fw-lighter'>Acesso</th>
                            <th class='text-secondary fw-lighter'>Email</th>
                            <th class='text-secondary fw-lighter'>CPF</th>
                            <th class='text-secondary fw-lighter'>Telefone</th>
                            <th class='text-secondary fw-lighter'>Situação</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($usuarios as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter'>".$resultado['id']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['name']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['password']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['access_level']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['email']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['cpf']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['phone']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['status']."</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-id='".$resultado['id']."' data-nome='".$resultado['name']."' data-email='".$resultado['email']."' data-situacao='".$resultado['status']."' data-type='".$resultado['access_level']."'></a></td>";
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
