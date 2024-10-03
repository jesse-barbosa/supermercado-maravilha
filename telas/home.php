<main>
  <div class="container-fluid my-3">
    <div class="buy-list p-3 rounded-5 d-flex justify-content-between mx-auto">
      <h2 class="opacity-50 fw-bold">Lista de Compras</h2>
      <img src="../img/ilustration.svg" style="width: 160px !important; height: 160px !important;" alt="">
    </div>
  </div>

  <div class="container rounded-lg px-3">
    <div class="mb-3">
      <label for="product-code" class="form-label fw-medium opacity-75 fs-4">Insira o código do Produto</label>
      <input type="text" class="form-control search" id="product-code" placeholder="Ex: #3213890" />
    </div>

    <?php
    include_once("../classes/MostrarProdutos.php");

    $categoriaId = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : null;

    $produtos = new MostrarProdutos();
    $produtos->mostrarProdutos($categoriaId);
    ?>

  </div>
</main>
