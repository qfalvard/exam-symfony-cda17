<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use App\Services\ActionResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("battle")
 */
class BattleController extends AbstractController
{
    private $actionResolver;

    /**
     * BattleController constructor.
     * @param $actionResolver
     */
    public function __construct(ActionResolver $actionResolver)
    {
        $this->actionResolver = $actionResolver;
    }


    /**
     * @Route("/", name="battle_test")
     * @param CharacterRepository $characterRepository
     * @return Response
     * @throws \Exception
     */
    public function test(CharacterRepository $characterRepository): Response
    {
        $gimli = $characterRepository->findOneBy(['name' => 'Gimli']);
        $legolas = $characterRepository->findOneBy(['name' => 'Legolas']);

        $runs = $this->runBattle($gimli, $legolas);

        return $this->render('battle/test.html.twig', [
            'gimli'   => $gimli,
            'legolas' => $legolas,
            'runs'    => $runs,
        ]);
    }

    /**
     * @param Character $gimli
     * @param Character $legolas
     *
     * @return array
     * @throws \Exception
     */
    protected function runBattle(Character $gimli, Character $legolas): array
    {
        $attacks = [];

        while (!$gimli->hasGivenUp() && !$legolas->hasGivenUp()) {
            $attacks[] = $this->runAttack($legolas, $gimli);

            if (!$gimli->hasGivenUp()) {
                $attacks[] = $this->runattack($gimli, $legolas);
            }
        }

        return $attacks;
    }

    /**
     * @throws \Exception
     */
    protected function runAttack(Character $attacker, Character $defender): array
    {
        $damage = $this->actionResolver->attack($attacker, $defender);
        if ($damage > 0) {
            $defender->getHit($damage);
        }

        return [
            'attacker'     => $attacker->getName(),
            'defender'     => $defender->getName(),
            'damage'       => $damage,
            'attackerWins' => $defender->hasGivenUp(),
        ];
    }
}
