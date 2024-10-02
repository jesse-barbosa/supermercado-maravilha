<?php
// Editar
include_once("../classe/AlterarItem.php");

if (isset($_POST['editar'])) {
    $idPedido = $_POST['idPedido'];
    // Utilize valores dos inputs hidden se access_level for 1
    $usuarioId = $_POST['usuarioIdPedido'] ?? $_POST['oldUsuarioIdPedido'];
    $produtoId = $_POST['produtoIdPedido'] ?? $_POST['oldProdutoIdPedido'];
    $quantidade = $_POST['quantidadePedido'] ?? $_POST['oldQuantidadePedido'];
    $situacao = $_POST['situacaoPedido'];

    $pedido = new Alterar();
    $pedido->alterarPedido($idPedido, $usuarioId, $produtoId, $quantidade, $situacao);
}
?>
<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3 fw-medium">Pedidos Realizados</div>
            </div>
        </div>
    </div>
</div>
<!-- Mostrar dados -->
<div class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col bg-white py-4 m-3 rounded-3">
                <?php
                    include_once("../classe/MostrarItem.php");
                    $pedidos = new Mostrar();
                    $pedidos->setNumPagina(@$_GET['pg']);
                    $pedidos->setUrl("?tela=cadListarPedidos");
                    $pedidos->setSessao('');
                    $pedidos->mostrarPedidos();
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Paginação -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
                <ul class="nav d-flex">
                    <li><?php $pedidos->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Edição de Pedido -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <!-- ID do Pedido -->
                    <input type="hidden" name="idPedido" id="editIdPedido" class="form-control" required>
                    
                    <?php
                    // Exibir campos baseados no nível de acesso do usuário
                    if ($_SESSION['access_level'] == 2) {
                        // Campos visíveis para access_level 2
                        echo '
                        <div class="mb-3 text-start">
                            <label for="editUsuarioIdPedido" class="form-label">ID do Usuário:</label>
                            <input type="text" name="usuarioIdPedido" id="editUsuarioIdPedido" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="editProdutoIdPedido" class="form-label">ID do Produto:</label>
                            <input type="text" name="produtoIdPedido" id="editProdutoIdPedido" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="editQuantidadePedido" class="form-label">Quantidade do Pedido:</label>
                            <input type="number" name="quantidadePedido" id="editQuantidadePedido" class="form-control" required>
                        </div>
                        ';
                    } elseif ($_SESSION['access_level'] == 1) {
                        // Campos ocultos para access_level 1
                        echo '
                        <input type="hidden" name="oldUsuarioIdPedido" id="editOldUsuarioIdPedido">
                        <input type="hidden" name="oldProdutoIdPedido" id="editOldProdutoIdPedido">
                        <input type="hidden" name="oldQuantidadePedido" id="editOldQuantidadePedido">
                        ';
                    }
                    ?>
                    
                    <!-- Situação do Pedido -->
                    <div class="mb-3 text-start">
                        <label for="editSituacaoPedido" class="form-label">Situação do Pedido:</label>
                        <select name="situacaoPedido" id="editSituacaoPedido" class="form-select" required>
                            <option value="" disabled selected>Escolha a situação</option>
                            <option value="0">Pendente</option>
                            <option value="1">Confirmado</option>
                            <option value="2">Cancelado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editar" class="btn btn-dark">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Atualizar o modal de edição ao clicar no botão de edição
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            const urlImagem = this.dataset.url;

            document.getElementById('editIdPedido').value = this.dataset.id;
            // Preencher inputs ocultos
            document.getElementById('editOldUsuarioIdPedido').value = this.dataset.userid;
            document.getElementById('editOldProdutoIdPedido').value = this.dataset.productid;
            document.getElementById('editOldQuantidadePedido').value = this.dataset.quantity;
            document.getElementById('editSituacaoPedido').value = this.dataset.status;

            // Abrir o modal de edição
            const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
            modal.show();
        });
    });
});
</script>
