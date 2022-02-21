<?php

namespace App\Repositories;

use App\Base\Contract\IFixture;
use App\Models\Matche;
use App\Models\Point;
use App\Models\Team;
use App\Models\Week;

class FixtureRepository implements IFixture
{

    protected $teams;
    protected $weeks;

    public function createFixtures(array $teams, object $weeks)
    {
        $this->teams = $teams;
        $this->weeks = $weeks;
        $numberOfWeeks = $this->getNumberOfWeeks(count($this->teams));
        $numberOfWeeklyFixtures = $this->getNumberOfWeeklyFixtures(count($this->teams));
        $allFixtures = $this->makeAllFixtures();
        shuffle($allFixtures); // Karıştırıyor
        $weeklyFixtures = $this->makeWeekFixtures($numberOfWeeks, $numberOfWeeklyFixtures, $allFixtures);
        $fixtures = $this->flatFixtures($weeklyFixtures);
        foreach ($fixtures as $fixture) {
            $matche = new Matche();
            $matche->homeowner_team_id = $fixture['home'];
            $matche->guestowner_team_id = $fixture['guest'];
            $matche->week_id = $fixture['week'];
            $matche->save();
        }
        $teams = Team::all();
        foreach ($teams as $value) {
            $point = new Point();
            $point->team_id = $value->id;
            $point->save();
        }
    }


    public function getNumberOfWeeks($teams)
    {
        if ($teams % 2 == 0) {
            return ($teams - 1) * 2;
        }
        return ($teams - 1) / 2;
    }

    public function getNumberOfWeeklyFixtures($teams)
    {
        return $teams / 2;
    }

    public function makeAllFixtures()
    {
        $fixtures = [];
        foreach ($this->teams as $homeownerteam) {
            foreach ($this->teams as $guestownerteam) {
                if ($homeownerteam === $guestownerteam) {
                    continue;
                }
                $fixtures[] = [
                    'home' => $homeownerteam,
                    'guest' => $guestownerteam,
                    'used' => 0
                ];
            }
        }
        return $fixtures;
    }

    public function makeWeekFixtures(int $numberOfWeeks, int $numberOfWeeklyFixtures, array $allFixtures)
    {
        $createWeekFixtures = [];
        for ($i = 1; $i <= $numberOfWeeks; $i++) {
            for ($k = 1; $k <= $numberOfWeeklyFixtures; $k++) {
                foreach ($allFixtures as &$fixture) {
                    if ($fixture['used'] === 1) {
                        continue;
                    }
                    $flag = false;
                    if (!count($createWeekFixtures) === 0 || array_key_exists($i, $createWeekFixtures)) {
                        $flag = $this->matchDuplicatedWeek($fixture, $createWeekFixtures[$i], $i);
                    }
                    if ($flag) {
                        continue;
                    }
                    $createWeekFixtures[$i][] = [
                        'home' => $fixture['home'],
                        'guest' => $fixture['guest'],
                        'week' => $i,
                        'match_status' => 0
                    ];
                    $fixture['used'] = 1;
                    break;
                }
            }
        }
        return $createWeekFixtures;
    }


    public function matchDuplicatedWeek($fixture, $allFixtures): bool
    {
        $response = false;
        foreach ($allFixtures as $f) {
            if (
            (
                ($fixture['home'] == $f['home'] || $fixture['home'] == $f['guest']) ||
                ($fixture['guest'] == $f['guest'] || $fixture['guest'] == $f['home'])
            )
            ) {
                $response = true;
                break;
            }
        }
        return $response;
    }

    public function flatFixtures($fixtures)
    {
        $flatFixturesArray = [];
        $allWeekFixtures = array_values($fixtures);
        foreach ($allWeekFixtures as $weekFixtures) {
            foreach ($weekFixtures as $fixture) {
                $flatFixturesArray[] = $fixture;
            }
        }

        return $flatFixturesArray;
    }

    public function allMatches()
    {
        $point =   Point::all();
        foreach($point as $item)
        {
            $data[] = array(
                'team' => $item->getTeamName(),
                'played' => $item->played,
                'drawn' => $item->drawn,
                'lost' => $item->lost,
                'point' => $item->point,
                'dg' => $item->dg,
                'won' => $item->won,
            );
        }
        return $data;
    }


    public function getWeekMatch()
    {
        $weeks = Week::all();
        foreach ($weeks as $week) {
            $data[] = array(
                'id' => $week->id,
                'name' => $week->week,
                'team' => $this->getTeam($week->id),
            );

        }
        return $data;
    }

    public function getTeam($id)
    {
        $matches = Matche::where('week_id', $id)->get();
        foreach ($matches as $match) {
            $data[] = array(
                'homeowner_name' => $match->homeownerteamname(),
                'guestowner_name' => $match->guestownerteamname(),
            );
        }
        return $data;
    }


}
