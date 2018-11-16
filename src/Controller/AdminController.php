<?php

namespace App\Controller;

use App\Repository\DeplacementRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/accueil.html.twig', [
        ]);
    }

    /**
     * @Route("/stats/nature-deplacements", name="nature-deplacements")
     */
    public function natureDeplacements(DeplacementRepository $deplacementRepository) {
        $statsNbr = $deplacementRepository->getStatsNatureDeplacementsNbr();
        $statsKilometrage = $deplacementRepository->getStatsNatureDeplacementsKilometrage();
        return $this->render('graphic/nature-deplacement.html.twig', [
            'statsNbr' => $statsNbr,
            'statsKilometrage' => $statsKilometrage
        ]);
    }
    /**
     * @Route("/stats/jours-util-vehicule", name="jours_util_vehicule")
     */
    public function joursUtilVehicule(DeplacementRepository $deplacementRepository) {
        $stats = $deplacementRepository->getStatsJoursUtilisationByVehicules();
        dump($stats);

        return $this->render('graphic/jours-utils-vehicule.html.twig', [
            'stats' => $stats,
        ]);
    }
}
