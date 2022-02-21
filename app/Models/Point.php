<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
   public function getTeamName()
   {
       return Team::find($this->team_id)->name;
   }
}
