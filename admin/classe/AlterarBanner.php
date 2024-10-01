<?php
include_once("Conexao.php");

// AlterarBanner.php

class AlterarBanner extends Conexao
{
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Função para obter os dados de um banner pelo id
    public function obterBanner($idBanner)
    {
        try {
            $sql = "SELECT * FROM banners WHERE idBanner = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idBanner);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                return $resultado->fetch_assoc();
            } else {
                return null; // Retorna null se o banner não for encontrado
            }
        } catch (Exception $e) {
            return "Erro ao obter banner: " . $e->getMessage();
        }
    }

    // Função para alterar os dados de um banner
    public function alterarBanner($idBanner, $situacao, $idImage = null)
    {
        try {
            // Verifica se o banner existe
            if (!$this->obterBanner($idBanner)) {
                return "Banner não encontrado.";
            }

            // Query de atualização com ou sem imagem
            if ($idImage !== null && $idImage !== '') {
                $sql = "UPDATE banners SET statusBanner = ?, idImage = ? WHERE idBanner = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ssi", $situacao, $idImage, $idBanner);
            } else {
                $sql = "UPDATE banners SET statusBanner = ? WHERE idBanner = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("si", $situacao, $idBanner);
            }

            // Executa o SQL e retorna o resultado da operação
            if ($stmt->execute()) {
                echo "<script>alert('Banner alterado com sucesso!');window.location.href = 'index.php?tela=cadListarBanners'</script>";
            } else {
                return "Erro ao atualizar banner: " . $stmt->error;
            }
        } catch (Exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}

?>
