<?php

namespace CMS\CoresBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\CoresBundle\Entity\Color;
use CMS\CoresBundle\Form\ColorType;

/**
 * Color controller.
 *
 */
class ColorController extends Controller
{

    /**
     * Lists all Color entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSCoresBundle:Color')->findAll();

        return $this->render('CMSCoresBundle:Color:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Color entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Color();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Color');
            $this->get('session')->getFlashBag()->add('message', 'Novo Color adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_cores_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSCoresBundle:Color:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Color entity.
    *
    * @param Color $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Color $entity)
    {
        $form = $this->createForm(new ColorType(), $entity, array(
            'action' => $this->generateUrl('cms_cores_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Color entity.
     *
     */
    public function newAction()
    {
        $entity = new Color();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSCoresBundle:Color:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Color entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSCoresBundle:Color')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Color entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSCoresBundle:Color:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Color entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSCoresBundle:Color')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Color entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSCoresBundle:Color:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Color entity.
    *
    * @param Color $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Color $entity)
    {
        $form = $this->createForm(new ColorType(), $entity, array(
            'action' => $this->generateUrl('cms_cores_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Color entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSCoresBundle:Color')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Color entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Color');
            $this->get('session')->getFlashBag()->add('message', 'Color editado com sucesso');

            return $this->redirect($this->generateUrl('cms_cores_edit', array('id' => $id)));
        }

        return $this->render('CMSCoresBundle:Color:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Color entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSCoresBundle:Color')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Color entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Color');
        $this->get('session')->getFlashBag()->add('message', 'Color excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSCoresBundle:Color')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Color entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Color');
            $this->get('session')->getFlashBag()->add('message', 'Color excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_cores'));
    }

    /**
     * Creates a form to delete a Color entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_cores_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Color entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSCoresBundle:Color')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Color entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Color');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Color excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_cores'));
}}
