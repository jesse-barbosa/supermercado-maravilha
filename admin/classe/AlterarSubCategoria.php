<?php
include_once("Conexao.php");

class AlterarSubCategoria extends Conexao {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function obterSubCategoria($idCategoria) {
        try {
            $sql = "SELECT * FROM subcategories WHERE idSubCategory = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idCategoria);
            $stmt->execute();
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            echo "Erro ao obter Sub Categoria: " . $e->getMessage();
        }
    }

    public function alterarSubCategoria($idCategoria, $nome, $descricao, $situacao) {
        try {
            $sql = "UPDATE subcategories SET nameSubCategory = ?, descSubCategory = ?, statusSubCategory = ? WHERE idSubCategory = ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("sssi", $nome, $descricao, $situacao, $idCategoria);

            if ($stmt->execute()) {
                // Sucesso ao alterar sub categoria
            } else {
                echo "Erro ao atualizar Sub Categoria: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
