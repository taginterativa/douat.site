<?php

namespace CMS\ConfiguracoesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ConfiguracoesBundle\Entity\Estado;
use CMS\ConfiguracoesBundle\Form\EstadoType;
use CMS\ConfiguracoesBundle\Form\EstadoFilterType;

/**
 * Estado controller.
 *
 */
class EstadoController extends Controller
{

    /**
     * Lists all Estado entities.
     *
     */
    public function indexAction(Request $request)
    {
        $entity = new Estado();
        $form = $this->createFilterForm($entity);
        $dados = $request->query->get('cms_configuracoesbundle_estado');

        if($request->getMethod() == 'GET' && isset($dados['pais'])){
            $repository = $this->getDoctrine()
                ->getRepository('CMSConfiguracoesBundle:Estado');

            $query = $repository->createQueryBuilder('e')
                ->where('e.pais = '. $dados['pais'])
                ->getQuery();

            $entities = $query->getResult();
        }else{
            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('CMSConfiguracoesBundle:Estado')->findAll();
        }

        return $this->render('CMSConfiguracoesBundle:Estado:index.html.twig', array(
            'entities' => $entities,
            'form'   => $form->createView(),
            'error' => null
        ));
    }
    /**
     * Creates a new Estado entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Estado();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Estado');
            $this->get('session')->getFlashBag()->add('message', 'Novo Estado adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_estado_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSConfiguracoesBundle:Estado:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Estado entity.
    *
    * @param Estado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Estado $entity)
    {
        $form = $this->createForm(new EstadoType(), $entity, array(
            'action' => $this->generateUrl('cms_estado_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Creates a form to create a Estado entity.
     *
     * @param Estado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createFilterForm(Estado $entity)
    {
        $form = $this->createForm(new EstadoFilterType(), $entity, array(
            'action' => $this->generateUrl('cms_estado'),
            'method' => 'GET',
        ));

        $form->add('submit', 'submit', array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Estado entity.
     *
     */
    public function newAction()
    {
        $entity = new Estado();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSConfiguracoesBundle:Estado:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Estado entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Estado:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Estado entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estado entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Estado:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Estado entity.
    *
    * @param Estado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Estado $entity)
    {
        $form = $this->createForm(new EstadoType(), $entity, array(
            'action' => $this->generateUrl('cms_estado_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Estado entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Estado');
            $this->get('session')->getFlashBag()->add('message', 'Estado editado com sucesso');

            return $this->redirect($this->generateUrl('cms_estado_edit', array('id' => $id)));
        }

        return $this->render('CMSConfiguracoesBundle:Estado:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Estado entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSConfiguracoesBundle:Estado')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Estado entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Estado');
        $this->get('session')->getFlashBag()->add('message', 'Estado excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Estado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estado entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Estado');
            $this->get('session')->getFlashBag()->add('message', 'Estado excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_estado'));
    }

    /**
     * Creates a form to delete a Estado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_estado_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Estado entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Estado')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estado entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Estado');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Estado excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_estado'));
}}
