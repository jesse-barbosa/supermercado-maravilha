<?php
include_once("Conexao.php");
class SubCategoria extends Conexao {
    private $nome, $descricao, $situacao;

    public function __construct($nome, $descricao, $situacao){
        parent::__construct();

        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->situacao = $situacao;
    }

    public function adicionarSubCategoria() {
        try {
            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO subcategories (nameSubCategory, descSubCategory, statusSubCategory)
                    VALUES ('$this->nome', '$this->descricao', '$this->situacao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Sub Categoria adicionada com sucesso!');window.location.href = 'index.php?tela=cadListarSubCategoria'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar sub categoria: " . $e->getMessage();
        }
    }
}
