<?php

namespace App\Controller;

use App\Entity\Deplacement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     * @Security("has_role('ROLE_USER')")
     */
    public function index()
    {
        $lastDeplacements = $this->getDoctrine()->getRepository(Deplacement::class)->getLastDeplacementsForUser($this->getUser());
        return $this->render('user/index.html.twig', [
            'deplacements' => $lastDeplacements
        ]);
    }

}
