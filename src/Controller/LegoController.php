<?php

namespace App\Controller;

use App\Entity\Lego;
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

        // Vérifiez si l'utilisateur est connecté
        if ($this->getUser()) {
            // Utilisateur connecté, récupérer toutes les catégories
            $legos = $legoService->findAll();
        } else {
            // Utilisateur non connecté, exclure la catégorie premium
            $legos = $legoService->findAllExcludingPremium();
        }

        $collections = $collectionRepository->findAll();
        foreach ($legos as $lego) {
            $response->setContent($response->getContent() . $this->renderView('lego.html.twig', [
                'lego' => $lego,
                'collections' => $collections
            ]));
        }
        return $response;
    }

    #[Route('/collections/{id}', name: 'filter_by_collection')]
    public function filter(int $id, LegoCollectionRepository $collectionRepository): Response
    {
        $legoCollection = $collectionRepository->find($id);
        if (!$legoCollection) {
            throw $this->createNotFoundException('Collection not found');
        }

        $legos = $legoCollection->getLego();
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

    // Supprimer la route de test
    // #[Route('/collection', name: 'test')]
    // public function test(LegoCollectionRepository $collectionRepository): Response
    // {
    //     $collections = $collectionRepository->findAll();
    //     return $this->render('collections.html.twig', ['collections' => $collections]);
    // }
}
?>