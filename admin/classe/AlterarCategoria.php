<?php
include_once("Conexao.php");

class AlterarCategoria extends Conexao {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function obterCategoria($idCategoria) {
        try {
            $sql = "SELECT * FROM categories WHERE idCategory = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idCategoria);
            $stmt->execute();
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            echo "Erro ao obter Categoria: " . $e->getMessage();
        }
    }

    public function alterarCategoria($idCategoria, $nome, $descricao, $situacao) {
        try {
            $sql = "UPDATE categories SET nameCategory = ?, descCategory = ?, statusCategory = ? WHERE idCategory = ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("sssi", $nome, $descricao, $situacao, $idCategoria);

            if ($stmt->execute()) {
                // Sucesso ao alterar categoria
            } else {
                echo "Erro ao atualizar Categoria: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
