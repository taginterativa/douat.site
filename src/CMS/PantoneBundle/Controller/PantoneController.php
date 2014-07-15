<?php

namespace CMS\PantoneBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\PantoneBundle\Entity\Pantone;
use CMS\PantoneBundle\Form\PantoneType;

/**
 * Pantone controller.
 *
 */
class PantoneController extends Controller
{

    /**
     * Lists all Pantone entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSPantoneBundle:Pantone')->findAll();

        return $this->render('CMSPantoneBundle:Pantone:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Pantone entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pantone();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pantone');
            $this->get('session')->getFlashBag()->add('message', 'Novo Pantone adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_pantone_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSPantoneBundle:Pantone:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Pantone entity.
    *
    * @param Pantone $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pantone $entity)
    {
        $form = $this->createForm(new PantoneType(), $entity, array(
            'action' => $this->generateUrl('cms_pantone_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Pantone entity.
     *
     */
    public function newAction()
    {
        $entity = new Pantone();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSPantoneBundle:Pantone:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Pantone entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSPantoneBundle:Pantone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSPantoneBundle:Pantone:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Pantone entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSPantoneBundle:Pantone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantone entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSPantoneBundle:Pantone:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Pantone entity.
    *
    * @param Pantone $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pantone $entity)
    {
        $form = $this->createForm(new PantoneType(), $entity, array(
            'action' => $this->generateUrl('cms_pantone_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Pantone entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSPantoneBundle:Pantone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pantone');
            $this->get('session')->getFlashBag()->add('message', 'Pantone editado com sucesso');

            return $this->redirect($this->generateUrl('cms_pantone_edit', array('id' => $id)));
        }

        return $this->render('CMSPantoneBundle:Pantone:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pantone entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSPantoneBundle:Pantone')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Pantone entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Pantone');
        $this->get('session')->getFlashBag()->add('message', 'Pantone excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSPantoneBundle:Pantone')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pantone entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pantone');
            $this->get('session')->getFlashBag()->add('message', 'Pantone excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_pantone'));
    }

    /**
     * Creates a form to delete a Pantone entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_pantone_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Pantone entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSPantoneBundle:Pantone')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pantone entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pantone');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Pantone excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_pantone'));
}}
