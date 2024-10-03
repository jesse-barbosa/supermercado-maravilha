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
                    <a href="#"><button type="button" class="form-control btn btn-confirm text-white">Confirmar</button></a>
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
                    <input type="text" class="form-control rounded-end-0 rounded-4 search py-3" id="product-code" name="token_produto" placeholder="Ex: #3213890" />
                    <button type="submit" class="btn btn-dark rounded-start-0 rounded-4 py-3"><i class="bi bi-search"></i></button>
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
    </div>
    <script>
    var modal = document.getElementById('staticBackdrop');
  
    // Evento que ocorre quando o modal é aberto
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productName = button.getAttribute('data-name');
        var productPrice = parseFloat(button.getAttribute('data-price').replace(',', '.'));
        var productImage = button.getAttribute('data-image');
        
        // Selecionar elementos no modal
        var modalProductName = modal.querySelector('.text');
        var modalProductPrice = modal.querySelector('.text1');
        var modalProductImage = modal.querySelector('.product-img');
        var modalProductQuantity = modal.querySelector('.product-quantity');

        // Atualizar os valores
        modalProductName.textContent = productName;
        modalProductPrice.textContent = 'R$ ' + productPrice.toFixed(2).replace('.', ',');
        modalProductImage.src = productImage;

        // Definir quantidade inicial
        var quantity = 1;
        modalProductQuantity.textContent = quantity;

        // Atualizar o preço total
        function updateTotalPrice() {
            var totalPrice = productPrice * quantity;
            modalProductPrice.textContent = 'R$ ' + totalPrice.toFixed(2).replace('.', ',');
        }

        // Adicionar eventos de clique para incrementar e decrementar
        var decrementButton = modal.querySelector('.btn-decrement');
        var incrementButton = modal.querySelector('.btn-increment');
        
        decrementButton.onclick = function() {
            if (quantity > 1) {
                quantity--;
                modalProductQuantity.textContent = quantity;
                updateTotalPrice();
            }
        };

        incrementButton.onclick = function() {
            quantity++;
            modalProductQuantity.textContent = quantity;
            updateTotalPrice();
        };
    });
    </script>
</main>
