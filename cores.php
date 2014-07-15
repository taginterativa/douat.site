<?php
ini_set('max_execution_time', '9999');
$conexao = mysql_connect('localhost', 'root', 'root');
mysql_select_db('douat');


function getReturn($cor)
{
    $url = 'http://www.textilcristina.com.br/ajax/consulta.php?busca=cor&cor=' .  $cor;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $head = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $arr = json_decode($head);

    $hex = str_replace("#", "", $arr->rgb);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }

    if($arr->codigo != "")
    {
        $SQL = "INSERT INTO pantone (name, hex, red, green, blue, created_at, updated_at, is_active)
                VALUES ('$arr->nome', '$arr->rgb', $r, $g, $b, NOW(), NOW(), 1)";

        mysql_query($SQL) or die(mysql_error());

        return array(
            'name' => $arr->nome,
            'hex'  => $arr->rgb,
            'codigo' => $arr->codigo,
            'pantone_id' => mysql_insert_id()
        );
    }
    else
    {
        return false;
    }
}


$file = fopen('pantones.csv', 'r');
while($linha = fgets($file))
{
    list($col1, $col2) = explode(',', $linha);
    list($code, $nome) = explode(' - ', $col1);
    list($pantone, $tp) = explode(' ', $col2);

    $arr = getReturn($pantone);

    if($arr === false)
    {
        echo $pantone . ' Inexistente<br />';
    }
    else
    {
        $SQL = "INSERT INTO color (pantone_id, name, code, created_at, updated_at, is_active)
                VALUES ($arr[pantone_id], '$nome', '$code', NOW(), NOW(), 1)";
        mysql_query($SQL) or die(mysql_error());
    }

}

fclose($file);


