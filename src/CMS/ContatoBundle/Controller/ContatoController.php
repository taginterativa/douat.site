<?php

namespace CMS\ContatoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ContatoBundle\Entity\Contato;
use CMS\ContatoBundle\Form\ContatoType;

/**
 * Contato controller.
 *
 */
class ContatoController extends Controller
{

    /**
     * Lists all Contato entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSContatoBundle:Contato')->findAll();

        return $this->render('CMSContatoBundle:Contato:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Contato entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Contato();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Contato');
            $this->get('session')->getFlashBag()->add('message', 'Novo Contato adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_contato_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSContatoBundle:Contato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Contato entity.
    *
    * @param Contato $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Contato $entity)
    {
        $form = $this->createForm(new ContatoType(), $entity, array(
            'action' => $this->generateUrl('cms_contato_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Contato entity.
     *
     */
    public function newAction()
    {
        $entity = new Contato();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSContatoBundle:Contato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Contato entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSContatoBundle:Contato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contato entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSContatoBundle:Contato:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Contato entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSContatoBundle:Contato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contato entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSContatoBundle:Contato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Contato entity.
    *
    * @param Contato $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contato $entity)
    {
        $form = $this->createForm(new ContatoType(), $entity, array(
            'action' => $this->generateUrl('cms_contato_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Contato entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSContatoBundle:Contato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contato entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Contato');
            $this->get('session')->getFlashBag()->add('message', 'Contato editado com sucesso');

            return $this->redirect($this->generateUrl('cms_contato_edit', array('id' => $id)));
        }

        return $this->render('CMSContatoBundle:Contato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Contato entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSContatoBundle:Contato')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Contato entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Contato');
        $this->get('session')->getFlashBag()->add('message', 'Contato excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSContatoBundle:Contato')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contato entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Contato');
            $this->get('session')->getFlashBag()->add('message', 'Contato excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_contato'));
    }

    /**
     * Creates a form to delete a Contato entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_contato_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Contato entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSContatoBundle:Contato')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contato entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Contato');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Contato excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_contato'));
}}
