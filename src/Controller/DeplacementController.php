<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DeplacementController extends Controller
{
    /**
     * @Route("/deplacement", name="deplacement")
     */
    public function index()
    {
        return $this->render('deplacement/index.html.twig', [
            'controller_name' => 'DeplacementController',
        ]);
    }
}
