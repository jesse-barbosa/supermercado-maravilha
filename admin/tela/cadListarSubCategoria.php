<?php
// Adicionar
include_once("../classe/AdicionarSubCategoria.php");

if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $situacao = $_POST['situacao'];
    if(isset($_POST['nome'])){
        $categoria = new SubCategoria($nome, $descricao, $situacao);
        $categoria->adicionarSubCategoria();
    } else {
        echo "Imagem não foi enviada.";
    }
}
// Editar
include_once("../classe/AlterarSubCategoria.php");

if (isset($_POST['editar'])) {
    $idSubCategoria = $_POST['idSubCategoria'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $situacao = $_POST['situacao'];

    $categoria = new AlterarSubCategoria();
    $categoria->alterarSubCategoria($idSubCategoria, $nome, $descricao, $situacao);
}

// Apagar
include_once("../classe/ApagarSubCategoria.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idSubCategoria'])) {
    $idSubCategoria = intval($_GET['idSubCategoria']);
    $apagarSubCategoria = new ApagarSubCategoria();
    $apagarSubCategoria->apagarSubCategoria($idSubCategoria);
}
?>
<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3">Sub-Categorias Cadastradas</div>
            </div>
            <div class="col-3 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark fw-medium" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
            <div class="col table-responsive">
                <?php
                    include_once("../classe/MostrarSubCategoria.php");
                    $subCategorias = new MostrarSubCategoria();
                    $subCategorias->setNumPagina(@$_GET['pg']);
                    $subCategorias->setUrl("?tela=cadListarSubCategoria");
                    $subCategorias->setSessao('');
                    $subCategorias->mostrarSubCategoria();
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
                    <li><?php $subCategorias->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar novo
                    item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarSubCategoria" method="post" >
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
<div class="modal fade" id="editSubCategoryModal" tabindex="-1" aria-labelledby="editSubCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubCategoryModalLabel">Editar Sub Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarSubCategoria" method="post" id="editCategoryForm">
                <div class="modal-body">
                    <input type="hidden" name="idSubCategoria" id="editIdSubCategoria">
                    <div class="mb-3">
                        <label for="editNomeSubCategoria" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNomeSubCategoria" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescricaoSubCategoria" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="editDescricaoSubCategoria" name="descricao" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSituacaoSubCategoria" class="form-label">Situação</label>
                        <select class="form-select" id="editSituacaoSubCategoria" name="situacao" required>
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
                Tem certeza de que deseja excluir esta Sub categoria?
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
            document.getElementById('editIdSubCategoria').value = this.dataset.id;
            document.getElementById('editNomeSubCategoria').value = this.dataset.nome;
            document.getElementById('editDescricaoSubCategoria').value = this.dataset.descricao;
            document.getElementById('editSituacaoSubCategoria').value = this.dataset.situacao;

            const modal = new bootstrap.Modal(document.getElementById('editSubCategoryModal'));
            modal.show();
        });
    });
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            const deleteId = this.dataset.id;
            const confirmDeleteButton = document.getElementById('confirmDelete');
            confirmDeleteButton.href = 'index.php?tela=cadListarSubCategoria&action=delete&idSubCategoria=' + deleteId;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });
});
</script>