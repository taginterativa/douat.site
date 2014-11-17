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

    public function getCidadesAction(Request $request) {
        $estadoSigla = $request->request->get("uf");

        $em = $this->getDoctrine()->getManager();
        $cidades = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->getCidadesByUF($estadoSigla);
        return $this->render('SITERepresentantesBundle:Default:cidades.html.twig', array(
            'cidades' => $cidades,
        ));
    }

    public function getRepresentantesAction(Request $request) {
        $cidadeId = $request->request->get("id");

        $em = $this->getDoctrine()->getManager();
        $representantes = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->getRepresentantesByCidade($cidadeId);

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
