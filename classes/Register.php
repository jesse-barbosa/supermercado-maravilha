<?php
include_once("Conexao.php");
class Register extends Conexao
{
    public function Register($name, $email, $password, $cpf, $phone)
    {
        // Verify Email is Valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-danger mt-3'>Email inválido.</div>";
            return;
        }

        // Verify Name is Exists
        $sql = mysqli_query($this->conectar, "SELECT * FROM users WHERE name = '$name'");

        if ($sql->num_rows > 0) {
            echo "<div class='alert alert-danger mt-3'>Usuário já cadastrado.</div>";
            return;
        }

        // Verify if cpf contains 11 letters
        $contCpf = strlen($cpf);

        if ($contCpf != 11) {
            echo "<div class='alert alert-danger mt-3'>CPF Inválido, Somente Números!</div>";
            return;
        }

        // Verify if phone contains 11 letters
        $contPhone = strlen($phone);

        if ($contPhone != 11) {
            echo "<div class='alert alert-danger mt-3'>Telefone Inválido, Somente Números!</div>";
            return;
        }  

        // Open Transaction for Database
        mysqli_begin_transaction($this->conectar);

        try {
            // Transform password in hash
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insert information about user in Database
            $sql = mysqli_query($this->conectar, "INSERT INTO users (name, password, email, cpf, phone) 
            VALUES ('$name', '$passwordHash','$email', '$cpf', '$phone')");

            // Save informations
            mysqli_commit($this->conectar);

            // Get informations
            $sql = mysqli_query($this->conectar, "SELECT * FROM users WHERE name = '$name' LIMIT 1");

            $results = $sql->fetch_assoc();

            session_start();

            // add user_id in $_SESSION
            $_SESSION['id'] = $results['id'];

            // redirect user for home page
            header('Location: /supermarket/telas/index.php?tela=home');

        } catch (Exception $e) {
            // if rollback has error
            mysqli_rollback($this->conectar);
            echo "Erro: " . $e->getMessage();
        }
    }
}
