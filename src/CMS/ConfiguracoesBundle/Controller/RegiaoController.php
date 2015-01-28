<?php

namespace CMS\ConfiguracoesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ConfiguracoesBundle\Entity\Regiao;
use CMS\ConfiguracoesBundle\Form\RegiaoType;

/**
 * Regiao controller.
 *
 */
class RegiaoController extends Controller
{

    /**
     * Lists all Regiao entities.
     *
     */
    public function indexAction(Request $request) {
        $page    = ($request->get("p")?$request->get("p"):1);
        $numRows = ($request->get("n")?$request->get("n"):10);

        $repository = $this->getDoctrine()->getManager()->getRepository('CMSConfiguracoesBundle:Regiao');
        $count      = count($repository->findAll());
        $entities   = $repository->findBy(array(),array("id" => 'ASC'),$numRows, ($page-1)*$numRows);
        $totalPages = intval($count/$numRows) + ($count % $numRows > 0?1:0);

        return $this->render('CMSConfiguracoesBundle:Regiao:index.html.twig', array(
            'entities'   => $entities,
            'page'       => $page,
            'totalPages' => $totalPages,
            'error'      => null
        ));
    }
    /**
     * Creates a new Regiao entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Regiao();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Regiao');
            $this->get('session')->getFlashBag()->add('message', 'Novo Regiao adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_regiao_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSConfiguracoesBundle:Regiao:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Regiao entity.
    *
    * @param Regiao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Regiao $entity)
    {
        $form = $this->createForm(new RegiaoType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('cms_regiao_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Regiao entity.
     *
     */
    public function newAction()
    {
        $entity = new Regiao();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSConfiguracoesBundle:Regiao:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Regiao entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Regiao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Regiao:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Regiao entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Regiao entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Regiao:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Regiao entity.
    *
    * @param Regiao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Regiao $entity)
    {
        $form = $this->createForm(new RegiaoType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('cms_regiao_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Regiao entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Regiao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Regiao');
            $this->get('session')->getFlashBag()->add('message', 'Regiao editado com sucesso');

            return $this->redirect($this->generateUrl('cms_regiao_edit', array('id' => $id)));
        }

        return $this->render('CMSConfiguracoesBundle:Regiao:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Regiao entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Regiao entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Regiao');
        $this->get('session')->getFlashBag()->add('message', 'Regiao excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Regiao entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Regiao');
            $this->get('session')->getFlashBag()->add('message', 'Regiao excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_regiao'));
    }

    /**
     * Creates a form to delete a Regiao entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_regiao_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
    /**
     * Deletes a Regiao entity.
     *
     */
    public function deleteAllAction(Request $request)
    {
        $data_delete = $request->request->get('record');

        if($data_delete){
            foreach($data_delete as $data){
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($data);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Regiao entity.');
                }

                $em->remove($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('title', 'Regiao');
                $this->get('session')->getFlashBag()->add('message', 'Lista de Regiao excluidos com sucesso');
            }
        }
        return $this->redirect($this->generateUrl('cms_regiao'));
    }

    public function getCidadesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $estadoId = $request->get("estado")?$request->get("estado"):0;
        $regiaoId = $request->get("regiao")?$request->get("regiao"):0;

        $estado  = $em->getRepository('CMSConfiguracoesBundle:Estado')->find($estadoId);
        $cidades = $em->getRepository('CMSConfiguracoesBundle:Cidade')->findBy(array("estado" => $estado), array());
        $regiao  = $em->getRepository('CMSConfiguracoesBundle:Regiao')->find($regiaoId);

        $cidades_regiao = array();
        if($regiao) {
            foreach($regiao->getCidades() as $cidade) {
                $cidades_regiao[] = $cidade->getId();
            }
        }

        return $this->render('CMSConfiguracoesBundle:Regiao:getCidades.html.twig', array(
            "cidades" => $cidades,
            "regiao_cidades" => $cidades_regiao
        ));
    }
}
