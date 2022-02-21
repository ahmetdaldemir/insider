<?php


namespace App\Http\Controllers;


use App\Models\Team;
use App\Repositories\Contract\ITeam;
use App\Repositories\Contract\IWeek;
use App\Repositories\FixtureRepository;
use App\Services\SimilatationService;
use Illuminate\Http\Request;

class HomeController
{
    private $teamRepository;
    private $weekRepository;
    private $fixtureRepository;

    public function __construct(ITeam $teamRepository, IWeek $weekRepository, FixtureRepository $fixtureRepository)
    {
        $this->weekRepository = $weekRepository;
        $this->teamRepository = $teamRepository;
        $this->fixtureRepository = $fixtureRepository;
    }

    public function weeks()
    {
        return view('weeks');
    }

    public function teams()
    {
        return view('teams');
    }

    public function match()
    {
        return view('matches');
    }

    public function fixtures()
    {
        return view('fixtures');
    }


    public function allweek()
    {
        return $this->weekRepository->all();
    }


    public function allteam()
    {
        return $this->teamRepository->all();
    }

    public function allMatches()
    {
        return $this->fixtureRepository->allMatches();
    }

    public function getWeekMatch()
    {
        return $this->fixtureRepository->getWeekMatch();
    }

    public function createSimulate()
    {
        $matches = $this->fixtureRepository->allMatches();
        $simulator = new SimilatationService();
        $simulator->simulateAllMatches($matches);
    }

    public function crud(Request $request)
    {
        $data = "";
        if ($request->model == "Week") {
            $data = $this->weekRepository->create($request);
        } else if ($request->model == "Team") {
            $data = $this->teamRepository->create($request);
        }
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function createfixture()
    {
        $teams = Team::all()->pluck('id')->toArray();
        $weeks = $this->weekRepository->all();
        $data = $this->fixtureRepository->createFixtures($teams, $weeks);
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function simulate(Request $request)
    {
        if ($request->week == "all") {
            $matches = $this->fixtureRepository->allMatches();
            $build = new SimilatationService($this->fixtureRepository, $this->matchRepository);
            $build->simulateAllMatches($matches);
        } else {
            $matches = $this->fixtureRepository->getWeekMatch($request->week);
            $matchSimulator = new SimilatationService($this->fixtureRepository, $this->matchRepository);
            $matchSimulator->simulateAllMatches($matches);
        }
        $data = $this->fixtureRepository->generateFixturesPlan($matches);
        return response()->json(['status' => 'ok', 'data' => $data], 200);
    }
}
