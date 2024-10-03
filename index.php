<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ECE1C0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
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
            <div class="col-6">
                <div class="login-container">
                    <div class="logo">
                        <img src="img/logo.svg" alt="Logo" style="width: 80px;">
                    </div>
                    <h2 class="text-center">Login</h2>
                    <form action="index.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" class="form-control" placeholder="Digite seu nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
                        </div>
                        <input type="submit" name="enviar" class="btn btn-primary w-100" value="Entrar" />
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        require_once "classes/Login.php";
                        $login = new Login();
                        $login->Login(trim($_POST['name']), trim($_POST['password']));
                    }
                    ?>
                    <p class="mt-3 text-center">
                        Não tem uma conta? <a href="register.php">Cadastre-se</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>