<section style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; gap: 12px; margin: 12px;">
  <!-- Search Bar -->
  <form style="width: 100%;">
    <input type="search" name="search" placeholder="Buscar" style="width: 100%; padding: 4px; outline: none; background-color: #D1D1D1; border-radius: 4px; border: 0;">
  </form>

  <?php
  // Example List Products
  $products = [
    [
      "product_id" => "1",
      "name" => "Café do Brasil",
      "price" => 10.00,
      "image" => "https://via.placeholder.com/48",
      "quantity" => "1",
    ],
  ]
  ?>

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

  <div style="display: flex; flex-direction: column; gap: 12px;"> 
    <!-- Button for Items Cart -->
    <buttom type="button" style="display: flex; align-items: center; justify-content: center; gap: 12px; padding: 12px; background-color: white; border-radius: 4px; position: relative;">
      <img src=<?= $products[0]["image"] ?> alt=<?= $products[0]["name"] ?> />

      <div style="display: flex; flex-direction: column; width: 100%;">
        <span style="font-weight: bold;"><?= $products[0]["name"] ?></span>
        <span>
          R$ <?= $products[0]["price"] ?>
        </span>
      </div>

      <div style="position: absolute; top: 4px; right: 1%; font-size: 14px;">
        x<?= $products[0]["quantity"] ?>
      </div>

      <div style="display: flex; align-items: center; background-color: white; gap: 12px;">
        <button type="button" style="border: 0; background-color: white;">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="
            M15.502 1.94a.5.5 0 0 1 0 .706
            L14.459 3.69l-2-2
            L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd" d="
            M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
          </svg>
        </button>

        <button type="button" style="border: 0; color: red; background-color: white;">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
          </svg>
        </button>
      </div>
      </button>
  </div>

  <div style="width: 100%; padding: 4px; font-weight: bold;" class="cartFooter">
    <span>Total: R$ 10</span>
    <button type="button" style="background-color: green; border: 0; border-radius: 4px; color: #FFF; padding: 8px;">
      Finalizar
    </button>
  </div>
</section>