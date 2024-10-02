<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: white;
            color: #fff;
        }
        .container-fluid {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 2rem;
            width: 100%;
            max-width: 600px;
        }
        .form-control {
            background-color: #333;
            border: 1px solid #444;
            color: #fff;
        }
        .form-control::placeholder {
            color: #888;
        }
        .btn-light {
            background-color: #fff;
            color: #333;
            border: none;
        }
        .btn-light:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="form-container">
            <h2 class="display-6 mb-4 text-center">Painel Administrativo</h2>
            <form action="index.php" method="post">
                <input type="hidden" name="idForm" value="formLogin">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha" class="form-control">
                </div>
                <div class="mt-4">
                    <button type="submit" name="enviar" class="btn btn-light w-100">Entrar</button>
                </div>
                <?php
                if (isset($_POST["enviar"])) {
                    if (empty($_POST["nome"]) || empty($_POST["senha"])) {
                        echo "<div class='alert alert-warning mt-3' role='alert'>Por favor, preencha todos os campos.</div>";
                    } else {
                        include_once("classe/VerificarLogin.php");
                        $dados = new VerificarLogin();
                        $dados->retornarNome($_POST["nome"]);
                        $dados->retornarSenha($_POST["senha"]);
                        $dados->verificarLogin();
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
