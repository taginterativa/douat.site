<?php

namespace CMS\RepresentanteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMS\RepresentanteBundle\Entity\Representante;
use CMS\RepresentanteBundle\Form\RepresentanteType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Representante controller.
 *
 */
class RepresentanteController extends Controller
{

    public function ajaxAction(Request $request)
    {
        if (! $request->isXmlHttpRequest()) {
            throw new NotFoundHttpException();
        }

        // Get the province ID
        $id = $request->query->get('estado_id');

        $result = array();

        // Return a list of cities, based on the selected province
        $repo = $this->getDoctrine()->getManager()->getRepository('CMSConfiguracoesBundle:Cidade');
        $cities = $repo->findByEstado($id, array('nome' => 'asc'));
        foreach ($cities as $city) {
            $result[$city->getNome()] = $city->getId();
        }

        return new JsonResponse($result);
    }

    /**
     * Lists all Representante entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSRepresentanteBundle:Representante')->findAll();

        return $this->render('CMSRepresentanteBundle:Representante:index.html.twig', array(
            'entities' => $entities,
            'error' => null
        ));
    }
    /**
     * Creates a new Representante entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Representante();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->setLatitudeLongitude($this->getLatitudeLongitude($em));
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Representante');
            $this->get('session')->getFlashBag()->add('message', 'Novo Representante adicionado com sucesso');

            return $this->redirect($this->generateUrl('cms_representantes_edit', array('id' => $entity->getId())));
        }

        return $this->render('CMSRepresentanteBundle:Representante:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Representante entity.
    *
    * @param Representante $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Representante $entity)
    {
        $form = $this->createForm(new RepresentanteType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('cms_representantes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Representante entity.
     *
     */
    public function newAction()
    {
        $entity = new Representante();
        $form   = $this->createCreateForm($entity);

        return $this->render('CMSRepresentanteBundle:Representante:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => null
        ));
    }

    /**
     * Finds and displays a Representante entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSRepresentanteBundle:Representante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Representante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSRepresentanteBundle:Representante:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Representante entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSRepresentanteBundle:Representante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Representante entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CMSRepresentanteBundle:Representante:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error' => null
        ));
    }

    /**
    * Creates a form to edit a Representante entity.
    *
    * @param Representante $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Representante $entity)
    {
        $form = $this->createForm(new RepresentanteType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('cms_representantes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Representante entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSRepresentanteBundle:Representante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Representante entity.');
        }

        $entity->setLatitudeLongitude($this->getLatitudeLongitude($entity));

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Representante');
            $this->get('session')->getFlashBag()->add('message', 'Representante editado com sucesso');

            return $this->redirect($this->generateUrl('cms_representantes_edit', array('id' => $id)));
        }

        return $this->render('CMSRepresentanteBundle:Representante:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Representante entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    if($request->getMethod() == 'GET'){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSRepresentanteBundle:Representante')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('Unable to find Representante entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('title', 'Representante');
        $this->get('session')->getFlashBag()->add('message', 'Representante excluido com sucesso');
    }else{
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSRepresentanteBundle:Representante')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Representante entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Representante');
            $this->get('session')->getFlashBag()->add('message', 'Representante excluido com sucesso');
        }
    }


        return $this->redirect($this->generateUrl('cms_representantes'));
    }

    /**
     * Creates a form to delete a Representante entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array ( 'attr' => array ( 'id' => 'delete_record' ) ) )
            ->setAction($this->generateUrl('cms_representantes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir', 'attr' => array('class' => 'btn btn-danger delete')))
            ->getForm()
        ;
    }
/**
    * Deletes a Representante entity.
*
    */
    public function deleteAllAction(Request $request)
{
    $data_delete = $request->request->get('record');

    if($data_delete){
        foreach($data_delete as $data){
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSRepresentanteBundle:Representante')->find($data);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Representante entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('title', 'Representante');
            $this->get('session')->getFlashBag()->add('message', 'Lista de Representante excluidos com sucesso');
        }
    }


    return $this->redirect($this->generateUrl('cms_representantes'));
}

    public function getLatitudeLongitude($entity)
    {
        $url = sprintf("http://maps.googleapis.com/maps/api/geocode/json?address=%s,%s,%s&sensor=true",
            ($entity->getAddress()),
            ($entity->getCidade()->getNome()),
            ($entity->getEstado()->getNome()));


        $url = str_replace(' ' , '+', $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $geoloc = json_decode(curl_exec($ch), true);

        return $geoloc['results'][0]['geometry']['location'];
    }


}
