<header class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand me-5 fw-bold fs-4" href="index.php"><img src="../img/logo.svg" height="30px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active opacity-75 fw-semibold mx-3 fs-5" aria-current="page" href="index.php">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary opacity-75 fw-semibold mx-3 fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produtos
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                                include_once("../classes/ListarCategorias.php");
                                $categorias = new ListarCategorias();
                                $categorias->listarCategorias();
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opacity-75 fw-semibold mx-3 fs-5" aria-current="page" href="index.php?tela=cart">Meu Carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opacity-75 fw-semibold mx-3 fs-5" aria-current="page" href="index.php?tela=orders">Meus Pedidos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary opacity-75 fw-semibold mx-3 fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Meu perfil
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item">
                                <div class="card bg-light p-3 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle me-2 fs-3"></i> <!-- Ícone de usuário -->
                                        <span class="fw-semibold">Usuário: <span class="text-black"><?php echo $_SESSION['nome']; ?></span></span>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link opacity-75 fw-semibold mx-3 fs-5" aria-current="page" href="../funcao/sair.php">Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>