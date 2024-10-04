<main>
<a href="index.php?tela=cart" class="text-decoration-none">
        <div class="container-fluid my-3">
            <div class="buy-list p-3 rounded-5 d-flex justify-content-between mx-auto">
                <div class="flex-column">
                    <h2 class="text-black opacity-50 fw-bold">Lista de Compras</h2>
                    <?php
                        include_once("../classes/Cart.php");

                        $cart = new Cart();
                        echo $cart->getItemsCard($_SESSION['id']);
                    ?>
                </div>
                <img src="../img/ilustration.svg" style="width: 160px !important; height: 160px !important;" alt="">
            </div>
        </div>
    </a>
    <!-- Modal de produto -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="" width="160" alt="" class="product-img">
                        </div>
                        <div class="col-6 col">
                            <h4 class="text fw-semibold">Nome do produto</h4>
                            <p class="text1">R$00,00</p>
                            <div class="col-12 text-start d-flex gap-3">
                                <button type="button" class="btn btn-outline-dark btn-decrement">−</button>
                                <span class="product-quantity">1</span>
                                <button type="button" class="btn btn-outline-dark btn-increment">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <!-- Formulário para adicionar ao carrinho -->
                    <form method="POST" action="index.php">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" />
                        <input type="hidden" name="product_id" class="product-id" />
                        <input type="hidden" name="quantity" class="modal-quantity" value="1" />
                        <button type="submit" name="enviar" class="form-control btn btn-confirm text-white">Confirmar</button>
                    </form>
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
                            include_once("../classes/Cart.php");

                            $cart = new Cart();
                            $userId = $_POST['user_id'];
                            $productId = (int) $_POST['product_id'];
                            $quantity = $_POST['quantity'];
                            
                            if ($productId > 0 && $quantity > 0) {
                                $response = $cart->addItem($userId, $productId, $quantity);

                                if ($response['status']) {
                                    echo("<script>window.location.href='index.php?tela=cart'</script>");
                                    exit;
                                } else {
                                    echo "Erro ao adicionar ao carrinho: " . $response['message'];
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container rounded-lg px-3">
        <div class="mb-3">
            <label for="product-code" class="form-label fw-medium opacity-75 fs-4">Insira o Token do Produto</label>
            <form method="GET" action="">
                <input type="hidden" name="categoria_id" value="<?php echo isset($_GET['categoria_id']) ? htmlspecialchars($_GET['categoria_id']) : ''; ?>" />
                <div class="input-group ">
                    <input type="text" class="form-control rounded-end-0 rounded-4 search py-3" id="product-code" name="token_produto" placeholder="Ex: #123" />
                    <button type="submit" class="btn search rounded-start-0 rounded-4 py-3"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>

        <?php
        include_once("../classes/MostrarProdutos.php");

        // Capturar o ID da categoria e o token do produto
        $categoriaId = isset($_GET['categoria_id']) ? trim($_GET['categoria_id']) : null;
        $tokenProduto = isset($_GET['token_produto']) ? trim($_GET['token_produto']) : null;

        $produtos = new MostrarProdutos();
        $produtos->mostrarProdutos($categoriaId, $tokenProduto);
        ?>
    <!-- Script JS para gerenciar o modal e quantidade -->
    <script>
var modal = document.getElementById('staticBackdrop');

modal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var productId = button.getAttribute('data-id');
    var productName = button.getAttribute('data-name');
    var productPrice = parseFloat(button.getAttribute('data-price').replace(',', '.'));
    var productImage = button.getAttribute('data-image');

    var modalProductId = modal.querySelector('.product-id');
    var modalProductQuantity = modal.querySelector('.modal-quantity');
    var modalProductQuantityDisplay = modal.querySelector('.product-quantity'); // Para exibir a quantidade
    var modalProductName = modal.querySelector('.text');
    var modalProductPrice = modal.querySelector('.text1');
    var modalProductImage = modal.querySelector('.product-img');

    // Atualize os valores no modal
    modalProductName.textContent = productName;
    modalProductPrice.textContent = 'R$ ' + productPrice.toFixed(2).replace('.', ',');
    modalProductImage.src = productImage;
    modalProductId.value = productId;  // Define o productId no formulário

    var quantity = 1;
    modalProductQuantity.value = quantity;  // Define a quantidade no input hidden
    modalProductQuantityDisplay.textContent = quantity;  // Atualiza a exibição

    // Função para atualizar o preço total
    function updateTotalPrice() {
        var totalPrice = productPrice * quantity;
        modalProductPrice.textContent = 'R$ ' + totalPrice.toFixed(2).replace('.', ',');
    }

    // Incrementar e decrementar quantidade
    var decrementButton = modal.querySelector('.btn-decrement');
    var incrementButton = modal.querySelector('.btn-increment');

    decrementButton.onclick = function() {
        if (quantity > 1) {
            quantity--;
            modalProductQuantityDisplay.textContent = quantity;  // Atualiza a exibição
            modalProductQuantity.value = quantity;  // Atualiza o valor no input hidden
            updateTotalPrice();
        }
    };

    incrementButton.onclick = function() {
        quantity++;
        modalProductQuantityDisplay.textContent = quantity;  // Atualiza a exibição
        modalProductQuantity.value = quantity;  // Atualiza o valor no input hidden
        updateTotalPrice();
    };
});

    </script>
</main>
