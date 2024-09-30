<?php
include_once("MinhaConexao.php");
class Categoria extends MinhaConexao {
    private $nome, $descricao, $situacao;

    public function __construct($nome, $descricao, $situacao){
        parent::__construct();

        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->situacao = $situacao;
    }

    public function adicionarCategoria() {
        try {
            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO categories (nameCategory, descCategory, statusCategory)
                    VALUES ('$this->nome', '$this->descricao', '$this->situacao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Categoria adicionada com sucesso!');window.location.href = 'index.php?tela=cadListarCategoria'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar categoria: " . $e->getMessage();
        }
    }
}
