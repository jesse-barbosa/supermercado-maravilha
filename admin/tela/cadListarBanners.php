<?php
// Adicionar
include_once("../classe/AdicionarBanner.php");

if (isset($_POST['enviar'])) {
    $situacao = $_POST['situacao'];
    $idImage = isset($_POST['idImage']) ? $_POST['idImage'] : null;

    if ($idImage !== null) {
        $banner = new AdicionarBanner();
        $banner->adicionarBanner($idImage, $situacao);
    } else {
        echo "Erro: Nenhuma imagem foi selecionada.";
    }
}

// Editar
include_once("../classe/AlterarBanner.php");

if (isset($_POST['editar'])) {
    $idBanner = $_POST['idBanner'];
    $situacao = $_POST['situacao'];

    $idImage = isset($_POST['idImage']) && !empty($_POST['idImage']) ? $_POST['idImage'] : null;
    $banner = new AlterarBanner();
    $resultado = $banner->alterarBanner($idBanner, $situacao, $idImage);
    
    if ($resultado === true) {
        echo "<script>window.location.href = 'index.php?tela=cadListarBanners';</script>";
    } else {
        echo "Erro: " . $resultado;
    }
}

// Apagar
include_once("../classe/ApagarBanner.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idBanner'])) {
    $idBanner = intval($_GET['idBanner']);
    $apagarBanner = new ApagarBanner();
    $apagarBanner->apagarBanner($idBanner);
}
?>

<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3">Banners Cadastrados</div>
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
            <div class="col bg-white py-4 m-3 rounded-3">
                <?php
                    include_once("../classe/MostrarBanners.php");
                    $banner = new MostrarBanners();
                    $banner->setNumPagina(@$_GET['pg']);
                    $banner->setUrl("?tela=cadListarBanners");
                    $banner->setSessao('');
                    $banner->mostrarBanners();
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
                <ul class="nav nav1 d-flex">
                    <li><?php $banner->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar novo item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                <!-- Seleção de Imagem -->
                <div class="mb-3 text-start">
                    <label for="editNomeImagem" class="form-label">Selecione a Imagem:</label>
                    <select name="idImage" id="editNomeImagem" class="form-select">
                <option value="" disabled selected>Escolha uma imagem</option>
<!-- Aqui vai ter o input para subir a imagem -->
            </select>
                </div>
                <!-- Preview da Imagem Selecionada para Adicionar -->
                <div class="mb-3 text-start">
                    <img id="addImagemPreview" src="" class="img-fluid" alt="Preview da Imagem Selecionada">
                </div>
                    <!-- Seleção do Status -->
                    <div class="mb-3 text-start">
                        <label for="situacao" class="form-label">Status do Banner:</label>
                        <select name="situacao" class="form-select" required>
                            <option value="ATIVO">ATIVO</option>
                            <option value="INATIVO">DESATIVO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="enviar" class="btn btn-dark">Adicionar Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal de Edição -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBannerModalLabel">Editar Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" id="editIdBanner" name="idBanner">
                    
                    <!-- Seleção de Imagem -->
                    <div class="mb-3 text-start">
                        <label for="editNomeImagem" class="form-label">Selecione a Imagem:</label>
                        <select name="idImage" id="editNomeImagemEditar" class="form-select">
                    <option value="" disabled selected>Escolha uma imagem</option>
<!-- Aqui vai ter o input para subir a imagem -->
                </select>
                    </div>
                    <!-- Preview da Imagem Selecionada para Editar -->
                    <div class="mb-3 text-start">
                        <img id="editImagemPreview" src="" class="img-fluid" alt="Preview da Imagem Selecionada">
                    </div>
                    <!-- Seleção do Status -->
                    <div class="mb-3 text-start">
                        <label for="editSituacaoBanner" class="form-label">Status do Banner:</label>
                        <select name="situacao" id="editSituacaoBanner" class="form-select" required>
                            <option value="ATIVO">Ativo</option>
                            <option value="INATIVO">Inativo</option>
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
                Tem certeza de que deseja excluir este Banner?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="" id="confirmDelete" class="btn btn-dark">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Adicionar imagem no modal de adicionar
    document.getElementById('editNomeImagem').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const url = selectedOption.dataset.url;
        document.getElementById('addImagemPreview').src = url;
    });

    // Editar imagem no modal de edição
    document.getElementById('editNomeImagemEditar').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const url = selectedOption.dataset.url;
        document.getElementById('editImagemPreview').src = url;
    });

    // Configuração do modal de edição
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            const idBanner = this.dataset.id;
            const situacao = this.dataset.situacao;
            const urlImagem = this.dataset.url;
            const idImage = this.dataset.idimage;

            // Preencher os campos do modal com os valores
            document.getElementById('editIdBanner').value = idBanner;
            document.getElementById('editSituacaoBanner').value = situacao;
            document.getElementById('editImagemPreview').src = urlImagem; // Mostrar a imagem atual

            // Selecionar a imagem correta no dropdown se existir
            const selectImagem = document.getElementById('editNomeImagemEditar');
            const options = selectImagem.querySelectorAll('option');
            options.forEach(option => {
                if (option.value === idImage) {
                    option.selected = true;
                }
            });

            // Abrir o modal de edição
            const modal = new bootstrap.Modal(document.getElementById('editBannerModal'));
            modal.show();
        });
    });
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            const deleteId = this.dataset.id;
            const confirmDeleteButton = document.getElementById('confirmDelete');
            confirmDeleteButton.href = 'index.php?tela=cadListarBanners&action=delete&idBanner=' + deleteId;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });
});
</script>
