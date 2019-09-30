<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Saison;
use AppBundle\Form\InscriptionType;
use AppBundle\Form\TirageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class LigueController extends Controller
{
    /**
     * @Route("/Inscription", name="inscription")
     */
    public function InscriptionAction(Request $request)
    {
        $form = $this->createForm(InscriptionType::class);

        // on recupere la soumission de l'utilisateur
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // si le formulaire est valide on enregistre en base
            // $inscription = $form->getData();

            /** 
             * @var Coach $coach 
             */
            $coach = $this->getDoctrine()->getRepository('AppBundle:Coach')
                ->find($form->get('coach')->getData());
            /** 
             * @var Saison $saison 
             */    
            $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')
                ->find($form->get('saison')->getData());

            $coach->addSaison($saison);
            $saison->addParticipant($coach);
            $this->getDoctrine()->getManager()->flush();
            
        }

        return $this->render('RJBloodbowl/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Tirage", name="tirage")
     */
    public function tirageAction(Request $request){
        $form = $this->createForm(TirageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var Saison $saison */
            $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')
                ->find($form->get('saison')->getData());
            $participants = $saison->getParticipants();


            $this->creationJournees($participants, 
                                    $form->get('nbPoule')->getData(),
                                    $form->get('nbQualif')->getData());
        }   

        return $this->render('RJBloodbowl/tirage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @var ArrayCollection $participants
     * @var int $poules
     * @var int $qualif
     */
    private function creationJournees($participants, $poules, $qualif){
        // le nombre de participants / par le nb de poules doit etre supérieur au nombre jours
        // de la phase de qualif
        if (($participants->count()/$poules) > $qualif){
            
        }
    }

}
