<div class="col">
    <div class="d-flex flex-row text-center">
        <div class="text-start my-auto ms-3 my-3 lead text-dark">
            <img src="../img/icon.png" class="rounded-3 my-3 mx-1 w-25" alt="Icone">
            <span class='ms-3 fw-normal fs-6'><?php echo $_SESSION['nome']; ?></span>
        </div>
    </div>
</div>
<ul class="nav flex-column">
    <!-- Itens de controle -->
    <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            aria-current="page" href="?tela=home"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-house pe-1"></i>
            Início
    </li></a>
    <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            aria-current="page" href="?tela=cadListarProduto"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-pc-display pe-1"></i>
            Produtos
    </li></a>
    <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="?tela=cadListarCategoria"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-bookmark pe-1"></i> Categorias
    </li></a>
    <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="?tela=cadListarSubCategoria"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-bookmarks pe-1"></i>
            Sub Categorias
    </li></a>
    <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="?tela=cadListarBanners"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-card-image pe-1"></i> Banners
    </li></a>
        <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="?tela=cadListarImagens"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-images pe-1"></i> Imagens
    </li></a>
    <!-- Intens para relatório -->
    <li class="nav-item bg-white py-2 ps-3">
        <a class="col-sm-2 d-md-none link-dark link-opacity-75-hover" href="?tela=relatorioContato"><i
                class="bi bi-person-rolodex"></i></a>
        <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="?tela=relContato"><i class="bi bi-person-rolodex pe-1"></i> Contato</a>
    </li>
    <!-- Intens para administrador -->
    <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="?tela=cadListarUsuario"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-people pe-1"></i> Usuários
    </li></a>
    <a class="d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="?tela=listarLixeira"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-trash pe-1"></i> Lixeira
    </li></a>
    <a class="mt-5 d-none d-md-inline-block link-underline link-underline-opacity-0 link-dark link-opacity-75-hover"
            href="../../admin/funcao/Sair.php"><li class="nav-item bg-white py-2 ps-3">
        <i class="bi bi-door-open pe-1"></i> Sair
    </li></a>
</ul>