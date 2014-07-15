<?php
/**
 * Created by PhpStorm.
 * User: fernandocchaves
 * Date: 03/06/14
 * Time: 14:35
 */


namespace Api;


class ApiController {

    private $data_controller = null;
    private $database = null;
    private $security = null;

    public function __construct($database, $security = null){
        $this->database = $database;
        $this->security = $security;
    }

    public function execute($data, $type, $file){

        if(!is_null($data)):
            $this->setDataControlle($data, $type);
        elseif(is_null($this->getDataController())):
            return 'Parametros Inválidos';
        endif;

        $data = $this->data_controller;

        if(!is_null($file)):
            $data->params->file = $file;
        endif;

        if(is_callable(array($this, $data->metodo))):
            $execute = call_user_func_array(array($this, $data->metodo), array($data->params));
        else:
            $execute = array('result'=> 'Função não existe');
        endif;

        $result = $this->getDataController($execute, $type);

        return $result;
    }

    private function setDataControlle($data, $type){
        $this->data_controller = $this->decrypt($data, $type);
    }

    private function getDataController($data, $type){
        return $this->encrypt($data, $type);
    }

    private function decrypt($data, $type){
        if(is_null($type)):
            return json_decode(base64_decode($data));
        else:
            return json_decode($data);
        endif;
    }

    private function encrypt($data, $type){
        if(is_null($type)):
            return base64_encode(json_encode($data));
        else:
            return json_encode($data);
        endif;
    }

    private function saveUser($params){
        $sql = "insert into membro (perfil_id, email, senha, nome) values(?, ?, ?, ?)";
        $result = $this->database->executeUpdate($sql, array($params->perfil_id, $params->email, $params->password, $params->nome));

        if($result):
            return array('result' => 1);
        else:
            return array('result' => 0);
        endif;
    }

    private function getLogin($params){
        $sql = "select * from membro where email = ? and senha = ?";
        $result = $this->database->fetchAssoc($sql, array($params->email, $params->password));

        if($result):
            return array('result' => array('autorization' => 1, 'user' => $result));
        else:
            return array('result' => array('autorization' => 0));
        endif;

    }

    private function getLogout($params){
        //$sql = "insert into user (username, password) values(?, ?)";
        //$result = $this->database->executeUpdate($sql, array($params['username'], $params['password']));
        return array('result' => null);
    }

    private function getUsers($params){
        $sql = "select * from membro";
        $result = $this->database->fetchAll($sql);
        return array('result' => $result);
    }

    private function getUser($params){
        $sql = "select * from membro where id = ?";
        $result = $this->database->fetchAssoc($sql, array($params->user_id));
        return array('result' => $result);
    }

    private function getStates($params = null){
        $sql = "select * from estado";
        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getStatesCameras($params = null){
        $sql = "select distinct estado_sigla as estado from camera order by estado";
        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getCities($params){
        var_dump($params);
        $sql = "select * from cidade where estado_id = " . $params->estado_id;
        $result = $this->database->fetchAll($sql);
        return array('result' => $result);
    }

    private function getCitieCameras($params = null){
        $sql = "select distinct cidade, cidade_slug, estado_sigla from camera where estado_sigla = '".$params->estado."' order by cidade asc";
        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getUserType($params){
        $sql = "select * from perfil";
        $result = $this->database->fetchAll($sql);
        return array('result' => $result);
    }

    private function getChannels($params = null){
        $sql = "select * from canais";
        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getChannelsCameras($params = null){
        
        if($params->canal != ''):
            
            foreach ($params->canal as $canal) :
                $sql = "select c.* from canais_camera cc join camera c on c.id = cc.camera_id  where canais_id = ".$canal;

                if ($params->limit != '') :
                    $sql .= ' limit '.$params->limit;
                endif;

                $result['cameras'][] = $this->database->fetchAll($sql);
            endforeach;
        else:
            $result = null;
        endif;

        return array('result' => $result);
    }

    private function getCamera($params = null){
        
        if($params->slug != ''):
            $sql = "select * from camera where estado_sigla = '".$params->estado."' and cidade = '".$params->cidade."' and slug = '".$params->slug."'";
            $result = $this->database->fetchAll($sql);
        else:
            $result = null;
        endif;

        return array('result' => $result);
    }

    private function getCameraDestaque($params = null){
        if(isset($params->canal) && $params->canal != ''):
            $sql = "select camera.* FROM canais_camera join canais on canais.id = canais_camera.canais_id join camera on camera.id = canais_camera.camera_id where canais_camera.canais_id = '".$params->canal."' limit 1";
        elseif(isset($params->cidade) && $params->cidade != ''):
            $sql = "select * FROM camera where cidade_slug = '".$params->cidade."' limit 1";
        else:
            $sql = "select * from camera limit 1";
        endif;

        $result = $this->database->fetchAssoc($sql);

        return array('result' => $result);
    }

    private function getNextCameras($params = null){

        $sql = "select * from camera";

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;
        $result = $this->database->fetchAll($sql);


        return array('result' => $result);
    }

    private function getCityCameras($params = null){

        $sql = "select * from camera where cidade_slug = '".$params->cidade."'";

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result = $this->database->fetchAll($sql);


        return array('result' => $result);
    }

    private function getCanal($params = null){

        $sql = "select * from canais where slug = '".$params->slug."'";
        $result = $this->database->fetchAssoc($sql);

        $sql = "select count(*) as total from canais_camera where canais_id = '".$result['id']."'";

        $count = $this->database->fetchAssoc($sql);
        $result['count'] = $count['total'];

        return array('result' => $result);
    }

    private function getCidade($params = null){

        $sql = "select * from cidade where slug = '".$params->slug."'";
        $result = $this->database->fetchAssoc($sql);

        $sql = "select count(*) as total from camera where cidade_slug = '".$params->slug."'";

        $count = $this->database->fetchAssoc($sql);
        $result['count'] = $count['total'];

        return array('result' => $result);
    }

    private function getCanalDestaque($params = null){

        if(isset($params->canal) && $params->canal != ''):
            $sql = "select camera.*, canais.nome as canal_nome FROM canais_camera join canais on canais.id = canais_camera.canais_id join camera on camera.id = canais_camera.camera_id where canais_camera.canais_id = '".$params->canal."'";
        else:
            $sql = "select count(canais_id) as total, canais.nome as canal_nome, canais_id FROM canais_camera join canais on canais.id = canais_camera.canais_id group by canais_id order by total desc limit 1";
            $canal = $this->database->fetchAssoc($sql);

            $sql = "select camera.*, canais.nome as canal_nome FROM canais_camera join canais on canais.id = canais_camera.canais_id join camera on camera.id = canais_camera.camera_id where canais_camera.canais_id = '".$canal['canais_id']."'";
        endif;
        
        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result['cameras'] = $this->database->fetchAll($sql);
        if(isset($canal['canal_nome'])):
            $result['canal'] = $canal['canal_nome'];
        endif;

        return array('result' => $result);
    }

    private function getMaisAcessadas($params = null){

        if(isset($params->canal) && $params->canal != ''):
            $sql = "select camera.* FROM canais_camera join canais on canais.id = canais_camera.canais_id join camera on camera.id = canais_camera.camera_id where canais_camera.canais_id = '".$params->canal."' order by visualizacoes desc";
        elseif(isset($params->cidade) && $params->cidade != ''):
             $sql = "select * FROM camera where cidade_slug = '".$params->cidade."' order by visualizacoes desc";
        else:
            $sql = "select * FROM camera order by visualizacoes desc";
        endif;
        

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getMaisRecentes($params = null){

        if(isset($params->canal) && $params->canal != ''):
            $sql = "select camera.* FROM canais_camera join canais on canais.id = canais_camera.canais_id join camera on camera.id = canais_camera.camera_id where canais_camera.canais_id = '".$params->canal."' order by visualizacoes desc";
        elseif(isset($params->cidade) && $params->cidade != ''):
             $sql = "select * FROM camera where cidade_slug = '".$params->cidade."' order by visualizacoes desc";
        else:
            $sql = "select * FROM camera order by created desc";
        endif;
        

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getVendoAgora($params = null){

        $sql = "select * FROM camera order by titulo asc";

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getBuscaCamera($params = null){

        $sql = "select * FROM camera where titulo like '%".$params->query."%'";

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getBuscaCanal($params = null){

        $sql = "select * FROM canais where nome like '%".$params->query."%'";

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }

    private function getBuscaCidade($params = null){

        $sql = "select * FROM cidade where nome like '%".$params->query."%'";

        if ($params->limit != '') :
            $sql .= ' limit '.$params->limit;
        endif;

        $result = $this->database->fetchAll($sql);

        return array('result' => $result);
    }


} 