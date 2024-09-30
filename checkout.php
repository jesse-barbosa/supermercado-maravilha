<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">Pagamento</h2>
        <form>
            <div class="mb-3">
                <label for="numero-cartao" class="form-label">Número do Cartão</label>
                <input type="text" class="form-control" id="numero-cartao" placeholder="Digite o número do seu cartão">
            </div>
            <div class="mb-3">
                <label for="validade" class="form-label">Validade</label>
                <input type="text" class="form-control" id="validade" placeholder="MM/AA">
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">Código de Segurança (CVV)</label>
                <input type="text" class="form-control" id="cvv" placeholder="CVV">
            </div>
            <button type="submit" class="btn btn-primary w-100">Pagar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
