<?php
include_once("Conexao.php");
class ListarCategorias extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    public function listarCategorias() {
        try {
            // Executa a consulta
            $sql = "SELECT id, name FROM categories";
            $query = self::execSql($sql);
            
            // Verifica se há resultados
            $resultado = self::listarDados($query); // Garantimos que o retorno seja um array
            $dados = count($resultado);  // Aqui usamos count() diretamente para contar os dados

            // Verifica se há dados e gera o HTML
            if ($dados > 0) {
                foreach ($resultado as $categoria) {
                    echo "<li><a class='dropdown-item' href='".$categoria['id']."'>". $categoria['name'] ."</a></li>";
                }
            } else {
                echo "<option value=''>Nenhuma categoria encontrada</option>";
            }
        } catch (Exception $e) {
            echo "<option value=''>Erro: " . $e->getMessage(). "</option>";
        }
    }
}
?>
