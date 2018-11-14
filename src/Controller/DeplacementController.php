<?php

namespace App\Controller;

use App\Entity\Deplacement;
use App\Entity\PleinCarburant;
use App\Form\DeplacementType;
use App\Form\PleinCarburantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeplacementController
 * @package App\Controller
 * @Route("/deplacement")
 * @Security("has_role('ROLE_USER')")
 */

class DeplacementController extends Controller
{
    /**
     * @Route("/new", name="new-deplacement")
     */
    public function newDeplacement(Request $request)
    {
        /* Création d'un déplacement vide */
        $deplacement = new Deplacement();
        /* Création du formulaire */
        $form = $this->createForm(DeplacementType::class, $deplacement);
        $form
            ->remove('date_retour')
            ->remove('kilometrage_retour')
            ->remove('lieu_retour')
            ->remove('pleins_carburant');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deplacement = $form->getData();
            $deplacement->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deplacement);
            $entityManager->flush();

            return $this->redirectToRoute('user');
        }
        return $this->render('deplacement/new-deplacement.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/back", name="back-deplacement")
     */
    public function backDeplacement(Request $request)
    {
        /* Création d'un retour */
        $deplacement = new Deplacement();
        /* Création du formulaire */
        $form = $this->createForm(DeplacementType::class, $deplacement);
        $form
            ->remove('date_depart')
            ->remove('kilometrage_depart')
            ->remove('lieu_depart')
            ->remove('nature');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deplacement = $form->getData();
            $deplacement->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deplacement);
            $entityManager->flush();

            return $this->redirectToRoute('user');
        }
        return $this->render('deplacement/back-deplacement.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/plein-carburant", name="plein-carburant")
     */
    public function pleinCarburant(Request $request)
    {
        /* Création d'un plein de carburant */
        $plein = new PleinCarburant();
        /* Création du formulaire */
        $form = $this->createForm(PleinCarburantType::class, $plein);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plein = $form->getData();
            $plein->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plein);
            $entityManager->flush();

            return $this->redirectToRoute('user');
        }
        return $this->render('Carburant/plein-carburant.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
