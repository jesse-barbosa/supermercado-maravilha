<?php
require_once "Conexao.php";

class Cart extends Conexao {
    public function addItem(int $userId, int $productId, int $quantity) {
        $this->conectar(); // Estabelece a conexão

        // Verifica se o produto já está no carrinho do usuário
        $stmt = $this->conectar->prepare("SELECT * FROM carts WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insere novo item no carrinho
            $stmt = $this->conectar->prepare("INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $userId, $productId, $quantity);
        } else {
            // Atualiza a quantidade do item no carrinho existente
            $stmt = $this->conectar->prepare("UPDATE carts SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("iii", $quantity, $userId, $productId);
        }

        if ($stmt->execute()) {
            return [
                'status' => true,
                'message' => 'Item adicionado/atualizado com sucesso'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Erro ao adicionar/atualizar o item no carrinho'
            ];
        }
    }

    public function deleteItem(int $userId, int $productId) {
        $this->conectar(); // Estabelece a conexão
        $stmt = $this->conectar->prepare("DELETE FROM carts WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $userId, $productId);

        if ($stmt->execute()) {
            return [
                'status' => true,
                'message' => 'Item removido com sucesso'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Erro ao remover o item do carrinho'
            ];
        }
    }

    public function getItems(int $userId) {
        $this->conectar(); // Estabelece a conexão
        $stmt = $this->conectar->prepare("SELECT c.quantity, p.name, p.price, p.image 
                                           FROM carts c 
                                           JOIN products p ON c.product_id = p.id 
                                           WHERE c.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return [
                'status' => true,
                'message' => 'Não há Itens no Carrinho!',
                'items' => []
            ];
        }

        $items = $result->fetch_all(MYSQLI_ASSOC);

        return [
            'status' => true,
            'items' => $items
        ];
    }

    public function getItemsCard(int $userId)
    {
        // A conexão é estabelecida na construção da classe `Cart`, portanto, não precisamos chamá-la novamente
        $stmt = $this->conectar->prepare("SELECT c.quantity, p.name, p.price, p.image 
                                           FROM carts c 
                                           JOIN products p ON c.product_id = p.id 
                                           WHERE c.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return "<div class='alert alert-warning'>Não há itens no carrinho!</div>";
        }

        $items = $result->fetch_all(MYSQLI_ASSOC);
        $output = "<ul class='list-group'>";

        foreach ($items as $item) {
            $output .= "<li class='list-group-item'>";
            $output .= "<img src='" . htmlspecialchars($item['image']) . "' alt='" . htmlspecialchars($item['name']) . "' style='width: 50px;'> ";
            $output .= htmlspecialchars($item['name']) . " - Preço: R$ " . number_format($item['price'], 2, ',', '.') . " - Quantidade: " . htmlspecialchars($item['quantity']);
            $output .= "</li>";
        }
        $output .= "</ul>";

        return $output;
    }
}
