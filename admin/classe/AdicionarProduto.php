<?php
include_once("Conexao.php");
include_once("UploadImagem.php");

class AdicionarProduto extends Conexao {

    public function __construct() {
        parent::__construct();
    }

    public function adicionarProduto($nome, $descricao, $quantidade, $preco, $categoria, $imagem, $situacao) {
        try {
            // Instanciar classe UploadImagem
            $uploadImagem = new UploadImagem();
            $uploadImagem->upload($imagem, 'produtos');

            // Verificar se o diretório da imagem foi setado corretamente
            $novoDiretorioImagem = $uploadImagem->getNovoDiretorio();
            if (!$novoDiretorioImagem) {
                throw new Exception("Erro ao fazer upload da imagem.");
            }

            // Inserir novo produto com o caminho da imagem no banco de dados
            $sql = "INSERT INTO products (name, description, price, in_stock, image, category_id, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("ssdisis", $nome, $descricao, $preco, $quantidade,  $novoDiretorioImagem, $categoria, $situacao);

            if ($stmt->execute()) {
                echo "<script>alert('Produto adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";
                exit();
            } else {
                echo "Erro ao adicionar produto: " . $stmt->error;
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Erro ao adicionar produto: " . $e->getMessage();
        }
    }
}
?>
