<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Coach;
use AppBundle\Form\CoachType;
use Symfony\Component\HttpFoundation\Request;

class CoachController extends Controller
{
    /**
     * @Route("Admin/Coach/new", name="newCoach")
     */
    public function newCoachAction(Request $request)
    {
        $coach = new Coach();
        $form = $this->createForm(CoachType::class, $coach);

        // on recupere la soumission de l'utilisateur
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // si le formulaire est valide on enregistre en base
            $coach = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coach);
            $entityManager->flush();
        }

        return $this->render('RJBloodbowl/new_coach.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
