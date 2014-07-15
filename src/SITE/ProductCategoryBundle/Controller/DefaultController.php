<?php

namespace SITE\ProductCategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')
            ->findAll();

        return $this->render('ProductCategoryBundle:Default:index.html.twig', array(
            'Categories'        => $entity,
            'TituloCategoria'   => 'Malhas',
            'HeadImage'         => $entity[rand(0, (count($entity) - 1))]->getImage(),
            'Familias'          => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getFamilias(),
            'Acabamentos'       => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getAcabamentos(),
            'Cores'             => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getCores()
        ));
    }


    public function categoryAction($category_slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')
            ->findBySlug($category_slug);

        return $this->render('ProductCategoryBundle:Default:index.html.twig', array(
            'Categories'        => $entity,
            'TituloCategoria'   => $entity[0]->getName(),
            'HeadImage'         => $entity[0]->getImage(),
            'Familias'          => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getFamilias(),
            'Acabamentos'       => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getAcabamentos(),
            'Cores'             => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getCores()
        ));
    }

    public function buscaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')
            ->search($request);


        return $this->render('ProductCategoryBundle:Default:index.html.twig', array(
            'Categories'        => $entity,
            'TituloCategoria'   => 'Busca',
            'HeadImage'         => $entity[0]->getImage(),
            'Familias'          => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getFamilias(),
            'Acabamentos'       => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getAcabamentos(),
            'Cores'             => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getCores()
        ));
    }


    public function subsAction($category_id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getSubCategories($category_id);

        $_arr = array();
        foreach($entity as $Category)
        {
            $_arr[$Category->getId()] = $Category->getName();
        }

        echo json_encode($_arr);
        exit;
    }
}
