<?php

namespace SITE\TrabalheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('SITETrabalheBundle:Default:index.html.twig', array(
            'Messages' => $this->get('session')->getFlashBag()->get('message'),
            'Estados'  => $em->getRepository('CMS\ConfiguracoesBundle\Entity\Estado')->findAll()
        ));
    }


    public function sendAction(Request $request)
    {
        if($request->get('estado') == "")
        {
            $uf = 24;
        }
        else
        {
            $uf = $request->get('estado');
        }

        $em = $this->getDoctrine()->getManager();
        $Estado = $em->getRepository('CMS\ConfiguracoesBundle\Entity\Estado')->find($uf);

        $form = $this->get('request')->request;
        $body = '<strong>Nome: </strong>'. $form->get('nome').'<br />';
        $body .= '<strong>Email: </strong>'. $form->get('email').'<br />';
        $body .= '<strong>Telefone: </strong>'. $form->get('telefone').'<br />';
        $body .= '<strong>Nascimento: </strong>'. $form->get('datanasc').'<br />';
        $body .= '<strong>Sexo: </strong>'. $form->get('sexo').'<br />';
        $body .= '<strong>Estado: </strong>'. $Estado->getNome().'<br />';
        $body .= '<strong>Cidade: </strong>'. $form->get('cidade').'<br />';
        $body .= '<strong>Mensagem: </strong><br />'. nl2br($form->get('mensagem'));


        $from = array('no-reply@douattextil.com.br' => 'Contato douat');
        $to = array('weverson@taginterativa.com.br' => 'Weverson Cachinsky',  'camila@taginterativa.com.br' => 'Doutora Camila');

        $message = \Swift_Message::newInstance()
            ->setSubject('Douat | Trabalhe Conosco')
            ->setFrom($from)
            ->setTo($to)
            ->addReplyTo($form->get('email'))
            ->setBody($body, 'text/html');

        if(isset($_FILES['upload']['name']) && $_FILES['upload']['name'] != "")
        {
            $message->attach(\Swift_Attachment::fromPath($_FILES['upload']['tmp_name'])->setFilename($_FILES['upload']['name']));
        }


        $sendMail = $this->get('mailer')->send($message);

        if($sendMail):
            $this->get('session')->getFlashBag()->add('message', 'Mensagem enviada com sucesso! Logo entraremos em contato');
        else:
            $this->get('session')->getFlashBag()->add('message', 'Erro ao enviar email! Verifique seus dados e tente novamente');
        endif;

        return new RedirectResponse($this->generateUrl('site_trabalhe_homepage'));
    }


    public function ajaxAction($estado)
    {
        $em = $this->getDoctrine()->getManager();
        $Cidades = $em->getRepository('CMS\ConfiguracoesBundle\Entity\Cidade')->findByEstado($estado);

        $arr = array();

        foreach($Cidades as $Cidade)
        {
            $arr[] = array('nome' => $Cidade->getNome());
        }
        echo json_encode($arr);
        exit;
    }
}
