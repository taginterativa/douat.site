<?php

namespace SITE\ContatoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $url = $this->container->getParameter('url');

        $dados['metodo'] = 'getChannels';
        $dados['params'] = array('limit' => 10);
        $canais = $this->get("tools")->sentApi($url,$dados);

        $dados = null;
        $dados['metodo'] = 'getChannelsCameras';
        $dados['params'] = array('limit' => 2);

        foreach($canais->result as $canal):
            $dados['params']['canal'][] = $canal->id;
        endforeach;
        $cameras = $this->get("tools")->sentApi($url,$dados);   
        return $this->render('ContatoBundle:Default:index.html.twig',array(
        	'canais_menu' => $canais->result,
            'cameras_menu' => $cameras->result
        ));
    }

    public function sendAction(Request $request)
    {
        $form = $this->get('request')->request;
        $body = '<strong>Nome: </strong>'. $form->get('nome').'<br />';
        $body .= '<strong>Email: </strong>'. $form->get('email').'<br />';
        $body .= '<strong>Telefone: </strong>'. $form->get('telefone').'<br />';
        $body .= '<strong>Mensagem: </strong><br />'. nl2br($form->get('mensagem'));


        $from = array('no-reply@vejoaovivo.com.br' => 'Contato vejo ao vivo');
        $to = array('fernando@taginterativa.com.br' => 'Fernando Cezar Chaves', 'contato@vejoaovivo.com.br' => 'Contato vejo ao vivo');

        $message = \Swift_Message::newInstance()
            ->setSubject('Contato')
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, 'text/html');

        $sendMail = $this->get('mailer')->send($message);

        if($sendMail):
            $this->get('session')->getFlashBag()->add('message', 'Mensagem enviado com sucesso! Logo entraremos en contato');
        else:
            $this->get('session')->getFlashBag()->add('message', 'Erro ao enviar email! Verifique seus dados e tente novamente');
        endif;

        return new RedirectResponse($this->generateUrl('contato_homepage'));
    }
}
