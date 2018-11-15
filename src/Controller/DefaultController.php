<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/error", name="error")
     */
    public function error(Request $request)
    {
        $error = $request->get('error');
        if (!$error) {
            $error = 'Erreur !';
        }
        return $this->render('default/error.html.twig', [
            'error' => $error,
        ]);
    }
}
