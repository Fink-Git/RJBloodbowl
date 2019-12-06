<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Saison;
use AppBundle\Form\SaisonType;
use Symfony\Component\HttpFoundation\Request;

class SaisonController extends Controller
{
    /**
     * @Route("Admin/Saison/new", name="newSaison")
     */
    public function newSaisonAction(Request $request)
    {
        $saison = new Saison();
        $form = $this->createForm(SaisonType::class, $saison);

        // on recupere la soumission de l'utilisateur
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // si le formulaire est valide on enregistre en base
            $saison = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($saison);
            $entityManager->flush();
        }

        return $this->render('RJBloodbowl/new_saison.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
