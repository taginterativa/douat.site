<?php

namespace CMS\ConfiguracoesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ConfiguracoesBundle\Entity\Pais;
use CMS\ConfiguracoesBundle\Form\PaisType;

/**
 * Pais controller.
 *
 */
class PaisController extends Controller
{

    /**
     * Lists all Pais entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSConfiguracoesBundle:Pais')->findAll();

        return $this->render('CMSConfiguracoesBundle:Pais:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Pais entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pais();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pais');
            $this->get('session')->getFlashBag()->add('message', 'Novo Pais adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_pais_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSConfiguracoesBundle:Pais:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Pais entity.
    *
    * @param Pais $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pais $entity)
    {
        $form = $this->createForm(new PaisType(), $entity, array(
            'action' => $this->generateUrl('cms_pais_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Pais entity.
     *
     */
    public function newAction()
    {
        $entity = new Pais();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSConfiguracoesBundle:Pais:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Pais entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Pais')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pais entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Pais:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Pais entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Pais')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pais entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Pais:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Pais entity.
    *
    * @param Pais $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pais $entity)
    {
        $form = $this->createForm(new PaisType(), $entity, array(
            'action' => $this->generateUrl('cms_pais_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Pais entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Pais')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pais entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pais');
            $this->get('session')->getFlashBag()->add('message', 'Pais editado com sucesso');

            return $this->redirect($this->generateUrl('cms_pais_edit', array('id' => $id)));
        }

        return $this->render('CMSConfiguracoesBundle:Pais:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pais entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSConfiguracoesBundle:Pais')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Pais entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Pais');
        $this->get('session')->getFlashBag()->add('message', 'Pais excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Pais')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pais entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pais');
            $this->get('session')->getFlashBag()->add('message', 'Pais excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_pais'));
    }

    /**
     * Creates a form to delete a Pais entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_pais_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Pais entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Pais')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pais entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Pais');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Pais excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_pais'));
}}
