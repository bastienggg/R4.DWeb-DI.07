<?php

namespace App\Controller;

use App\Entity\Lego; // Ensure that the Lego class is correctly defined in the App\Entity namespace
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\LegoRepository;


class LegoController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(LegoRepository $legoService): Response
    {
        $response = new Response();
        $legos = $legoService->findAll();
        foreach ($legos as $lego) {
            $response->setContent($response->getContent() . $this->renderView('lego.html.twig', ['lego' => $lego]));
        }
        return $response;
    }

    #[Route('/{collection}', name: 'filter_by_collection', requirements: ['collection' => 'creator|star_wars|creator_expert'])]
    public function filter(string $collection, LegoRepository $legoService): Response
    {
        $response = new Response();
        if ($collection == 'star_wars') {
            $collection = 'Star Wars';
        } else if ($collection == 'creator_expert') {
            $collection = 'creator expert';
        }
        $legos = $legoService->findByCollection($collection);
        foreach ($legos as $lego) {
            $response->setContent($response->getContent() . $this->renderView('lego.html.twig', ['lego' => $lego]));
        }
        return $response;
    }

    #[Route('/me', name: 'me')]
    public function me()
    {
        die("BradSavary");
    }
}
?>