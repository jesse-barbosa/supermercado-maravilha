<main>
  <div class="container-fluid my-3">
    <div class="buy-list p-3 rounded-5 d-flex justify-content-between mx-auto">
      <h2 class="opacity-50 fw-bold">Lista de Compras</h2>
      <img src="../img/ilustration.svg" style="width: 160px !important; height: 160px !important;" alt="">
    </div>
  </div>
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <!-- Imagem dinâmica com JS -->
            <img src="" width="160" alt="" class="product-img">
          </div>
          <div class="col-6 col">
            <!-- Nome do produto dinâmico com JS -->
            <h4 class="text fw-semibold">Nome do produto</h4>
            <!-- Preço do produto dinâmico com JS -->
            <p class="text1">R$00,00</p>
          <!-- Selecionar quantidade com JS -->
          <div class="col-12 text-start d-flex gap-3">
            <!-- Botões de quantidade -->
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
      <label for="product-code" class="form-label fw-medium opacity-75 fs-4">Insira o código do Produto</label>
      <input type="text" class="form-control search py-3" id="product-code" placeholder="Ex: #3213890" />
    </div>

    <?php
    include_once("../classes/MostrarProdutos.php");

    $categoriaId = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : null;

    $produtos = new MostrarProdutos();
    $produtos->mostrarProdutos($categoriaId);
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
