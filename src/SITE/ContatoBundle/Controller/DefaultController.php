<?php

namespace SITE\ContatoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ContatoBundle:Default:index.html.twig', array(
            'Messages' => $this->get('session')->getFlashBag()->get('message')
        ));
    }

    public function sendAction(Request $request)
    {
        $form = $this->get('request')->request;
        $body = '<strong>Nome: </strong>'. $form->get('nome').'<br />';
        $body .= '<strong>Email: </strong>'. $form->get('email').'<br />';
        $body .= '<strong>Telefone: </strong>'. $form->get('telefone').'<br />';
        $body .= '<strong>Mensagem: </strong><br />'. nl2br($form->get('mensagem'));


        $from = array('no-reply@douattextil.com.br' => 'Contato douat');
        $to = array('weverson@taginterativa.com.br' => 'Weverson Cachinsky');

        $message = \Swift_Message::newInstance()
            ->setSubject('Contato')
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, 'text/html');

        $sendMail = $this->get('mailer')->send($message);

        if($sendMail):
            $this->get('session')->getFlashBag()->add('message', 'Mensagem enviada com sucesso! Logo entraremos em contato');
        else:
            $this->get('session')->getFlashBag()->add('message', 'Erro ao enviar email! Verifique seus dados e tente novamente');
        endif;

        return new RedirectResponse($this->generateUrl('contato_homepage'));
    }
}
