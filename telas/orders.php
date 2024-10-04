<?php
include_once('../classes/Cart.php');
include_once('../classes/Order.php');

$orderClass = new Order();
$userId = $_SESSION['id'];

// Verificar se há um pedido para cancelar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    
    $cancelResponse = $orderClass->cancelOrder($orderId);
}

// Recuperar os pedidos atualizados após o possível cancelamento
$orderResponse = $orderClass->getOrders($userId);
$orders = $orderResponse['orders'];

// Função para mapear o status
function mapStatus($status) {
    switch ($status) {
        case 0: return 'Cancelado';
        case 1: return 'Pendente';
        case 2: return 'Confirmado';
        default: return 'Desconhecido';
    }
}
?>

<style>
    .cancelled {
        opacity: 0.5; /* Reduz a opacidade do card */
        text-decoration: line-through; /* Tacha o texto */
    }
</style>

<section style="margin: 12px; min-height: 80vh;">
  <!-- Botão para voltar para home -->
  <a href="index.php" style="text-decoration: none; color: inherit;">
    <button type="button" style="border: none; background-color: transparent; cursor: pointer;">
      <i class="bi bi-arrow-left" style="font-size: 26px;"></i>
    </button>
  </a>

  <section class="p-3" style="display: flex; flex-direction: column; gap: 2px; overflow: auto;">
    <?php if (empty($orders)) : ?>
      <div class='text-center mt-5 flex-column'>
        <i class='bi bi-emoji-frown fs-1 text-secondary'></i>
        <h2 class='mt-3 text-secondary'>Ops! Você ainda não tem pedidos.</h2>
      </div>
    <?php else : ?>
      <?php foreach ($orders as $order) : ?>
        <div style='display: flex; flex-direction: column; border: 1px solid #D1D1D1; border-radius: 4px; padding: 16px; margin: 8px 0; <?php echo $order['status'] === 0 ? 'opacity: 0.5; text-decoration: line-through;' : ''; ?>'>
          <h5>Pedido #<?php echo $order['id']; ?></h5>
          <p><strong>Status:</strong> <?php echo mapStatus($order['status']); ?></p>

          <h6>Itens do Pedido:</h6>
          <ul>
            <?php
            // Instanciar a classe Product para buscar os detalhes dos produtos
            $productClass = new Order();
            $items = $productClass->getItemsByOrderId($order['id']); // Método para obter itens do pedido

            foreach ($items as $item) : ?>
              <li style="<?php echo $order['status'] === 0 ? 'text-decoration: line-through;' : ''; ?>">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" style="width: 20px; height: 20px;"/> 
                <?php echo $item['name'] . " - R$ " . number_format($item['price'], 2, ',', '.') . " x " . $item['quantity']; ?>
              </li>
            <?php endforeach; ?>
          </ul>

          <!-- Condicional para exibir o botão apenas se o pedido não estiver cancelado -->
          <?php if ($order['status'] !== 0) : ?>
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $order['id']; ?>">
              Cancelar Pedido <i class="bi bi-x-circle ms-1"></i>
            </button>
          <?php endif; ?>

          <!-- Modal de confirmação -->
          <div class="modal fade" id="cancelModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="cancelModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="cancelModalLabel<?php echo $order['id']; ?>">Cancelar Pedido #<?php echo $order['id']; ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Você tem certeza que deseja cancelar este pedido?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                    <button type="submit" class="btn btn-dark">Confirmar Cancelamento</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</section>
