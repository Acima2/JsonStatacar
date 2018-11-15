<?php

namespace App\Controller;

use App\Entity\Deplacement;
use App\Entity\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends Controller
{
    /**
     * @Route("/vehicule/{id}", name="vehicule")
     */
    public function statVehicule(Vehicule $vehicule)
    {
        $kilometrage = $this->getDoctrine()->getRepository(Deplacement::class)->getKilometrageVehicule($vehicule);
        return $this->render('graphic/vehicule.html.twig', [
            'kilometrage'=>$kilometrage,
        ]);
    }
}
