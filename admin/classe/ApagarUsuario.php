<?php
include_once("Conexao.php");

class ApagarUsuario extends Conexao {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function apagarUsuario($idUsuario) {
        try {
            $sql = "UPDATE users SET deletedUser = 1 WHERE idUser = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);

            if ($stmt->execute()) {
                echo "<script>window.location.href = 'index.php?tela=cadListarUsuario';</script>";
            } else {
                echo "Erro ao excluir usuário: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
