<?php
// Adicionar
include_once("../classe/AdicionarCategoria.php");

if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $situacao = $_POST['situacao'];
    
    if(isset($_POST['nome'])){
        $categoria = new Categoria($nome, $descricao, $situacao);
        $categoria->adicionarCategoria();
    
    } else {
        echo "Nome não foi enviado.";
    }
}
// Editar
include_once("../classe/AlterarCategoria.php");

if (isset($_POST['editar'])) {
    $idCategoria = $_POST['idCategoria'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $situacao = $_POST['situacao'];

    $categoria = new AlterarCategoria();
    $categoria->alterarCategoria($idCategoria, $nome, $descricao, $situacao);
}

// Apagar
include_once("../classe/ApagarCategoria.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idCategoria'])) {
    $idCategoria = intval($_GET['idCategoria']);
    $apagarCategoria = new ApagarCategoria();
    $apagarCategoria->apagarCategoria($idCategoria);
}
?>
<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3">Categorias Cadastradas</div>
            </div>
            <div class="col-3 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark fw-medium" data-bs-toggle="modal" data-bs-target="#staticBackdropAdC">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Mostrar dados -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col bg-white py-4 m-3 rounded-3">
                    <?php
                        include_once("../classe/MostrarCategorias.php");
                        $categorias = new MostrarCategorias();
                        $categorias->setNumPagina(@$_GET['pg']);
                        $categorias->setUrl("?tela=cadListarCategoria");
                        $categorias->setSessao('');
                        $categorias->mostrarCategoria();
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
                    <li><?php $categorias->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro -->
<div class="modal fade" id="staticBackdropAdC" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar novo item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarCategoria" method="post">
                <div class="modal-body">
                    <div class="text-start border px-1 py-1 mb-1">
                        <input type="text" name="nome" class="input border-0 py-1" placeholder="Nome" required>
                    </div>
                    <div class="text-start border px-1 py-1 mb-1">
                        <input type="text" name="descricao" class="input border-0 py-1" placeholder="Descrição" required>
                    </div>
                    <div class="text-start border px-1 py-1 mb-1">
                        <select name="situacao" class="form-select border-0" required>
                            <option value='ATIVO'>ATIVO</option>
                            <option value='DESATIVO'>DESATIVO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" name="enviar" class="btn btn-dark form-control fw-medium">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal de Edição -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarCategoria" method="post" id="editCategoryForm">
                <div class="modal-body">
                    <input type="hidden" name="idCategoria" id="editIdCategoria">
                    <div class="mb-3">
                        <label for="editNomeCategoria" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNomeCategoria" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescricaoCategoria" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="editDescricaoCategoria" name="descricao" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSituacaoCategoria" class="form-label">Situação</label>
                        <select class="form-select" id="editSituacaoCategoria" name="situacao" required>
                            <option value='ATIVO'>ATIVO</option>
                            <option value='DESATIVO'>DESATIVO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editar" class="btn btn-dark form-control">Salvar alterações</button>
                </div>
            </form>
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
                Tem certeza de que deseja excluir esta categoria?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="" id="confirmDelete" class="btn btn-dark">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            // Utiliza os atributos data- para preencher os campos
            document.getElementById('editIdCategoria').value = this.dataset.id;
            document.getElementById('editNomeCategoria').value = this.dataset.nome;
            document.getElementById('editDescricaoCategoria').value = this.dataset.descricao;
            document.getElementById('editSituacaoCategoria').value = this.dataset.situacao;

            const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            modal.show();
        });
    });
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            const deleteId = this.dataset.id;
            const confirmDeleteButton = document.getElementById('confirmDelete');
            confirmDeleteButton.href = 'index.php?tela=cadListarCategoria&action=delete&idCategoria=' + deleteId;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });
});
</script>