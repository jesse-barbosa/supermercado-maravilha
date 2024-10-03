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
            padding: 40px;
            border-radius: 12px;
        }
        h2 {
            color: #4B8339;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #E37A35;
            border: none;
        }
        .btn-primary:hover {
            background-color: #FCC83A;
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
        <div class="col-9">
            <div class="register-container">
                <div class="logo">
                    <img src="img/logo.svg" alt="Logo" style="width: 80px;">
                </div>
                <h2 class="text-center">Cadastro</h2>
                <form action="telas/index.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" placeholder="Digite seu nome completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Digite seu email" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control" placeholder="Digite seu CPF" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control" placeholder="Digite seu telefone" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" placeholder="Crie uma senha" required>
                    </div>
                    <input type="submit" class="btn btn-primary w-100" value="Cadastrar" />
                </form>
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
