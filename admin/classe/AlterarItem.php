<?php
include_once("Conexao.php");

class Alterar extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    public function alterarCategoria($idCategoria, $nome, $descricao) {
        try {
            $sql = "SELECT * FROM categories WHERE id = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("i", $idCategoria);
            $stmt->execute();
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            echo "Erro ao obter Categoria: " . $e->getMessage();
        }
        try {
            $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";

            $stmt = $this->getConnection()->prepare($sql);

            $stmt->bind_param("ssi", $nome, $descricao, $idCategoria);

            if ($stmt->execute()) {
                // Sucesso ao alterar categoria
            } else {
                echo "Erro ao atualizar Categoria: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    // Função para alterar os dados de um produto
    public function alterarProduto($idProduto, $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $imagem = null){
        try {
            $sql = "SELECT * FROM products WHERE id = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("i", $idProduto);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                try {
                    // Query de atualização com ou sem imagem
                    if ($imagem !== null && $imagem !== '') {
                        $sql = "UPDATE products SET name = ?, description = ?, in_stock = ?, price = ?, category_id = ?, status = ?, image = ? WHERE id = ?";
                        $stmt = $this->getConnection()->prepare($sql);
                        $stmt->bind_param("ssdisssi", $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $imagem, $idProduto);
                    } else {
                        $sql = "UPDATE products SET name = ?, description = ?, in_stock = ?, price = ?, category_id = ?, status = ? WHERE id = ?";
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
            } else {
                return "Produto não encontrado.";
            }
        } catch (Exception $e) {
            return "Erro ao obter produto: " . $e->getMessage();
        }
    }
    public function alterarUsuario($idUsuario, $nome, $email, $senha = null, $accessLevel, $cpf, $phone, $situacao,) {
        try {
            if ($senha) {
                $sql = "UPDATE users SET name = ?, email = ?, password = ?, access_level = ?, cpf = ?, phone = ?, status = ?, WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("sssiiis", $nome, $email, $senha, $accessLevel, $cpf, $phone, $situacao, $idUsuario);
            } else {
                $sql = "UPDATE users SET name = ?, email = ?, access_level = ?, cpf = ?, phone = ?, status = ? WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("ssiiisi", $nome, $email,  $accessLevel, $cpf, $phone, $situacao, $idUsuario);
            }

            if ($stmt->execute()) {
                // Sucesso ao alterar usuário
            } else {
                echo "Erro ao atualizar usuário: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
