<?php

namespace App\Services;

use App\Base\Contract\ISimulate;
use App\Models\Point;

class SimilatationService implements ISimulate
{

    public function simulate($match)
    {
        // TODO: Implement simulate() method.
    }

    public function simulateAllMatches($matches)
    {
        foreach ($matches as $match) {
            $home = Point::where('team_id', $match->homeowner_id)->first();
            $guest = Point::where('team_id', $match->guestowner_id)->first();
            $homeOwnerScore = rand(0, 5);
            $guestOwnerScore = rand(0, 6);
            $home->played += 1;
            $home->save();
            $guest->played += 1;
            $guest->save();
            $this->updateMatchScore($homeOwnerScore, $guestOwnerScore, $home, $guest);
            $this->resultSaver($match, $homeOwnerScore, $guestOwnerScore);
        }
    }

    public function updateMatchScore($homeOwnerScore, $guestOwnerScore, $home, $guest)
    {
        $goalDrawn = abs($guestOwnerScore - $homeOwnerScore);
        if ($homeOwnerScore > $guestOwnerScore) {
            $home->won = $goalDrawn;
            $guest->lost = $goalDrawn;

        } elseif ($guestOwnerScore > $homeOwnerScore) {
            $guest->won = $goalDrawn;
            $home->lost = $goalDrawn;
        } else {
            $home->drawn = "1";
            $guest->drawn = "1";
        }

        $home->save();
        $guest->save();
    }

    public function resultSaver($match, $homeOwnerScore, $guestOwnerScore)
    {
        $match->homeowner_team_goals = $homeOwnerScore;
        $match->guestowner_team_goals = $guestOwnerScore;
        $match->match_status = 1;
        return $match->save();
    }

}
