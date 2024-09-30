<?php
include_once("MinhaConexao.php");

class ApagarSubCategoria extends MinhaConexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function apagarSubCategoria($idSubCategoria)
    {
        try {
            // Usar prepare para evitar SQL Injection
            $sql = "UPDATE subcategories SET deletedSubCategory = 1 WHERE idSubCategory = ?";
            $stmt = mysqli_prepare($this->conectar, $sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . mysqli_error($this->conectar));
            }

            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, 'i', $idSubCategoria);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . mysqli_error($this->conectar));
            }

            mysqli_stmt_close($stmt);

            echo "<script>alert('Sub Categoria apagada com sucesso!');window.location.href = 'index.php?tela=cadListarSubCategoria'</script>";
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            echo "<script>window.location.href = 'index.php?tela=cadListarSubCategoria'</script>";
            exit();
        }
    }
}
?>
