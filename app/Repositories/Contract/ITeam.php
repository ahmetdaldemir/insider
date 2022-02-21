<?php


namespace App\Repositories\Contract;


interface ITeam
{
    public function get($id);

    public function all();

    public function delete($id);

    public function create(object $data);

    public function update(object $data);
}
