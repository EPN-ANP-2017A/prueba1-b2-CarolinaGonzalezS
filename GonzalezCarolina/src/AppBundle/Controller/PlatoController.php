<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cliente;
use AppBundle\Entity\Plato;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Plato controller.
 *
 * @Route("restaurante/plato")
 */
class PlatoController extends Controller
{

    /**
     * Lists all plato entities.
     *
     * @Route("/{id}", name="restaurante_plato_index")
     * @Method("GET")
     */
    public function indexAction(Cliente $cliente)
    {
        $em = $this->getDoctrine()->getManager();

        $platos = $em->getRepository('AppBundle:Plato')->findAll();

        return $this->render('plato/index.html.twig', array(
            'platos' => $platos,
            'cliente'=>$cliente
        ));
    }

    /**
     * Creates a new plato entity.
     *
     * @Route("/new", name="restaurante_plato_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plato = new Plato();
        $form = $this->createForm('AppBundle\Form\PlatoType', $plato);
        $form->remove('precio');
        $form->add('precio',NumberType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $valorNRe=$plato->getPrecio();
            $valorRe=round($valorNRe,2);
            $plato->setPrecio($valorRe);
            $em->persist($plato);
            $em->flush();

            return $this->redirectToRoute('restaurante_plato_show', array('id' => $plato->getId()));
        }

        return $this->render('plato/new.html.twig', array(
            'plato' => $plato,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plato entity.
     *
     * @Route("/{id}", name="restaurante_plato_show")
     * @Method("GET")
     */
    public function showAction(Plato $plato)
    {
        $deleteForm = $this->createDeleteForm($plato);

        return $this->render('plato/show.html.twig', array(
            'plato' => $plato,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plato entity.
     *
     * @Route("/{id}/edit", name="restaurante_plato_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plato $plato)
    {
        $deleteForm = $this->createDeleteForm($plato);
        $editForm = $this->createForm('AppBundle\Form\PlatoType', $plato);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('restaurante_plato_edit', array('id' => $plato->getId()));
        }

        return $this->render('plato/edit.html.twig', array(
            'plato' => $plato,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a plato entity.
     *
     * @Route("/{id}", name="restaurante_plato_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plato $plato)
    {
        $form = $this->createDeleteForm($plato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plato);
            $em->flush();
        }

        return $this->redirectToRoute('restaurante_plato_index');
    }

    /**
     * Creates a form to delete a plato entity.
     *
     * @param Plato $plato The plato entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plato $plato)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('restaurante_plato_delete', array('id' => $plato->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
