<?php
include_once("MinhaConexao.php");

class ApagarContato extends MinhaConexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function apagarContato($idContact)
    {
        try {
            // Usar prepare para evitar SQL Injection
            $sql = "UPDATE contacts SET deletedContact = 1 WHERE idContact = ?";
            $stmt = mysqli_prepare($this->conectar, $sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . mysqli_error($this->conectar));
            }

            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, 'i', $idContact);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . mysqli_error($this->conectar));
            }

            mysqli_stmt_close($stmt);

            echo "<script>alert('Contato apagado com sucesso!');window.location.href = 'index.php?tela=relContato'</script>";
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            echo "<script>window.location.href = 'index.php?tela=relContato'</script>";
            exit();
        }
    }
}

// Verifica se um ID de Contato foi passado e processa a exclusão
if (isset($_GET['idContact'])) {
    $idContact = intval($_GET['idContact']);
    $apagarContato = new ApagarContato();
    $apagarContato->apagarContato($idContact);
}
?>
