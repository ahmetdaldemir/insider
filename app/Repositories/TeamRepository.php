<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\Contract\ITeam;

class TeamRepository implements ITeam
{

    public function get($id)
    {
        $team = Team::find($id);
        return $team;
    }

    public function all()
    {
        $team = Team::all();
        return $team;
    }

    public function delete($id)
    {
        $team = Team::find($id);
        $team->delete($id);
        return $team;
    }

    public function create(object $data)
    {
        $team = new Team();
        $team->name = $data->name;
        $team->save();
    }

    public function update(object $data)
    {
        $team = Team::find($data->id);
        $team->name = $data->name;
        $team->save();
    }
}
