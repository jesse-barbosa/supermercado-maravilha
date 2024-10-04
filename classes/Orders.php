<?php
require_once "Conexao.php";

class Orders extends Conexao {
    public function createOrder(int $userId, array $cartItems, float $totalPrice, string $paymentMethod) {
        try {
            // Inicia a transação
            $this->conectar()->begin_transaction();

            // Insere o pedido na tabela orders
            $sql = "INSERT INTO orders (user_id, total_price, payment_method, status) VALUES (?, ?, ?, 2)";
            $stmt = $this->conectar()->prepare($sql);
            $stmt->bind_param("ids", $userId, $totalPrice, $paymentMethod);
            $stmt->execute();

            // Obtém o ID do pedido recém-criado
            $orderId = $this->conectar()->insert_id;

            // Insere os itens do carrinho no pedido
            foreach ($cartItems as $item) {
                $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
                $stmt = $this->conectar()->prepare($sql);
                $stmt->bind_param("iii", $orderId, $item['product_id'], $item['quantity']);
                $stmt->execute();
            }

            // Se tudo ocorreu bem, realiza o commit
            $this->conectar()->commit();

            return [
                'status' => true,
                'message' => 'Pedido criado com sucesso',
                'order_id' => $orderId
            ];
        } catch (Exception $e) {
            // Se ocorreu um erro, realiza o rollback
            $this->conectar()->rollback();
            return [
                'status' => false,
                'message' => 'Erro ao criar o pedido: ' . $e->getMessage()
            ];
        }
    }

    public function getOrders(int $userId) {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return [
                'status' => true,
                'message' => 'Nenhum pedido encontrado',
                'orders' => []
            ];
        }

        $orders = $result->fetch_all(MYSQLI_ASSOC);

        return [
            'status' => true,
            'orders' => $orders
        ];
    }
}
?>
