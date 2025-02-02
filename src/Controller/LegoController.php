<?php

namespace App\Controller;

use App\Entity\Lego; // Ensure that the Lego class is correctly defined in the App\Entity namespace
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\LegoService;


class LegoController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(LegoService $legoService): Response
    {
        $lego = $legoService->getLego();
        return $this->render('lego.html.twig', ['lego' => $lego]);
    }

    #[Route('/bastieng', name: 'bastieng')]
    public function me()
    {
        die("bastieng");
    }
}
