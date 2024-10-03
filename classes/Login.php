<?php
include_once("Conexao.php");
class Login extends Conexao
{
    public function Login($name, $password)
    {
        try {
            // Get informations user
            $sql = mysqli_query($this->conectar, "SELECT * FROM users WHERE name = '$name' LIMIT 1");

            if ($sql->num_rows == 0) {
                echo "<div class='alert alert-danger mt-3'>Usuário ou Senha Incorretos.</div>";
            }

            $results = $sql->fetch_assoc();

            // Verify if password is correct
            $verifyPassword = password_verify($password, $results['password']);

            if (!$verifyPassword) {
                echo "<div class='alert alert-danger mt-3'>Usuário ou Senha Incorretos.</div>";
            }

            session_start();

            // add user_id in $_SESSION
            $_SESSION['nome'] = $results['name'];
            $_SESSION['id'] = $results['id'];

            // redirect user for home page
            header('Location: /supermarket/telas/index.php?tela=home');

        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
