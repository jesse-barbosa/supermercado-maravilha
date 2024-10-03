<?php

require_once "Conexao.php";

class Cart extends Conexao
{
  public function addItem(
    int $userId,
    int $productId,
    int $quantity
  ) {
    $info = mysqli_query($this->conectar, "SELECT * FROM carts WHERE user_id = $userId AND product_id = $productId");

    $query = match (true) {
      $info->num_rows == 0 => mysqli_query($this->conectar, "INSERT INTO carts (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)"),
      $info->num_rows > 0 => mysqli_query($this->conectar, "UPDATE carts SET quantity = $quantity WHERE user_id = $userId AND product_id = $productId")
    };

    $sql = mysqli_query($this->conectar, $query);

    return [
      'status' => true,
      'message' => 'Item adicionado com sucesso'
    ];
  }

  public function deleteItem(int $userId, int $productId)
  {
    $sql = mysqli_query($this->conectar, "DELETE FROM carts WHERE user_id = $userId AND product_id = $productId");

    return [
      'status' => true,
      'message' => 'Item removido com sucesso'
    ];
  }

  public function getItems(int $userId){
    $sql = mysqli_query($this->conectar, "SELECT * FROM carts WHERE user_id = $userId");

    if ($sql->num_rows == 0) {
      return [
        'status' => true,
        'Não há Itens no Carrinho!'
      ];
    }

    $results = $sql->fetch_all(MYSQLI_ASSOC);

    $products = [];

    foreach ($results as $result) {
      $sql = mysqli_query($this->conectar, "SELECT * FROM products WHERE id = $result[product_id] and STATUS = 'ATIVO' lIMIT 1");

      if ($sql->num_rows == 0) {
        return;
      }

      $product = $sql->fetch_assoc();

      array_push($products, [
        'name' => $product['name'],
        'image' => $product['image'],
        'price' => $product['price'],
        'quantity' => $result['quantity']
      ]);
    }

    return [
      'status' => true,
      'message' => 'Items encontrados com Sucesso!',
      'items' => $products,
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

    // Verifica se há resultados
    if ($sql->num_rows == 0) {
        return '<p>Não há Itens no Carrinho!</p>';
    }

    // Inicializa o HTML que será retornado
    $html = '<div class="d-flex align-items-center gap-3">';

    // Loop para percorrer os resultados da consulta
    while ($product = $sql->fetch_assoc()) {
        $html .= '
            <div class="d-flex flex-column align-items-center">
                <span class="badge bg-secondary rounded-pill">' . $product['quantity'] . '</span>
                <img src="' . $product['image'] . '" class="rounded-circle" style="width: 40px; height: 40px;">
            </div>';
    }

    // Adiciona o botão "+" no final da lista de produtos
    $html .= '
        <div class="d-flex align-items-center justify-content-center bg-success rounded-circle" style="width: 40px; height: 40px;">
            <span class="text-white fw-bold">+</span>
        </div>';

    // Fecha o container HTML
    $html .= '</div>';

    // Retorna o HTML gerado
    return $html;
}

}
