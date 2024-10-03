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

  public function getItems(int $userId)
  {
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
}
