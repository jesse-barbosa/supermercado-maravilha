<?php
include_once("MinhaConexao.php");

class AlterarUsuario extends MinhaConexao {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function alterarUsuario($idUsuario, $nome, $email, $senha = null, $situacao, $typeUser) {
        try {
            if ($senha) {
                $sql = "UPDATE users SET nameUser = ?, emailUser = ?, passwordUser = ?, statusUser = ?, typeUser = ? WHERE idUser = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("sssssi", $nome, $email, $senha, $situacao, $typeUser, $idUsuario);
            } else {
                $sql = "UPDATE users SET nameUser = ?, emailUser = ?, statusUser = ?, typeUser = ? WHERE idUser = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ssssi", $nome, $email, $situacao, $typeUser, $idUsuario);
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
