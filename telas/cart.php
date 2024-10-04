<?php
require_once dirname(__DIR__) . '/classes/Cart.php';

// Verifica se a requisição é um POST para editar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $cart = new Cart();
    $userId = $_SESSION['id'];
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['quantity']; // Nova quantidade recebida do formulário

    // Chama o método para adicionar ou atualizar a quantidade do item
    $response = $cart->addItem($userId, $productId, $newQuantity);

    if ($response['status']) {
        echo "<script>alert('Produto atualizado com sucesso!'); window.location.href='index.php?tela=cart'</script>";
        exit;
    } else {
        echo "<p>Erro ao atualizar o item: " . $response['message'] . "</p>";
    }
}

$cart = new Cart();
$products = $cart->getItems($_SESSION['id'])['items'];
?>
<?php
require_once dirname(__DIR__) . '/classes/Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $cart = new Cart();
    $userId = $_SESSION['id'];
    $productId = $_POST['product_id'];
    $response = $cart->deleteItem($userId, $productId);
    if ($response['status']) {
        echo "<script>alert('Produto removido com sucesso!'); window.location.href='index.php?tela=cart'</script>";
        exit;
    } else {
        echo "<p>Erro ao remover o item: " . $response['message'] . "</p>";
    }
}

$cart = new Cart();
$products = $cart->getItems($_SESSION['id'])['items'];
?>

<section style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; gap: 12px; margin: 12px; min-height: 80vh;">
  <!-- Botão para voltar para home -->
  <a href="index.php" style="text-decoration: none; color: inherit;">
    <button type="button" style="border: none; background-color: transparent; cursor: pointer;">
      <i class="bi bi-arrow-left" style="font-size: 26px;"></i>
    </button>
  </a>

  <!-- Seção de itens do carrinho -->
  <section style="display: flex; flex-direction: column; gap: 12px; height: 62vh; overflow: auto;">
    <?php
    if ($products == null) {
      echo "<div class='text-center my-auto flex-column'>";
        echo "<i class='bi bi-emoji-frown fs-1 text-secondary'></i>";
        echo "<h2 class='mt-3 text-secondary'> Ops! Seu carrinho está vazio.</h2>";
      echo "</div>";
    }

    $total_price = 0;

    foreach ($products as $product) {
      $total_price += $product['price'] * $product['quantity'];
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
          <button type='button' style='border: 0; background-color: white; cursor: pointer;' 
                  data-bs-toggle='modal' data-bs-target='#editModal'
                  data-id='$product[id]' 
                  data-name='$product[name]' 
                  data-price='$product[price]' 
                  data-image='$product[image]'
                  data-quantity='$product[quantity]'>
            <i class='bi bi-pencil-square' style='font-size: 24px;'></i>
          </button>
            <!-- Botão para abrir modal de confirmação de exclusão -->
            <button type='button' style='border: 0; color: red; background-color: white; cursor: pointer;' 
                    data-bs-toggle='modal' data-bs-target='#deleteModal'
                    data-id='$product[id]' data-user='$_SESSION[id]'>
              <i class='bi bi-trash3-fill' style='font-size: 24px;'></i>
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
  <div style="align-items: center; padding: 4px; font-weight : bold;" class="cartFooter">
    <p class="my-2 ms-1 fs-4">Total: R$ <?php echo number_format($total_price, 2, ',', '.'); ?></p>
  <button type="button" class="btn-confirm form-control" style="border: 0; border-radius: 4px; color: #FFF; padding: 8px;" onclick="window.location.href='index.php?tela=payment';">
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
            <input type="hidden" id="edit-product-id" value="">
            <input type="hidden" name="quantity" id="edit-product-quantity" value="">
          </div>
        </div>
      </div>
      <div class="p-2">
        <button type="button" class="form-control btn btn-confirm text-white" id="confirm-edit">Confirmar</button>
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
        <form method="POST" action="">
          <input type="hidden" name="user_id" id="delete-user-id" value="">
          <input type="hidden" name="product_id" id="delete-product-id" value="">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>// Script para preencher o modal de edição com os dados do produto
document.querySelectorAll("[data-bs-target='#editModal']").forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        const productName = this.getAttribute('data-name');
        const productPrice = parseFloat(this.getAttribute('data-price'));
        const productImage = this.getAttribute('data-image');
        const productQuantity = parseInt(this.getAttribute('data-quantity'));

        document.getElementById('product-name').textContent = productName;
        document.getElementById('product-price').textContent = 'R$ ' + (productPrice * productQuantity).toFixed(2).replace('.', ',');
        document.getElementById('product-img').src = productImage;
        document.querySelector('.product-quantity').textContent = productQuantity;
        document.getElementById('edit-product-id').value = productId; // Adiciona o ID do produto
        document.getElementById('edit-product-quantity').value = productQuantity; // Adiciona a quantidade

        var decrementButton = document.querySelector('.btn-decrement');
        var incrementButton = document.querySelector('.btn-increment');

        decrementButton.onclick = function() {
            var quantity = parseInt(document.querySelector('.product-quantity').textContent);
            if (quantity > 1) {
                quantity--;
                document.querySelector('.product-quantity').textContent = quantity;
                document.getElementById('product-price').textContent = 'R$ ' + (productPrice * quantity).toFixed(2).replace('.', ',');
                document.getElementById('edit-product-quantity').value = quantity; // Atualiza a quantidade oculta
            }
        };

        incrementButton.onclick = function() {
            var quantity = parseInt(document.querySelector('.product-quantity').textContent);
            quantity++;
            document.querySelector('.product-quantity').textContent = quantity;
            document.getElementById('product-price').textContent = 'R$ ' + (productPrice * quantity).toFixed(2).replace('.', ',');
            document.getElementById('edit-product-quantity').value = quantity; // Atualiza a quantidade oculta
        };
    });
});

// Captura o evento de confirmação da edição
document.getElementById('confirm-edit').addEventListener('click', function() {
    const productId = document.getElementById('edit-product-id').value;
    const quantity = document.getElementById('edit-product-quantity').value;
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';

    const inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'product_id';
    inputId.value = productId;
    
    const inputQuantity = document.createElement('input');
    inputQuantity.type = 'hidden';
    inputQuantity.name = 'quantity';
    inputQuantity.value = quantity;

    const inputEdit = document.createElement('input');
    inputEdit.type = 'hidden';
    inputEdit.name = 'edit';
    inputEdit.value = '1';

    form.appendChild(inputId);
    form.appendChild(inputQuantity);
    form.appendChild(inputEdit);
    document.body.appendChild(form);
    form.submit();
});

  // Script para preencher os campos ocultos do formulário com os dados do produto a ser excluído
  document.querySelectorAll("[data-bs-target='#deleteModal']").forEach(button => {
    button.addEventListener('click', function() {
      const productId = this.getAttribute('data-id');
      const userId = this.getAttribute('data-user');
      document.getElementById('delete-product-id').value = productId;
      document.getElementById('delete-user-id').value = userId;
    });
  });
</script>