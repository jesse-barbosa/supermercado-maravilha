<?php
abstract class Conexao
{
    protected $servidor, $usuario, $senha, $banco, $conectar, $sql, $query, $dados, $totalDados;

    public function __construct()
    {
        $this->servidor = "localhost";
        $this->usuario = "root";
        $this->senha = "";
        $this->banco = "dbsupermarket";
        self::conectar();
    }

    protected function conectar()
    {
        try {
            $this->conectar = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
        } catch (Exception $e) {
            echo "Erro ao conectar o banco de dados ".$this->banco.":".$e->getMessage();
        }
    }

    protected function execSql($sql)
    {
        $this->sql = $this->conectar->query($sql);
        return $this->sql;
    }

    // Corrigido para listar múltiplos registros
    protected function listarDados($qr)
    {
        $this->dados = [];
        while ($row = mysqli_fetch_assoc($qr)) {
            $this->dados[] = $row;  // Adiciona cada linha ao array
        }
        return $this->dados;
    }

    protected function contarDados($qr)
    {
        try {
            $this->totalDados = mysqli_num_rows($qr);
            return $this->totalDados;
        } catch (Exception $e) {
            echo "<br><b>Erro ao retornar a quantidade de dados buscados: </b>" . $this->totalDados;
            echo "<br><b>Mensagem do MySql: </b>" . $e->getMessage();
        }
    }
}