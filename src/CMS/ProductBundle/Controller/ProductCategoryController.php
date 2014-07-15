<?php

namespace CMS\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ProductBundle\Entity\ProductCategory;
use CMS\ProductBundle\Form\ProductCategoryType;

/**
 * ProductCategory controller.
 *
 */
class ProductCategoryController extends Controller
{

    /**
     * Lists all ProductCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSProductBundle:ProductCategory')->findAll();

        return $this->render('CMSProductBundle:ProductCategory:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new ProductCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductCategory();
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

            $this->get('session')->getFlashBag()->add('title', 'ProductCategory');
            $this->get('session')->getFlashBag()->add('message', 'Novo ProductCategory adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_produtos_categorias_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSProductBundle:ProductCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ProductCategory entity.
    *
    * @param ProductCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ProductCategory $entity)
    {
        $form = $this->createForm(new ProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('cms_produtos_categorias_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new ProductCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductCategory();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSProductBundle:ProductCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a ProductCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSProductBundle:ProductCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ProductCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSProductBundle:ProductCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a ProductCategory entity.
    *
    * @param ProductCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductCategory $entity)
    {
        $form = $this->createForm(new ProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('cms_produtos_categorias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing ProductCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $image_file = $entity->getImage();

        $deleteForm = $this->createDeleteForm($id);
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

            $this->get('session')->getFlashBag()->add('title', 'ProductCategory');
            $this->get('session')->getFlashBag()->add('message', 'ProductCategory editado com sucesso');

            return $this->redirect($this->generateUrl('cms_produtos_categorias_edit', array('id' => $id)));
        }

        return $this->render('CMSProductBundle:ProductCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSProductBundle:ProductCategory')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'ProductCategory');
        $this->get('session')->getFlashBag()->add('message', 'ProductCategory excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSProductBundle:ProductCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductCategory entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'ProductCategory');
            $this->get('session')->getFlashBag()->add('message', 'ProductCategory excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_produtos_categorias'));
    }

    /**
     * Creates a form to delete a ProductCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_produtos_categorias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a ProductCategory entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSProductBundle:ProductCategory')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductCategory entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'ProductCategory');
            $this->get('session')->getFlashBag()->add('message', 'Lista de ProductCategory excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_produtos_categorias'));
}}
