<?php
/**
 * Created by PhpStorm.
 * User: Fernando
 * Date: 15/06/14
 * Time: 22:39
 */

namespace CMS\ConfiguracoesBundle\Services;

class Tools {
    /*
    public function sentApi($url, $fields, $file = null){
        $send['token'] = md5(date('Ymd'));
        $send['data'] = base64_encode(json_encode($fields));

        $send_string = '';

        foreach($send as $key=>$value) : $send_string .= $key.'='.$value.'&'; endforeach;
        rtrim($send_string, '&');

        if(!is_null($file)):
            $send['file'] = '@'.$file;
        endif;


        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $send);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        /*
        if($fields['metodo'] == 'getCanal'):
            var_dump($result);
            die();
        endif;


        if(curl_errno($ch)):
            $result = 'error:' . curl_error($ch);
        else:
            $result = json_decode(base64_decode($result));
        endif;

        curl_close($ch);

        return $result;
    }
    */

    public function sentApi($url, $fields, $file = null){
        $send['token'] = md5(date('Ymd'));
        $send['data'] = base64_encode(json_encode($fields));

        $send_string = '';

        foreach($send as $key=>$value) : $send_string .= $key.'='.$value.'&'; endforeach;
        rtrim($send_string, '&');

        if(!is_null($file)):
            $send['file'] = '@'.$file;
        endif;

        $result = $this->curlExecute($url, $send);

        if(isset($result['error'])):
            $result = $result['error'];
        else:
            $result = json_decode(base64_decode($result['response']));
        endif;

        return $result;
    }

    public function connectFacebook($app_id, $app_secret, $url_return){
        $code = '';

        if(isset($_REQUEST["code"])):
            $code = $_REQUEST["code"];
        endif;

        if(empty($code)) {
            $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
            $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($url_return) . "&state=" . $_SESSION['state']."&scope=user_about_me,email";

            echo("<script> top.location.href='" . $dialog_url . "'</script>");

            die();
        }

        $token_url = "https://graph.facebook.com/oauth/access_token?" . "client_id=" . $app_id . "&redirect_uri=" . urlencode($url_return) . "&client_secret=" . $app_secret . "&code=" . $code;

        $response = $this->curlExecute($token_url);
        $params = null;
        parse_str($response['response'], $params);

        return $params;
    }

    public function curlExecute($url, $data = null){
        $ch = curl_init();
        $timeout = 0; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, "$url");
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

        if(!is_null($data)):
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
        endif;

        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $result['response'] = curl_exec($ch);

        if(curl_errno($ch)):
            $result['error'] = 'error:' . curl_error($ch);
        endif;


        if(!is_null($data)):
            //var_dump($result);
            //die();
        endif;

        
        curl_close($ch);

        return $result;
    }
} 