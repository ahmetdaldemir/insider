<?php


namespace App\Base\Contract;


interface IFixture
{
    public function createFixtures(array $teams, object $weeks);
    public function allMatches();
}
