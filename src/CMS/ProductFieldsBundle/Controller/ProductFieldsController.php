<?php

namespace CMS\ProductFieldsBundle\Controller;

use CMS\ProductBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ProductFieldsBundle\Entity\ProductFields;
use CMS\ProductFieldsBundle\Form\ProductFieldsType;

/**
 * ProductFields controller.
 *
 */
class ProductFieldsController extends Controller
{

    /**
     * Lists all ProductFields entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSProductFieldsBundle:ProductFields')->findAll();

        return $this->render('CMSProductFieldsBundle:ProductFields:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new ProductFields entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductFields();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $uploaded_file = $form['image']->getData();
            if ($uploaded_file)
            {
                $picture = ProductType::processImage($uploaded_file, $entity);
                $entity->setImage('uploads/product/' . $picture);
            }


            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'ProductFields');
            $this->get('session')->getFlashBag()->add('message', 'Novo ProductFields adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_product_fields_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSProductFieldsBundle:ProductFields:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ProductFields entity.
    *
    * @param ProductFields $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ProductFields $entity)
    {
        $form = $this->createForm(new ProductFieldsType(), $entity, array(
            'action' => $this->generateUrl('cms_product_fields_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new ProductFields entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductFields();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSProductFieldsBundle:ProductFields:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a ProductFields entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductFieldsBundle:ProductFields')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductFields entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSProductFieldsBundle:ProductFields:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ProductFields entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductFieldsBundle:ProductFields')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductFields entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSProductFieldsBundle:ProductFields:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a ProductFields entity.
    *
    * @param ProductFields $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductFields $entity)
    {
        $form = $this->createForm(new ProductFieldsType(), $entity, array(
            'action' => $this->generateUrl('cms_product_fields_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing ProductFields entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSProductFieldsBundle:ProductFields')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductFields entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        $image_file = $entity->getImage();

        if ($editForm->isValid()) {

            $uploaded_file = $editForm['image']->getData();

            if ($uploaded_file && !is_null($uploaded_file))
            {
                if(file_exists($image_file)){
                    unlink($image_file);
                }

                $picture = ProductType::processImage($uploaded_file, $entity);
                $entity->setImage('uploads/product/' . $picture);
            }
            else
            {
                $entity->setImage($image_file);
            }

            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'ProductFields');
            $this->get('session')->getFlashBag()->add('message', 'ProductFields editado com sucesso');

            return $this->redirect($this->generateUrl('cms_product_fields_edit', array('id' => $id)));
        }

        return $this->render('CMSProductFieldsBundle:ProductFields:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductFields entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSProductFieldsBundle:ProductFields')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find ProductFields entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'ProductFields');
        $this->get('session')->getFlashBag()->add('message', 'ProductFields excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSProductFieldsBundle:ProductFields')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductFields entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'ProductFields');
            $this->get('session')->getFlashBag()->add('message', 'ProductFields excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_product_fields'));
    }

    /**
     * Creates a form to delete a ProductFields entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_product_fields_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a ProductFields entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSProductFieldsBundle:ProductFields')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductFields entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'ProductFields');
            $this->get('session')->getFlashBag()->add('message', 'Lista de ProductFields excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_product_fields'));
}}
