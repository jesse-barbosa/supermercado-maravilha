<?php
include_once("MinhaConexao.php");

class ApagarProduto extends MinhaConexao {
    public function __construct()
    {
        parent::__construct();
    }

    public function apagarProduto($idProduto) {
        try {
            // Consulta preparada
            $sql = "UPDATE products SET deletedProduct = 1 WHERE idProduct = ?";
            $stmt = mysqli_prepare($this->conectar, $sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . mysqli_error($this->conectar));
            }

            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, 'i', $idProduto);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . mysqli_error($this->conectar));
            }

            mysqli_stmt_close($stmt);
            echo "<script>alert('Produto apagado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";
            exit();
        } catch (Exception $e) {
            error_log("Erro ao apagar produto: " . $e->getMessage());
            exit();
        }
    }
}
?>
