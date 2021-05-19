<?php

namespace App\Services;

use App\Entity\Character;
use App\Services\DiceThrower;


class ActionResolver{

    private $diceThrower;

    /**
     * ActionResolver constructor.
     * @param \App\Services\DiceThrower $diceThrower
     */
    public function __construct(DiceThrower $diceThrower)
    {
        $this->diceThrower = $diceThrower;
    }

    public function attack(Character $attacker, Character $defender) {
        $attackerDice = $this->diceThrower->bestResult($this->diceThrower->rollDices(2,100));
        if ($attackerDice > $attacker->getStrength()){
            return null;
        } else {
            $defenseurDice = $this->diceThrower->roolHundred(1);
            if ($defenseurDice < $defender->getDefense()){
                return null;
            }
            $damage = array_sum($this->diceThrower->rollDices(6,6));
            return $damage;
        }
    }
}
