<?php

namespace App\Controller;

use App\Entity\Deplacement;
use App\Form\DeplacementType;
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
}
