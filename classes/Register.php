<?php
include_once("Conexao.php");
class Register extends Conexao {
    public function Register($nome, $email, $senha, $cpf, $phone) {
        try {
            // Verifica se já existe um usuário com o mesmo nome ou email
            $sqlCheck = "SELECT * FROM users WHERE name = '$nome' OR email = '$email'";
            $resultCheck = self::execSql($sqlCheck);

            if ($resultCheck === false) {
                throw new Exception("Erro ao verificar a existência do usuário: " . mysqli_error(self::$conectar));
            }

            // Se o usuário já existir, exibe uma mensagem e interrompe o registro
            $usuariosExistentes = self::contarDados($resultCheck);
            if ($usuariosExistentes > 0) {
                echo "<div class='alert alert-danger mt-3'>Usuário ou email já cadastrado!</div>";
                return;
            }

            // Se não houver registros, procede com o cadastro
            $sqlInsert = "INSERT INTO users (name, password, email, cpf, phone) 
                          VALUES ('$nome', '$email', '$senha', '$cpf', '$phone')";
            $query = self::execSql($sqlInsert);

            // Verifica se a query de inserção foi bem-sucedida
            if ($query === false) {
                throw new Exception("Erro ao inserir o usuário: " . mysqli_error(self::$conectar));
            }

            echo "<div class='alert alert-success mt-3'>Cadastro realizado com sucesso!</div>";
            header('Location: /supermarket/telas/index.php?tela=');

        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}

