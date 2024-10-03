<?php
    class TrocarUrl{
        public function trocarUrl($url){

            if(empty($url || $url = null)){
                $url = "../telas/home.php";
            } else{
                $url = "../telas/$url.php";
            }
            include_once($url);
        }
    }
?>