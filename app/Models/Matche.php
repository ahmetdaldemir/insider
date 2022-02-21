<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{

    public function homeownerteamname()
    {
        return Team::find($this->homeowner_team_id)->name;
    }

    public function guestownerteamname()
    {
        return Team::find($this->guestowner_team_id)->name;
    }
}
