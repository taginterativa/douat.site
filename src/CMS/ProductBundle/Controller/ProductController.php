<?php

namespace CMS\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Tools\Pagination\Paginator;

use CMS\ProductBundle\Entity\Product;
use CMS\ProductBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

    public function paginationajaxAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            //return false;
        }
        $page = $request->get('draw') != "" ? $request->get('draw') : 1;
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT COUNT(p) as total FROM CMSProductBundle:Product p";

        $query = $em->createQuery($dql)->getResult();
        $count = $query[0]['total'];

        $dql = "SELECT p FROM CMSProductBundle:Product p";


        if($request->get('search'))
        {
            //$search = $request->get('search');
            //$dql .= " WHERE p.name LIKE '%" . $search['value'] . "%'";
        }

        $query = $em->createQuery($dql)->setFirstResult(($page-1)*10)
            ->setMaxResults(10);

        $entities = new Paginator($query, $fetchJoinCollection = true);
        $Data = array(
            'data' => array(),
            'draw' => $page,
            'recordsTotal' => $count,
            'recordsFiltered' => count($entities)
        );

        foreach($entities as $Entity)
        {
            $Data['data'][] = array(
                $Entity->getId(),
                $Entity->getId(),
                $Entity->getName(),
                $Entity->getCreatedAt()->format('dmy'),
                $Entity->getUpdatedAt()->format('dmy'),
                $Entity->getIsActive(),
                $Entity->getId()
            );
        }

        return new Response(json_encode($Data));
    }


    /**
     * Lists all Product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSProductBundle:Product')->findAll();

        return $this->render('CMSProductBundle:Product:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Product entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Product();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if(!is_null($form['image']->getData()))
            {
                $entity->upload();
            }
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Product');
            $this->get('session')->getFlashBag()->add('message', 'Novo Product adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_produtos_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSProductBundle:Product:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Product entity.
    *
    * @param Product $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('cms_produtos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     *
     */
    public function newAction()
    {
        $entity = new Product();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSProductBundle:Product:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSProductBundle:Product:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSProductBundle:Product:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Product entity.
    *
    * @param Product $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('cms_produtos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Product entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductBundle:Product')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        $image_file = $entity->getImage();

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        if ($editForm->isValid()) {

            if(!is_null($editForm['image']->getData()))
            {
                $entity->upload();
            }
            else
            {
                $entity->setImage($image_file);
            }
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Product');
            $this->get('session')->getFlashBag()->add('message', 'Product editado com sucesso');

            return $this->redirect($this->generateUrl('cms_produtos_edit', array('id' => $id)));
        }

        return $this->render('CMSProductBundle:Product:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSProductBundle:Product')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Product');
        $this->get('session')->getFlashBag()->add('message', 'Product excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSProductBundle:Product')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Product');
            $this->get('session')->getFlashBag()->add('message', 'Product excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_produtos'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_produtos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Product entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSProductBundle:Product')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Product');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Product excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_produtos'));
}}
