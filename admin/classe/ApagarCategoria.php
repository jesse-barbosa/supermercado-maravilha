<?php
include_once("MinhaConexao.php");

class ApagarCategoria extends MinhaConexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function apagarCategoria($idCategoria)
    {
        try {
            // Usar prepare para evitar SQL Injection
            $sql = "UPDATE categories SET deletedCategory = 1 WHERE idCategory = ?";
            $stmt = mysqli_prepare($this->conectar, $sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . mysqli_error($this->conectar));
            }

            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, 'i', $idCategoria);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . mysqli_error($this->conectar));
            }

            mysqli_stmt_close($stmt);

            echo "<script>alert('Categoria apagada com sucesso!');window.location.href = 'index.php?tela=cadListarCategoria'</script>";
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            echo "<script>window.location.href = 'index.php?tela=cadListarCategoria'</script>";
            exit();
        }
    }
}

// Verifica se um ID de categoria foi passado e processa a exclusão
if (isset($_GET['idCategoria'])) {
    $idCategoria = intval($_GET['idCategoria']);
    $apagarCategoria = new ApagarCategoria();
    $apagarCategoria->apagarCategoria($idCategoria);
}
?>
