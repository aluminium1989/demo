<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Req;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Req controller.
 *
 * @Route("req")
 */
class ReqController extends Controller
{
    /**
     * Lists all req entities.
     *
     * @Route("/", name="req_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reqs = $em->getRepository('AppBundle:Req')->findAll();

        return $this->render('req/index.html.twig', array(
            'reqs' => $reqs,
        ));
    }

    /**
     * Creates a new req entity.
     *
     * @Route("/new", name="req_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $req = new Req();
        $form = $this->createForm('AppBundle\Form\ReqType', $req);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $id = $this->getUser()->getId();

            $req->setCustomerId($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($req);
            $em->flush($req);

            return $this->redirectToRoute('req_show', array('id' => $req->getId()));
        }

        return $this->render('req/new.html.twig', array(
            'req' => $req,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a req entity.
     *
     * @Route("/{id}", name="req_show")
     * @Method("GET")
     */
    public function showAction(Req $req)
    {
        $deleteForm = $this->createDeleteForm($req);

        return $this->render('req/show.html.twig', array(
            'req' => $req,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing req entity.
     *
     * @Route("/{id}/edit", name="req_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Req $req)
    {
        $deleteForm = $this->createDeleteForm($req);
        $editForm = $this->createForm('AppBundle\Form\ReqType', $req);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('req_edit', array('id' => $req->getId()));
        }

        return $this->render('req/edit.html.twig', array(
            'req' => $req,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a req entity.
     *
     * @Route("/{id}", name="req_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Req $req)
    {
        $form = $this->createDeleteForm($req);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($req);
            $em->flush($req);
        }

        return $this->redirectToRoute('req_index');
    }

    /**
     * Creates a form to delete a req entity.
     *
     * @param Req $req The req entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Req $req)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('req_delete', array('id' => $req->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
