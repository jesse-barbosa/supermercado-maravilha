<section style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; gap: 12px; margin: 12px; min-height: 80vh;">

  <!-- Botão para voltar para home -->
  <a href="index.php" style="text-decoration: none; color: inherit;">
    <button type="button" style="border: none; background-color: transparent; cursor: pointer;">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="38" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 0-.708 0L2.5 7.293l2.646 2.647a.5.5 0 0 0 .708-.708L4.207 8H13.5a.5.5 0 0 0 0-1H4.207l1.647-1.646a.5.5 0 0 0 0-.708z"/>
      </svg>
    </button>
  </a>

  <!-- Seção de itens do carrinho -->
  <section style="display: flex; flex-direction: column; gap: 12px; height: 62vh; overflow: auto;">
    <?php
    require_once dirname(__DIR__) . '/classes/Cart.php';
    $cart = new Cart();
    $products = $cart->getItems($_SESSION['id'])['items'];

    if ($products == null) {
      echo "<span> Não Há Itens no Carrinho! </span>";
    }

    $total_price = 0;

    foreach ($products as $product) {
      $total_price += $product['price'];
      $productPriceFormat = number_format($product['price'], 2, ',', '.');

      echo "
        <div style='display: flex; align-items: center; justify-content: start; gap: 12px; padding: 12px; background-color: white; border-radius: 4px; position: relative; margin-right: 20px; margin-left: 20px; border: 1px solid #D1D1D1;'>
          <img src='$product[image]' alt='$product[name]' style='width: 64px; height: 64px;' />

          <div style='display: flex; flex-direction: column; justify-content: start; width: 100%;'>
            <p style='font-weight: bold; text-align: start; margin: 0;'>$product[name]</p>
            <p style='text-align: start; margin: 0;'>R$ $productPriceFormat</p>
          </div>

          <!-- Botões de editar e apagar -->
          <div style='display: flex; gap: 24px;'>
            <!-- Botão para abrir modal de edição -->
            <button type='button' style='border: 0; background-color: white; cursor: pointer;' data-bs-toggle='modal' data-bs-target='#editModal'>
              <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z Z' />
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z Z' />
              </svg>
            </button>

            <!-- Botão para abrir modal de confirmação de exclusão -->
            <button type='button' style='border: 0; color: red; background-color: white; cursor: pointer;' data-bs-toggle='modal' data-bs-target='#deleteModal'>
              <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5 Z' />
              </svg>
            </button>
          </div>

          <div style='position: absolute; top: 4px; right: 1%; font-size: 14px;'>
            <span>x$product[quantity]</span>
          </div>
        </div>";
    }
    ?>
  </section>

  <!-- Footer com valor total -->
  <div style="align-items: center; padding: 4px; font-weight: bold; border: 1px solid #D1D1D1;" class="cartFooter">
    <p class="my-2 ms-1 fs-4">Total: R$ <?php echo number_format($total_price, 2, ',', '.'); ?></p>
    <button type="button" class="btn-confirm form-control" style="border: 0; border-radius: 4px; color: #FFF; padding: 8px;">
      Finalizar
    </button>
  </div>

</section>

<!-- Modal para Editar Produto -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <img src="" id="product-img" width="160" alt="" class="product-img">
          </div>
          <div class="col-6">
            <h4 id="product-name" class="text fw-semibold">Nome do Produto</h4>
            <p id="product-price" class="text1">R$00,00</p>
            <div class="col-12 d-flex gap-3">
              <button type="button" class="btn btn-outline-dark btn-decrement">−</button>
              <span class="product-quantity">1</span>
              <button type="button" class="btn btn-outline-dark btn-increment">+</button>
            </div>
          </div>
        </div>
      </div>
      <div class="p-2">
        <button type="button" class="form-control btn btn-confirm text-white">Confirmar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para Confirmar Exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Você tem certeza de que deseja excluir este item do carrinho?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" onclick="deleteItem()">Excluir</button>
      </div>
    </div>
  </div>
</div>

<!-- Função para excluir item do carrinho -->
<script>
  function deleteItem() {
  }
</script>
