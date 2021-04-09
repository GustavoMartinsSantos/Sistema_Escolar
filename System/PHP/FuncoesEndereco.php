<?php
    function webClient($url) {
        $ch = curl_init();
   
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   
        $data = curl_exec($ch);
   
        curl_close($ch);
   
        return $data;
    }

    function get_cep($rua, $cidade, $uf) {
        $rua = str_replace(" ", "%20", 
        preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/",
                           "/(é|è|ê|ë)/","/(É|È|Ê|Ë)/",
                           "/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/",
                           "/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/",
                           "/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/"),
        explode(" ","a A e E i I o O u U"), $rua));

        $url = sprintf('https://viacep.com.br/ws/%s/%s/%s/json/ ', $uf, $cidade, $rua);
        $result = json_decode(webClient($url));

        return $result[0]->cep;
    }

    function get_endereco($cep){
        // formatar o cep removendo caracteres não numéricos
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "https://viacep.com.br/ws/$cep/xml/";
    
        $xml = simplexml_load_file($url);
    
        if($xml->erro == true)
          return false;
    
        return $xml;
    }
?>