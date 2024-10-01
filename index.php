<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center">Login</h2>
                <form action="telas/index.php" method="POST" class="form bg-white p-3 rounded-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"  placeholder="Digite seu email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" placeholder="Digite sua senha">
                    </div>
                    <input type="submit" class="btn btn-primary w-100" value="Entrar"/>
                </form>
                <p class="mt-3 text-center">
                    Não tem uma conta? <a href="register.php">Cadastre-se</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
