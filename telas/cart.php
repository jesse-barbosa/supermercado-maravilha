<section style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; gap: 12px; margin: 12px; min-height: 80vh;">
  <!-- Search Bar -->
  <form style="width: 100%;">
    <input type="search" name="search" placeholder="Buscar"
      style="width: 100%; padding: 4px; outline: none; background-color: #D1D1D1; border-radius: 4px; border: 0;">
  </form>

  <style>
    .cartFooter {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #FFF;
      border-radius: 4px;
    }

    @media screen and (max-width: 768px) {
      .cartFooter {
        display: flex;
        align-items: start;
        flex-direction: column;
        justify-content: start;
        background-color: #FFF;
        border-radius: 4px;
        gap: 12px;
      }

      .cartFooter button {
        width: 100%;
      }
    }
  </style>

  <section style="display: flex; flex-direction: column; gap: 12px; height: 62vh; overflow: auto;">

    <?php
    require_once dirname(__DIR__) . '/classes/Cart.php';
    $cart = new Cart();
    // Get items
    $products = $cart->getItems($_SESSION['id'])['items'];

    // Verify if exists item in cart
    if ($products == null) {
      echo "<span> Não Há Itens no Carrinho! </span>";
    }

    // Value init
    $total_price = 0;

    foreach ($products as $product) {

      // Add product price to total price
      $total_price += $product['price'];

      $productPriceFormat = number_format($product['price'], 2, ',', '.');

      // Button for Items Cart
      echo "
        <div style='display: flex; align-items: center; justify-content: start; gap: 12px; padding: 12px; background-color: white; border-radius: 4px; position: relative; margin-right: 20px; margin-left: 20px; border: 1px solid #D1D1D1;'>
      ";

      // Image Product
      echo "
        <img src='$product[image]' alt='$product[name]' style='width: 64px; height: 64px;' />
      ";

      // Information Product
      echo "
        <div style='display: flex; flex-direction: column; justify-content: start; width: 100%;'>
          <p style='font-weight: bold; text-align: start; margin: 0;'>
            $product[name]
          </p>
          <p style='text-align: start; margin: 0;'>
            R$ $productPriceFormat
          </p>
        </div>
      ";

      // Buttons for Editing and Deleting
      echo "
      <div style='display: flex; gap: 24px;'>
        <button type='button' style='border: 0; background-color: white; cursor: pointer;'>
          <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z Z' />
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z Z' />
          </svg>
        </button>
      
        <button type='button' style='border: 0; color: red; background-color: white; cursor: pointer;'>
          <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5 Z' />
          </svg>
        </button>
      </div>
      ";

      // Quantity in Cart
      echo "
        <div style='position: absolute; top: 4px; right: 1%; font-size: 14px;'>
          <span>x$product[quantity]</span>
        </div>
      ";

      echo "</div>";
    }
    ?>
  </section>

  <!-- Footer  -->
  <div style="width: 100%; display: flex;   align-items: center; padding: 4px; font-weight: bold; border: 1px solid #D1D1D1;" class="cartFooter">
    <p style="margin: 0;">Total: R$ <?php echo number_format($total_price, 2, ',', '.'); ?></p>
    <button type="button" style="background-color: green; border: 0; border-radius: 4px; color: #FFF; padding: 8px;">
      Finalizar
    </button>
  </div>
</section>