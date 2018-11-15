<?php

namespace App\Controller;

use App\Entity\Deplacement;
use App\Entity\User;
use App\Entity\PleinCarburant;
use App\Form\DeplacementType;
use App\Form\PleinCarburantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

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
        /* Récupèration de l'utilisateur connecté */
        $user = $this->getUser();
        /* Test si un déplacement est déjà en cours */
        if($user->hasActiveDeplacement())
        {
            return $this->redirectToRoute("error", [
                "error" => "Vous avez déjà un déplacement en cours, ne jouez pas au plus fin avec Json Statacar !"
            ]);
        }
        /* Création d'un déplacement vide */
        $deplacement = new Deplacement();
        $deplacement->setDateDepart(new \DateTime());
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
            $deplacement->setChauffeur($user);
            $user->setActiveDeplacement(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deplacement);
            $entityManager->persist($user);
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
        /* Récupération de l'utilisateur connecté */
        $user = $this->getUser();
        /* Test si un déplacement est déjà en cours */
        if(!$user->hasActiveDeplacement())
        {
            return $this->redirectToRoute("error", [
                "error" => "Vous n'avez pas de déplacement en cours, ne jouez pas au plus fin avec Json Statacar !"
            ]);
        }
        /* Création d'un retour */
        $deplacement = $this->getDoctrine()->getRepository(Deplacement::class)
            ->getActiveDeplacementForUser($$user);
        $deplacement->setDateRetour(new \DateTime());
        /* Création du formulaire */
        $form = $this->createForm(DeplacementType::class, $deplacement);
        $form
            ->remove('date_depart')
            ->remove('kilometrage_depart')
            ->remove('lieu_depart')
            ->remove('nature')
            ->remove('vehicule');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deplacement = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $user->setActiveDeplacement(false);
            $entityManager->persist($deplacement);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user');
        }
        return $this->render('deplacement/back-deplacement.html.twig', ['form' => $form->createView(),]);
    }


    /**
     * @Route("/full-tank", name="plein-carburant")
     */
    public
    function pleinCarburant(Request $request)
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
