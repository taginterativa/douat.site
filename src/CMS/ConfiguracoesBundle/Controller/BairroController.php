<?php

namespace CMS\ConfiguracoesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ConfiguracoesBundle\Entity\Bairro;
use CMS\ConfiguracoesBundle\Form\BairroType;

/**
 * Bairro controller.
 *
 */
class BairroController extends Controller
{

    /**
     * Lists all Bairro entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSConfiguracoesBundle:Bairro')->findAll();

        return $this->render('CMSConfiguracoesBundle:Bairro:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Bairro entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Bairro();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Bairro');
            $this->get('session')->getFlashBag()->add('message', 'Novo Bairro adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_bairro_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSConfiguracoesBundle:Bairro:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Bairro entity.
    *
    * @param Bairro $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Bairro $entity)
    {
        $form = $this->createForm(new BairroType(), $entity, array(
            'action' => $this->generateUrl('cms_bairro_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Bairro entity.
     *
     */
    public function newAction()
    {
        $entity = new Bairro();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSConfiguracoesBundle:Bairro:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Bairro entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Bairro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bairro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Bairro:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Bairro entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Bairro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bairro entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Bairro:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Bairro entity.
    *
    * @param Bairro $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bairro $entity)
    {
        $form = $this->createForm(new BairroType(), $entity, array(
            'action' => $this->generateUrl('cms_bairro_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Bairro entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Bairro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bairro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Bairro');
            $this->get('session')->getFlashBag()->add('message', 'Bairro editado com sucesso');

            return $this->redirect($this->generateUrl('cms_bairro_edit', array('id' => $id)));
        }

        return $this->render('CMSConfiguracoesBundle:Bairro:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Bairro entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSConfiguracoesBundle:Bairro')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Bairro entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Bairro');
        $this->get('session')->getFlashBag()->add('message', 'Bairro excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Bairro')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bairro entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Bairro');
            $this->get('session')->getFlashBag()->add('message', 'Bairro excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_bairro'));
    }

    /**
     * Creates a form to delete a Bairro entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_bairro_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Bairro entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Bairro')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bairro entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Bairro');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Bairro excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_bairro'));
}}
