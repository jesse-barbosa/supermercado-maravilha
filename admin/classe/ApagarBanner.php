<?php
include_once("Conexao.php");

class ApagarBanner extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ApagarBanner($idBanner)
    {
        try {
            // Usar prepare para evitar SQL Injection
            $sql = "UPDATE banners SET deletedBanner = 1 WHERE idBanner = ?";
            $stmt = mysqli_prepare($this->conectar, $sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . mysqli_error($this->conectar));
            }

            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, 'i', $idBanner);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . mysqli_error($this->conectar));
            }

            mysqli_stmt_close($stmt);

            echo "<script>alert('Banner apagado com sucesso!');window.location.href = 'index.php?tela=cadListarBanners'</script>";
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            echo "<script>window.location.href = 'index.php?tela=cadListarBanners'</script>";

            exit();
        }
    }
}
?>
