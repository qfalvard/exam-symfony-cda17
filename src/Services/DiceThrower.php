<?php

namespace App\Services;


use Symfony\Component\Config\Definition\Exception\Exception;

class DiceThrower
{
    /**
     * @param int $nbDice
     * @param int $nbFacet
     * @return array
     */
    public function rollDices(int $nbDice, int $nbFacet)
    {
        $results = [];
        if ($nbDice > 0 && $nbFacet > 1) {
            for ($i = 1; $i <= $nbDice; $i++) {
                $results[] = mt_rand(1, $nbFacet);
            }
        }
        return $results;
    }

    public function roolHundred(int $nbDice)
    {
        $results = [];
        if ($nbDice > 0) {
            for ($i = 1; $i <= $nbDice; $i++) {
                $results[] = mt_rand(1, 100);
            }
        } else {
            throw new Exception('Vous devez envoyer au moins un dé');
        }
        return $results;
    }

    public function bestResult(array $result)
    {
        sort($result);
        return array_pop($result);
    }

    public function worstResult(array $result)
    {
        rsort($result);
        return array_pop($result);
    }
}

