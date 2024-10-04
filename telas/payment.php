<?php
include_once('../classes/Cart.php');
include_once('../classes/Order.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay'])) {
    $cart = new Cart();
    $orders = new Order();
    $userId = $_SESSION['id'];

    // Obtém os itens do carrinho
    $cartItems = $cart->getItems($userId)['items'];
    $total_price = 0;

    foreach ($cartItems as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    $status = 2;

    $response = $orders->createOrder($userId, $cartItems,  $status);

    if ($response['status']) {
        echo "<script>alert('Pedido criado com sucesso!'); window.location.href='index.php?tela=orders'</script>";
        exit;
    } else {
        echo "<p>Erro ao criar o pedido: " . $response['message'] . "</p>";
    }
}

// Obtém os itens do carrinho para exibir
$cart = new Cart();
$products = $cart->getItems($_SESSION['id'])['items'];

$total_price = 0;

foreach ($products as $product) {
    $total_price += $product['price'] * $product['quantity'];
}
?>
    <style>
        .payment-option {
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .payment-option.selected {
            background-color: #f0f0f0;
            border-color: #000;
        }
    </style>
<section style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; gap: 12px; margin: 12px; min-height: 80vh;">
    <div class="d-flex justify-content-between w-75">
        <a href="index.php?tela=cart" style="text-decoration: none; color: inherit;">
            <button type="button" style="border: none; background-color: transparent; cursor: pointer;">
                <i class="bi bi-arrow-left" style="font-size: 26px;"></i>
            </button>
        </a>
        <h2 class="mt-2 fw-medium">Faça o Pagamento</h2>
    </div>

    <section class='p-3' style="display: flex; flex-direction: column; gap: 2px; height: 32vh; overflow: auto;">
        <?php
        if ($products == null) {
            echo "<div class='text-center my-auto flex-column'>";
            echo "<i class='bi bi-emoji-frown fs-1 text-secondary'></i>";
            echo "<h2 class='mt-3 text-secondary'> Ops! Seu carrinho está vazio.</h2>";
            echo "</div>";
        }

        foreach ($products as $product) {
            $productPriceFormat = number_format($product['price'], 2, ',', '.');

            echo "
            <div style='display: flex; align-items: center; justify-content: start; gap: 6px; padding: 4px; background-color: white; border-radius: 4px; position: relative; margin-right: 20px; margin-left: 20px; border: 1px solid #D1D1D1;'>
                <img src='$product[image]' alt='$product[name]' style='width: 36px; height: 36px;' />
                <div style='display: flex; flex-direction: column; justify-content: start; width: 100%;'>
                    <p style='font-weight: bold; text-align: start; margin: 0;'>$product[name]</p>
                    <p style='text-align: start; margin: 0;'>R$ $productPriceFormat</p>
                </div>
                <div class='text-secondary' style='position: absolute; top: 10px; right: 3%; font-size: 20px;'>
                    <span>x$product[quantity]</span>
                </div>
            </div>";
        }
        ?>
    </section>

    <div class="card mx-auto mt-4" style="max-width: 400px;">
        <div class="card-body">
            <h5 class="text-center">Selecione a forma de pagamento</h5>
            <div id="payment-options">
                <div class="payment-option py-2 border rounded my-1 px-2" id="credit-card-option">
                    <i class="bi bi-credit-card"></i> Cartão de Crédito
                </div>
                <div class="payment-option py-2 border rounded my-1 px-2" id="boleto-option">
                    <i class="bi bi-receipt"></i> Boleto Bancário
                </div>
                <div class="payment-option py-2 border rounded my-1 px-2" id="pix-option">
                    <i class="bi bi-qrcode"></i> PIX
                </div>
            </div>

            <div id="credit-card-form" style="display: none;">
                <h5 class="text-center">Pagamento com Cartão</h5>
                <div class="mb-3">
                    <label for="card-name" class="form-label">Nome no Cartão</label>
                    <input type="text" class="form-control" id="card-name" placeholder="Nome completo">
                </div>
                <div class="mb-3">
                    <label for="card-number" class="form-label">Número do Cartão</label>
                    <input type="text" class="form-control" id="card-number" placeholder="0000 0000 0000 0000">
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="card-expiry" class="form-label">Validade</label>
                        <input type="text" class="form-control" id="card-expiry" placeholder="MM/AA">
                    </div>
                    <div class="col-6">
                        <label for="card-cvc" class="form-label">CVC</label>
                        <input type="text" class="form-control" id="card-cvc" placeholder="CVC">
                    </div>
                </div>
            </div>

            <div id="boleto-info" style="display: none;">
                <p class="text-center mt-3">Clique abaixo para gerar seu boleto:</p>
                <button class="btn btn-outline-dark w-100">Gerar Boleto</button>
            </div>

            <div id="pix-info" style="display: none;">
                <p class="text-center mt-3">Escaneie o código QR ou clique na chave PIX para copiar:</p>
                <div class="text-center">
                    <img src="../img/qr-code.png" alt="QR Code PIX" style="width: 150px;">
                    <p style="cursor: pointer; display: inline-block;" onclick="copyPixCode()">
                        Chave PIX:  
                        <span id="pix-code">xxxxxxxxxxxxxx</span>
                        <i class="bi bi-clipboard" style="margin-left: 8px;"></i>
                    </p>
                </div>
            </div>

            <div style="align-items: center; padding: 4px;">
                <p class="my-1 fs-5 fw-semibold">Total a Pagar: R$ <?php echo number_format($total_price, 2, ',', '.'); ?></p>
            </div>
            <form method="POST">
                <input type="hidden" name="payment_method" id="payment_method" value="">
                <input type="submit" name="pay" class="btn btn-dark mt-3 w-100" id="pay-button" value="Pagar">
            </form>
        </div>
    </div>
</section>

<script>
    function copyPixCode() {
        const pixCode = document.getElementById('pix-code').innerText;
        const tempInput = document.createElement('input');
        tempInput.value = pixCode;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Código PIX copiado com sucesso!');
    }

    const creditCardOption = document.getElementById('credit-card-option');
    const boletoOption = document.getElementById('boleto-option');
    const pixOption = document.getElementById('pix-option');
    const creditCardForm = document.getElementById('credit-card-form');
    const boletoInfo = document.getElementById('boleto-info');
    const pixInfo = document.getElementById('pix-info');
    const paymentOptions = document.querySelectorAll('.payment-option');

    function resetPaymentOptions() {
        paymentOptions.forEach(option => {
            option.classList.remove('selected');
        });
    }

    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            resetPaymentOptions();
            option.classList.add('selected');

            if (option.id === 'credit-card-option') {
                creditCardForm.style.display = 'block';
                boletoInfo.style.display = 'none';
                pixInfo.style.display = 'none';
                document.getElementById('payment_method').value = 'credit_card';
            } else if (option.id === 'boleto-option') {
                creditCardForm.style.display = 'none';
                boletoInfo.style.display = 'block';
                pixInfo.style.display = 'none';
                document.getElementById('payment_method').value = 'boleto';
            } else if (option.id === 'pix-option') {
                creditCardForm.style.display = 'none';
                boletoInfo.style.display = 'none';
                pixInfo.style.display = 'block';
                document.getElementById('payment_method').value = 'pix';
            }
        });
    });

    // Função chamada quando o botão de pagamento é clicado
    function setPaymentMethod() {
        const selectedOption = document.querySelector('.payment-option.selected');
        if (!selectedOption) {
            alert('Por favor, selecione uma forma de pagamento!');
            return false; // Previne o envio do formulário
        }
    }
</script>