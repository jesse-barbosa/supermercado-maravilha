<?php
require_once "Conexao.php";

class Cart extends Conexao {
    public function addItem(int $userId, int $productId, int $quantity) {
        try {
            // Verifica se o produto existe na tabela products
            $sql = "SELECT id FROM products WHERE id = $productId";
            $result = self::execSql($sql);
            
            // Se o produto não existir, retorna um erro
            if (self::contarDados($result) == 0) {
                return [
                    'status' => false,
                    'message' => 'Produto não existe'
                ];
            }
    
            // Verifica se o produto já está no carrinho do usuário
            $sql = "SELECT * FROM carts WHERE user_id = $userId AND product_id = $productId";
            $result = self::execSql($sql);
    
            if (self::contarDados($result) == 0) {
                // Insere novo item no carrinho
                $sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
            } else {
                // Atualiza a quantidade do item no carrinho existente
                $sql = "UPDATE carts SET quantity = quantity + $quantity WHERE user_id = $userId AND product_id = $productId";
            }
    
            // Executa o comando
            if (self::execSql($sql)) {
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
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Erro ao processar a operação: ' . $e->getMessage()
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

    public function getItemsCard(int $userId) {
        // Consulta otimizada usando JOIN para buscar produtos e carrinho de uma vez
        $sql = mysqli_query($this->conectar, "
            SELECT carts.quantity, products.name, products.image, products.price 
            FROM carts 
            JOIN products ON carts.product_id = products.id 
            WHERE carts.user_id = $userId AND products.status = 'ATIVO'
        ");
        
        // Verifica se houve erro na consulta
        if (!$sql) {
            return '<p>Erro na consulta: ' . mysqli_error($this->conectar) . '</p>';
        }
    
        // Verifica se há resultados
        if ($sql->num_rows == 0) {
            return '<p>Não há Itens no Carrinho!</p>';
        }
    
        // Inicializa o HTML que será retornado
        $html = '<div class="d-flex align-items-center gap-0">';
        $count = 0; // Contador de produtos exibidos
    
        // Loop para percorrer os resultados da consulta
        while ($product = $sql->fetch_assoc()) {
            if ($count < 4) {
                $html .= '
                    <div class="d-flex flex-column align-items-center">
                        <span class="badge bg-secondary ms-3 rounded-pill">' . $product['quantity'] . '</span>
                        <img src="' . $product['image'] . '" class="rounded-circle" style="width: 40px; height: 40px;">
                    </div>';
            }
            $count++;
        }
    
        // Se houver mais de 4 produtos, adicionar ícone de excesso
        if ($count > 4) {
            $excessCount = $count - 4;
            $html .= '
                    <div class="rounded-circle mt-3 bg-light d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                        <span class="text-muted">+' . $excessCount . '</span>
                    </div>';
        }
    
        // Fecha o container HTML
        $html .= '</div>';
    
        // Retorna o HTML gerado
        return $html;
    }
}