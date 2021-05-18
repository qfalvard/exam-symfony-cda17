<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BugController extends AbstractController
{
    /**
     * @Route("/bug", name="bug")
     */
    public function index(): Response
    {
        // On injecte le service "CharacterRepository"
        $characterRepository = $this->getCharacterRepository();
        // On injecte le service "DiceThrower"
        $diceThrower = $this->getDiceThrower();
        // On récupère la liste des personnages
        $characters = $characterRepository->findBy([
            'strentgh' => 'DESC',
        ]);
        // On affiche la vue
        return $this->render('bug/index.html.twig');
    }
}
