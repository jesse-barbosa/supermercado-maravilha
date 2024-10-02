<?php
// Adicionar
include_once("../classe/AdicionarProduto.php");

if (isset($_POST['enviar'])) {
    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descricaoProduto'];
    $quantidade = $_POST['quantidadeProduto'];
    $preco = $_POST['precoProduto'];
    $categoria = $_POST['categoriaProduto'];
    $situacao = $_POST['situacaoProduto']; // Captura a situação

    $imagem = $_FILES['url']; // A imagem deve ser capturada a partir de $_FILES

    $adicionarProduto = new AdicionarProduto();
    $adicionarProduto->adicionarProduto($nome, $descricao, $quantidade, $preco, $categoria, $imagem, $situacao);
}

// Editar
include_once("../classe/AlterarProduto.php");

if (isset($_POST['editar'])) {
    $idProduto = $_POST['idProduto'];
    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descricaoProduto'];
    $quantidade = $_POST['quantidadeProduto'];
    $preco = $_POST['precoProduto'];
    $categoria = $_POST['categoriaProduto'];
    $situacao = $_POST['situacaoProduto'];

    @$idImage = $_POST['idImage'];

    $produto = new AlterarProduto();
    $produto->alterarProduto($idProduto, $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $idImage);
}

// Apagar
include_once("../classe/ApagarProduto.php");

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];
    
    $apagar = new ApagarProduto();
    $apagar->apagarProduto($idProduto);
}

?>
<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3 fw-semibold">Produtos Cadastrados</div>
            </div>
            <div class="col-3 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark fw-medium" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    Adicionar
                </button>
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
                    include_once("../classe/MostrarProdutos.php");
                    $produtos = new MostrarProdutos();
                    $produtos->setNumPagina(@$_GET['pg']);
                    $produtos->setUrl("?tela=cadListarProduto");
                    $produtos->setSessao('');
                    $produtos->mostrarProdutos();
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
                    <li><?php $produtos->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Adicionar Novo Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Nome do Produto -->
                    <div class="mb-3 text-start">
                        <label for="nomeProduto" class="form-label">Nome do Produto:</label>
                        <input type="text" name="nomeProduto" id="nomeProduto" class="form-control" required>
                    </div>
                    <!-- Seleção da Imagem -->
                    <div class="mb-3 text-start">
                        <label for="addIdImage" class="form-label">Selecione a Imagem:</label>
                        <div class="text-start px-1 py-1 mb-1">
                            <label for="addUrlImage" class="form-label">Imagem</label>
                            <input type="file" class="form-control" id="addUrlImage" name="url" required>
                        </div>
                    </div>
                    <!-- Preview da Imagem Selecionada -->
                    <div class="mb-3 text-start">
                        <img class="addImagemPreview img-fluid" src="" alt="Preview da Imagem Selecionada">
                    </div>
                    <!-- Descrição do Produto -->
                    <div class="mb-3 text-start">
                        <label for="descricaoProduto" class="form-label">Descrição do Produto:</label>
                        <textarea name="descricaoProduto" id="descricaoProduto" class="form-control" rows="3" required></textarea>
                    </div>
                    <!-- Quantidade do Produto -->
                    <div class="mb-3 text-start">
                        <label for="quantidadeProduto" class="form-label">Quantidade do Produto:</label>
                        <input type="number" name="quantidadeProduto" id="quantidadeProduto" class="form-control" required>
                    </div>
                    <!-- Preço do Produto -->
                    <div class="mb-3 text-start">
                        <label for="precoProduto" class="form-label">Preço do Produto:</label>
                        <input type="number" name="precoProduto" id="precoProduto" class="form-control" step="0.01" required>
                    </div>
                    <!-- Categoria do Produto -->
                    <div class="mb-3 text-start">
                        <label for="categoriaProduto" class="form-label">Categoria do Produto:</label>
                        <select name="categoriaProduto" id="categoriaProduto" class="form-select text-dark" required>
                            <option value="" disabled selected>Escolha uma categoria</option>
                            <?php
                            include_once("../classe/ListarCategorias.php");
                            $listarCategorias = new ListarCategorias();
                            $categorias = $listarCategorias->listarCategorias();
                            foreach ($categorias as $categoria) {
                                // Certifique-se que 'id' e 'name' são os índices corretos
                                echo "<option value='" . htmlspecialchars($categoria['id']) . "'>" . htmlspecialchars($categoria['name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Situação do Produto -->
                    <div class="mb-3 text-start">
                        <label for="situacaoProduto" class="form-label">Situação do Produto:</label>
                        <select name="situacaoProduto" id="situacaoProduto" class="form-select" required>
                            <option value="" disabled selected>Escolha a situação</option>
                            <option value="ATIVO">Ativo</option>
                            <option value="INATIVO">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" name="enviar" class="btn btn-primary">Adicionar Produto</button>
                </div>
            </form>
    </div>
</div>
</div>
<!-- Modal de Edição de Produto -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" id="editIdProduto" name="idProduto">
                <!-- Nome do Produto -->
                <div class="mb-3 text-start">
                    <label for="editNomeProduto" class="form-label">Nome do Produto:</label>
                    <input type="text" name="nomeProduto" id="editNomeProduto" class="form-control" required>
                </div>
                <!-- Seleção da Imagem -->
                <div class="mb-3 text-start">
                <div class="text-start px-1 py-1 mb-1">
                    <label for="addUrlImage" class="form-label">Imagem</label>
                    <input type="file" class="form-control" id="addUrlImage" name="url">
                </div>
                </div>
                <!-- Preview da Imagem Selecionada -->
                <div class="mb-3 text-start">
                    <img class="editImagemPreview img-fluid" src="" alt="Preview da Imagem Selecionada">
                </div>
                <!-- Descrição do Produto -->
                <div class="mb-3 text-start">
                    <label for="editDescricaoProduto" class="form-label">Descrição do Produto:</label>
                    <textarea name="descricaoProduto" id="editDescricaoProduto" class="form-control" rows="3" required></textarea>
                </div>
                <!-- Quantidade do Produto -->
                <div class="mb-3 text-start">
                    <label for="editQuantidadeProduto" class="form-label">Quantidade do Produto:</label>
                    <input type="number" name="quantidadeProduto" id="editQuantidadeProduto" class="form-control" required>
                </div>
                <!-- Preço do Produto -->
                <div class="mb-3 text-start">
                    <label for="editPrecoProduto" class="form-label">Preço do Produto:</label>
                    <input type="number" name="precoProduto" id="editPrecoProduto" class="form-control" step="0.01" required>
                </div>
                <!-- Categoria do Produto -->
                <div class="mb-3 text-start">
                    <label for="editCategoriaProduto" class="form-label">Categoria do Produto:</label>
                    <select name="categoriaProduto" id="editCategoriaProduto" class="form-select" required>
                        <option value="" disabled selected>Escolha uma categoria</option>
                    <?php
                    include_once("../classe/ListarCategorias.php");
                    $listarCategorias = new ListarCategorias();
                    $categorias = $listarCategorias->listarCategorias();
                    foreach ($categorias as $categoria) {
                        // Certifique-se que 'id' e 'name' são os índices corretos
                        echo "<option value='" . htmlspecialchars($categoria['id']) . "'>" . htmlspecialchars($categoria['name']) . "</option>";
                    }
                    ?>
                    </select>
                </div>
                <!-- Situação do Produto -->
                <div class="mb-3 text-start">
                    <label for="editSituacaoProduto" class="form-label">Situação do Produto:</label>
                    <select name="situacaoProduto" id="editSituacaoProduto" class="form-select" required>
                        <option value="" disabled selected>Escolha a situação</option>
                        <option value="ATIVO">ATIVO</option>
                        <option value="INATIVO">INATIVO</option>
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
<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Você tem certeza que deseja excluir este produto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-dark" id="confirmDelete">Excluir</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    let deleteId = null;  // Definir deleteId globalmente

    // Atualizar o modal de edição ao clicar no botão de edição
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            const idProduto = this.dataset.id;
            const nomeProduto = this.dataset.nome;
            const precoProduto = this.dataset.preco;
            const descricaoProduto = this.dataset.descricao;
            const quantidadeProduto = this.dataset.quantidade;
            const urlImagem = this.dataset.url;
            const categoriaProduto = this.dataset.categoria;
            const situacaoProduto = this.dataset.situacao;

            // Preencher os campos do modal com os valores
            document.getElementById('editIdProduto').value = idProduto;
            document.getElementById('editNomeProduto').value = nomeProduto;
            document.getElementById('editPrecoProduto').value = precoProduto;
            document.getElementById('editDescricaoProduto').value = descricaoProduto;
            document.getElementById('editQuantidadeProduto').value = quantidadeProduto;
            document.getElementById('editCategoriaProduto').value = categoriaProduto;
            document.getElementById('editSituacaoProduto').value = situacaoProduto;

            // Atualizar o preview da imagem
            if (urlImagem) {
                document.querySelector('.editImagemPreview').src = urlImagem;
            } else {
                document.querySelector('.editImagemPreview').src = ''; // Limpar preview se não houver imagem
            }

            // Abrir o modal de edição
            const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
            modal.show();
        });
    });

    // Preview da imagem no modal de edição ao trocar a imagem
    document.getElementById('editUrlImage').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('.editImagemPreview').src = e.target.result;
        };
        if (file) {
            reader.readAsDataURL(file); // Ler o arquivo de imagem selecionado
        } else {
            document.querySelector('.editImagemPreview').src = ''; // Limpar preview se não houver imagem
        }
    });

    // Preview da imagem no modal de adição ao trocar a imagem
    document.getElementById('addUrlImage').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('.addImagemPreview').src = e.target.result;
        };
        if (file) {
            reader.readAsDataURL(file); // Ler o arquivo de imagem selecionado
        } else {
            document.querySelector('.addImagemPreview').src = ''; // Limpar preview se não houver imagem
        }
    });

    // Exibir modal de confirmação de exclusão
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            deleteId = this.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });

    // Confirmar exclusão
    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteId) {
            window.location.href = 'index.php?tela=cadListarProduto&action=delete&id=' + deleteId;
        }
    });
});
</script>
