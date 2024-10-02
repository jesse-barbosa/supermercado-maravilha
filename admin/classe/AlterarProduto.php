<?php
include_once("Conexao.php");

class AlterarProduto extends Conexao {
    public function __construct() {
        parent::__construct();
    }
    // Função para obter os dados de um produto pelo id
    public function obterProduto($idProduto)
    {
        try {
            $sql = "SELECT * FROM products WHERE id = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("i", $idProduto);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                return $resultado->fetch_assoc();
            } else {
                return null; // Retorna null se o produto não for encontrado
            }
        } catch (Exception $e) {
            return "Erro ao obter produto: " . $e->getMessage();
        }
    }

    // Função para alterar os dados de um produto
    public function alterarProduto($idProduto, $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $imagem = null)
    {
        try {
            // Verifica se o produto existe
            if (!$this->obterProduto($idProduto)) {
                return "Produto não encontrado.";
            }
    
            // Query de atualização com ou sem imagem
            if ($imagem !== null && $imagem !== '') {
                $sql = "UPDATE products SET name = ?, description = ?, in_stock = ?, price = ?, idCategory = ?, status = ?, image = ? WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("ssdisssi", $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $imagem, $idProduto);
            } else {
                $sql = "UPDATE products SET name = ?, description = ?, in_stock = ?, price = ?, idCategory = ?, status = ? WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("ssdissi", $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $idProduto);
            }
    
            // Executa o SQL e retorna o resultado da operação
            if ($stmt->execute()) {
                return true;
            } else {
                return "Erro ao atualizar produto: " . $stmt->error;
            }
        } catch (Exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    
}
?>
