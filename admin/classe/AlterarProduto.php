    <?php
    include_once("MinhaConexao.php");

    class AlterarProduto extends MinhaConexao
    {
        private $conn;

        public function __construct()
        {
            parent::__construct();
            $this->conn = $this->getConnection();
        }

        // Função para obter os dados de um produto pelo id
        public function obterProduto($idProduto)
        {
            try {
                $sql = "SELECT * FROM products WHERE idProduct = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("i", $idProduto);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if ($resultado->num_rows > 0) {
                    return $resultado->fetch_assoc();
                } else {
                    return null; // Retorna null se o produto não for encontrado
                }
            } catch (Exception $e) {
                return "Erro ao obter produto: " . $e->getMessage();
            }
        }

        // Função para alterar os dados de um produto
public function alterarProduto($idProduto, $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $idImage = null) {
    try {
        // Verifica se o produto existe
        if (!$this->obterProduto($idProduto)) {
            return "Produto não encontrado.";
        }

        // Query de atualização com ou sem imagem
        if ($idImage !== null && $idImage !== '') {
            $sql = "UPDATE products SET nameProduct = ?, descProduct = ?, quantProduct = ?, priceProduct = ?, idCategory = ?, idSubCategory = ?, statusProduct = ?, idImage = ? WHERE idProduct = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssidsissi", $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $idImage, $idProduto);
        } else {
            $sql = "UPDATE products SET nameProduct = ?, descProduct = ?, quantProduct = ?, priceProduct = ?, idCategory = ?, idSubCategory = ?, statusProduct = ? WHERE idProduct = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssidsisi", $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $idProduto);
        }

        // Executa o SQL e retorna o resultado da operação
        if ($stmt->execute()) {
            return true;
        } else {
            return "Erro ao atualizar produto: " . $stmt->error;
        }
    } catch (Exception $e) {
        return "Erro: " . $e->getMessage();
    }
}
    }
?>
