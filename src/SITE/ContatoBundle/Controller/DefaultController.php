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

        $from = array('no-reply@douattextil.com.br' => 'Contato douat');
        $to = array('weverson@taginterativa.com.br' => 'Weverson Cachinsky', 'camila@taginterativa.com.br' => 'Doutora Camila');

        $message = \Swift_Message::newInstance()
            ->setSubject('Douat | Contato')
            ->setFrom($from)
            ->setTo($to)
            ->addReplyTo($this->get('request')->request->get('email'))
            ->setBody(
                $this->renderView(
                    'ContatoBundle:Templates:contato.html.twig',
                    array('form' => $this->get('request')->request->all())
                ), 'text/html'
            );

        $sendMail = $this->get('mailer')->send($message);

        if($sendMail):
            $this->get('session')->getFlashBag()->add('message', 'Mensagem enviada com sucesso! Logo entraremos em contato');
        else:
            $this->get('session')->getFlashBag()->add('message', 'Erro ao enviar email! Verifique seus dados e tente novamente');
        endif;

        return new RedirectResponse($this->generateUrl('contato_homepage'));
    }
}
