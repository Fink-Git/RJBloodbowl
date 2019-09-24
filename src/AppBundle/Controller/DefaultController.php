<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Cycle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    // src/AppBundle/Controller/DefaultController.php



    public function createAction()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $cycle = new Cycle();
        $cycle->setName('');

        // tells Doctrine you want to (eventually) save the Cycle (no queries yet)
        $entityManager->persist($cycle);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new cycle with id '.$cycle->getId());
    }

    // if you have multiple entity managers, use the registry to fetch them
    public function editAction()
    {
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();
        $otherEntityManager = $doctrine->getManager('other_connection');
    }

    public function showAction($cycleId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($cycleId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$cycleId
            );
        }

        // ... do something, like pass the $product object into a template
    }

    public function updateAction($cycleId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cycle = $entityManager->getRepository(Cycle::class)->find($cycleId);

        if (!$cycle) {
            throw $this->createNotFoundException(
                'No product found for id '.$cycleId
            );
        }

        $cycle->setName('New cycle name!');
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

}
