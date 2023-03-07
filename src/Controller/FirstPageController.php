<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FirstPageController
extends AbstractController
{
    // TODO : add action
    #[Route('/firstpage/hasardannot')]

    public function hasardAnnot(): Response
    {
        $number = random_int(100, 200);
        return new Response(
            '<html><body>
                <p>FirstPage.HasardAnnot():' . $number . '<p>
                </body></html>'
        );
    }
    #[Route('/', name: 'hasard')]
    public function hasard(): Response
    {
        $number = mt_rand(200, 300);
        $message = 'Je suis un nombre complètement aléatoire';
        return $this->render('first_page/hasard.html.twig', ['number' => $number, 'message' => $message]);
    }
}