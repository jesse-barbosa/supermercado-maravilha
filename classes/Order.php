<?php
require_once "Conexao.php";

class Order extends Conexao {
    public function createOrder(int $userId, array $cartItems, int $status) {
        try {
            // Inicia a transação
            $this->conectar->begin_transaction();

            // Insere cada item do carrinho como um registro individual na tabela orders
            foreach ($cartItems as $item) {
                // Insere o pedido
                $sql = "INSERT INTO orders (user_id, product_id, quantity, status) VALUES (?, ?, ?, ?)";
                $stmt = $this->conectar->prepare($sql);
                $stmt->bind_param("iiii", $userId, $item['id'], $item['quantity'], $status);
                $stmt->execute();
            }

            // Remove os itens do carrinho após a criação do pedido
            $this->removeItemsFromCart($userId);

            // Se tudo ocorreu bem, realiza o commit
            $this->conectar->commit();

            return [
                'status' => true,
                'message' => 'Pedido criado com sucesso'
            ];
        } catch (Exception $e) {
            // Se ocorreu um erro, realiza o rollback
            $this->conectar->rollback();
            return [
                'status' => false,
                'message' => 'Erro ao criar o pedido: ' . $e->getMessage()
            ];
        }
    }

    public function removeItemsFromCart(int $userId) {
        // Remove os itens do carrinho do usuário
        $sql = "DELETE FROM carts WHERE user_id = ?";
        $stmt = $this->conectar->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    }

    public function getOrders(int $userId) {
        // Seleciona apenas os campos relevantes da tabela orders
        $sql = "SELECT id, status FROM orders WHERE user_id = ? ORDER BY id DESC";
        $stmt = $this->conectar->prepare($sql);
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

    public function getItemsByOrderId($orderId) {
        // Seleciona os detalhes dos itens do pedido
        $sql = "SELECT p.id, p.name, p.price, p.image, o.quantity 
                FROM orders o 
                JOIN products p ON o.product_id = p.id 
                WHERE o.id = ?";
        $stmt = $this->conectar->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
