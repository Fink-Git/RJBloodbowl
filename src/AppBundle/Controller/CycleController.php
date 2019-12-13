<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Cycle;
use AppBundle\Form\CycleType;
use Symfony\Component\HttpFoundation\Request;

class CycleController extends Controller
{
    /**
     * @Route("Admin/Cycle/new", name="newCycle")
     */
    public function newCycleAction(Request $request)
    {
        $cycle = new Cycle();
        $form = $this->createForm(CycleType::class, $cycle);

        // on recupere la soumission de l'utilisateur
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // si le formulaire est valide on enregistre en base
            $cycle = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cycle);
            $entityManager->flush();

            $this->addFlash('notice', 'Cycle créé');

            return $this->redirect($request->getUri());
        }

        return $this->render('RJBloodbowl/new_cycle.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
