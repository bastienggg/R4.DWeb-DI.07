<?php

/* indique où "vit" ce fichier */
namespace App\Controller;

/* indique l'utilisation du bon bundle pour gérer nos routes */
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

/* le nom de la classe doit être cohérent avec le nom du fichier */
class TestController
{
    // L'attribute #[Route] indique ici que l'on associe la route
    // "/" à la méthode home() pour que Symfony l'exécute chaque fois
    // que l'on accède à la racine de notre site.

    #[Route('/', name: 'home')]
    public function home(): Response
    {
    return new Response(
        '<html><head><style>body { font-family: Arial, sans-serif; background-color: #f0f0f0; text-align: center; padding: 50px; } h1 { color: #333; } p { color: #666; }</style></head><body><h1>Welcome to my homepage!</h1><p>This is a beautiful HTML page.</p></body></html>'
    );
}
    #[Route('/bastieng', name: 'bastieng')]
    public function me()
    {
        die("bastieng");
    }
}
?>
