<?php
include_once("Conexao.php");

class ApagarProduto extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    public function apagarProduto($idProduto) {
        try {
            // Consulta preparada para atualizar o status do produto
            $sql = "UPDATE products SET deletedProduct = 1 WHERE idProduct = ?";
            $stmt = $this->getConnection()->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . $this->getConnection()->error);
            }

            // Vincular parâmetros e executar a consulta
            $stmt->bind_param('i', $idProduto);
            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . $stmt->error);
            }

            $stmt->close();
            echo "<script>alert('Produto apagado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";
            exit();
        } catch (Exception $e) {
            error_log("Erro ao apagar produto: " . $e->getMessage());
            echo "<script>alert('Erro ao apagar produto: " . $e->getMessage() . "');window.location.href = 'index.php?tela=cadListarProduto'</script>";
            exit();
        }
    }
}
?>
