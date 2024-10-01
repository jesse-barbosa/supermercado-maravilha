<?php
include_once("Conexao.php");
class Usuario extends Conexao {

    public function __construct(){
        parent::__construct();
    }

    public function adicionarUsuario($nome, $email, $senha, $typeUser, $situacao)
    {
        try {

            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO users (nameUser, emailUser, passwordUser, typeUser, statusUser)
             VALUES ('$nome', '$email', '$senha', '$typeUser', '$situacao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Usuário adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarUsuario'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar Usuário: " . $e->getMessage();
        }
    }
}
