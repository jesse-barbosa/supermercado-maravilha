<?php
include_once("MinhaConexao.php");

class AdicionarProduto extends MinhaConexao {

    public function __construct() {
        parent::__construct();
    }

    public function adicionarProduto($nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $idImage) {
        try {
            // Inserir novo produto
            $sql = "INSERT INTO products (nameProduct, idImage, descProduct, quantProduct, priceProduct, idCategory, idSubCategory, statusProduct)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("ssisiiis", $nome, $idImage, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao);
            
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
