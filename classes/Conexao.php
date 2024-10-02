<?php
abstract class Conexao
{
    protected $servidor, $usuario, $senha, $banco, $conectar, $sql, $query, $dados, $totalDados;
    /**Método construtor para realizar uma conexão no banco de dados, este método será executado automaticamente sempre que esta classe for herdada */
    public function __construct()
    {
        $this->servidor = "localhost";
        $this->usuario = "root";
        $this->senha = "";
        $this->banco = "dbsupermarket";
        self::conectar();
    }
    /**Método que recebe os dados necessários para realizar uma conexão ao banco e executa o comando */
    protected function conectar()
    {
        try {
            $this->conectar = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
        } catch (Exception $e) {
            echo "Erro ao conectar o banco de dados ".$this->banco.":".$e->getMessage();
        }
    }
    /**Método que realiza uma consulta ao banco de dados */
    protected function execSql($sql){
            $this->sql = $this->conectar->query($sql);
            return $this->sql;
    }
    /**Método para listar os valores que foram encontrados no banco de dados */
    protected function listarDados($qr){
            $this->dados = mysqli_fetch_assoc($qr);
            return $this->dados;
    }
    /**Método que contabiliza a quantidade de itens foram encontrdos na consulta */
    protected function contarDados($qr){
        try {
            $this->totalDados = mysqli_num_rows($qr);
            return $this->totalDados;
        } catch (Exception $e) {
            echo "<br><b>Erro ao retornar a quantidade de dados buscados: </b>" . $this->totalDados;
            echo "<br><b>Mensagem do MySql: </b>" . $e->getMessage();
        }
    }
}