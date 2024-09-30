<?php
// Verifica o tipo do usuário
if (!isset($_SESSION['typeUser']) || $_SESSION['typeUser'] !== 'admin-master') {
    echo "<script>alert('Você não tem permissão para acessar esta página! Apenas administradores-master podem acessar.'); window.location.href = 'index.php';</script>";
    die();
}

include_once("../classe/ApagarItem.php");

// Verificar se a ação de exclusão foi solicitada
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idItem']) && isset($_GET['tipo'])) {
    $idItem = intval($_GET['idItem']);
    $tipoItem = $_GET['tipo']; // Adicionado tipo de item
    $apagarItem = new ApagarItem();
    $apagarItem->apagarItem($idItem, $tipoItem);
    header("Location: index.php?tela=listarLixeira"); // Redirecionar após exclusão
}

include_once("../classe/RestaurarItem.php");

// Verificar se a ação de restauração foi solicitada
if (isset($_GET['action']) && $_GET['action'] === 'restore' && isset($_GET['idItem']) && isset($_GET['tipo'])) {
    $idItem = intval($_GET['idItem']);
    $tipoItem = $_GET['tipo']; // Adicionado tipo de item
    $restaurarItem = new RestaurarItem();
    $restaurarItem->restaurarItem($idItem, $tipoItem);
    header("Location: index.php?tela=listarLixeira"); // Redirecionar após restauração
}
?>

<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3">Itens Excluídos</div>
            </div>
            <div class="col-3 text-end">
            </div>
        </div>
    </div>
</div>
<!-- Mostrar dados -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col table-responsive">
                <?php
                include_once("../classe/MostrarLixeira.php");
                $lixeira = new MostrarLixeira();
                $lixeira->setNumPagina(@$_GET['pg']);
                $lixeira->setUrl("?tela=listarLixeira");
                $lixeira->setSessao('');
                $lixeira->mostrarLixeira();
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
                    <?php $lixeira->geraNumeros(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark" id="confirmDelete">Excluir</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Confirmação de Restauração -->
<div class="modal fade" id="restoreConfirmationModal" tabindex="-1" aria-labelledby="restoreConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreConfirmationModalLabel">Confirmar Restauração</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja restaurar este item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark" id="confirmRestore">Restaurar</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let deleteId = '';
    let deleteType = '';
    let restoreId = '';
    let restoreType = '';

    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', (event) => {
            const target = event.currentTarget;
            const id = target.getAttribute('data-id');
            const tipo = target.getAttribute('data-tipo');
            const action = target.getAttribute('data-action');

            if (action === 'delete') {
                deleteId = id;
                deleteType = tipo;
                document.getElementById('confirmDelete').setAttribute('data-id', id);
                document.getElementById('confirmDelete').setAttribute('data-type', tipo);
            } else if (action === 'restore') {
                restoreId = id;
                restoreType = tipo;
                document.getElementById('confirmRestore').setAttribute('data-id', id);
                document.getElementById('confirmRestore').setAttribute('data-type', tipo);
            }
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', () => {
        if (deleteId && deleteType) {
            window.location.href = `index.php?tela=listarLixeira&action=delete&idItem=${deleteId}&tipo=${deleteType}`;
        }
    });

    document.getElementById('confirmRestore').addEventListener('click', () => {
        if (restoreId && restoreType) {
            window.location.href = `index.php?tela=listarLixeira&action=restore&idItem=${restoreId}&tipo=${restoreType}`;
        }
    });
});
</script>
