<?php
class TrocarUrl {
    public function trocarUrl($tela) {
        try {
            if($tela){
                include_once("../telas/$tela.php");
            }   else {
                include_once("../telas/home.php");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
