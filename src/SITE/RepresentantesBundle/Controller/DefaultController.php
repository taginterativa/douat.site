<?php

namespace SITE\RepresentantesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->get('estado'))
        {
            $Representantes = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->search($request->get('estado'), $request->get('cidade'));
        }
        else
        {
            $Representantes = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->findAll();
        }

        if($request->get('estado'))
        {
            $Cidades = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->getCidadesByUF($request->get('estado'));
        }
        else
        {
            $Cidades = null;
        }

        return $this->render('SITERepresentantesBundle:Default:index.html.twig', array(
            'Representantes' => $Representantes,
            'Estados' => $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->getEstados(),
            'Cidades' => $Cidades,
            'estado'  => $em->getRepository('CMS\ConfiguracoesBundle\Entity\Estado')->findOneBySigla($request->get('estado')),
            'cidade'  => $request->get('cidade')
        ));
    }


    public function jsonAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->get('estado'))
        {
            $Representantes = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->search($request->get('estado'), $request->get('cidade'));
        }
        else
        {
            $Representantes = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->findAll();
        }

        $arr = array();

        foreach($Representantes as $Representante)
        {

            $arr[] = array(
                'id' => $Representante->getId(),
                'nome' => $Representante->getName(),
                'endereco' => $Representante->getAddress(),
                'cep'       => '',
                'bairro'   => $Representante->getBairro(),
                'cidade'    => $Representante->getCidade()->getNome(),
                'estado'    => $Representante->getEstado()->getNome(),
                'telefone'  => $Representante->getPhone(),
                'lng'       => $Representante->getLongitude(),
                'lat'       => $Representante->getLatitude(),
                'email'     => $Representante->getEmail(),
                'image'     => str_replace("app_dev.php", "", $request->getUriForPath('site/images/pin.png'))
            );
        }


        echo json_encode($arr);
        exit;
    }


    public function getCidadesAction($estado)
    {
        $em = $this->getDoctrine()->getManager();
        $Cidades = $em->getRepository('CMS\RepresentanteBundle\Entity\Representante')->getCidadesByUF($estado);

        $arr = array();

        foreach($Cidades as $Cidade)
        {
            $arr[] = array('nome' => $Cidade->getNome());
        }
        echo json_encode($arr);
        exit;
    }
}
