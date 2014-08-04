<?php

namespace CMS\PageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\PageBundle\Entity\Paginas;
use CMS\PageBundle\Form\PaginasType;

/**
 * Paginas controller.
 *
 */
class PaginasController extends Controller
{

    /**
     * Lists all Paginas entities.
     *
     */
    public function indexAction()
    {
        $em       = $this->getDoctrine()->getManager();
        $num_rows = count($em->getRepository('CMSPageBundle:Paginas')->findAll());
        $entities = $em->getRepository('CMSPageBundle:Paginas')->findBy(array(),array(),10);

        return $this->render('CMSPageBundle:Paginas:index.html.twig', array(
            'entities' => $entities,
            'error' => null,
            'page' => '1',
            'num_rows' => $num_rows
        ));
    }

    public function paginateAction($page)
    {
        $em       = $this->getDoctrine()->getManager();
        $num_rows = count($em->getRepository('CMSPageBundle:Paginas')->findAll());
        $entities = $em->getRepository('CMSPageBundle:Paginas')->findBy(array(),array(),10, ($page-1)*10);

        return $this->render('CMSPageBundle:Paginas:index.html.twig', array(
            'entities' => $entities,
            'error' => null,
            'page' => $page,
            'num_rows' => $num_rows
        ));
    }
    /**
     * Creates a new Paginas entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Paginas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            if(!is_null($form['imagem']->getData())) {
                $entity->upload();
            }

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Paginas');
            $this->get('session')->getFlashBag()->add('message', 'Novo Paginas adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_paginas_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSPageBundle:Paginas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Paginas entity.
    *
    * @param Paginas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Paginas $entity)
    {
        $form = $this->createForm(new PaginasType(), $entity, array(
            'action' => $this->generateUrl('cms_paginas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Finds and displays a Paginas entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSPageBundle:Paginas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paginas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSPageBundle:Paginas:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Paginas entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSPageBundle:Paginas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paginas entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSPageBundle:Paginas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Paginas entity.
    *
    * @param Paginas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Paginas $entity)
    {
        $form = $this->createForm(new PaginasType(), $entity, array(
            'action' => $this->generateUrl('cms_paginas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Paginas entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSPageBundle:Paginas')->find($id);
        $image_file = $entity->getImagem();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paginas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if(!is_null($editForm['imagem']->getData())) {
                $entity->upload();
            } else {
                $entity->setImagem($image_file);
            }

            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Paginas');
            $this->get('session')->getFlashBag()->add('message', 'Paginas editado com sucesso');

            return $this->redirect($this->generateUrl('cms_paginas_edit', array('id' => $id)));
        }

        return $this->render('CMSPageBundle:Paginas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Paginas entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSPageBundle:Paginas')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Paginas entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Paginas');
        $this->get('session')->getFlashBag()->add('message', 'Paginas excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSPageBundle:Paginas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paginas entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Paginas');
            $this->get('session')->getFlashBag()->add('message', 'Paginas excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_paginas'));
    }

    /**
     * Creates a form to delete a Paginas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_paginas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Paginas entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSPageBundle:Paginas')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paginas entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Paginas');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Paginas excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_paginas'));
}}
