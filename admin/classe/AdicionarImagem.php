<?php
include_once("Conexao.php");
include_once("UploadImagem.php");

class AdicionarImagem extends Conexao {

    public function __construct() {
        parent::__construct();
    }

    public function adicionarImagem($nomeImagem, $imagem, $tipoImagem, $statusImagem) {
        // Verificar se já existe uma imagem com o mesmo nome
        $sqlVerificacao = "SELECT COUNT(*) FROM images WHERE (nameImage = ? AND deletedImage = 0)";
        $stmtVerificacao = $this->getConnection()->prepare($sqlVerificacao);
        $stmtVerificacao->bind_param("s", $nomeImagem);
        $stmtVerificacao->execute();
        $stmtVerificacao->bind_result($contagem);
        $stmtVerificacao->fetch();
        $stmtVerificacao->close();

        if ($contagem > 0) {
            echo "Erro: Já existe uma imagem com esse nome.";
            return;
        }

        // Fazer o upload da imagem e obter o caminho
        $upload = new UploadImagem();
        
        // Aqui, você pode verificar se a imagem foi enviada corretamente
        if (is_array($imagem) && isset($imagem['tmp_name']) && !empty($imagem['tmp_name'])) {
            // O local de upload é baseado no tipo da imagem, ex: "banners", "products", etc.
            $upload->upload($imagem, $tipoImagem);
            $urlImagem = $upload->getNovoDiretorio();
        } else {
            echo "Erro: Nenhuma imagem foi enviada ou ocorreu um problema no upload.";
            return;
        }

        // Inserir nova imagem no banco de dados
        $sql = "INSERT INTO images (nameImage, urlImage, typeImage, statusImage) VALUES (?, ?, ?, ?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param("ssss", $nomeImagem, $urlImagem, $tipoImagem, $statusImagem);

        if ($stmt->execute()) {
            echo "<script>alert('Imagem adicionada com sucesso!');window.location.href = 'index.php?tela=cadListarImagens'</script>";
        } else {
            echo "Erro ao adicionar imagem: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
