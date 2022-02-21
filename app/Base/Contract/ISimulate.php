<?php
namespace App\Base\Contract;

interface ISimulate
{
    public function simulate($match);
    public function simulateAllMatches($matches);
}
