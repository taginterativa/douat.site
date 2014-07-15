<?php

namespace CMS\ConfiguracoesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\ConfiguracoesBundle\Entity\Cidade;
use CMS\ConfiguracoesBundle\Form\CidadeType;
use CMS\ConfiguracoesBundle\Form\CidadeFilterType;

/**
 * Cidade controller.
 *
 */
class CidadeController extends Controller
{

    /**
     * Lists all Cidade entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Cidade();
        $form = $this->createFilterForm($entity);
        $dados = $request->query->get('cms_configuracoesbundle_cidade');

        if($request->getMethod() == 'GET' && ((isset($dados['estado']) && !empty($dados['estado'])) || (isset($dados['nome']) && !empty($dados['nome'])))){
            $repository = $this->getDoctrine()
                ->getRepository('CMSConfiguracoesBundle:Cidade');

            $query = $repository->createQueryBuilder('c');

            if(isset($dados['estado']) && !empty($dados['estado'])):
                $query->andWhere("c.estado = '". $dados['estado']."'");
            endif;

            if(isset($dados['nome'])):
                $query->andWhere("c.nome like '%". $dados['nome']."%'");
            endif;

            $entities = $query->getQuery()->getResult();
        }else{
            $entities = null;
        }

        return $this->render('CMSConfiguracoesBundle:Cidade:index.html.twig', array(
            'entities' => $entities,
            'form'   => $form->createView(),
            'error' => null
        ));
    }
    /**
     * Creates a new Cidade entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Cidade();
        $form = $this->createCreateForm($entity);

        $entity->setImage("");
        $form->setData($entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $uploaded_file = $form['image']->getData();
            if ($uploaded_file)
            {
                $picture = CidadeType::processImage($uploaded_file, $entity);
                $entity->setImage('uploads/cidade/' . $picture);
            }

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Cidade');
            $this->get('session')->getFlashBag()->add('message', 'Novo Cidade adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_cidade_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSConfiguracoesBundle:Cidade:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Cidade entity.
    *
    * @param Cidade $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Cidade $entity)
    {
        $form = $this->createForm(new CidadeType(), $entity, array(
            'action' => $this->generateUrl('cms_cidade_create'),
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
    private function createFilterForm(Cidade $entity)
    {
        $form = $this->createForm(new CidadeFilterType(), $entity, array(
            'action' => $this->generateUrl('cms_cidade'),
            'method' => 'GET',
        ));

        $form->add('submit', 'submit', array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Cidade entity.
     *
     */
    public function newAction()
    {
        $entity = new Cidade();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSConfiguracoesBundle:Cidade:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Cidade entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Cidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidade entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Cidade:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Cidade entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Cidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidade entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSConfiguracoesBundle:Cidade:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Cidade entity.
    *
    * @param Cidade $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cidade $entity)
    {
        $form = $this->createForm(new CidadeType(), $entity, array(
            'action' => $this->generateUrl('cms_cidade_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Cidade entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSConfiguracoesBundle:Cidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidade entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        $editForm->setData($entity);

        $image_file = $entity->getImage();

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $uploaded_file = $editForm['image']->getData();
            if ($uploaded_file && !is_null($uploaded_file))
            {
                if(file_exists($image_file)){
                    unlink($image_file);
                }

                $picture = CidadeType::processImage($uploaded_file, $entity);
                $entity->setImage('uploads/cidade/' . $picture);
            }else{
                $entity->setImage($image_file);
            }

            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Cidade');
            $this->get('session')->getFlashBag()->add('message', 'Cidade editado com sucesso');

            return $this->redirect($this->generateUrl('cms_cidade_edit', array('id' => $id)));
        }

        return $this->render('CMSConfiguracoesBundle:Cidade:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cidade entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSConfiguracoesBundle:Cidade')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Cidade entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Cidade');
        $this->get('session')->getFlashBag()->add('message', 'Cidade excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Cidade')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cidade entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Cidade');
            $this->get('session')->getFlashBag()->add('message', 'Cidade excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_cidade'));
    }

    /**
     * Creates a form to delete a Cidade entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_cidade_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Cidade entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSConfiguracoesBundle:Cidade')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cidade entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Cidade');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Cidade excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_cidade'));
}}
