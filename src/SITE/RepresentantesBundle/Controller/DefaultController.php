<?php

namespace SITE\RepresentantesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $estados = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->getEstados();
        return $this->render('SITERepresentantesBundle:Default:index.html.twig', array(
            'estados' => $estados,
        ));
    }

    public function getRegioesAction(Request $request) {
        $estadoSigla = $request->request->get("uf");
        $em = $this->getDoctrine()->getManager();

        $estado = $em->getRepository('CMSConfiguracoesBundle:Estado')->findOneBy(array("sigla" => $estadoSigla));
        if($estado)
            $regioes = $em->getRepository('CMSConfiguracoesBundle:Regiao')->findBy(array("estado" => $estado));
        else
            $regioes = array();

        return $this->render('SITERepresentantesBundle:Default:regioes.html.twig', array(
            'regioes' => $regioes,
        ));
    }

    public function getRepresentantesAction(Request $request) {
        $regiaoId = $request->get("id");

        $em = $this->getDoctrine()->getManager();
        $regiao = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($regiaoId);
        $representantes = $em->getRepository('CMSRepresentanteBundle:Representante')->getRepresentantesByCidades($regiao->getCidades());

        return $this->render('SITERepresentantesBundle:Default:representantes.html.twig', array(
            'representantes' => $representantes,
        ));

    }

    public function js_ajaxAction() {
        $response = $this->render('SITERepresentantesBundle:Default:ajax.js.twig', array());
        $response->headers->set('Content-Type', 'text/javascript; charset=UTF-8');

        return $response;
    }
}
