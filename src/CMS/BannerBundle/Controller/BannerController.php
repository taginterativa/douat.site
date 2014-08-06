<?php

namespace CMS\BannerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\BannerBundle\Entity\Banner;
use CMS\BannerBundle\Form\BannerType;

/**
 * Banner controller.
 *
 */
class BannerController extends Controller
{

    /**
     * Lists all Banner entities.
     *
     */
    public function indexAction()
    {
        $em       = $this->getDoctrine()->getManager();
        $num_rows = count($em->getRepository('CMSBannerBundle:Banner')->findAll());
        $entities = $em->getRepository('CMSBannerBundle:Banner')->findBy(array(),array(),10);

        return $this->render('CMSBannerBundle:Banner:index.html.twig', array(
            'entities' => $entities,
            'error' => null,
            'page' => '1',
            'num_rows' => $num_rows
        ));
    }

    public function paginateAction($page)
    {
        $em       = $this->getDoctrine()->getManager();
        $num_rows = count($em->getRepository('CMSBannerBundle:Banner')->findAll());
        $entities = $em->getRepository('CMSBannerBundle:Banner')->findBy(array(),array(),10, ($page-1)*10);

        return $this->render('CMSBannerBundle:Banner:index.html.twig', array(
            'entities' => $entities,
            'error' => null,
            'page' => $page,
            'num_rows' => $num_rows
        ));
    }
    /**
     * Creates a new Banner entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Banner();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if(!is_null($form['image']->getData())) {
                $entity->upload();
            }

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Banner');
            $this->get('session')->getFlashBag()->add('message', 'Novo Banner adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_banner__edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSBannerBundle:Banner:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Banner entity.
    *
    * @param Banner $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Banner $entity)
    {
        $form = $this->createForm(new BannerType(), $entity, array(
            'action' => $this->generateUrl('cms_banner__create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Banner entity.
     *
     */
    public function newAction()
    {
        $entity = new Banner();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSBannerBundle:Banner:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Banner entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSBannerBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSBannerBundle:Banner:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Banner entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSBannerBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSBannerBundle:Banner:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Banner entity.
    *
    * @param Banner $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Banner $entity)
    {
        $form = $this->createForm(new BannerType(), $entity, array(
            'action' => $this->generateUrl('cms_banner__update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Banner entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSBannerBundle:Banner')->find($id);
        $image_file = $entity->getImage();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if(!is_null($editForm['image']->getData())) {
                $entity->upload();
                if(file_exists($image_file)) {
                    unlink($image_file);
                }
            } else {
                $entity->setImage($image_file);
            }

            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Banner');
            $this->get('session')->getFlashBag()->add('message', 'Banner editado com sucesso');

            return $this->redirect($this->generateUrl('cms_banner__edit', array('id' => $id)));
        }

        return $this->render('CMSBannerBundle:Banner:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Banner entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSBannerBundle:Banner')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Banner');
        $this->get('session')->getFlashBag()->add('message', 'Banner excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSBannerBundle:Banner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Banner entity.');
            }

            $image_file = $entity->getImage();

            $em->remove($entity);
            $em->flush();

            if(file_exists($image_file)) {
                unlink($image_file);
            }

            $this->get('session')->getFlashBag()->add('title', 'Banner');
            $this->get('session')->getFlashBag()->add('message', 'Banner excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_banner'));
    }

    /**
     * Creates a form to delete a Banner entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_banner__delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Banner entity.
*
    */
    public function deleteAllAction(Request $request)
    {
        $data_delete = $request->request->get('record');

        if($data_delete){
            foreach($data_delete as $data){
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('CMSBannerBundle:Banner')->find($data);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Banner entity.');
                }

                $image_file = $entity->getImage();

                $em->remove($entity);
                $em->flush();

                if(file_exists($image_file)) {
                    unlink($image_file);
                }

                $this->get('session')->getFlashBag()->add('title', 'Banner');
                $this->get('session')->getFlashBag()->add('message', 'Lista de Banner excluidos com sucesso');
            }
        }
        return $this->redirect($this->generateUrl('cms_banner'));
    }

}
