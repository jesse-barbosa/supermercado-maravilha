<?php
require_once dirname(__DIR__) . '/classes/Order.php';

$order = new Order();
$userId = $_SESSION['id'];
$orders = $order->getUserOrders($userId); // Supondo que você tenha um método para pegar os pedidos do usuário

?>

<section style="margin: 12px; min-height: 80vh;">
    <div class="d-flex justify-content-between w-75">
        <h2 class="mt-2 fw-medium">Meus Pedidos</h2>
    </div>

    <section class="p-3" style="display: flex; flex-direction: column; gap: 2px; overflow: auto;">
        <?php if (empty($orders)) : ?>
            <div class='text-center my-auto flex-column'>
                <i class='bi bi-emoji-frown fs-1 text-secondary'></i>
                <h2 class='mt-3 text-secondary'>Ops! Você ainda não tem pedidos.</h2>
            </div>
        <?php else : ?>
            <?php foreach ($orders as $order) : ?>
                <div style='display: flex; flex-direction: column; border: 1px solid #D1D1D1; border-radius: 4px; padding: 16px; margin: 8px 0;'>
                    <h5>Pedido #<?php echo $order['id']; ?></h5>
                    <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
                    <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                    <h6>Itens do Pedido:</h6>
                    <ul>
                        <?php foreach ($order['items'] as $item) : ?>
                            <li><?php echo $item['name'] . " - R$ " . number_format($item['price'], 2, ',', '.') . " x " . $item['quantity']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p><strong>Total:</strong> R$ <?php echo number_format($order['total'], 2, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</section>
