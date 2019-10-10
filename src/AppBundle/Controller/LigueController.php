<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Journee;
use AppBundle\Entity\Rencontre;
use AppBundle\Entity\Saison;
use AppBundle\Form\InscriptionType;
use AppBundle\Form\TirageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class LigueController extends Controller
{
    /**
     * @Route("/Ligue/Inscription", name="inscription")
     */
    public function InscriptionAction(Request $request){
        $form = $this->createForm(InscriptionType::class);

        // on recupere la soumission de l'utilisateur
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

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
     * @Route("/Ligue/Tirage", name="tirage")
     */
    public function tirageAction(Request $request){
        $form = $this->createForm(TirageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var Saison $saison */
            $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')
                ->find($form->get('saison')->getData());

            $this->creationJournees($saison, 
                                    $form->get('nbPoule')->getData(),
                                    $form->get('nbQualif')->getData());

            // redirection pour l'affichage des journees
            $this->redirectToRoute('affichageSaison', ['saisonid' => $saison->getId()]) ;
        }   

        return $this->render('RJBloodbowl/tirage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Ligue/Affichage/{saisonid}", name="affichageSaison")
     */
    public function matchSaisonAction($saisonid=null){
        /** @var Saison $saison */
        $saison = null;
        if (empty($saisonid) | !is_numeric($saisonid)){
            $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')->getDerniereSaison();
        }
        else{
            $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')->find($saisonid);
            if (empty($saison)){
                $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')->getDerniereSaison();
            }
        }
        $journees = $saison->getJournees();
        $tableaumatch = [];
        foreach ($journees as $journee) {
            /** @var Journee $journee */
            $rencontres = $journee->getRencontres();
            foreach ($rencontres as $rencontre) {
                /** @var Rencontre $rencontre */
                $coachs = $rencontre->getCoachs();
                $adversaires = [];
                foreach ($coachs as $coach) {
                    /** @var Coach $coach */
                    $adversaires[] = $coach->getName();
                }
                $tableaumatch[$journee->getName()][] = $adversaires;
            }
        }

        return $this->render('RJBloodbowl/affichage.html.twig', ['saison' => $tableaumatch]);
    }

    /**
     * @param Saison $saison Saison dans laquelle est créée la journée
     * @param int $poules Nombre de poules désirées pour la saison
     * @param int $qualif Nombre de jours pour la phase de qualif
     */
    private function creationJournees($saison, $poules, $qualif){
        //TODO : Gerer plusieurs poules
        $participants = $saison->getParticipants();
        if(count($participants) < 2){
            return [];
        }

        if (count($participants) % 2 === 1){
            // nb de participants impair, il faut en exclure un par journée
        }

        if (empty($qualif)){
            $qualif = count($participants) - 1;
        }

        $entityManager = $this->getDoctrine()->getManager();
        // creation des adversaires rencontrés pour chaque joueur
        $adversaires = [];
        foreach ($participants as $partipant) {
            $adversaires[$partipant->getName()] = [];
        }

        // creation de toutes les journees de la saison
        // et des rencontres associes
        for ($i=1; $i <= $qualif; $i++) { 
            // creation de la journee
            $journee = new Journee();
            $entityManager->persist($journee);
            $journee->setName('J'.$i);
            $journee->setSaison($saison);

            foreach ($participants as $coach1) {
                /** @var Coach $coach1 */
                if (!$this->aJoue($coach1->getName(), $adversaires, $i)){
                    $rencontre = new Rencontre();
                    $entityManager->persist($rencontre);                  
                    $rencontre->setJournee($journee);
                    $rencontre->addCoach($coach1); 
                    $coach1->addRencontre($rencontre);

                    $adversairetrouve = false;
                    foreach ($participants as $coach2) {
                        /** @var Coach $coach2 */
                        if (!$adversairetrouve &
                            $coach1 != $coach2 &
                            !$this->aJoue($coach2->getName(), $adversaires, $i) &
                            !$this->aRencontre($coach1->getName(), $adversaires, $coach2->getName())){
                            $rencontre->addCoach($coach2);
                            $coach2->addRencontre($rencontre);

                            $adversaires[$coach1->getName()][$i] = $coach2->getName();
                            $adversaires[$coach2->getname()][$i] = $coach1->getName();
                            $adversairetrouve = true;
                        }
                    }
                    $journee->addRencontre($rencontre);
                    $entityManager->flush();
                }
            }
        }
    }

    /**
     * @param string $participant nom du participant
     * @param Array $adversaires tableau des rencontres deja déterminées
     * @param int $numJournee numero de la journée en cours
     * @return bool $ajoue booleen indiquant si le participant a joue une rencontre durant 
     *                      la journée desirée
     */
    private function aJoue($participant, $adversaires, $numJournee){
        $ajoue = false;
        if (!empty($adversaires[$participant][$numJournee])){
            $ajoue = true;
        }
        return $ajoue;
    }

    /**
     * @param string $participant nom du participant
     * @param Array $adversaires tableau des rencontres deja déterminées
     * @param string $affronte adversaire du participant
     * @return bool $arencontre booleen indiquant si le participant a deja rencontre son 
     *                          adversaire
     */
    private function aRencontre($participant, $adversaires, $affronte){
        $arencontre = false;
        if (in_array($affronte, array_values($adversaires[$participant]))){
            $arencontre = true;
        }
        return $arencontre;
    }

}
