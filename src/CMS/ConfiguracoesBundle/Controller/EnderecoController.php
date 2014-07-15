<?php

namespace CMS\ConfiguracoesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ConfiguracoesBundle\Entity\Endereco;
use CMS\ConfiguracoesBundle\Form\EnderecoType;

/**
 * Endereco controller.
 *
 */
class EnderecoController extends Controller
{

    /**
     * Lists all Endereco entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSConfiguracoesBundle:Endereco')->findAll();

        return $this->render('CMSConfiguracoesBundle:Endereco:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Endereco entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Endereco();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Endereco');
            $this->get('session')->getFlashBag()->add('message', 'Novo Endereco adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_endereco_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSConfiguracoesBundle:Endereco:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Endereco entity.
    *
    * @param Endereco $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Endereco $entity)
    {
        $form = $this->createForm(new EnderecoType(), $entity, array(
            'action' => $this->generateUrl('cms_endereco_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Endereco entity.
     *
     */
    public function newAction()
    {
        $entity = new Endereco();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSConfiguracoesBundle:Endereco:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Endereco entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Endereco')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endereco entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Endereco:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Endereco entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Endereco')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endereco entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Endereco:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Endereco entity.
    *
    * @param Endereco $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Endereco $entity)
    {
        $form = $this->createForm(new EnderecoType(), $entity, array(
            'action' => $this->generateUrl('cms_endereco_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Endereco entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Endereco')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endereco entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Endereco');
            $this->get('session')->getFlashBag()->add('message', 'Endereco editado com sucesso');

            return $this->redirect($this->generateUrl('cms_endereco_edit', array('id' => $id)));
        }

        return $this->render('CMSConfiguracoesBundle:Endereco:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Endereco entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSConfiguracoesBundle:Endereco')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Endereco entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Endereco');
        $this->get('session')->getFlashBag()->add('message', 'Endereco excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Endereco')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Endereco entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Endereco');
            $this->get('session')->getFlashBag()->add('message', 'Endereco excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_endereco'));
    }

    /**
     * Creates a form to delete a Endereco entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_endereco_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Endereco entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Endereco')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Endereco entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Endereco');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Endereco excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_endereco'));
}}
