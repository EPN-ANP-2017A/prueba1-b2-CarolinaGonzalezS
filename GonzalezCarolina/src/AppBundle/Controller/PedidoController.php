<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pedido;
use AppBundle\Entity\Plato;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pedido controller.
 *
 * @Route("restaurante/pedido")
 */
class PedidoController extends Controller
{
    /**
     * Lists all pedido entities.
     *
     * @Route("/", name="restaurante_pedido_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pedidos = $em->getRepository('AppBundle:Pedido')->findAll();

        return $this->render('pedido/index.html.twig', array(
            'pedidos' => $pedidos,
        ));
    }

    /**
     * Creates a new pedido entity.
     *
     * @Route("/new/{id}", name="restaurante_pedido_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Plato $plato)
    {
        $pedido = new Pedido();
        $form = $this->createForm('AppBundle\Form\PedidoType', $pedido);
        $form->remove('cliente');
        $form->remove('plato');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pedido->setPlato($plato);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return $this->redirectToRoute('restaurante_pedido_show', array('id' => $pedido->getId()));
        }

        return $this->render('pedido/new.html.twig', array(
            'pedido' => $pedido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pedido entity.
     *
     * @Route("/{id}", name="restaurante_pedido_show")
     * @Method("GET")
     */
    public function showAction(Pedido $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);

        return $this->render('pedido/show.html.twig', array(
            'pedido' => $pedido,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pedido entity.
     *
     * @Route("/{id}/edit", name="restaurante_pedido_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pedido $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);
        $editForm = $this->createForm('AppBundle\Form\PedidoType', $pedido);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('restaurante_pedido_edit', array('id' => $pedido->getId()));
        }

        return $this->render('pedido/edit.html.twig', array(
            'pedido' => $pedido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pedido entity.
     *
     * @Route("/{id}", name="restaurante_pedido_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pedido $pedido)
    {
        $form = $this->createDeleteForm($pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pedido);
            $em->flush();
        }

        return $this->redirectToRoute('restaurante_pedido_index');
    }

    /**
     * Creates a form to delete a pedido entity.
     *
     * @param Pedido $pedido The pedido entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pedido $pedido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('restaurante_pedido_delete', array('id' => $pedido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
