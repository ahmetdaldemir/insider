<?php
namespace App\Repositories;

use App\Models\Week;
use App\Repositories\Contract\IWeek;

class WeekRepository implements IWeek
{

    public function get($id)
    {
        $week = Week::find($id);
        return $week;
    }

    public function all()
    {
        $week = Week::all();
        return $week;
    }

    public function delete($id)
    {
        $week = Week::find($id);
        $week->delete($id);
        return $week;
    }

    public function create(object $data)
    {
        $week = new Week();
        $week->week = $data->week;
        $week->save();
    }

    public function update(object $data)
    {
        $week = Week::find($data->id);
        $week->week = $data->week;
        $week->save();
    }
}
