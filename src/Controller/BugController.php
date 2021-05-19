<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use App\Services\DiceThrower;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BugController extends AbstractController
{
    /**
     * @Route("/bug", name="bug")
     * @param CharacterRepository $characterRepository
     * @param DiceThrower $diceThrower
     * @return Response
     */
    public function index(CharacterRepository $characterRepository, DiceThrower $diceThrower): Response
    {
        $characters = $characterRepository->findAll();

        // On affiche la vue
        return $this->render('bug/index.html.twig', [
            'characters' => $characters,
            'diceThrower' => $diceThrower
        ]);
    }
}
