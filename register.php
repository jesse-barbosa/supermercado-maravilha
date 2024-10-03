<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ECE1C0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: #ffffff;
            padding: 10px 40px;
            border-radius: 12px;
        }
        h2 {
            color: #4B8339;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #4B8339;
            border: none;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #3d6b2e;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="register-container">
                <div class="logo">
                    <img src="img/logo.svg" alt="Logo" style="width: 80px;">
                </div>
                <h2 class="text-center">Crie sua Conta</h2>
                <form action="register.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" placeholder="Seu nome completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Seu melhor email" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control" placeholder="Digite seu CPF" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Digite seu telefone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" placeholder="Uma senha segura" required>
                    </div>
                    <input type="submit" name="enviar" class="btn btn-primary w-100" value="Cadastrar" />
                </form>
                <?php
                if (isset($_POST["enviar"])) {
                    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["cpf"]) || empty($_POST["phone"]) || empty($_POST["password"])) {
                        echo "<div class='alert alert-warning mt-3' role='alert'>Por favor, preencha todos os campos.</div>";
                    } else {
                        $nome = $_POST["name"];
                        $email = $_POST["email"];
                        $senha = $_POST["password"];
                        $cpf = $_POST["cpf"];
                        $phone = $_POST["phone"];

                        include_once("classes/Register.php");
                        $dados = new Register();
                        $dados->Register($nome, $email, $senha, $cpf, $phone);
                    }
                }
                ?>
                <p class="mt-3 text-center">
                    Já tem uma conta? <a href="index.php">Faça login</a>
                </p>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
