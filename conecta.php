<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>

<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery('#estado_id').change(function(){
            var dados = {};
            dados.metodo = 'getCities';
            var params = {};
            params.estado_id = $(this).val();
            dados.params = {};
            dados.params = params;
            var json = (JSON.stringify(dados));
            jQuery.ajax({
                type: "POST",
                url: "http://localhost/vejoaovivo/api/",
                dataType: 'json',
                data: { token: "<?php echo md5(date('Ymd')); ?>", data: json, type: 'json' }
            }).done(function( jsonReturn ) {
               var object = JSON.parse(jsonReturn);
               if(object.result.length > 0){
                   var html = '<option value="0">Selecione a cidade </option>';
                   for(i=0; i < object.result.length; i++){
                       html += '<option value="' + object.result[i].id + '">' + object.result[i].nome + '</option>';
                   }
               }else{
                   var html = '<option value="0">Selecione o estado </option>';
               }

               jQuery('#cidade_id').html(html);
            });
        });
    });
</script>
<?php
/**
 * Created by PhpStorm.
 * User: fernandocchaves
 * Date: 03/06/14
 * Time: 11:10
 */

$url = 'http://dev.taginterativa.com.br/clientes/vav/api/';

function sentApi($url, $fields, $file = null){
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string, '&');

    if(!is_null($file)):
        $fields['file'] = '@'.$file;
    endif;


    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    if(curl_errno($ch))
    {
        $result = 'error:' . curl_error($ch);
    }

    var_dump($result);
    die();

    curl_close($ch);

    return $result;
}

if(isset($_POST['nome'])):
    $dados['metodo'] = 'saveUser';

    $file = null;
    if(isset($_FILES)):
        move_uploaded_file($_FILES['image']['tmp_name'], 'upload/'.$_FILES['image']['name']);
        $file = realpath('upload/'.$_FILES['image']['name']);
    endif;

    $dados['params'] = $_POST;

    $send['token'] = md5(date('Ymd'));
    $send['data'] = base64_encode(json_encode($dados));

    $api = sentApi($url, $send, $file);

    $user = json_decode(base64_decode($api));
    if($user->result == 1):
        echo '<p>Dados Salvos com sucesso</p>';
    else:
        echo '<p>Erro ao gravar os dados</p>';
    endif;
endif;

$dados == null;

$dados['metodo'] = 'getCanalDestaque';
$dados['params'] = array('limit' => 6, 'canal' => 2);

$send['token'] = md5(date('Ymd'));
$send['data'] = base64_encode(json_encode($dados));

$api = sentApi($url, $send);

$users = json_decode(base64_decode($api));

var_dump($users);

echo '<table>';
echo '<tr>';
echo '<th>Nome</th>';
echo '<th>Email</th>';
echo '</tr>';

foreach($users->result as $user):
    echo '<tr>';
    echo '<th>'.$user->nome.'</th>';
    echo '<th>'.$user->email.'</th>';
    echo '</tr>';
endforeach;

echo '</table>';

?>

<?php
$dados == null;

$dados['metodo'] = 'getUserType';
$send['token'] = md5(date('Ymd'));
$send['data'] = base64_encode(json_encode($dados));

$api = sentApi($url, $send);

$perfils = json_decode(base64_decode($api));

$dados == null;

$dados['metodo'] = 'getStates';

$send['token'] = md5(date('Ymd'));
$send['data'] = base64_encode(json_encode($dados));

$api = sentApi($url, $send);

$estados = json_decode(base64_decode($api));

?>

<form action="conecta.php" method="post" enctype="multipart/form-data">
    <label>Perfil</label><br/>
    <select name="perfil_id" id="perfil_id">
        <option value="0">Selecione o Perfil</option>
        <?php foreach($perfils->result as $perfil): ?>
            <option value="<?php echo $perfil->id;?>"><?php echo $perfil->nome;?></option>
        <?php endforeach; ?>
    </select>
    <br/><br/>
    <label>Nome</label><br/>
    <input type="text" name="nome"/>
    <br/><br/>
    <label>Email</label><br/>
    <input type="text" name="email"/>
    <br/><br/>
    <label>Telefone</label><br/>
    <input type="text" name="telefone"/>
    <br/><br/>
    <label>Password</label><br/>
    <input type="text" name="password"/>
    <br/><br/>
    <label>Imagem</label><br/>
    <input type="file" name="image"/>
    <br/><br/>
    <label>Estado</label><br/>
    <select name="estado_id" id="estado_id">
        <option value="0">Selecione o Estado</option>
        <?php foreach($estados->result as $estado): ?>
            <option value="<?php echo $estado->id;?>"><?php echo $estado->nome;?></option>
        <?php endforeach; ?>
    </select>
    <br/><br/>
    <label>Estado</label><br/>
    <select name="cidade_id" id="cidade_id">
        <option value="0">Selecione o Estado</option>
    </select>
    <br/><br/>
    <input type="submit" value="Enviar"/>
</form>

</body>
</html>