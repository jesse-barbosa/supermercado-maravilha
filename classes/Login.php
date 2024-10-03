<?php
include_once("Conexao.php");
class Login extends Conexao {
    public function Login($nome, $senha) {
     try {
        $sql = "SELECT * FROM users WHERE name = '$nome' AND password = '$senha'";
        $query = self::execSql($sql);
        $resultado = self::listarDados($query);
        $dados = self::contarDados($query);
        
        if($dados <= 0){
            echo "<div class='alert alert-danger mt-3'>Nome ou senha inválidos.</div>";
        }else if($dados == 1){
            session_start();
            
            $_SESSION['nome'] = $nome;
            $_SESSION['senha'] = $senha;
            $_SESSION['access_level'] = $resultado[0]['access_level'];
            
            header('Location: /supermarket/telas/index.php?tela=');
        }
     } catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
     }   
    }
}