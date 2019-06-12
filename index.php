<?php  

ini_set('max_execution_time', 300);

function tirarTexto($str) {	
	$numero = preg_replace("/[^0-9]/", "", $str);
	return $numero;
}

function ler(){
    $arquivo = "file.fs";
    $fp = fopen($arquivo, "r");
    while (!feof ($fp)) {
        $dadosLinha = fgets($fp, 4096);
		$fw = fopen('novo.txt', 'a+');
		$arrayLinha = explode('|', $dadosLinha);
		if ($arrayLinha[0] == 'PNM'){
			if(!tirarTexto($arrayLinha[6])==0){
				$arrayLinha[7] = str_replace(",", "",  number_format(intval(tirarTexto($arrayLinha[6]))*intval($arrayLinha[7]),2));	
			} else {
				$arrayLinha[7] = str_replace(",", "",  number_format(1 * intval($arrayLinha[7]),2));	
			}
			$arrayLinha[6] = 'UN';		
		}
       	fwrite($fw, implode("|",$arrayLinha)."\n");	
        fclose($fw);
    }
    fclose($fp);
}

echo ler();
?>