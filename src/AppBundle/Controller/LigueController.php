<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Journee;
use AppBundle\Entity\Rencontre;
use AppBundle\Entity\Saison;
use AppBundle\Form\InscriptionType;
use AppBundle\Form\MatchType;
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
            $this->redirectToRoute('affichageSaison', [
                'saisonid' => $saison->getId(),
                'action' => 'view'
                ]) ;
        }   

        return $this->render('RJBloodbowl/tirage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(
     *      "/Ligue/Affichage/{action}/{saisonid}", 
     *      name="affichageSaison",
     *      requirements={
     *          "action" : "view|input"
     *      }
     * )
     */
    public function matchSaisonAction($saisonid=null, $action, Request $request){
        /** @var Saison $saison */
        $saison = $this->saisonParDefaut($saisonid);

        $journees = $saison->getJournees();
        $tableaumatch = [];
        $matches = [];
        foreach ($journees as $journee) {
            /** @var Journee $journee */
            $rencontres = $journee->getRencontres();
            foreach ($rencontres as $rencontre) {
                $adversaires = [];
                /** @var Rencontre $rencontre */
                $adversaires[] = $rencontre->getCoach1()->getName();
                $adversaires[] = $rencontre->getCoach2()->getName();
                $adversaires[]=$rencontre->getEnregistre();
                $tableaumatch[$journee->getName()][$rencontre->getId()] = $adversaires;
            }
        }

        $form_view = null;
        if ($action == 'input'){
            $form = $this->createForm(MatchType::class, $tableaumatch);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()){
                /** @var Rencontre $match */
                $match = $this->getDoctrine()->getRepository('AppBundle:Rencontre')
                    ->find($form->get('match')->getData());
                
                $match->setScoreCoach1($form->get('score_coach1')->getData());
                $match->setScoreCoach2($form->get('score_coach2')->getData());
                $match->setSortiesCoach1($form->get('sorties_coach1')->getData());
                $match->setSortiesCoach2($form->get('sorties_coach2')->getData());
                $match->setEnregistre(true);
                $this->getDoctrine()->getManager()->flush();

                //TODO: message flash de confirmation d'enregistrement
                return $this->redirect($request->getUri());
            }
            $form_view = $form->createView();
        }

        return $this->render('RJBloodbowl/affichage.html.twig', [
            'saison' => $tableaumatch, 
            'action' => $action,
            'form' => $form_view,
            ]);
    }


    /**
     * Renvoie la saison demandé ou la derniere s'il n'y a pas parametres ou que le parametre est KO
     * 
     * @param int|null $saisonid id de la saison ou null
     * @return Saison $saison Objet Saison 
     */
    private function saisonParDefaut($saisonid){
        if (empty($saisonid) | !is_numeric($saisonid)){
            $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')->getDerniereSaison();
        }
        else{
            $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')->find($saisonid);
            if (empty($saison)){
                $saison = $this->getDoctrine()->getRepository('AppBundle:Saison')->getDerniereSaison();
            }
        }
        return $saison;
    }

    /**
     * @param Saison $saison Saison dans laquelle est créée la journée
     * @param int $poules Nombre de poules désirées pour la saison
     * @param int $qualif Nombre de jours pour la phase de qualif
     */
    private function creationJournees($saison, $poules, $qualif){
        //TODO : Gerer plusieurs poules et nombre de joueurs impairs
        //TODO: Faire un random sur les participants ?
        $participants = $saison->getParticipants();
        if(count($participants) < 2){
            return [];
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
            if (count($participants) % 2 === 1){
                // nb de participants impair, il faut en exclure un par journée
                // a chaque journee, ce doit etre une personne differente
            }

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
                    $rencontre->setCoach1($coach1);
                    // $rencontre->addCoach($coach1); 
                    // $coach1->addRencontre($rencontre);

                    $adversairetrouve = false;
                    foreach ($participants as $coach2) {
                        /** @var Coach $coach2 */
                        if (!$adversairetrouve &
                            $coach1 != $coach2 &
                            !$this->aJoue($coach2->getName(), $adversaires, $i) &
                            !$this->aRencontre($coach1->getName(), $adversaires, $coach2->getName())){
                            $rencontre->setCoach2($coach2);
                            // $rencontre->addCoach($coach2);
                            // $coach2->addRencontre($rencontre);

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
