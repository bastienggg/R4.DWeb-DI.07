<?php

namespace App\Controller;

use App\Entity\Lego; // Ensure that the Lego class is correctly defined in the App\Entity namespace
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\LegoRepository;
use App\Repository\LegoCollectionRepository;
use App\Entity\LegoCollection;

class LegoController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(LegoRepository $legoService, LegoCollectionRepository $collectionRepository): Response
    {
        $response = new Response();
        $legos = $legoService->findAll();
        $collections = $collectionRepository->findAll();
        foreach ($legos as $lego) {
            $response->setContent($response->getContent() . $this->renderView('lego.html.twig', [
                'lego' => $lego,
                'collections' => $collections
            ]));
        }
        return $response;
    }

    #[Route('/{collection}', name: 'filter_by_collection', requirements: ['collection' => 'creator|star_wars|creator_expert'])]
    public function filter(string $collection, LegoCollectionRepository $collectionRepository): Response
    {
        if ($collection == 'star_wars') {
            $collection = 'Star Wars';
        } else if ($collection == 'creator_expert') {
            $collection = 'creator expert';
        }

        $legoCollection = $collectionRepository->findOneBy(['name' => $collection]);
        if (!$legoCollection) {
            throw $this->createNotFoundException('Collection not found');
        }

        $legos = $legoCollection->getLegos();
        $collections = $collectionRepository->findAll();

        $response = new Response();
        foreach ($legos as $lego) {
            $response->setContent($response->getContent() . $this->renderView('lego.html.twig', [
                'lego' => $lego,
                'collections' => $collections
            ]));
        }
        return $response;
    }

    #[Route('/collection', name: 'test')]
    public function test(LegoCollectionRepository $collectionRepository): Response
    {
        $collections = $collectionRepository->findAll();
        return $this->render('collections.html.twig', ['collections' => $collections]);
    }
}
?>