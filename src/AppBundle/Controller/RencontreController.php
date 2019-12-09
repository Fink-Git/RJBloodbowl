<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Rencontre;

class RencontreController extends Controller
{
    /**
     * @Route(
     *  "/Rencontre/info",
     *  name="infoRencontre", 
     *  methods={"POST"}
     * )
     */
    public function infoAction(Request $request)
    {
        $return = array('error' => true);
        if ($request->isXmlHttpRequest()){
            $id = $request->request->get('idrencontre');

            if (!empty($id)){
                $match = $this->getDoctrine()->getRepository('AppBundle:Rencontre')->find($id);
                if (!empty($match)){
                    $return['error'] = false;
                    $rencontre = [];
                    $rencontre['coach1'] = $match->getCoach1()->getName();
                    $rencontre['coach2'] = $match->getCoach2()->getName();
                    $rencontre['scorecoach1'] = $match->getScoreCoach1();
                    $rencontre['scorecoach2'] = $match->getScoreCoach2();
                    $rencontre['sortiescoach1'] = $match->getSortiesCoach1();
                    $rencontre['sortiescoach2'] = $match->getSortiesCoach2();
                    $return['rencontre'] = $rencontre;
                }
            }
        }
        $reponse = new Response(json_encode($return));
        $reponse->headers->set('Content-Type', 'application/json');
        return $reponse;
    }

}
