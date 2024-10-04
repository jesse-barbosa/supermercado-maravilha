<?php
include_once('../classes/Cart.php');
include_once('../classes/Order.php'); // Para buscar ícones dos produtos

$orderClass = new Order();
$userId = $_SESSION['id'];
$orderResponse = $orderClass->getOrders($userId); // Retorna o array com 'status', 'message' e 'orders'
$orders = $orderResponse['orders']; // Obtendo os pedidos especificamente

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
        <div style='display: flex; flex-direction: column; border: 1px solid #D1D1D1; border-radius: 4px; padding: 16px; margin: 8px 0;'>
          <h5>Pedido #<?php echo $order['id']; ?></h5>
          <p><strong>Status:</strong> <?php echo mapStatus($order['status']); ?></p>

          <h6>Itens do Pedido:</h6>
          <ul>
            <?php
            // Instanciar a classe Product para buscar os detalhes dos produtos
            $productClass = new Order();
            $items = $productClass->getItemsByOrderId($order['id']); // Método para obter itens do pedido

            foreach ($items as $item) : ?>
              <li>
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" style="width: 20px; height: 20px;"/> 
                <?php echo $item['name'] . " - R$ " . number_format($item['price'], 2, ',', '.') . " x " . $item['quantity']; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</section>
